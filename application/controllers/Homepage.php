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
        $this->load->library('pagination');
        if ($this->input->post('submit')) {
            $data['cari'] =  $this->input->post('cari');
            $this->session->set_userdata('cari', $data['cari']);
        } else {
            $data['cari'] = $this->session->userdata('cari');
        }

        //config
        $this->db->like('nama_product', $data['cari']);
        $this->db->from('product');
        $config['total_rows']      = $this->db->count_all_results();
        $config['per_page']        = 12;
        $config['base_url']        = base_url('Homepage/index');
        $config['num_links']       = 3;
        //styling
        $config['full_tag_open']   = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']  = '</ul></nav>';
        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#" >';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';
        $config['attributes']      = array('class' => 'page-link');
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['product'] = $this->Product_m->get_all_product_pag($config['per_page'], $data['start'], $data['cari']);

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
