<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin_belife extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('users_m');
        $this->load->model('DataMaster_m');
    }



    public function Index()
    {
        $data['title']          = "Dashboard";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('employeeid'));
        $this->load->view('Dashboard/admin_belife', $data);
    }
}
