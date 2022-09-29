<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataLog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Log_activity_m');
    }

    public function index()
    {
        $this->UserActivity();
    }

    public function UserActivity()
    {
        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_all();
        $this->load->view('DataLog/UserActivity_v', $data);
    }

    public function ViewUserActivity($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_data($id);
        $this->load->view('DataLog/ViewUserActivity_v', $data);
    }
}
