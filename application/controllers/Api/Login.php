<?php
require_once APPPATH . 'helpers/Belife_helper.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {



	public function __construct()
	{

			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		

		  

	}



	
	public function index()
	{
		
        $this->load->model('api_model','blm');

        $email = $this->input->get('email');
        $password = $this->input->get('password');
		$client_signature = $this->input->get('signature');
        $list_gets = array(
            'email' => $email,
            'password' => $password,
            'company_id' => 'BELIFE',
			'belife_signature' => $client_signature
           
        );

        $secret_key = $this->blm->get_secret_key($list_gets['company_id']);
	    $signature = new Belife_helper();
        $belife_signature = $signature->get_signature_login($list_gets, $secret_key[0]['SecretKey']);
		
		
		
        if ($client_signature === $belife_signature) {

			
			$user = $this->db->get_where('users', ['email' => $email])->row_array();
			
			if($user){

			  if($user['is_active'] == 1){

					  if(password_verify($password, $user['password'])) {
						  			$status ='true';
									$message ='Login Berhasil';  
									$datauser =  $this->blm->datauser($email);
									$datalimit = [
										'email' => $email,
										'limit' => '10000000'];

									$product = [

										'id_product' => 'PRD_001',
										'name_product' => 'Kopi Kenangan',
										'harga_product' => '50000' 

									];						
												
										$datajson =json_encode(array('status' => $status,
																	 'message' => $message,
																	'datauser' => $datauser['0'],					
																	'datalimit' => $datalimit,
																	'product' => $product		
								
									
									));
										echo $datajson;          

									
											
											if($user['id']==1){

												$logData = [
													'employeeid' => $user['employeeid'],
													'activities' => 'Login to App wtih mobile',
													'object'     => $user['email'],
													'url'        => base_url('Auth/Login'),
													'ipdevice'   => Get_ipdevice(),
													'at_time'    => date('Y-m-d H:i:s')
												];
												$this->db->insert('log_activity', $logData);										  

										    	} 
											
											else {

												$logData = [
													'employeeid' => $user['employeeid'],
													'activities' => 'Login to App wtih mobile',
													'object'     => $user['employeeid'],
													'url'        => base_url('Auth/Login'),
													'ipdevice'   => Get_ipdevice(),
													'at_time'    => date('Y-m-d H:i:s')
												];
												$this->db->insert('log_activity', $logData);
											

												}


					  }

					  else {
						$status ='false';
						$message ='Password Salah';  
					
							
							$datajson =json_encode(array('status' => $status,
							'message' => $message
									));
										   
							  echo $datajson;             

					  }

			  }
			   else {
						
				$status ='false';
				$message ='User Tidak Active';  
			
					
					$datajson =json_encode(array('status' => $status,
					'message' => $message
							));
																   
							  echo $datajson;   

			  }

			}
			else
			{
				


				$status ='false';
				$message ='User Belum Terdaftar';  
			
					
					$datajson =json_encode(array('status' => $status,
					'message' => $message
							));
																   
							  echo $datajson;   

			

			}




            

        } else {
            echo 'Signature yang digenerate Belife : ' . $belife_signature.'<br>';
            $this->output->set_status_header('401');
            echo '401 Unauthorized';
        }

	
		


	}


















	



















}