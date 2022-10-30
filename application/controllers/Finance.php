<?php
defined('BASEPATH') or exit('No direct script access allowed');


require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->library('upload');


        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Finance_m');
    }



    public function PoDoList()
    {
        $data['title']          = "Purchase Order & Delivery Order List";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));


        $data['listreq'] = $this->Finance_m->get_all_po_do_list_req();

        $data['listapv'] = $this->Finance_m->get_all_po_do_list_apv();


        $this->load->view('Finance/PoDoList', $data);
    }


    public function PoDoReq_Review($id = NULL)
    {
        $kode_po_do = Decrypt_url($id);


        $podotype = $this->Finance_m->chekcpodotype($kode_po_do);



        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));


        if ($podotype['po_do_type'] == 1) {

            redirect('Finance/PoDoReq_Review_D1/' . $kode_po_do);
        } else {


            redirect('Finance/PoDoReq_Review_D2/' . $kode_po_do);
        }
    }


    public function PoDoReq_Review_D1($kode_po_do)
    {

        $data['title']          = "Purchase Order & Delivery Review";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Finance_m->get_all_po_do_list_D1($kode_po_do);



        $data['pododata']     = $this->Finance_m->get_podo_data($kode_po_do);



        $this->load->view('Finance/PoDoReq_Review_D1', $data);
    }

    public function PoDoReq_Review_D2($kode_po_do)
    {

        $data['title']          = "Purchase Order & Delivery Review";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Finance_m->get_all_po_do_list_D2($kode_po_do);
        $data['pododata']     = $this->Finance_m->get_podo_data($kode_po_do);





        $this->load->view('Finance/PoDoReq_Review_D2', $data);
    }


    public function PostPoDo_Review_Upd()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $kode_po_do = $this->input->post('kodepodo');

        $dataupdate = [
            'status_po_do' => 'REQ APV',
            'note_review' => $this->input->post('notereview'),
            'user_proses' => $username,
            'date_proses' =>  date('Y-m-d H:i:s')

        ];


        $this->Finance_m->PostPoDo_Review_Upd_M($kode_po_do, $dataupdate);

        $this->session->set_flashdata('message', '
             <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>Success!</h5>
                ' . $kode_po_do . ' Sudah Masuk List Approval BOD.
              </div> ');

        redirect('Finance/PoDoList');
    }








    public function Operational()
    {
        $data['title']          = "Operational Cash Flow";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $this->load->view('Finance/Operational', $data);
    }



    public function Billing()
    {
        $data['title']          = "Billing Customer";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['listfileuplaod'] = $this->Finance_m->get_all_list_file_upload();
        $data['dataunposting'] = $this->Finance_m->get_data_upload_unposting();
        $data['checkposting'] = $this->Finance_m->checkposting()->num_rows();



        $this->load->view('Finance/Billing', $data);
    }


    public function BillingUpload()
    {


        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $checkposting = $this->Finance_m->checkposting()->num_rows();



        if ($checkposting == 1) {

            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Warning!</h5>
                 File Sebelumnya Belum Terposting </div> ');

            redirect('Finance/Billing');
        } else {

            $config['upload_path']   = './assets/upload/billing/';
            $config['allowed_types'] = 'xlsx|xls';
            $config['max_size']     = '3072';   // data tidak lebih dari 3 MB
            $config['file_name']     = "BILL_" . time();
            $config['overwrite']     = TRUE;


            $this->upload->initialize($config);

            if (!$this->upload->do_upload('billing')) {

                $error = array('error' => $this->upload->display_errors());

        
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-info"></i>Danger !</h5>
                 Your File not Required! </div> ');

                redirect('Finance/Billing');
            } else {

                $datafile = [
                    'nama_file' => $this->upload->data('file_name'),
                    'is_posting' => 0,
                    'user_upload' => $this->session->userdata('username'),
                    'date_upload'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('billing_upload', $datafile);

                //  mkdir("./assets/upload/billing/" .$datafile['nama_file'], 0777, true);

                $reader = ReaderEntityFactory::createXLSXReader();
               
                $reader->open('assets/upload/billing/' . $datafile['nama_file']);
                $reader->setShouldFormatDates(true);
                foreach ($reader->getSheetIterator() as $sheet) {
                    $numRow = 1;

                   

                    foreach ($sheet->getRowIterator() as $row) {
                        if ($numRow > 1) {

                       


                            $databilling = array(
                                'nama_file'                     => $datafile['nama_file'] . '',
                                'contract_no'                   => $row->getCellAtIndex(0),
                                'installment_no'                => $row->getCellAtIndex(1),
                                'amount'                        => $row->getCellAtIndex(2),
                                'date_payment'                  => $row->getCellAtIndex(3),
                                'bank_account'                  => $row->getCellAtIndex(4),
                            );
 
                             $this->Finance_m->importdatabilling($databilling);
                        }
                   
                        $numRow++;
                       
                    }
                    $reader->close();


                  unlink('assets/upload/billing/'.$datafile['nama_file']);    //( jika file ingin langsung di delte ketika sesudah di insert ke table)

                }



                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload File Billing',
                    'url'        => base_url('Finance/Billing'),
                    'object'     =>  $config['file_name'],
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);


                $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Success!</h5>
                 Data Success Upload! </div> ');

                redirect('Finance/Billing');
            }
        }
    }





    public function ResetBillingUpload()
    {


        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $checkposting = $this->Finance_m->checkposting()->row_array();

        $namafile = $checkposting['nama_file'];

        $this->Finance_m->cleasingdata_dataupload($namafile);
        $this->Finance_m->cleasingdata_dataupload_list($namafile);


        unlink('assets/upload/billing/' . $namafile);    // hapus file 

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Reset File Billing',
            'url'        => base_url('Finance/ResetBillingUpload'),
            'object'     =>  $namafile,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);


        $this->session->set_flashdata('message', '
           <div class="alert alert-info alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data Success Di Reset! </div> ');

        redirect('Finance/Billing');
    }


    public function PostingBillingUpload()
    {


        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $checkposting = $this->Finance_m->checkposting()->row_array();

        $namafile = $checkposting['nama_file'];
        $this->Finance_m->update_dataInstallment($namafile);

        $dataupdate1 = [
            'is_posting' => 1,
            'user_posting' => $this->session->userdata('username'),
            'date_posting' => date('Y-m-d H:i:s')

        ];
        $this->Finance_m->update_dataupload($namafile, $dataupdate1);



        unlink('assets/upload/billing/' . $namafile);    // hapus file 

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Upload File Billing',
            'url'        => base_url('Finance/ResetBillingUpload'),
            'object'     =>  $namafile,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data Success Di Posting! </div> ');
        redirect('Finance/Billing');
    }




    public function PrintPodoListDone($id = NULL)
    {
        $kode_po_do = Decrypt_url($id);


        $this->Finance_m->get_all_po_do_list_DONE($kode_po_do);

        $this->Finance_m->get_all_po_do_list_f_done($kode_po_do);

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
         <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h5><i class="icon fas fa-check"></i>Success!</h5>
         PO DO Done Process! </div> ');

        redirect('Finance/PoDoList');
    }



    public function PrintPodoList($id = NULL)
    {

        $kode_po_do = Decrypt_url($id);

        $data['title']    = "PO DO" . $kode_po_do;

        $data['datapodo']  = $this->Finance_m->pododatamain($kode_po_do);



        if ($data['datapodo']['po_do_type'] == 1) {


            $data['datapododetail']  = $this->Finance_m->podopermohonandana($kode_po_do);
        } else {

            $data['datapododetail']  = $this->Finance_m->pododatasupplier($kode_po_do);
        }




        // update is print di podo
        // abil detail data podo 


        $this->Finance_m->update_isprint_podo($kode_po_do);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrain');
        $this->pdf->filename = "Print_" . $kode_po_do . ".pdf";
        $this->pdf->load_view('PDF/PoDoProcess', $data);
    }
}
