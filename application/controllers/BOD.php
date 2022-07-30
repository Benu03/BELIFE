<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BOD extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Bod_m');
    }



    public function Approval_List()
    {
        $data['title']          = "Approval List";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $data['listreqapv'] = $this->Bod_m->get_all_po_do_list_req_apv();

        $this->load->view('BOD/Approval_List', $data);
    }



    public function PoDoReq_Review($id = NULL)
    {

        $kode_po_do = Decrypt_url($id);

        $podotype = $this->Bod_m->chekcpodotype($kode_po_do);



        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));


        if ($podotype['po_do_type'] == 1) {

            redirect('BOD/PoDoReq_Review_D1/' . $kode_po_do);
        } else {


            redirect('BOD/PoDoReq_Review_D2/' . $kode_po_do);
        }
    }


    public function PoDoReq_Review_D1($kode_po_do)
    {

        $data['title']          = "Purchase Order & Delivery Review";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Bod_m->get_all_po_do_list_D1($kode_po_do);
        $data['pododata']     = $this->Bod_m->get_podo_data($kode_po_do);




        $this->load->view('BOD/PoDoReq_Review_D1', $data);
    }

    public function PoDoReq_Review_D2($kode_po_do)
    {

        $data['title']          = "Purchase Order & Delivery Review";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['DetailData']     = $this->Bod_m->get_all_po_do_list_D2($kode_po_do);
        $data['pododata']     = $this->Bod_m->get_podo_data($kode_po_do);





        $this->load->view('BOD/PoDoReq_Review_D2', $data);
    }



    public function PostPoDo_Review_Upd()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $kode_po_do = $this->input->post('kodepodo');

        $dataupdate = [
            'status_po_do' => 'APV',
            'note_approve' => $this->input->post('noteapv'),
            'user_approve' => $username,
            'date_approve' =>  date('Y-m-d H:i:s')

        ];


        $this->Bod_m->PostPoDo_Review_Upd_M($kode_po_do, $dataupdate);

        $this->session->set_flashdata('message', '
             <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>Success!</h5>
                ' . $kode_po_do . ' Sudah Di Proses.
              </div> ');

        redirect('BOD/Approval_List');
    }



    public function PostPoDo_Review_Upd_rjt()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $kode_po_do = $this->input->post('kode_po_do');
        $noteapv = $this->input->post('noteapv');


        $dataupdate = [
            'status_po_do' => 'RJC',
            'note_approve' => $noteapv,
            'user_approve' => $username,
            'date_approve' =>  date('Y-m-d H:i:s')

        ];




        $this->Bod_m->PostPoDo_Review_Upd_M($kode_po_do, $dataupdate);








        $data['redirect'] = base_url('BOD/Approval_List');



        echo json_encode($data);
    }
}
