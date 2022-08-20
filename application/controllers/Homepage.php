<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');


        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Product_m');
    }

    public function Index()
    {
        $data['title'] = "Homepage Belife";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('employeeid'));
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['kategori']       = $this->Product_m->get_all_kategori();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['banner1'] =  $this->Users_m->Banner('IMG_Banner1');
        $data['banner2'] =  $this->Users_m->Banner('IMG_Banner2');
        $data['banner3'] =  $this->Users_m->Banner('IMG_Banner3');


        $data['product'] = $this->Product_m->get_all_product_home();

        $this->load->view('Homepage/header', $data);
        $this->load->view('Homepage/home', $data);
        $this->load->view('Homepage/footer', $data);
    }

    public function About()
    {
        $data['title'] = "Tentang Belife";


        $this->load->view('Homepage/header', $data);
        $this->load->view('Homepage/about', $data);
        
        $this->load->view('Homepage/footer', $data);
    }

    public function Contact()
    {



        $data['title'] = "Kontak Belife";
        $this->load->view('Homepage/header', $data);
        $this->load->view('Homepage/contact', $data);
        $this->load->view('Homepage/footer', $data);
    }



    public function KontakSend()
    {
        $data = [

            'nama'  => $this->input->post('nama'),
            'email'  => $this->input->post('email'),
            'subject'  => $this->input->post('subject'),
            'pesan'  => $this->input->post('pesan'),
            'ip_post'   => Get_ipdevice(),
            'date_post'    => date('Y-m-d H:i:s'),
            'is_reply'  => 0

        ];

        $this->db->insert('kontak', $data);

        $this->session->set_flashdata('flash', 'DiKirim');

        redirect('Homepage/Contact');
    }
}
