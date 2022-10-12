<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrder_DeliveryOrder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Po_do_m');
        $this->load->model('Finance_m');
    }



    public function PermohoanDana()
    {
        $data['title']          = "Permohonan Dana";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $data['podolist']     = $this->Po_do_m->list_wating_podo();

        $data['kode_podo']    =    $this->Po_do_m->kode_podo_seq();
        $kode_po_do =  $data['kode_podo'];
        $data['listadd']    =   $this->Po_do_m->list_wating_podo_add($kode_po_do)->result_array();

        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add($kode_po_do);




        $this->load->view('Po_Do/PermohonanDana', $data);
    }


    public function PoDoSupplier()
    {
        $data['title']          = "PO & DO Supplier";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $data['list_supplier']     = $this->Po_do_m->list_supplier();
        $data['kode_podo']    =    $this->Po_do_m->kode_podo_seq();
        $kode_po_do =  $data['kode_podo'];
        $data['listadd_supplier']    =   $this->Po_do_m->list_wating_podo_add_supplier($kode_po_do)->result_array();
        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add_supplier($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add_supplier($kode_po_do);
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $this->load->view('Po_Do/PoDoSupplier', $data);
    }



    public function PostPoDo_1()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $kode_po_do = $this->input->post('kodepodo');

        $datainsert = [

            'kode_po_do' => $this->input->post('kodepodo'),
            'total_req' => $this->input->post('totalreqpodo2'),
            'count_detail' => $this->input->post('countoderpodo'),
            'status_po_do' => 'REQ',
            'po_do_type' => 1,
            'is_print' => 0,
            'user_request' => $username,
            'date_request'  => date('Y-m-d H:i:s')
        ];


        $this->db->insert('po_do', $datainsert);


        $this->Po_do_m->update_po_do_request($kode_po_do);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Req Permohonan Dana Pembelian Barang',
            'url'        => base_url('PurchaseOrder_DeliveryOrder/PostPoDo_1'),
            'object'     => $datainsert['kodepodo'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                   Request Permohonan Dana Sudah Terkirim Ke Finance .
                </div>
            ');
        redirect('PurchaseOrder_DeliveryOrder/PermohoanDana');
    }




    public function PostPoDo_2()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $kode_po_do = $this->input->post('kodepodo');

        $datainsert = [

            'kode_po_do' => $this->input->post('kodepodo'),
            'total_req' => $this->input->post('totalreqpodo2'),
            'count_detail' => $this->input->post('countoderpodo'),
            'status_po_do' => 'REQ',
            'po_do_type' => 2,
            'is_print' => 0,
            'user_request' => $username,
            'date_request'  => date('Y-m-d H:i:s')
        ];


        $this->db->insert('po_do', $datainsert);


        $this->Po_do_m->update_po_do_request_sup($kode_po_do);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Req PO DO Supplier',
            'url'        => base_url('PurchaseOrder_DeliveryOrder/PostPoDo_2'),
            'object'     => $datainsert['kodepodo'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                   Request Permohonan Dana Sudah Terkirim Ke Finance .
                </div>
            ');
        redirect('PurchaseOrder_DeliveryOrder/PoDoSupplier');
    }







    public function AddPoDoPermohonanDana()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $kode_po_do = $this->input->post('kode_po_do');
        $kode_parent =  $this->input->post('kode_parent');

        $price =  $this->input->post('price');

        $data = [

            'kode_po_do' => $kode_po_do,
            'kode_parent' => $kode_parent,
            'price' => $price,
            'po_do_type' => 1,
            'is_request' => 0,
            'is_add' => 1,
            'user_post' => $username,
            'date_post'  => date('Y-m-d H:i:s')
        ];

        $this->db->insert('po_do_detail', $data);


        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add($kode_po_do);


        $data2 = [
            'countoderpodo' => $data['countoderpodo'],
            'sumpodoadd'  => $data['sumpodoadd']['price']

        ];


        echo json_encode($data2);
    }


    public function DelPoDoPermohonanDana()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $id =  $this->input->post('id');
        $kode_po_do =  $this->input->post('kode_po_do');





        $this->Po_do_m->del_wating_podo($id);

        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add_supplier($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add($kode_po_do);


        $data = [
            'countoderpodo' => $data['countoderpodo'],
            'sumpodoadd'  => $data['sumpodoadd']['price']

        ];




        echo json_encode($data);
    }

    public function Checksupplierdata()
    {

        $id_supplier =  $this->input->post('id_supplier');

        $data =  $this->Po_do_m->getdatasupplier($id_supplier);




        echo json_encode($data);
    }





    public function AddPoDoSupplier()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $kode_po_do = $this->input->post('kode_po_do');
        $kode_parent =  $this->input->post('kode_parent');

        $price =  $this->input->post('price');

        $data = [

            'kode_po_do' => $kode_po_do,
            'kode_parent' => $kode_parent,
            'price' => $price,
            'po_do_type' => 2,
            'is_request' => 0,
            'is_add' => 1,
            'user_post' => $username,
            'date_post'  => date('Y-m-d H:i:s')
        ];


        $this->db->insert('po_do_supplier_detail', $data);




        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add_supplier($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add_supplier($kode_po_do);


        $data2 = [
            'countoderpodo' => $data['countoderpodo'],
            'sumpodoadd'  => $data['sumpodoadd']['price']

        ];



        echo json_encode($data2);
    }



    public function DelPoDoSupplier()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];
        $id =  $this->input->post('id');
        $kode_po_do =  $this->input->post('kode_po_do');
        $this->Po_do_m->del_wating_podo_sup($id);
        $data['countoderpodo']    =   $this->Po_do_m->list_wating_podo_add_supplier($kode_po_do)->num_rows();
        $data['sumpodoadd']    =   $this->Po_do_m->sum_wating_podo_add_supplier($kode_po_do);
        $data = [
            'countoderpodo' => $data['countoderpodo'],
            'sumpodoadd'  => $data['sumpodoadd']['price']
        ];

        echo json_encode($data);
    }

    public function PO_supplier()
    {
        $data['title']          = "PO List Supplier";
        $data['polist']    =   $this->Po_do_m->get_data_polist_supplier()->result_array();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $this->load->view('Po_Do/PoListSupplier', $data);
    }


    public function PO_supplier_d($kode_po_do)
    {

        $data['title']          = "Detail PO List Supplier";
        $data['podetailsup']    =   $this->Po_do_m->get_data_polist_supplier_d($kode_po_do)->row_array();


        $data['podetailsup2']    =   $this->Po_do_m->get_data_polist_supplier_d2($kode_po_do)->result_array();

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $this->load->view('Po_Do/PoListSupplier_detail', $data);
    }


    public function PoSupDetailDone($kode_po_do)
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username    = $data['usrProfile']['username'];
        $this->Po_do_m->update_polist_supplier($kode_po_do, $username);


        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Po supplier Process Done',
            'object'     => $kode_po_do,
            'url'        => base_url('PurchaseOrder_DeliveryOrder/PoSupDetailDone'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);


        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
            Purchase Order Supplier Done.
            </div> ');
        redirect('PurchaseOrder_DeliveryOrder/PO_supplier');
    }

    public function GeneratePDFPOSup($kode_po_do)
    {
        $data['title']        = "Report PO List Supplier";
        $data['dtPODODetail'] = $this->Po_do_m->get_data_polist_supplier_d2($kode_po_do)->result_array();

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Print_" . $kode_po_do . ".pdf";
        $this->pdf->load_view('PDF/PoSupplierProcess', $data);
    }

    public function PO_DO_History(){

        $data['title']          = "PO & DO History";      
        $data['listdata']    =   $this->Po_do_m->HistoryPODO();
        $this->load->view('Po_Do/PO_DO_History', $data);

    }


    public function PO_His_d($kode_po_do){        
        $type   =   $this->Po_do_m->ChekctypePoDO($kode_po_do)->row_array();

        if($type['po_do_type'] == 1){
            $this->PO_His1_d($kode_po_do);
        }
        else{

            $this->PO_His2_d($kode_po_do);
        }    
       

    }


    public function PO_His1_d($kode_po_do){        

        $data['title']          = "PO & DO History";  
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Finance_m->get_all_po_do_list_D1($kode_po_do);
        $data['pododata']     = $this->Finance_m->get_podo_data($kode_po_do);

        $this->load->view('Po_Do/PO_DO_History_1', $data);

    }

    public function PO_His2_d($kode_po_do){        
        $data['title']          = "PO & DO History";  

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Finance_m->get_all_po_do_list_D2($kode_po_do);
        $data['pododata']     = $this->Finance_m->get_podo_data($kode_po_do);

        $this->load->view('Po_Do/PO_DO_History_2', $data);
   

    }





    
    
}

