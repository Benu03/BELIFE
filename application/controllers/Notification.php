<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        // is_logged_in();
        $this->load->model('Users_m');
        $this->load->model('Notification_m');
    }



    public function listdata()
    {
        $data['title']     = "Pemberitahuan";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $data['notif'] = $this->Notification_m->getdatanotif($username);

        $data['notifpesanan'] = $this->Notification_m->getdatanotifpesanan($username);
      
        $this->load->view('Notification/list_data', $data);

    }



    public function isview_notif()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $id =  $this->input->post('id');
    
        $Datanotification_view = [
            'username'  =>  $username,
            'id_notif'     =>  $id
         ];

        $this->db->insert('notification_view', $Datanotification_view);


        redirect('Notification/listdata');
    }


    public function isview_notif2($id)
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $id =  $this->input->post('id');

        $this->Notification_m->updateisview($id);

        redirect('Notification/listdata');
    }
}
