<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardFinance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
    }



    public function index()
    {
        $data['title']          = "Dashboard";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $this->load->view('Dashboard/Finance', $data);
    }
}
