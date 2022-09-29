<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMasterFinance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Finance_m');
    }


 


    public function Coa()
    {
        $data['title']          = "Chart Of Account";
        $data['coa'] = $this->Finance_m->get_all_coa();
        $this->load->view('Finance/Coa', $data);
    }


    public function AddCoa()
    {
        $this->form_validation->set_rules('coa_name', 'Coa Name', 'required|trim|is_unique[coa.coa_name]', ['is_unique' => 'Ekspedisi name has already added.']);
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->Coa();
        } else {
            $datainsertcoa = array(
                'coa_name' => $this->input->post('coa_name'),
                'description' => $this->input->post('description'),
                'is_active'         => $this->input->post('is_active')
            );

            $this->db->insert('coa', $datainsertcoa);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Ekspedisi',
                'url'        => base_url('DataMaster_Product/AddCoa'),
                'object'     => $datainsertcoa['coa_name'],
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
            redirect('DataMasterFinance/Coa');
        }
    }

  


    public function UpdateCoa($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']          = "Chart Of Account";
        $data['coaid'] = $this->Finance_m->get_Coa_byid($id);
        $this->load->view('Finance/UpdateCoa_v', $data);
    }



    public function EditCoa($id = NULL)
    {
        $id = Decrypt_url($id);

        $this->form_validation->set_rules('coa_name', 'Coa Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == false) {
            $this->UpdateCoa($id);
        } else {
            $data = array(
                'coa_name' => $this->input->post('coa_name'),
                'description' => $this->input->post('description'),
                'is_active'         => $this->input->post('is_active')
            );
            $this->Finance_m->edit_Coa($id, $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Update data Coa',
                'object'     => $data['ekspedisi_name'],
                'url'        => base_url('DataMasterFinance/EditCoa'),
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
            redirect('DataMasterFinance/Coa');
        }
    }


    public function DeleteCoa($id = NULL)
    {
        $id   = Decrypt_url($id);
        $data = $this->Finance_m->get_Coa_byid($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delete data Coa',
            'object'     => $data['coa_name'],
            'url'        => base_url('DataMasterFinance/DeleteCoa'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->Finance_m->delete_Coa($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been deleted.
            </div>
        ');
        redirect('DataMasterFinance/Coa');
    }










    
    

}
