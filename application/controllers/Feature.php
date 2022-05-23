<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feature extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('log_activity_m');
        $this->load->model('users_m');
        $this->load->model('Product_m');
        $this->load->model('Feature_m');
        $this->load->model('master_m');
    }

 


    public function Product()
    {
        $data['title']      = "Product";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $this->load->view('Feature/Product', $data);
    }



    public function Keranjang()
    {



        $data['title']      = "Keranjang Belanja";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
      
        $data['spread'] = $this->master_m->get_spred_harga_product();   
        $username           = $data['usrProfile']['username'];
        $data['datacart']    = $this->Product_m->get_data_keranjang($username)->result_array();
        $data['count_item']    = $this->Product_m->get_data_countitemkeranjang($username)->num_rows();
        $data['totalharga']    = $this->Product_m->get_data_totalharga($username)->row_array();

        $datacheck = $this->Feature_m->checkkeanjang($username);

        if($datacheck >= 1){


        $this->load->view('Feature/Keranjang', $data);
             }
             else 
             {

                redirect('DashboardUser');     

             }


    }



    public function Updatekeranjang()
    {
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $qty =$this->input->post('qty');
        $datasubtotal =  $this->input->post('datasubtotal');
        $kodeprd =  $this->input->post('kodeprd');
        $id =  $this->input->post('id');

      

 

        $this->Product_m->updateKeranjang($qty,$datasubtotal,$id);

      
        $data = $this->Product_m->get_data_totalharga($username)->row_array(); ;

         echo json_encode($data);
      


    }
    


    public function DetailProduct($kode_product)
    {
        $data['title']          = "Detail Product";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $data['spread'] = $this->master_m->get_spred_harga_product();   
        $data['dataproduct']    = $this->Product_m->get_data_productdetail($kode_product)->result_array();

    

    
        $this->load->view('Feature/DetailProduct_User', $data);



    }



    public function DetailProductkeranjang($kode_product)
    {
        $data['title']          = "Detail Product";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $data['spread'] = $this->master_m->get_spred_harga_product();   
        $data['dataproduct']    = $this->Product_m->get_data_productdetail($kode_product)->result_array();
        
 


        $data['listdataproductkeranjang']    = $this->Product_m->get_data_productdetail_keranjang($kode_product,$username)->result_array();
  

    
        $this->load->view('Feature/DetailProductKeranjang', $data);



    }



    public function Deleteallkeranjang()
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

    
        $this->Product_m->delete_data_keranjang($username);
      
        redirect('DashboardUser');     

    }



    public function DeleteProductkeranjangdetail()
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $id = $this->input->get('id');
        $kode_product = $this->input->get('kode_product');


    
        $this->Product_m->delete_data_keranjang_detail($id);
      
        redirect('Feature/Keranjang');      

    }


    public function DeleteProductkeranjang($id)
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $this->Product_m->delete_dataproduct_keranjang($id,$username);
      
        redirect('DashboardUser');     

    }


    public function OrderUser()
    {
            $data['title']      = "Pengajuan Pesanan";
            $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
            $username           = $data['usrProfile']['username']; 
            $datacheckcontract  = $this->Feature_m->check_contract($username)->row_array();

            $datacheckvalidasi  = $this->Feature_m->check_order_validasi($username)->row_array();
        
   
          

            //  tamahan pada saat pengajuan di proses admin , tidak bisa mengajukan pesana jg 
            
                

                 if($datacheckcontract['countdata'] > 0  && $datacheckvalidasi['countdata'] > 0){
                   
                 $this->session->set_flashdata('alert', '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Info !!!</h5>
                        Tangihan Anda Sebelumnya Belum Selesai Atau Tangihan Anda Lagi di Proses Admin..!
                    </div> ');
                   
             
                     redirect('Feature/Keranjang');     

                     }
                    

                     else 
                     {

                        $data['kode_order']  =$this->Feature_m->getkodeorder($username);
                        $data['tenor']      =$this->Feature_m->gettenor(); 
                        $data['customeroder']  =$this->Feature_m->getdatecustomerorder($username); 
                        $data['datacart']    = $this->Feature_m->get_data_keranjang($username)->result_array();
                        $data['totalharga']    = $this->Feature_m->get_data_totalharga($username)->row_array();
                        $data['biayaadmin']    = $this->Feature_m->get_data_biayaadmin()->row_array();
            
                        $this->load->view('Feature/Order_User', $data);
                     

    

                      }

           


    }


    public function kalkulasi_angsuran()
    {
        $tenor =$this->input->post('tenor');
        $totalharga =$this->input->post('totalharga');
        $rate = $this->master_m->ratetenor($tenor);
        
        $data = ((($totalharga*$rate['rate'])/100) + $totalharga) / $tenor;

  
        echo json_encode($data);

    }




    
    public function VoucherCheck()
    {
        $kode_voucher =$this->input->post('kode_voucher');
        $vouchervalue = $this->master_m->vouchervalue($kode_voucher);
        
        
        $data = $vouchervalue['value_voucher'];

        // $this->master_m->voucherupdateget($kode_voucher);
      
         echo json_encode($data);
      

    }


       
    public function VoucherUpdateGet()
    {
        $kode_voucher =$this->input->post('kode_voucher');
        $this->master_m->voucherupdateget($kode_voucher);


      

    }



   


    




    public function AddOrder()
    {

        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));
        

        $username           = $data['usrProfile']['username'];
       
       
        $kodeshipping =$this->Feature_m->getkodeshipping();


        $kode_voucher = $this->input->post('kode_voucher') ;
        $data['biayaadmin']    = $this->Feature_m->get_data_biayaadmin()->row_array();
   
        

        $DataOrder = [
           'kode_order'  => $this->input->post('kode_order') ,
           'total_order' => $this->input->post('totalharga') ,
           'tenor'       =>  $this->input->post('tenor'),
           'angsuran'   =>  $this->input->post('angsuran') ,
           'status_order'     =>  'ORDER',
           'user_order' => $username,
           'date_order'  => date('Y-m-d H:i:s'),
           'kode_shipping' =>  $kodeshipping,
           'kode_voucher'   =>  $kode_voucher ,
           'admin_cost'   => $data['biayaadmin']['value']

            ];




        $this->db->insert('orders', $DataOrder);

    
        $DataKeranjang   = $this->Feature_m->get_data_keranjang($username)->result_array();
            

    

        $result = array();
        foreach($DataKeranjang as $dt){
         $result[] = array(
          "kode_order"  => $this->input->post('kode_order'),
          "kode_product"  => $dt['kode_product'],
          "qty"  => $dt['qty'],
          "price"  =>   $dt['subtotal'],
          "price_buy"  =>   $dt['price_buy'],
          'user_order' => $username,
          'date_order'  => date('Y-m-d H:i:s')

         );
        }

     


        $dataupdate = array();
        foreach($DataKeranjang as $ee){
        $dataupdate[] = array(
        
          "kode_product"  => $ee['kode_product'],
          "qty"  => $ee['stok']-$ee['qty']

         );
        }

        $Datashipping = [
         
            'kode_shipping' =>  $kodeshipping,
            'nama_penerima'  =>  $this->input->post('nama_penerima') ,
            'kontak_penerima'  =>  $this->input->post('kontak_penerima') ,
            'alamat_pengiriman'  => $this->input->post('alamat_pengiriman') ,
            'status_pengiriman'  => 'PROSPECT',
            'user_post' => $username,
            'date_post'  => date('Y-m-d H:i:s')
         ];
 
         

         $this->db->insert_batch('order_detail', $result);
 
         $this->db->insert('shipping', $Datashipping);

         $this->db->update_batch('product', $dataupdate,'kode_product');
        $this->Feature_m->UpdateKeranjang($username);
        $this->Feature_m->UpdateVoucher($kode_voucher,$username);


        $DataHistoryOrder = [
            "kode_order"  => $this->input->post('kode_order'),
            'status_order'     =>  'ORDER',
            'user_proses' => $username,
            'date_proses'  => date('Y-m-d H:i:s')

        ];

        $this->db->insert('order_history', $DataHistoryOrder);


        $Datanotification = [
            "user_receive"  => $username,
            'massage'     =>  'Pesanan Anda Sedang Proses Verifikasi Admin Dengan Kode Order '.$this->input->post('kode_order') ,
            'is_view' => 0,
            'date_notif'  => date('Y-m-d H:i:s')

        ];

        $this->db->insert('notification', $Datanotification);



        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
            Pesanan Anda Sedang Di Verifikasi Admin Belife.
         </div> ');
        redirect('DashboardUser');     


    }


  

  public function HistoyTransaksi()
    {
        $data['title']      = "History Transaksi";
        $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        
        $data['Historyorder']  =$this->Feature_m->HistoryOrder($username);
  

        $this->load->view('Feature/HistoyTransaksi', $data);
    }


    
  public function DetailHistoryOrder($id)
  {

 

      $data['title']      = "Detail History Transaksi";
      $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));

      $username           = $data['usrProfile']['username'];
      
     

      $this->load->view('Feature/DetailHistoyTransaksi', $data);
  }



  public function KontakAdminBelife()
    {

     $data['title']         = "Kontak Admin Belife";
      $data['usrProfile']     = $this->users_m->get_user_profile($this->session->userdata('username'));

      $username           = $data['usrProfile']['username'];
      
     


      $this->load->view('Feature/KontakAdminBelife', $data);

    }





}
