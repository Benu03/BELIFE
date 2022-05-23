<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('user_menu_m');
        $this->load->model('user_sub_menu_m');
    }

    public function index()
    {
        $this->Menu();
    }

    public function Menu()
    {
        $data['title']  = "Menu";
        $data['dtMenu'] = $this->user_menu_m->get_all();
        $this->load->view('Navigation/Menu_v', $data);
    }

    public function AddMenu()
    {
        $this->form_validation->set_rules('title', 'Menu Title', 'required|trim');
        $this->form_validation->set_rules('url', 'Menu URL', 'required|trim|is_unique[user_menu.url]', ['is_unique' => 'URL has already added.']);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->Menu();
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'url'   => $this->input->post('url'),
                'icon'  => $this->input->post('icon'),
                'name'  => $this->input->post('name')
            );
            $this->user_menu_m->insert($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Menu',
                'url'        => base_url('Navigation/AddMenu'),
                'object'     => $data['url'],
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
            redirect('Navigation/Menu');
        }
    }

    public function UpdateMenu($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']  = "Menu";
        $data['dtMenu'] = $this->user_menu_m->get_data($id);
        $this->load->view('Navigation/UpdateMenu_v', $data);
    }

    public function EditMenu($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('title', 'Icon', 'required|trim');
        $this->form_validation->set_rules('url', 'Icon', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->UpdateMenu($id);
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'url'   => $this->input->post('url'),
                'icon'  => $this->input->post('icon'),
                'name'  => $this->input->post('name')
            );
            $this->user_menu_m->edit($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Menu',
                'object'     => $data['url'],
                'url'        => base_url('Navigation/UpdateMenu'),
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
            redirect('Navigation/Menu');
        }
    }

    public function DeleteMenu($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->user_menu_m->get_data($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Menu',
            'object'     => $data['url'],
            'url'        => base_url('Navigation/DeleteMenu'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->user_menu_m->delete($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('Navigation/Menu');
    }

    public function SubMenu()
    {
        $data['title']     = "Sub Menu";
        $data['dtMenu']    = $this->user_menu_m->get_all();
        $data['dtSubMenu'] = $this->user_sub_menu_m->get_all();
        $this->load->view('Navigation/SubMenu_v', $data);
    }

    public function AddSubMenu()
    {
        // $this->form_validation->set_rules('title', 'Sub Menu Title', 'required|trim|is_unique[user_sub_menu.title]');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->SubMenu();
        } else {
            $data = array(
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'       => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            );
            $this->user_sub_menu_m->insert($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new SubMenu',
                'url'        => base_url('Navigation/AddSubMenu'),
                'object'     => $data['title'],
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
            redirect('Navigation/SubMenu');
        }
    }

    public function UpdateSubMenu($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']     = "Sub Menu";
        $data['dtMenu']    = $this->user_menu_m->get_all();
        $data['dtSubMenu'] = $this->user_sub_menu_m->get_data($id);
        $this->load->view('Navigation/UpdateSubMenu_v', $data);
    }

    public function EditSubMenu($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->SubMenu();
        } else {
            $data = array(
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'       => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            );
            $this->user_sub_menu_m->edit($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data SubMenu',
                'url'        => base_url('Navigation/UpdateSubMenu'),
                'object'     => $data['title'],
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
            redirect('Navigation/SubMenu');
        }
    }

    public function DeleteSubMenu($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->user_sub_menu_m->get_data($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data SubMenu',
            'object'     => $data['title'],
            'url'        => base_url('Navigation/DeleteSubMenu'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->user_sub_menu_m->delete($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('Navigation/SubMenu');
    }
}
