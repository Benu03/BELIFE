<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('DataMaster_m');
        $this->load->model('User_roles_m');
        $this->load->model('User_menu_m');
        $this->load->model('Users_m');
        $this->load->model('Log_activity_m');
    }

    public function index()
    {
        $this->UserRoles();
    }

    public function UserRoles()
    {
        $data['title']      = "User Roles";
        $data['dtUsrRoles'] = $this->User_roles_m->get_all();
        $this->load->view('User/UserRoles_v', $data);
    }

    public function AddRole()
    {

        $this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[user_roles.role]', [
            'is_unique' => 'Data Role has already added.'
        ]);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UserRoles();
        } else {
            $data = array(
                'role'      => $this->input->post('role'),
                'is_active' => strval($this->input->post('is_active'))
            );


            $this->User_roles_m->insert($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Role',
                'url'        => base_url('User/AddRole'),
                'object'     => $data['role'],
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
            redirect('User/UserRoles');
        }
    }

    public function AccessRole($id = NULL)
    {
        $data['title']  = "User Roles";
        $data['dtRole'] = $this->User_roles_m->get_data($id);
        $data['dtMenu'] = $this->User_menu_m->get_all_exc_usermenu();
        $this->load->view('User/AccessRole_v', $data);
    }

    public function ChangeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data   = ['role_id' => $role_id, 'menu_id' => $menu_id];
        $dtRole = $this->User_roles_m->get_data($data['role_id']);
        $dtMenu = $this->User_menu_m->get_data($data['menu_id']);
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Change access menu ' . $dtMenu['title'] . ' for ' . $dtRole['role'] . ' role',
            'url'        => base_url('User/ChangeAccess'),
            'object'     => $dtRole['role'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Access Changed.
            </div>
        ');
    }

    public function UpdateRole($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']  = "User Roles";
        $data['dtRole'] = $this->User_roles_m->get_data($id);
        $this->load->view('User/UpdateRole_v', $data);
    }

    public function EditRole($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UserRoles();
        } else {
            $data = array(
                'role'      => $this->input->post('role'),
                'is_active' => $this->input->post('is_active')
            );
            $this->User_roles_m->edit($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Role',
                'object'     => $data['role'],
                'url'        => base_url('Navigation/UpdateRole'),
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
            redirect('User/UserRoles');
        }
    }

    public function DeleteRole($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->User_roles_m->get_data($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data SubMenu',
            'object'     => $data['role'],
            'url'        => base_url('Navigation/DeleteSubMenu'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->User_roles_m->delete($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('User/UserRoles');
    }

    public function UserManagement()
    {
        $data['title']   = "User Management";
        $data['dtUsers'] = $this->Users_m->get_all();
        $data['dtRoles'] = $this->User_roles_m->get_all_exc_admin();
        $data['dtLoc']   = $this->DataMaster_m->get_all_worklocation();
        $data['dtOrg']   = $this->DataMaster_m->get_all_organization();
        $this->load->view('User/UserManagement_v', $data);
    }

    public function AddUser()
    {
        $this->form_validation->set_rules('username', 'Employee ID', 'required|trim|is_unique[users.username]', ['is_unique' => 'Employee ID has already added.']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        $this->form_validation->set_rules('id_loc', 'Worklocation', 'required');
        $this->form_validation->set_rules('id_org', 'Organization', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UserManagement();
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'name'       => $this->input->post('name'),
                'email'      => $this->input->post('email'),
                'id_role'    => $this->input->post('id_role'),
                'id_loc'     => $this->input->post('id_loc'),
                'id_org'     => $this->input->post('id_org'),
                'password'   => password_hash('BELIFE21', PASSWORD_DEFAULT),
                'img_user'   => 'default_img_user.png',
                'created_at' => date('Y-m-d H:i:s'),
                'is_active'  => strval($this->input->post('is_active'))
            );
            $this->Users_m->insert($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new User',
                'url'        => base_url('User/AddUser'),
                'object'     => $data['username'],
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
            redirect('User/UserManagement');
        }
    }

    public function ViewUser($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']  = "User Management";
        $data['dtUser'] = $this->Users_m->get_row_data($id);
        $this->load->view('User/ViewUser_v', $data);
    }

    public function UpdateUser($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']   = "User Management";
        $data['dtUser']  = $this->Users_m->get_row_data($id);
        $data['dtRoles'] = $this->User_roles_m->get_all_exc_admin();
        $data['dtLoc']   = $this->DataMaster_m->get_all_worklocation();
        $data['dtOrg']   = $this->DataMaster_m->get_all_organization();
        $this->load->view('User/UpdateUser_v', $data);
    }

    public function EditUser($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim');
        $this->form_validation->set_rules('id_role', 'Role', 'required|trim');
        $this->form_validation->set_rules('id_loc', 'Work Location', 'required|trim');
        $this->form_validation->set_rules('id_org', 'Organization', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->UserManagement();
        } else {
            $data = array(
                'name'       => $this->input->post('name'),
                'email'      => $this->input->post('email'),
                'id_role'    => $this->input->post('id_role'),
                'id_loc'     => $this->input->post('id_loc'),
                'id_org'     => $this->input->post('id_org'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active'  => $this->input->post('is_active')
            );
            $this->Users_m->edit_data($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data User',
                'object'     => $data['name'],
                'url'        => base_url('User/UpdateUser'),
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
            redirect('User/UserManagement');
        }
    }

    public function ResetPassUser($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->Users_m->get_row_data($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Reset password User',
            'object'     => $data['username'],
            'url'        => base_url('User/ResetPassUser'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $dtPass = array(
            'password'   => password_hash('SMSF2021', PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->Users_m->edit_data($id, $dtPass);

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Password user has been reset.
            </div>
        ');
        redirect('User/UserManagement');
    }

    public function UserActivity()
    {
        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_all();
        $this->load->view('User/UserActivity_v', $data);
    }

    public function ViewUserActivity($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_data($id);
        $this->load->view('User/ViewUserActivity_v', $data);
    }
}
