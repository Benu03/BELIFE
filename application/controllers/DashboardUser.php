<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUser extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Product_m');
        $this->load->model('Master_m');
        $this->load->model('Feature_m');
    }



    public function Index()
    {
        $data['title']          = "Dashboard";

        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();

        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['kategori'] = $this->Product_m->get_all_kategori();
        $data['usrProfile']  = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $data['banner1'] =  $this->Users_m->Banner('IMG_Banner1');
        $data['banner2'] =  $this->Users_m->Banner('IMG_Banner2');
        $data['banner3'] =  $this->Users_m->Banner('IMG_Banner3');


        $this->load->library('pagination');

        if ($this->input->post('submit')) {         
            $data['cari']   =  $this->input->post('cari');
            $this->session->set_userdata('cari', $data['cari']);
  
  
        } 
        else {
            $data['cari'] = $this->session->userdata('cari');
    
        }

        if ($this->input->post('submit2')) {         
         
            $data['kategoridata'] =  $this->input->post('kategori_dashboard');
          
            $this->session->set_userdata('kategori', $data['kategori']);
  
        } 
        else {
            $data['kategoridata'] = null;
        }




        $this->db->where('id_category_product', $data['kategoridata']);
        $this->db->like('title_product', $data['cari']);
        $this->db->or_like('nama_product', $data['cari']);
        $this->db->from('product');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 12;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['product'] = $this->Product_m->get_all_product_pag($config['per_page'], $data['start'],$data['cari'],$data['kategoridata']);


        $this->load->view('Dashboard/user', $data);
    }









    public function AddBucketProduct($id)
    {



        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $datapersonal = $this->Users_m->personal_customer_check($username)->row_array();

         if($datapersonal['selfie_image']==NULL && $datapersonal['ktp_image']==NULL && $datapersonal['selfie_ktp_image']==NULL && $datapersonal['buku_tabungan']==NULL && $datapersonal['slip_gaji']==NULL){
                $this->session->set_flashdata('message', '
                <div class="alert alert-info alert-dismissible">
                     <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h5><i class="icon fas fa-check"></i>Info!</h5>
                   Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
                 </div>');
                redirect('Home/PersonalData');
            

         }
         elseif($datapersonal['status_register'] !== "approved"){

            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Akun Anda Sedang Menunggu Verifikasi Admin Belife ...!!!
             </div>');
            redirect('Home');

        }

         else{

        $data['product'] = $this->Product_m->find_product($id);
        $spread = $this->Master_m->get_spred_harga_product();
        $hargabarang = $data['product']['price_sell'];
        // $hargajual = (($hargabarang * $spread['value']) / 100) + $hargabarang;
        $hargajual = $hargabarang;
        $hargabeli = $data['product']['price_buy'];

        $checkdatakeranjang = $this->Feature_m->check_keranjang($id, $username);
        $checkstok = $this->Feature_m->check_stokproduct($id);


        if ($checkstok['qty'] <= 0) {


            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
                Stok Barang Habis, Silakan Kontak Admin Untuk Konfirmasi...!
             </div>
         ');
            redirect('DashboardUser');
        } else {





            if ($checkdatakeranjang == 1) {


                // update di tambah 1
                $preparedata = $this->Feature_m->preparedatakeranjang($id, $username);

                $id = $preparedata['id'];
                $qty = $preparedata['qty'] + 1;
                $subtotal  = $preparedata['price'] * $qty;

                $dataupdate = [

                    'qty'     =>  $qty,
                    'subtotal' => $subtotal,
                    'user_order' => $username,
                    'date_post' => date('Y-m-d H:i:s')
                ];


                $this->Feature_m->update_add_keranjang($id, $dataupdate);
            } else {

                $datacart = array(
                    'kode_product' => $data['product']['kode_product'],
                    'qty'     => 1,
                    'price'   => $hargajual,
                    'price_buy'   => $hargabeli,
                    'user_order' => $data['usrProfile']['username'],
                    'is_order' => 0,
                    'subtotal' => $hargajual,
                    'date_post' => date('Y-m-d H:i:s')
                );

                $this->db->insert('keranjang', $datacart);
            }


            redirect('Feature/Keranjang');
        }
        }
    }



    public function AddBucketProductDetail($id)
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['product'] = $this->Product_m->find_product($id);
        $spread = $this->Master_m->get_spred_harga_product();
        $hargabarang = $data['product']['price_sell'];
        $hargajual = (($hargabarang * $spread['value']) / 100) + $hargabarang;
        $hargabeli = $data['product']['price_buy'];


        $datacart = array(
            'kode_product'      => $data['product']['kode_product'],
            'qty'     => 1,
            'price'   =>  $hargajual,
            'price_buy'   => $hargabeli,
            'user_order' => $data['usrProfile']['username'],
            'is_order' => 0,
            'date_post'           => date('Y-m-d H:i:s')
        );

        $this->db->insert('keranjang', $datacart);

        redirect('Feature/DetailProductkeranjang/' . $data['product']['kode_product']);
    }
}
