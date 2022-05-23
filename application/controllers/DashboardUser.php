<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUser extends CI_Controller
{
    public function __construct()
    {
        
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
    
        $this->load->model('users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Product_m');
        $this->load->model('master_m');
        $this->load->model('Feature_m');
        
       
    }

    

    public function index()
    {
        $data['title']          = "Dashboard";
       
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['kategori'] = $this->Product_m->get_all_kategori();       
        $data['usrProfile']  = $this->users_m->get_user_profile($this->session->userdata('username'));

        $data['banner1'] =  $this->users_m->Banner('IMG_banner1');
        $data['banner2'] =  $this->users_m->Banner('IMG_banner2');
        $data['banner3'] =  $this->users_m->Banner('IMG_banner3');

            


        $this->load->library('pagination');

        if($this->input->post('submit'))
        {
        $data['cari']=  $this->input->post('cari');
        $this->session->set_userdata('cari',$data['cari']);
        }else {
            $data['cari']= $this->session->userdata('cari');
        }

       

        //config
        $this->db->like('nama_product', $data['cari']);
        $this->db->from('product'); 
        $config['total_rows']= $this->db->count_all_results();
        $config['per_page']=12;
    

        $config['base_url']= base_url('DashboardUser/index'); 
        
       
        $config['num_links']=3;


        //styling
        $config['full_tag_open']='<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']='</ul></nav>';

        $config['first_link']='First';
        $config['first_tag_open']='<li class="page-item">';
        $config['first_tag_close']='</li>';

        $config['last_link']='Last';
        $config['last_tag_open']='<li class="page-item">';
        $config['last_tag_close']='</li>';

        $config['next_link']='&raquo';
        $config['next_tag_open']='<li class="page-item">';
        $config['next_tag_close']='</li>';

        $config['prev_link']='&laquo';
        $config['prev_tag_open']='<li class="page-item">';
        $config['prev_tag_close']='</li>';

        $config['cur_tag_open']='<li class="page-item active"><a class="page-link" href="#" >';
        $config['cur_tag_close']='</a></li>';

        $config['num_tag_open']='<li class="page-item">';
        $config['num_tag_close']='</li>';

        $config['attributes']= array('class' => 'page-link');

        $this->pagination->initialize($config);


        $data['start']=$this->uri->segment(3);
    
        $data['spread'] = $this->master_m->get_spred_harga_product();       
        $data['product']= $this->Product_m->get_all_product_pag($config['per_page'],$data['start'],$data['cari']);
      

       
         $this->load->view('Dashboard/user', $data);




    }






   

    
    public function AddBucketProduct($id)
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $data['product'] = $this->Product_m->find_product($id);

        
     



        $spread = $this->master_m->get_spred_harga_product();       
        $hargabarang =$data['product']['price_sell'];
        // $hargajual = (($hargabarang * $spread['value']) / 100) + $hargabarang;
        $hargajual = $hargabarang;
        $hargabeli =$data['product']['price_buy'];

  


        $checkdatakeranjang = $this->Feature_m->check_keranjang($id,$username );
        $checkstok = $this->Feature_m->check_stokproduct($id);
  

        if ($checkstok['qty'] <= 0){


            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
                Stok Barang Habis, Silakan Kontak Admin Untuk Konfirmasi...!
             </div>
         ');
            redirect('DashboardUser');  

        }

        else{

       


        
        if($checkdatakeranjang == 1){


            // update di tambah 1
            $preparedata = $this->Feature_m->preparedatakeranjang($id,$username );

            $id = $preparedata['id'];
            $qty = $preparedata['qty']+1;
            $subtotal  = $preparedata['price'] * $qty;
            
            $dataupdate =[
               
                'qty'     =>  $qty,
                'subtotal' => $subtotal,
                'user_order' => $username,
                'date_post' => date('Y-m-d H:i:s')
            ];

    
            $this->Feature_m->update_add_keranjang($id,$dataupdate);



        }
        else{

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



    public function AddBucketProductDetail($id)
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $data['product'] = $this->Product_m->find_product($id);
        $spread = $this->master_m->get_spred_harga_product();       
        $hargabarang =$data['product']['price_sell'];
        $hargajual = (($hargabarang * $spread['value']) / 100) + $hargabarang;
        $hargabeli =$data['product']['price_buy'];
       

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

                    redirect('Feature/DetailProductkeranjang/'.$data['product']['kode_product']);     

    }
    
    







 













    
}
