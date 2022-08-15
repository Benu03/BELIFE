<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
    }

    public function Index()
    {
        $this->Login();
    }


    public function Login()
    {
        if ($this->session->userdata('username')) {
            redirect('Home');
        }

        $data['title'] = "Login";

        $this->form_validation->set_rules('username', 'Employee ID', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login_v', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password   = $this->input->post('password');
        $user       = $this->Users_m->get_session($username);


        // Jika data user ada
        if ($user) {
            // Jika data user aktif
            if ($user['is_active'] == '1') {
                // Match password user
                if (password_verify($password, $user['password'])) {

                    $logData = [
                        'username' => $user['username'],
                        'activities' => 'Login to App',
                        'object'     => $user['username'],
                        'url'        => base_url('Auth/Login'),
                        'ipdevice'   => Get_ipdevice(),
                        'at_time'    => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('log_activity', $logData);

                    $sessionData = [
                        'name'         => $user['name'],
                        'username'   => $user['username'],
                        'img_user'     => $user['img_user'],
                        'email'        => $user['email'],
                        'id_role'      => $user['id_role'],
                        'worklocation' => $user['location_name'],
                        'organization' => $user['organization_name'],
                        'is_login'      => TRUE
                    ];
                    $this->session->set_userdata($sessionData);



                    if ($sessionData['id_role'] == '2') {

                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Homepage');
                    } elseif ($sessionData['id_role'] == '3') {



                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('DashboardAdmin_belife');
                    } elseif ($sessionData['id_role'] == '4') {



                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('DashboardAdmin_Product');
                    } elseif ($sessionData['id_role'] == '5') {


                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('DashboardBOD');
                    } elseif ($sessionData['id_role'] == '6') {


                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('DashboardFinance');
                    } else {



                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Home');
                    }
                } else {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                            Wrong password!
                        </div>
                    ');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                        Your account has not been activated.
                    </div>
                ');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    Your account is not registered.
                </div>
            ');
            redirect('Auth');
        }
    }

    public function Registration()
    {
        // if ($this->session->userdata('username')) {
        //     redirect('Home');
        // }

        $data['title'] = "Registration";

        $data['dtOrganization'] = $this->DataMaster_m->get_all_organization();
        $data['patner'] = $this->DataMaster_m->get_all_patner();

        $data['provinsi'] = $this->DataMaster_m->get_all_provinsi();
        $data['kota'] = $this->DataMaster_m->get_all_kota();

        //Validasi Form Register
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
    
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[1]|matches[password2]', [
            'matches' => 'Password didnt match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register_v', $data);
        } else {


            $userNameRandom = $this->input->post('name', true);
            $userNameRandom2 = strtoupper(substr($userNameRandom, 0, 4)) . date('Hs');


                    $dataregister = array(
                        'name'          => htmlspecialchars($this->input->post('name', true)),
                        'username'      => $userNameRandom2,
                        'email'         => htmlspecialchars($this->input->post('email', true)),
                        'img_user'      => 'default_img_user.png',
                        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                        'created_at'    => date('Y-m-d H:i:s'),
                        'id_role'       => 2,
                        'is_active'     => '0'
                    );



                    $originalDate = $this->input->post('tgl_lahir', true);
                    $tgl_lahir =  str_replace('/', '-', $originalDate);

                    $datapersonal = array(

                        'username'          => $userNameRandom2,
                        'name_full'         => $this->input->post('name', true),
                        'email'             => $this->input->post('email', true),
                        'phone'             => $this->input->post('nohp', true),
                        'nik'               => $this->input->post('nik', true),
                        'tgl_lahir'         => date('Y-m-d', strtotime($tgl_lahir)),
                        'tempat_lahir'      => $this->input->post('tempat_lahir', true),
                        'jenis_kelamin'     => $this->input->post('jenis_kelamin', true),
                        'provinsi_id'       => $this->input->post('provinsi', true),
                        'kota_id'           => $this->input->post('kota', true),
                        'address_ktp'       => $this->input->post('alamat', true),
                        // 'selfie_image'      => $default_name_selfie,
                        // 'ktp_image'         => $default_name_ktp,
                        // 'selfie_ktp_image'  => $default_name_selfie_ktp,
                        'limit_user'        => 0,
                        'id_loc'            => 1,
                        'id_org'            => $this->input->post('id_org', true),
                        'datetime_post'     => date('Y-m-d H:i:s')

                    );


                    // $this->Users_m->insert($dataregister);
                    // $this->Users_m->insert_datapersonal($datapersonal);
                    mkdir("./assets/img/img-profile/" . $userNameRandom2, 0777, true);
                    

                    $sessionData = [
                        'username'          => $userNameRandom2,
                        'email'             => $this->input->post('email', true)
                    ];
                    $this->session->set_userdata($sessionData);       

                    redirect('Auth/Registration_upload');
            //     }
            // }
        }
    }


    
    public function Registration_upload()
    {
       
        $data['title'] = "Registration";

        $datasession = $this->session->userdata();
        

        $data['username'] = $this->session->userdata('username');
        $data['email'] =$this->session->userdata('email');



        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register_v2', $data);
        } else {
      
            if (empty($_FILES['selfie_image']['name']) && empty($_FILES['ktp_image']['name']) && empty($_FILES['selfie_ktp_image']['name']) && empty($_FILES['buku_tabungan']['name']) && empty($_FILES['slip_gaji']['name'])) {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                        Your file is empty.
                    </div>
                ');
                redirect('Registration_upload');
            } else {
              
                    $email  = $datasession['email'];

                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_create' => time()
                    ];

                    $this->db->insert('user_token', $user_token);

                    $this->_sendEmail($token, 'verify');

                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('email');
                    $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Congratulation!</h5>
                    Anda Berhasil Registrasi, Silakan Menunggu Verifikasi Dari Admin.
                </div>
            ');
                    redirect('Auth');
                 }
             
             }
    }

    

    function Upload_selfie_image(){

        $username= $this->input->post('username');
        $email= $this->input->post('email');

        var_dump($username);

        $default_name_selfie          = 'SELFIE_' . $username . ".jpg";
        $config_img['upload_path']   = './assets/img/img-profile/' . $username . '/';
        $config_img['allowed_types'] = 'jpg|jpeg|png';
        $config_img['file_name']     = $default_name_selfie;
        $config_img['overwrite']     = TRUE;
        $config['encrypt_name']     = TRUE;
        $config_img['max_size']      = 512; /* max 512kb */
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());

             
            $result= $this->Users_m->update_selfie_image($username,$default_name_selfie);
            echo json_decode($result);
        }
 
     }









    // START IBNU TAMBAHAN 

    public function forgot_password()
    {



        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Forgot Password';
            $this->load->view('auth/forgotpass_v', $data);
        } else {
            $email = $this->input->post('email');

            $user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();


            if ($user) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_create' => time()


                ];

                $this->db->insert('user_token', $user_token);

                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Please Check your Email To Reset Password.!</div>');
                redirect('auth');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Email is not Registered or Activated.!</div>');
                redirect('auth/Forgot_Password');
            }
        }
    }



    public function Logout()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username = $data['usrProfile']['username'];

        $logData = [
            'username' => $username,
            'activities' => 'Logout from App',
            'object'     => $username,
            'url'        => base_url('Auth/Logout'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->unset_userdata('name');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('img_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('worklocation');
        $this->session->unset_userdata('organization');
        $this->session->unset_userdata('is_login');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Thank You!</h5>
                You have been logged.
            </div>
        ');
        redirect('Homepage');
    }

    public function blocked()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                    Please login first!
                </div>
            ');
            redirect('Auth');
        }

        $data['title'] = "403 Access Forbidden";
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('auth/blocked_v', $data);
    }




    // START IBNU TAMBAHAN


    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol'         => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_user'     => 'belifeindonesia@gmail.com',
            // 'smtp_pass'     => 'Belife!23JAP',    //password account google
            'smtp_pass'     => 'lcljoowkougttvnk',
            'smtp_port'     => 465,
            'mailtype'         => 'html',
            'charset'         => 'utf-8',
            'smtp_timeout'     => '7',
            'newline'         => "\r\n"
            // lcljoowkougttvnk

        ];

        $email = $this->input->post('email');
        $this->email->initialize($config);

        $this->email->from('noreplay@belife.com', 'BELIFE INDONESIA');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('
                <b>Dear Sahabat Belife </b><br>
                <br>
                    Akun Anda Sedang di Verifikasi oleh admin, mohon untuk ditunggu.
                    Status Akun akan di informasikan kembali.
                <br> <br>
                Best Regards<br>
                Betterlife Jaya indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/belife-logo-email.png') . '"   width="190" height="40"  class="img-fluid" >
                <hr><b> 
                PT Betterlife Jaya indonesia<br>
                Jl. Ciputat Raya No.28D, RT.3/RW.10, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan<br>
                Daerah Khusus Ibukota Jakarta 12240</b>
                ');



            if ($this->email->send()) {

                return true;
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                ' . $email . ' User Anda Sedang Di Verikasi Admin,Mohon untuk Menunggu.!</div>');
                redirect('auth');
            }
        } else if ($type == 'forgot') {

            $this->email->subject('Reset Password');
            $this->email->message('
                <b>Dear Sahabat Belife </b><br>
                <br>
                Silakan Klik Link Untuk Mereset Password : <a class="btn btn-info" href="' . base_url() . 'Auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"  >Reset Password</a><br>
                <br>
                Best Regards<br>
                Betterlife Jaya indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/belife-logo-email.png') . '"   width="190" height="40"  class="img-fluid" >
                <hr><b>
                PT Betterlife Jaya indonesia<br>
                Jl. Ciputat Raya No.28D, RT.3/RW.10, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan<br>
                Daerah Khusus Ibukota Jakarta 12240</b>

               
                ');


            if ($this->email->send()) {

                return true;
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                ' . $email . ' Silakan Check Email.!</div>');
                redirect('auth');
            }
        }
    }


    public function verify()
    {



        $email = $this->input->get('email');
        $token = $this->input->get('token');


        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_create'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                               ' . $email . 'Anda Berhasil Registrasi, Silakaan menunggu verifikasi dari admin..!</div>');
                    redirect('auth');
                } else {

                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                Account Activation failed ! Token Expired</div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Account Activation failed ! Token Invalid </div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account Activation failed ! Wrong Email </div>');
            redirect('auth');
        }
    }


    public function resetpassword()
    {



        $email = $this->input->get('email');
        $token = $this->input->get('token');


        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {


                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                    Reset Password Failed.! Wrong Token.</div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset Password Failed.! Wrong Email.</div>');
            redirect('auth');
        }
    }






    public function changePassword()
    {

        if (!$this->session->userdata('reset_email')) {

            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Passsword', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Passsword', 'required|trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            // $this->load->view('Templates/auth_header', $data);
            $this->load->view('auth/changepassword', $data);
            // $this->load->view('Templates/auth_footer');
        } else {

            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                       Password Success Update, Please Login .!</div>');
            redirect('auth');
        }
    }




    // END IBNU TAMBAHAN















































}
