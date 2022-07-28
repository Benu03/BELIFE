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


        $username  = $data['usrProfile']['username'];
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
                    Your file is empty.
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
                mkdir("./assets/img/img-profile/" . $id);
                $default_name                = $id . ".jpg";
                $config_img['upload_path']   = './assets/img/img-profile/' . $id . '/';
                $config_img['allowed_types'] = 'jpg|jpeg|png';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
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

    public function PersonalCustomer()
    {

        $data['title']          = "Personal Information";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['dtWorklocation'] = $this->DataMaster_m->get_all_worklocation();

        $username = $data['usrProfile']['username'];
        $data['personaluser'] = $this->Users_m->personal_customer_check($username)->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('id_org', 'id_org', 'required');
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
                        'id_org'       => $this->input->post('id_org'),
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
}
