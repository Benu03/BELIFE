<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Transaction_m');
        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Feature_m');
        $this->load->model('Finance_m');
    }

    public function index()
    {
        $this->OrderProcess();
    }

    public function OrderProcess()
    {
        $data['title']      = "List Data Orders";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Dataorders']  = $this->Transaction_m->get_all_orders();

        $this->load->view('Transaction/DataOrders', $data);
    }


    public function DetailOrder($id)
    {



        $data['title']      = "Detail Data Orders";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Dataorders']  = $this->Transaction_m->get_all_detail_orders($id);

        $data['Dataorders_item']  = $this->Transaction_m->get_all_detail_order_item($id);


        $data['totalharga']    = $this->Transaction_m->get_data_totalharga($id)->row_array();

        $data['fintech'] = $this->DataMaster_m->get_all_fintect();


        $this->load->view('Transaction/DetailDataOrders', $data);
    }


    public function ApproveOrder()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username               = $data['usrProfile']['username'];
        $kode_order             = $this->input->post('kode_order');





        $this->form_validation->set_rules('fintech', 'Fintech', 'required');
        $this->form_validation->set_rules('cutoffdate', 'Tanggal Cut Off', 'required');

        if ($this->form_validation->run() == false) {

            $this->DetailOrder($kode_order);
        } else {



            $dataupdate = [

                'status_order'  => 'APPROVE',
                'note_order'     => $this->input->post('noteorder'),
                'id_fintech'       => $this->input->post('fintech'),
                'user_proses'       => $this->session->userdata('username'),
                'date_proses'       => date('Y-m-d H:i:s')
            ];

            $DateCutOff = $this->input->post('cutoffdate');

        

            $kode_shipping =  $this->Transaction_m->getkodeshipping($kode_order);
            $kode_shippingpost =  $kode_shipping['kode_shipping'];
            $this->Transaction_m->updateapproval($kode_order, $dataupdate);
            $this->Transaction_m->updateshipping($kode_shippingpost);

            $contractno = $this->Transaction_m->getcontrackno();
            $dataorderdetail = $this->Transaction_m->getdataorderdetail($kode_order);



            $datacontract = [
                'contract_no'           => $contractno,
                'user_order'            => $dataorderdetail['user_order'],
                'date_order'            => $dataorderdetail['date_order'],
                'kode_order'            => $dataorderdetail['kode_order'],
                'total_amount'          => $dataorderdetail['total_order'],
                'tenor'                 => $dataorderdetail['tenor'],
                'angsuran'              => $dataorderdetail['angsuran'],
                'admin_cost'            => $dataorderdetail['admin_cost'],
                // 'shipping_cost'      => $dataorderdetail['date_order'],
                'status_contract'       => 'GOLIVE',
                'id_fintech'            => $dataorderdetail['id_fintech'],
                // 'id_ekspedisi'       => $dataorderdetail['date_order'],
                'user_approve'          => $dataorderdetail['user_proses'],
                'date_approve'          => $dataorderdetail['date_proses'],
                'kode_shipping'         => $dataorderdetail['kode_shipping'],
                'status_pengiriman'     => 'PROSPECT',
                'user_post'             => $this->session->userdata('username'),
                'date_post'             => date('Y-m-d H:i:s')

            ];

            

            // $this->db->insert('contract', $datacontract);

            // $duedateadjustment =  date('Y-m-25');        
            $duedateadjustment =  date('Y-m-'.$DateCutOff); 
            $datainstallment = array();
            $tenor = $dataorderdetail['tenor'];
        

            for ($i = 1; $i <= $tenor; $i++) {
                $datainstallment[] = array(
                    'contract_no'           => $contractno,
                    'installment_no'        => $i, 
                    'due_date'              => date('Y-m-d', strtotime('+' . $i . ' month', strtotime($duedateadjustment))),  
                    'angsuran'                => $dataorderdetail['angsuran'], 

                );

             
            }



           $this->db->insert_batch('installment_customer', $datainstallment);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Approve Order',
                'object'     => $this->input->post('kode_order'),
                'url'        => base_url('Transaction/ApproveOrder'),
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_activity', $logData);

            $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Approve.
         </div> ');
            redirect('Transaction/OrderProcess');
        }
    }



    public function RejectOrder($kode_order)
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $kode_shipping =  $this->Transaction_m->getkodeshipping($kode_order);
        $kode_shippingpost =  $kode_shipping['kode_shipping'];
        $dataupdate = [

            'status_order'  => 'REJECT',
            'note_order'     => '',
            'id_fintech'       => '',
            'user_proses'       => $this->session->userdata('username'),
            'date_proses'       => date('Y-m-d H:i:s')
        ];

        $this->Transaction_m->updateapproval($kode_order, $dataupdate);
        $this->Transaction_m->updateshippingreject($kode_shippingpost);




        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Reject Order',
            'object'     => $this->input->post('kode_order'),
            'url'        => base_url('Transaction/RejectOrder'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Reject.
         </div> ');
        redirect('Transaction/OrderProcess');
    }






    public function Kontak()
    {
        $data['title']      = "List Data Kontak";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Kontaks']  = $this->Transaction_m->get_all_kontaks();

        $this->load->view('Transaction/Kontak', $data);
    }



    public function DetailKontak($id)
    {
        $id = Decrypt_url($id);

        $data['title']      = "DetailKontak";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Kontakdetail']  = $this->Transaction_m->get_all_detail_kontak($id);





        $this->load->view('Transaction/DetailKontak', $data);
    }


    public function ReplyKontak()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $id = $this->input->post('id');
        $replykontak = $this->input->post('replykontak');
        $this->Transaction_m->update_kontak_reply($id, $replykontak);



        // kirim ke email, setealh di update ke table 




        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Reply.
         </div> ');
        redirect('Transaction/Kontak');
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



        $this->load->view('Transaction/Billing', $data);
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

            redirect('Transaction/Billing');
        } else {
            $this->load->library('upload');
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

                redirect('Transaction/Billing');
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
                    'url'        => base_url('Transaction/Billing'),
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

                redirect('Transaction/Billing');
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
            'url'        => base_url('Transaction/ResetBillingUpload'),
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

        redirect('Transaction/Billing');
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
            'url'        => base_url('Transaction/ResetBillingUpload'),
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
        redirect('Transaction/Billing');
    }












}
