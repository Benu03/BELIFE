<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMaster_Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('DataMaster_m');
    }


 


    public function Ekspedisi()
    {
        $data['title']          = "Ekspedisi";
        $data['dtEkspedisi'] = $this->DataMaster_m->get_all_Ekspedisi();
        $this->load->view('DataMaster_Product/Ekspedisi_v', $data);
    }

    public function Supplier()
    {
        $data['title']          = "Supplier";
        $data['dtsupplier'] = $this->DataMaster_m->get_all_Supplier();
        $this->load->view('DataMaster_Product/Supplier', $data);
    }

    public function TenorSetting()
    {
        $data['title']      = "Tenor Setting";
        $data['rate'] = $this->DataMaster_m->get_all_rate();
        $this->load->view('DataMaster_Product/Tenor_v', $data);
    }

    public function UpdateTenor($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Tenor Setting";
        $data['tenor'] = $this->DataMaster_m->get_tenor_byid($id);
        $this->load->view('DataMaster_Product/UpdateTenor_v', $data);
    }


    public function AddTenor()
    {
        $this->form_validation->set_rules('tenor', 'Tenor', 'required|trim|is_unique[ms_tenor.tenor]', ['is_unique' => 'Tenor has already added.']);
        $this->form_validation->set_rules('rate', 'Rate %', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');

        if ($this->form_validation->run() == false) {
            $this->TenorSetting();
        } else {
            $data = array(
                'tenor' => $this->input->post('tenor'),
                'User_post' => $this->session->userdata('username'),
                'Datetime_post' => date('Y-m-d H:i:s'),
                'rate'     => $this->input->post('rate'),
                'description'     => $this->input->post('description')
            );
            $this->DataMaster_m->insert_tenor($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Tenor',
                'url'        => base_url('DataMaster_Product/AddTenor'),
                'object'     => $data['description'],
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
            redirect('DataMaster_Product/TenorSetting');
        }
    }


    public function EditTenor($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('tenor', 'Tenor', 'required|trim');
        $this->form_validation->set_rules('rate', 'Rate %', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');


        if ($this->form_validation->run() == false) {


            $this->UpdateTenor($id);
        } else {
            $data = array(
                'tenor' => $this->input->post('tenor'),
                'rate'     => $this->input->post('rate'),
                'description'     => $this->input->post('description')
            );





            $this->DataMaster_m->edit_tenor($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Tenor',
                'object'     => $data['description'],
                'url'        => base_url('DataMaster_Product/EditTenor'),
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
            redirect('DataMaster_Product/TenorSetting');
        }
    }


    public function DeleteTenor($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_tenor_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Tenor',
            'object'     => $data['description'],
            'url'        => base_url('DataMaster/DeleteTenor'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_tenor($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster/TenorSetting');
    }



    public function AddSupplier()
    {
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required|trim|is_unique[supplier.supplier_name]', ['is_unique' => 'supplier name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Supplier();
        } else {
            $data = array(
                'supplier_name' => $this->input->post('supplier_name'),
                'alamat' => $this->input->post('alamat'),
                'nama_kontak_supplier' => $this->input->post('nama_kontak_supplier'),
                'kontak_supplier' => $this->input->post('kontak_supplier'),
                'bank_supplier' => $this->input->post('bank_supplier'),
                'norek_supplier' => $this->input->post('norek_supplier'),
                'is_active'         => $this->input->post('is_active'),
                'user_create' => $this->session->userdata('username'),
                'date_create'    => date('Y-m-d H:i:s')

            );

            $this->DataMaster_m->insert_Supplier($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Supplier',
                'url'        => base_url('DataMaster_Product/AddSupplier'),
                'object'     => $data['supplier_name'],
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
            redirect('DataMaster_Product/Supplier');
        }
    }

    public function AddEkspedisi()
    {
        $this->form_validation->set_rules('ekspedisi_name', 'Ekspedisi Name', 'required|trim|is_unique[ekspedisi.ekspedisi_name]', ['is_unique' => 'Ekspedisi name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Ekspedisi();
        } else {
            $data = array(
                'ekspedisi_name' => $this->input->post('ekspedisi_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->insert_Ekspedisi($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Ekspedisi',
                'url'        => base_url('DataMaster_Product/AddEkspedisi'),
                'object'     => $data['ekspedisi_name'],
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
            redirect('DataMaster_Product/Ekspedisi');
        }
    }




   

    public function UpdateEkspedisi($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Ekspedisi";
        $data['dtEkspedisi'] = $this->DataMaster_m->get_Ekspedisi_byid($id);
        $this->load->view('DataMaster_Product/UpdateEkspedisi_v', $data);
    }


    public function UpdateSupplier($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Supplier";
        $data['dtSupplier'] = $this->DataMaster_m->get_Supplier_byid($id);
        $this->load->view('DataMaster_Product/UpdateSupplier', $data);
    }


   

    public function EditEkspedisi($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('ekspedisi_name', 'Ekspedisi Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateEkspedisi($id);
        } else {
            $data = array(
                'ekspedisi_name' => $this->input->post('ekspedisi_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_Ekspedisi($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Ekspedisi',
                'object'     => $data['ekspedisi_name'],
                'url'        => base_url('DataMaster_Product/EditEkspedisi'),
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
            redirect('DataMaster_Product/Ekspedisi');
        }
    }


    public function EditSupplier($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateSupplier($id);
        } else {
            $data = array(
                'supplier_name' => $this->input->post('supplier_name'),
                'alamat' => $this->input->post('alamat'),
                'nama_kontak_supplier' => $this->input->post('nama_kontak_supplier'),
                'kontak_supplier' => $this->input->post('kontak_supplier'),
                'bank_supplier' => $this->input->post('bank_supplier'),
                'norek_supplier' => $this->input->post('norek_supplier'),
                'is_active'         => $this->input->post('is_active'),
                'user_update' => $this->session->userdata('username'),
                'date_update'    => date('Y-m-d H:i:s')

            );



            $this->DataMaster_m->edit_Supplier($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Supplier',
                'object'     => $data['supplier_name'],
                'url'        => base_url('DataMaster_Product/EditSupplier'),
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
            redirect('DataMaster_Product/Supplier');
        }
    }



    public function DeleteEkspedisi($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_Ekspedisi_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Ekspedisi',
            'object'     => $data['ekspedisi_name'],
            'url'        => base_url('DataMaster_Product/DeleteEkspedisi'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_Ekspedisi($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster_Product/Ekspedisi');
    }


    public function DeleteSupplier($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_Supplier_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Supplier',
            'object'     => $data['supplier_name'],
            'url'        => base_url('DataMaster_Product/DeleteSupplier'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_Supplier($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster_Product/Supplier');
    }


    
  
    public function GeneralSetting()
    {
        $data['title']          = "General Setting";
        $data['General'] = $this->DataMaster_m->get_all_general_setting();
        $this->load->view('DataMaster_Product/General_v', $data);
    }


    public function AddGeneral()
    {
        $this->form_validation->set_rules('code', 'Kode', 'required|trim|is_unique[ms_general.code]', ['is_unique' => 'Kode name has already added.']);
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');
        $this->form_validation->set_rules('file_upload', 'File', 'is_unique[ms_general.file_upload]', ['is_unique' => 'File Name has already added.']);

        if ($this->form_validation->run() == false) {
            $this->GeneralSetting();
        } else {

      


            $this->load->library('upload');

            $default_name_file          = $this->input->post('code').".".pathinfo($_FILES["file_upload"]["name"],PATHINFO_EXTENSION) ;
            $config_file['upload_path']   = './assets/img/general/';
            $config_file['allowed_types'] = 'jpg|jpeg|png|pdf|doc|txt|csv';
            $config_file['file_name']     = $default_name_file;
            $config_file['overwrite']     = TRUE;
            $config_file['max_size']      = 1024; /* max 512kb */
            $this->upload->initialize($config_file);
            if (($_FILES['file_upload']['name'])) {
                if ($this->upload->do_upload('file_upload')) {
                    $this->upload->data();
                }
            }


            $data = array(
                'code'                  => $this->input->post('code'),
                'description'           => $this->input->post('description'),
                'value'                  => $this->input->post('value'),
                'file_upload'                  =>  $default_name_file,
                'is_active'                  => $this->input->post('is_active'),
                'user_update'           => $this->session->userdata('username'),
                'date_update'           => date('Y-m-d H:i:s')
            );

         



            $this->DataMaster_m->insert_general($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new General Setting',
                'url'        => base_url('DataMaster_Product/AddGeneral'),
                'object'     => $data['code'],
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
            redirect('DataMaster_Product/GeneralSetting');
        }
    }



    public function DeleteGeneral($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_general_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data General Setting',
            'object'     => $data['code'],
            'url'        => base_url('DataMaster/DeleteGeneral'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_general($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster_Product/GeneralSetting');
    }


    public function UpdateGeneral($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "General Setting";
        $data['general'] = $this->DataMaster_m->get_general_byid($id);
        $this->load->view('DataMaster_Product/Updategeneral_v', $data);
        
    }



    public function EditGeneral($id = NULL)
    {
        $id = Decrypt_url($id);

   
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateGeneral($id);
        } else {

        
                // $kode_product = $this->product_m->getkodeproductseq();

        

                $this->load->library('upload');
                // mkdir("./assets/img/product/");
                $default_name_file            = $this->input->post('code').".".pathinfo($_FILES["file_upload"]["name"],PATHINFO_EXTENSION) ;
                $config_img['upload_path']   = './assets/img/general/';
                $config_file['allowed_types'] = 'jpg|jpeg|png|pdf|doc|txt|csv';
                $config_file['file_name']     = $default_name_file;
                $config_file['overwrite']     = TRUE;
                $config_file['max_size']      = 1024; /* max 512kb */
                $this->upload->initialize($config_file);
                if (($_FILES['file_upload']['name'])) {
                    if ($this->upload->do_upload('file_upload')) {
                        $this->upload->data();
                    }
                }




            $dataupdate = array(
              
                'description'           => $this->input->post('description'),
                'value'                  => $this->input->post('value'),
                'file_upload'                  =>  $default_name_file,
                'is_active'                  => $this->input->post('is_active'),
                'user_update'           => $this->session->userdata('username'),
                'date_update'           => date('Y-m-d H:i:s')
            );



   
            $this->DataMaster_m->edit_general($id, $dataupdate);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data General Setting',
                'object'     => $dataupdate['code'],
                'url'        => base_url('DataMaster_Product/UpdateGeneral'),
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
            redirect('DataMaster_Product/GeneralSetting');
        
    }

}



    public function Voucher()
    {
        $data['title']          = "Voucher";
        $data['voucher'] = $this->DataMaster_m->get_all_voucher();
        $data['vouchercode'] = $this->DataMaster_m->get_code_voucher();

        $this->load->view('DataMaster_Product/Voucher_v', $data);
    }

   
    public function AddVoucher()
    {
       
        $this->form_validation->set_rules('value_voucher', 'Nominal', 'required');

        $kode =substr(base64_encode(random_bytes(32)),1,10);

        if ($this->form_validation->run() == false) {
            $this->Voucher();
        } else {
            $data = array(
                'kode_voucher'          => $kode,
                'value_voucher'         => $this->input->post('value_voucher'),
                'description'           => $this->input->post('description'),
                'user_create'           => $this->session->userdata('username'),
                'date_create'       	=> date('Y-m-d H:i:s'),
                'is_used'               => 0,
                'is_get'               => 0

            );
            $this->DataMaster_m->insert_Voucher($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Voucher',
                'url'        => base_url('DataMaster_Product/AddVoucher'),
                'object'     => $data['kode_voucher'],
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
            redirect('DataMaster_Product/Voucher');
        }
    }
    


    
    public function DeleteVoucher($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_voucher_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Voucher',
            'object'     => $data['kode_voucher'],
            'url'        => base_url('DataMaster/DeleteVoucher'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_voucher($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster_Product/Voucher');
    }


    

}
