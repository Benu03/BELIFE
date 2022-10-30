<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Product_m');
        $this->load->model('Smarch_m');
    }

    public function index()
    {

        $this->MyProfile();
    }

    public function MyProfile()

    {
        $data['title']          = "My Profile";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['contract_data']     = $this->Users_m->get_user_contract($this->session->userdata('username'));
        
        if(isset($data['contract_data'])){
            $contract_no = $data['contract_data']['contract_no'];
        }else {
            $contract_no ='20222022';
            $data['contract_data']  = ['status_contract' => 'NO CONTRACT'];
        }
        $data['contract'] = $this->Smarch_m->checkcontract($contract_no)->row_array();
        $data['personaldata'] = $this->Smarch_m->personaldata($this->session->userdata('username'))->row_array();
        $data['installment_data'] = $this->Smarch_m->installmentdata($contract_no)->result_array();
        $data['history_contract'] = $this->Smarch_m->history_contract($this->session->userdata('username'))->result_array();
       

        $username  = $data['usrProfile']['username'];
        $data['personal']  = $this->Users_m->personal_customer_check($username)->row_array();
        $data['datacart']    = $this->Product_m->get_data_keranjang($username)->num_rows();

        $this->load->view('Home/MyProfile_v', $data);
    }

    public function UpdateImage($username = NULL)
    {
        $id = Decrypt_url($username);

        if (empty($_FILES['img_user']['name'])) {
            $this->session->set_flashdata('pass_message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File Belu Di pilih.
                </div>
            ');
            redirect('Home/MyProfile');
        } else {
            if ($_FILES['img_user']['size'] >= 524288) {
                $this->session->set_flashdata('pass_message', '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                        File size cannot be more than 512kb.
                    </div>
                ');
                redirect('Home/MyProfile');
            } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $id, 0777, true);
                $default_name                = $id . ".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $id;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['img_user']['name'])) {
                    if ($this->upload->do_upload('img_user')) {
                        $this->upload->data();
                    }
                }



                $dataUpdate = array(
                    'img_user'   => $default_name,
                    'updated_at' => date('Y-m-d H:i:s')
                );


                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Change own profile image',
                    'object'     => $id,
                    'url'        => base_url('Home/MyProfile/UpdateImage'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->edit($id, $dataUpdate);
                $this->session->set_flashdata('pass_message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Image Profile has been updated.
                    </div>
                ');
                redirect('Home/MyProfile');
            }
        }
    }

    public function EditProfile($username = NULL)
    {
        $id = Decrypt_url($username);

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->MyProfile();
        } else {
            $data = array(
                'name'       => $this->input->post('name'),
                'email'      => $this->input->post('email'),
                'id_org'     => $this->input->post('id_org'),
                'id_loc'     => $this->input->post('id_loc'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Change own profile data',
                'object'     => $id,
                'url'        => base_url('Home/MyProfile/EditProfile'),
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_activity', $logData);

            $this->Users_m->edit($id, $data);
            $this->session->set_flashdata('pass_message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Success!</h5>
                    Your profile has been updated.
                </div>
            ');
            redirect('Home/MyProfile');
        }
    }

    public function ChangePassword($username = NULL)
    {
        $id = Decrypt_url($username);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->MyProfile();
        } else {
            $checkUsrPass     = $this->Users_m->get_password($id);
            $current_password = $this->input->post('current_password');
            $new_password     = $this->input->post('new_password1');

            if (!password_verify($current_password, $checkUsrPass)) {
                $this->session->set_flashdata('pass_message', '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Wrong current password!
                    </div>
                ');
                redirect('Home/MyProfile');
            } else {
                if ($current_password === $new_password) {
                    $this->session->set_flashdata('pass_message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            New password cannot be the same as current password!
                        </div>
                    ');
                    redirect('Home/MyProfile');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $logData = [
                        'username' => $this->session->userdata('username'),
                        'activities' => 'Change own password',
                        'object'     => $id,
                        'url'        => base_url('Home/MyProfile/ChangePassword'),
                        'ipdevice'   => Get_ipdevice(),
                        'at_time'    => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('log_activity', $logData);

                    $this->Users_m->edit_password($id, $password_hash);
                    $this->session->set_flashdata('pass_message', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                            Password has been updated.
                        </div>
                    ');
                    redirect('Home/MyProfile');
                }
            }
        }
    }

    public function PersonalData()
    {

        $data['title']          = "Personal Data";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        // $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();

        $username = $data['usrProfile']['username'];
        $data['personaluser'] = $this->Users_m->personal_customer_get($username)->row_array();
   


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('id_partner', 'id_partner', 'required');
        $this->form_validation->set_rules('id_loc', 'id_loc', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('Home/Personal_informasi', $data);
        } else {

            if (empty($_FILES['image_selfie']['name'])) {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                        Your file is empty.
                    </div>
                ');
                redirect('Home/PersonalCustomer');
            } else {
                if ($_FILES['image_selfie']['size'] >= 524288) {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                            File size cannot be more than 512kb.
                        </div>
                    ');
                    redirect('Home/PersonalCustomer');
                } else {
                    $this->load->library('upload');
                    mkdir("./assets/img/img-profile/" . $username);
                    $default_name                = 'SELFIE_' . $username . ".jpg";
                    $config_img['upload_path']   = './assets/img/img-profile/' . $username . '/';
                    $config_img['allowed_types'] = 'jpg|jpeg|png';
                    $config_img['file_name']     = $default_name;
                    $config_img['overwrite']     = TRUE;
                    $config_img['max_size']      = 512; /* max 512kb */
                    $this->upload->initialize($config_img);
                    if (($_FILES['image_selfie']['name'])) {
                        if ($this->upload->do_upload('image_selfie')) {
                            $this->upload->data();
                        }
                    }




                    $datapersonal = array(
                        'username'     => $username,
                        'email'     => $this->input->post('email'),
                        'name_full'     => $this->input->post('name'),
                        'phone'   => $this->input->post('phone'),
                        'address'       => $this->input->post('alamat'),
                        'selfie_image' => $default_name,
                        'id_partner'       => $this->input->post('id_partner'),
                        'id_loc' => $this->input->post('id_loc'),
                        'datetime_post' => date('Y-m-d H:i:s')
                    );



                    $this->db->insert('personal_customer', $datapersonal);






            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                Silakan Melanjutkan Pesanan.
            </div>
        ');




                    redirect('Feature/Keranjang');
                }
            }
        }
    }



    public function Upload_ktp()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        if(empty($_FILES['ktp_image']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File KTP Belum Di pilih.
                </div>
            ');
            redirect('Home/PersonalData');
        } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $username, 0777, true);
                $default_name                = "KTP_".$username.".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $username;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['ktp_image']['name'])) {
                    if ($this->upload->do_upload('ktp_image')) {
                        $this->upload->data();
                    }
                }

                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload ktp_image',
                    'object'     => $username,
                    'url'        => base_url('Home/Upload_ktp'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->upload_ktp($username, $default_name);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        KTP sudah terupload.
                    </div>
                ');
                redirect('Home/PersonalData');
            
        }

    }

    
    public function Upload_selfie()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        if(empty($_FILES['selfie_image']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File Selfie Belum Di pilih.
                </div>
            ');
            redirect('Home/PersonalData');
        } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $username, 0777, true);
                $default_name                = "SELFIE_".$username.".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $username;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['selfie_image']['name'])) {
                    if ($this->upload->do_upload('selfie_image')) {
                        $this->upload->data();
                    }
                }

                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload selfie_image',
                    'object'     => $username,
                    'url'        => base_url('Home/Upload_selfie'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->upload_selfie($username, $default_name);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Selfie sudah terupload.
                    </div>
                ');
                redirect('Home/PersonalData');
            
        }

    }


     
    public function Upload_selfie_ktp()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        if(empty($_FILES['selfie_ktp_image']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File Selfie KTP Belum Di pilih.
                </div>
            ');
            redirect('Home/PersonalData');
        } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $username, 0777, true);
                $default_name                = "SELFIE_KTP_".$username.".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $username;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['selfie_ktp_image']['name'])) {
                    if ($this->upload->do_upload('selfie_ktp_image')) {
                        $this->upload->data();
                    }
                }

                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload selfie_ktp_image',
                    'object'     => $username,
                    'url'        => base_url('Home/Upload_selfie_ktp'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->upload_selfie_ktp($username, $default_name);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Selfie KTP sudah terupload.
                    </div>
                ');
                redirect('Home/PersonalData');
            
        }

    }


    public function Upload_buku_tabungan()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        if(empty($_FILES['buku_tabungan_image']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File Buku Tabungan Belum Di pilih.
                </div>
            ');
            redirect('Home/PersonalData');
        } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $username, 0777, true);
                $default_name                = "BUKU_TABUNGAN_".$username.".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $username;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['buku_tabungan_image']['name'])) {
                    if ($this->upload->do_upload('buku_tabungan_image')) {
                        $this->upload->data();
                    }
                }

                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload buku_tabungan_image',
                    'object'     => $username,
                    'url'        => base_url('Home/Upload_buku_tabungan'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->upload_buku_tabungan($username, $default_name);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Buku Tabungan sudah terupload.
                    </div>
                ');
                redirect('Home/PersonalData');
            
        }

    }



    public function Upload_slip_gaji()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

                     if(empty($_FILES['slip_gaji_image']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    File Slip Gaji Belum Di pilih.
                </div>
            ');
            redirect('Home/PersonalData');
        } else {
                $this->load->library('upload');
                mkdir("./assets/img/img-profile/" . $username, 0777, true);
                $default_name                = "SLIP_GAJI_".$username.".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $username;
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                chmod($config_img['upload_path'], 0777);

                $this->upload->initialize($config_img);


                if (($_FILES['slip_gaji_image']['name'])) {
                    if ($this->upload->do_upload('slip_gaji_image')) {
                        $this->upload->data();
                    }
                }

                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Upload slip_gaji_image',
                    'object'     => $username,
                    'url'        => base_url('Home/Upload_slip_gaji'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);

                $this->Users_m->upload_slip_gaji($username, $default_name);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Slip Gaji sudah terupload.
                    </div>
                ');
                redirect('Home/PersonalData');
            
        }

    }



    public function UpdateRegisterStatus()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        $datapersonal = $this->Users_m->personal_customer_check($username)->row_array();

        if($datapersonal['ktp_image'] == null ){
            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
             </div>');
            redirect('Home/PersonalData');
         }
         elseif($datapersonal['selfie_ktp_image'] == null){
            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
             </div>');
            redirect('Home/PersonalData');

         }
         elseif($datapersonal['buku_tabungan'] == null){
            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
             </div>');
            redirect('Home/PersonalData');

         }
         elseif($datapersonal['slip_gaji'] == null){
            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
             </div>');
            redirect('Home/PersonalData');

         }
         elseif($datapersonal['selfie'] == null){
            $this->session->set_flashdata('message', '
            <div class="alert alert-info alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i>Info!</h5>
               Mohon Untuk Menlengkapi Data Profile Terlebih Dahulu  ...!!!
             </div>');
            redirect('Home/PersonalData');

         }else{
        
                $logData = [
                    'username' => $this->session->userdata('username'),
                    'activities' => 'Update Register Status',
                    'object'     => $username,
                    'url'        => base_url('Home/UpdateRegisterStatus'),
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('log_activity', $logData);
                $statusregister ='update';
                $this->Users_m->upload_status_register($username, $statusregister);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                        Data Anda Akan Di verifikasi Admin...!
                    </div>
                ');
                redirect('Home');
            
            }

    }


    

}



