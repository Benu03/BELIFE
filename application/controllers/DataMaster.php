<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMaster extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('DataMaster_m');
    }

    public function index()
    {
        $this->WorkLocation();
    }

    public function WorkLocation()
    {
        $data['title']      = "Work Location";
        $data['dtLocation'] = $this->DataMaster_m->get_all_worklocation();
        $this->load->view('DataMaster/WorkLocation_v', $data);
    }

    public function TenorSetting()
    {
        $data['title']      = "Tenor Setting";
        $data['rate'] = $this->DataMaster_m->get_all_rate();
        $this->load->view('DataMaster/Tenor_v', $data);
    }


    public function AddWorkLocation()
    {
        $this->form_validation->set_rules('location_name', 'Location Name', 'required|trim|is_unique[worklocation.location_name]', ['is_unique' => 'Location name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->WorkLocation();
        } else {
            $data = array(
                'location_name' => $this->input->post('location_name'),
                'is_active'     => $this->input->post('is_active')
            );
            $this->DataMaster_m->insert_worklocation($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Work Location',
                'url'        => base_url('DataMaster/AddWorkLocation'),
                'object'     => $data['location_name'],
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
            redirect('DataMaster/WorkLocation');
        }
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
                'url'        => base_url('DataMaster/AddTenor'),
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
            redirect('DataMaster/TenorSetting');
        }
    }


    public function UpdateWorkLocation($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Work Location";
        $data['dtLocation'] = $this->DataMaster_m->get_worklocation_byid($id);
        $this->load->view('DataMaster/UpdateWorkLocation_v', $data);
    }


    public function UpdateTenor($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Tenor Setting";
        $data['tenor'] = $this->DataMaster_m->get_tenor_byid($id);
        $this->load->view('DataMaster/UpdateTenor_v', $data);
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
                'url'        => base_url('DataMaster/EditTenor'),
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
            redirect('DataMaster/TenorSetting');
        }
    }

    public function EditWorkLocation($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('location_name', 'Location Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateWorkLocation($id);
        } else {
            $data = array(
                'location_name' => $this->input->post('location_name'),
                'is_active'     => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_worklocation($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Work Location',
                'object'     => $data['location_name'],
                'url'        => base_url('DataMaster/UpdateWorkLocation'),
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
            redirect('DataMaster/WorkLocation');
        }
    }

    public function DeleteWorkLocation($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_worklocation_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Work Location',
            'object'     => $data['location_name'],
            'url'        => base_url('DataMaster/DeleteWorkLocation'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_worklocation($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster/WorkLocation');
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


    public function Organization()
    {
        $data['title']          = "Organization";
        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $this->load->view('DataMaster/Organization_v', $data);
    }

    public function Fintech()
    {
        $data['title']          = "Fintech";
        $data['fintech'] = $this->DataMaster_m->get_all_fintect();
        $this->load->view('DataMaster/Fintech_v', $data);
    }

    public function AddOrganization()
    {
        $this->form_validation->set_rules('organization_name', 'Organization Name', 'required|trim|is_unique[organization.organization_name]', ['is_unique' => 'Organization name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Organization();
        } else {
            $data = array(
                'organization_name' => $this->input->post('organization_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->insert_organization($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Organization',
                'url'        => base_url('DataMaster/AddOrganization'),
                'object'     => $data['organization_name'],
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
            redirect('DataMaster/Organization');
        }
    }


    public function AddFintech()
    {
        $this->form_validation->set_rules('fintech_name', 'fintech Name', 'required|trim|is_unique[fintech.fintech_name]', ['is_unique' => 'fintech name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Organization();
        } else {
            $data = array(
                'fintech_name' => $this->input->post('fintech_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->insert_fintech($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Fintech',
                'url'        => base_url('DataMaster/AddFintech'),
                'object'     => $data['fintech_name'],
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
            redirect('DataMaster/Fintech');
        }
    }

    public function UpdateOrganization($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Organization";
        $data['dtOrganization'] = $this->DataMaster_m->get_organization_byid($id);
        $this->load->view('DataMaster/UpdateOrganization_v', $data);
    }


    public function Updatefintech($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Fintech";
        $data['fintech'] = $this->DataMaster_m->get_fintech_byid($id);
        $this->load->view('DataMaster/Updatefintech_v', $data);
    }


    public function EditOrganization($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('organization_name', 'Organization Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateOrganization($id);
        } else {
            $data = array(
                'organization_name' => $this->input->post('organization_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_organization($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Organization',
                'object'     => $data['organization_name'],
                'url'        => base_url('DataMaster/UpdateOrganization'),
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
            redirect('DataMaster/Organization');
        }
    }


    public function Editfintech($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('fintech_name', 'fintech Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Updatefintech($id);
        } else {
            $data = array(
                'fintech_name' => $this->input->post('fintech_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_fintech($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data fintech',
                'object'     => $data['fintech_name'],
                'url'        => base_url('DataMaster/Updatefintech'),
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
            redirect('DataMaster/Fintech');
        }
    }


    public function DeleteOrganization($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_organization_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Organization',
            'object'     => $data['organization_name'],
            'url'        => base_url('DataMaster/DeleteOrganization'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_organization($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster/Organization');
    }

    public function DeleteFintech($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_fintech_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Fintech',
            'object'     => $data['fintech_name'],
            'url'        => base_url('DataMaster/Deletefintech'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_fintech($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster/Fintech');
    }





    public function Patner()
    {
        $data['title']          = "Patner";
        $data['Patner'] = $this->DataMaster_m->get_all_Patner();
        $this->load->view('DataMaster/Patner_v', $data);
    }


    public function AddPatner()
    {
        $this->form_validation->set_rules('patner_name', 'patner Name', 'required|trim|is_unique[patner.patner_name]', ['is_unique' => 'patner name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Organization();
        } else {
            $data = array(
                'patner_name' => $this->input->post('patner_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->insert_patner($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new patner',
                'url'        => base_url('DataMaster/AddPatner'),
                'object'     => $data['patner_name'],
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
            redirect('DataMaster/Patner');
        }
    }

    public function Updatepatner($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Patner";
        $data['patner'] = $this->DataMaster_m->get_patner_byid($id);
        $this->load->view('DataMaster/Updatepatner_v', $data);
    }

    public function Editpatner($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('patner_name', 'patner Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Updatepatner($id);
        } else {
            $data = array(
                'patner_name' => $this->input->post('patner_name'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_patner($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data patner',
                'object'     => $data['patner_name'],
                'url'        => base_url('DataMaster/Updatepatner'),
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
            redirect('DataMaster/Patner');
        }
    }


    public function Deletepatner($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->DataMaster_m->get_patner_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Patner',
            'object'     => $data['patner_name'],
            'url'        => base_url('DataMaster/Deletepatner'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->DataMaster_m->delete_patner($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMaster/Patner');
    }






    public function GeneralSetting()
    {
        $data['title']          = "General Setting";
        $data['General'] = $this->DataMaster_m->get_all_general_setting();
        $this->load->view('DataMaster/General_v', $data);
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

            $default_name_file          = $_FILES['file_upload']['name'];
            $config_file['upload_path']   = './assets/img/general';
            $config_file['allowed_types'] = '*';
            $config_file['file_name']     = $default_name_file;
            $config_file['overwrite']     = TRUE;
            $config_file['max_size']      = 512; /* max 512kb */
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
                'user_update'           => $this->session->userdata('user_update'),
                'date_update'           => date('Y-m-d H:i:s')
            );





            $this->DataMaster_m->insert_general($data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new General Setting',
                'url'        => base_url('DataMaster/AddGeneral'),
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
            redirect('DataMaster/GeneralSetting');
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
        redirect('DataMaster/GeneralSetting');
    }


    public function UpdateGeneral($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "General Setting";
        $data['general'] = $this->DataMaster_m->get_general_byid($id);
        $this->load->view('DataMaster/Updategeneral_v', $data);
    }



    public function EditGeneral($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('code', 'Kode', 'required|trim|is_unique[ms_general.code]', ['is_unique' => 'Kode name has already added.']);
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateGeneral($id);
        } else {
            $data = array(
                'code'                  => $this->input->post('code'),
                'description'           => $this->input->post('description'),
                'value'                  => $this->input->post('value'),
                'is_active'                  => $this->input->post('is_active')
            );
            $this->DataMaster_m->edit_general($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data General Setting',
                'object'     => $data['code'],
                'url'        => base_url('DataMaster/UpdateGeneral'),
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
            redirect('DataMaster/GeneralSetting');
        }
    }
}
