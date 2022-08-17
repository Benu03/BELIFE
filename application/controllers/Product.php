<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Product_m');
    }

    public function index()
    {
        $this->DataProduct();
    }

    public function DataProduct()
    {
        $data['title']      = "Data Product";
        $data['product'] = $this->Product_m->get_all_productshow()->result_array();
        $data['kategoriproduct'] = $this->Product_m->get_all_kategoriproduct()->result_array();
        $data['diskon'] = $this->Product_m->get_all_diskon()->result_array();


        $this->load->view('Product/DataProduct', $data);
    }


    public function DataKategoriProduct()
    {
        $data['title']      = "Data Kategori Product";
        $data['kategoriproduct'] = $this->Product_m->get_all_kategoriproduct()->result_array();
        $this->load->view('Product/KategoriProduct', $data);
    }

    public function AddKategoriProduct()
    {
        $this->form_validation->set_rules('kategori_product', 'Category Name', 'required|trim|is_unique[product_category.category_name]', ['is_unique' => 'Category name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->DataKategoriProduct();
        } else {
            $data = array(
                'category_name' => $this->input->post('kategori_product'),
                'is_active'         => $this->input->post('is_active')
            );

            $this->Product_m->insert_kategorproduct($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Category Product',
                'url'        => base_url('Product/AddKategoriProduct'),
                'object'     => $data['kategori_product'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_activity', $logData);

            $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                    Data has been added.
                </div>
            ');
            redirect('Product/DataKategoriProduct');
        }
    }



    public function UpdateKategoriproduct($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Kategori Product";
        $data['kategori'] = $this->Product_m->get_kategoiproduct_byid($id);


        $this->load->view('Product/UpdateKategoriProduct_v', $data);
    }


    public function Updateproduct($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Data Product";
        $data['product'] = $this->Product_m->get_all_productshow_byid($id);

        $data['kategoriproduct'] = $this->Product_m->get_all_kategoriproduct()->result_array();
        $data['diskon'] = $this->Product_m->get_all_diskon()->result_array();

        $this->load->view('Product/UpdateProduct_v', $data);
    }



    public function EditKategoriProduct($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('kategori_name', 'Category Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateKategoriproduct($id);
        } else {
            $data = array(
                'category_name' => $this->input->post('kategori_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->Product_m->edit_kategoriproduct($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Kategoy Product',
                'object'     => $data['category_name'],
                'url'        => base_url('Product/EditKategoriProduct'),
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_activity', $logData);

            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                    Data has been updated.
                </div>
            ');
            redirect('Product/DataKategoriProduct');
        }
    }



    public function DeleteKategoriproduct($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->Product_m->get_kategoiproduct_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Organization',
            'object'     => $data['category_name'],
            'url'        => base_url('Product/DeleteKategoriproduct'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->Product_m->delete_kategoriproduct($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('Product/DataKategoriProduct');
    }


    // ----------   product -------------


    public function AddProduct()
    {
        $this->form_validation->set_rules('title', 'Title Product', 'required');
        $this->form_validation->set_rules('product_name', 'Nama Product', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori Product', 'required');
        $this->form_validation->set_rules('hargaproductbeli', 'Harga Beli', 'required');
        $this->form_validation->set_rules('hargaproduct', 'Harga', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');



        if ($this->form_validation->run() == false) {
            $this->DataProduct();
        } else {


            if (empty($_FILES['image_product']['name'])) {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                        Your file is empty.
                    </div>
                ');
                redirect('Product/DataProduct');
            } else {
                if ($_FILES['image_product']['size'] >= 524288) {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                            File size cannot be more than 512kb.
                        </div>
                    ');
                    redirect('Product/DataProduct');
                } else {

                    $kode_product = $this->Product_m->getkodeproductseq();

                    $this->load->library('upload');
                    // mkdir("./assets/img/product/");
                    $default_name                =  $kode_product . ".jpg";
                    $config_img['upload_path']   = './assets/img/product/';
                    $config_img['allowed_types'] = 'jpg|jpeg|png';
                    $config_img['file_name']     = $default_name;
                    $config_img['overwrite']     = TRUE;
                    $config_img['max_size']      = 512; /* max 512kb */
                    $this->upload->initialize($config_img);
                    if (($_FILES['image_product']['name'])) {
                        if ($this->upload->do_upload('image_product')) {
                            $this->upload->data();
                        }
                    }


                     $is_diskon =  $this->input->post('diskon');
                     if($is_diskon == 0){
                        $diskon_value = NULL;
                        $date_expired_diskon = NULL;

                     }  
                     else{

                        $diskon_value = $this->input->post('diskon_value');
                        $date_expired_diskon = $this->input->post('dateexpired_diskon');

                     }

                    $datainsertproduct = array(
                        'kode_product'          => $kode_product,
                        'title_product'         => $this->input->post('title'),
                        'nama_product'          => $this->input->post('product_name'),
                        'description'           => $this->input->post('deskripsi'),
                        'id_category_product'   => $this->input->post('kategori'),
                        'price_buy'             => $this->input->post('hargaproductbeli'),
                        'price_sell'            => $this->input->post('hargaproduct'),
                        'is_diskon'             => $is_diskon,
                        // 'diskon_id'             => $diskon_id,
                        'status'                => $this->input->post('status'),
                        'qty'                   => $this->input->post('qty'),
                        'image_product'         => $default_name,
                        'user_create'           => $this->session->userdata('username'),
                        'date_create'           => date('Y-m-d H:i:s'),
                        'price_belife'          => $this->input->post('hargaproductbelife'),
                        'rate_beli'             => $this->input->post('rateproductbeli'),
                        'rate_belife'           => $this->input->post('rateproductbelife'),
                        'date_expired_diskon'   => $date_expired_diskon,
                        'diskon_value'          => $diskon_value
                        
                    );


                    $this->db->insert('product', $datainsertproduct);

                    // $this->Product_m->insert_product($data);

                    $logData = [
                        'username' => $this->session->userdata('username'),
                        'activities' => 'Add new  Product',
                        'url'        => base_url('Product/AddProduct'),
                        'object'     => $datainsertproduct['kode_product'],
                        'ipdevice'   => Get_ipdevice(),
                        'at_time'    => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('log_activity', $logData);

                    $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                    Data has been added.
                </div>
            ');
                    redirect('Product/DataProduct');
                }
            }
        }
    }




    public function EditProduct($id = NULL)
    {
        $id = Decrypt_url($id);
        $this->form_validation->set_rules('title', 'Title Product', 'required');
        $this->form_validation->set_rules('product_name', 'Nama Product', 'required');

        $this->form_validation->set_rules('kategori', 'Kategori Product', 'required');
        $this->form_validation->set_rules('hargaproduct', 'Harga', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');



        if ($this->form_validation->run() == false) {
            $this->Updateproduct($id);
        } else {




            if ($_FILES['image_product']['size'] >= 524288) {
                $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                            File size cannot be more than 512kb.
                        </div>
                    ');
                redirect('Product/Updateproduct/' . $id);
            } else {

                // $kode_product = $this->Product_m->getkodeproductseq();

                $this->load->library('upload');
                // mkdir("./assets/img/product/");
                $default_name                =  $id . ".jpg";
                $config_img['upload_path']   = './assets/img/product/';
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                $this->upload->initialize($config_img);
                if (($_FILES['image_product']['name'])) {
                    if ($this->upload->do_upload('image_product')) {
                        $this->upload->data();
                    }
                }


                $is_diskon =  $this->input->post('diskon');
                if($is_diskon == 0){
                   $diskon_value = NULL;
                   $date_expired_diskon = NULL;

                }  
                else{

                   $diskon_value = $this->input->post('diskon_value');
                   $date_expired_diskon = $this->input->post('dateexpired_diskon');

                }



                $data = array(
                    'title_product'         => $this->input->post('title'),
                    'nama_product'          => $this->input->post('product_name'),
                    'description'           => $this->input->post('deskripsi'),
                    'id_category_product'   => $this->input->post('kategori'),
                    'price_buy'             => $this->input->post('hargaproductbeli'),
                    'price_sell'            => $this->input->post('hargaproduct'),
                    'is_diskon'             => $is_diskon,
                    // 'diskon_id'             => $diskon_id,
                    'status'                => $this->input->post('status'),
                    'qty'                   => $this->input->post('qty'),
                    'image_product'         => $default_name,
                    'user_update'           => $this->session->userdata('username'),
                    'date_update'           => date('Y-m-d H:i:s'),
                    'price_belife'          => $this->input->post('hargaproductbelife'),
                    'rate_beli'             => $this->input->post('rateproductbeli'),
                    'rate_belife'           => $this->input->post('rateproductbelife'),
                    'date_expired_diskon'   => $date_expired_diskon,
                    'diskon_value'          => $diskon_value
                );



                $this->Product_m->edit_product($id, $data);
                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Add new  Product',
                    'url'        => base_url('Product/AddProduct'),
                    'object'     => $data['kode_product'],
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                    Data has been added.
                </div>
            ');
                redirect('Product/DataProduct');
            }
        }
    }



    public function DeleteProduct($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->Product_m->get_all_productshow_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Product',
            'object'     => $data['kode_product'],
            'url'        => base_url('Product/DeleteProduct'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->Product_m->delete_product($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('Product/DataProduct');
    }
}
