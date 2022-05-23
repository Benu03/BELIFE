<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        // is_logged_in();
        $this->load->model('users_m');
        $this->load->model('Notification_m');
       
    }

  

    public function listdata()
    {
        $data['title']     = "Pemberitahuan";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
         $data['notif'] = $this->Notification_m->getdatanotif($username);
            // var_dump($data['notif'] );
            // die();
        $datacheck = $this->Notification_m->checknotif($username);



    

        if($datacheck >= 1){


            $this->load->view('Notification/list_data', $data);
                 }
                 else 
                 {
    
                    redirect('DashboardUser');     
    
                 }


    }

  

    public function isview_notif()
    {
        $id =  $this->input->post('id');
        $this->Notification_m->updateisview($id);
    


        redirect('Notification/listdata');
    }


    public function isview_notif2($id)
    {
        $id =  $this->input->post('id');
        $this->Notification_m->updateisview($id);
    
        redirect('Notification/listdata');
    }





}
