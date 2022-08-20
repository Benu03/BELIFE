<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smart_Search extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Smarch_m');
        $this->load->model('Users_m');
        $this->load->model('Log_activity_m');
    }


	public function index()
	{
		$data['title']      = "Smart Search";
		$data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
		$this->load->view('Smart_Search/index', $data);

	}


	public function Kontrak_detail()
	{
		$data['title']      = "Kontrak Detail";
		$data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

		$this->form_validation->set_rules('contract_no', 'Kontrak', 'required');
		
		if ($this->form_validation->run() == false) {
            $this->index();
        } else {
			$contract_no =$this->input->post('contract_no');

			
			$check = $this->Smarch_m->checkcontract($contract_no)->num_rows();

			if($check == 0){
				$this->session->set_flashdata('message', '
				<div class="alert alert-warning alert-dismissible">
					 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
					 <h5><i class="icon fas fa-info"></i>Warning!</h5>
					 Kontrak Tidak ada</div> ');
	
				redirect('Smart_Search/index');

			}
			else{

				$dataUser = $this->Smarch_m->checkcontract($contract_no)->row_array();
				$usercontract = $dataUser['user_order'];
				$data['contract'] = $this->Smarch_m->checkcontract($contract_no)->row_array();
				$data['personaldata'] = $this->Smarch_m->personaldata($usercontract)->row_array();
				$data['installment_data'] = $this->Smarch_m->installmentdata($contract_no)->result_array();
				$data['history_contract'] = $this->Smarch_m->history_contract($usercontract)->result_array();
		
				$this->load->view('Smart_Search/kontrak_detail', $data);
			}


		}
	}
	



}
