<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class User_Manage extends CI_Controller
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
        $this->load->model('User_manage_m');
    }

    public function index()
    {
        $this->ListUser();
    }

    public function ListUser()
    {
        $data['title']      = "List User";
        $data['listuser'] = $this->User_manage_m->get_list_user();


        $this->load->view('User_Manage/ListUser', $data);
    }


    public function viewDetailUser($id = NULL)
    {
        $id = Decrypt_url($id);



        $data['title']      = "Detail User";

        $data['detailUser'] = $this->User_manage_m->get_all_detailuser($id);



        $this->load->view('User_Manage/ViewDetailUser_v', $data);
    }




    public function UserActivity()
    {
        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_all();
        $this->load->view('User_Manage/UserActivity_v', $data);
    }



    public function ViewUserActivity($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_data($id);
        $this->load->view('User_Manage/ViewUserActivity_v', $data);
    }




    public function ValidasiRegister()
    {
        $data['title']      = "List User Registrasi";

        $data['dataregister'] = $this->User_manage_m->get_all_dataregister();


        $this->load->view('User_Manage/ValidasiUser', $data);
    }


    public function GenerateReportUserList()
    {


        $data = $this->User_manage_m->get_all_user_generate();






        include_once APPPATH . '/third_party/xlsxwriter.class.php';
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);

        $filename = "ReportListUser-" . date('d-m-Y-H-i-s') . ".xlsx";

        ob_end_clean();
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $styles = array('widths' => [35, 45, 25, 15, 15, 15, 15, 15, 15, 15, 35, 25, 25], 'font' => 'Arial', 'font-size' => 11, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'left,right,top,bottom');


        $header = array(
            'username' => 'string',
            'Nama Lengkap' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'nik' => 'string',
            'tgl_lahir' => 'string',
            'tempat_lahir' => 'string',
            'jenis_kelamin' => 'string',
            'nama_provinsi' => 'string',
            'nama_kota_kabupaten' => 'string',
            'address_ktp' => 'string',
            'limit' => 'string',
            'patner_name' => 'string',



        );

        $writer = new XLSXWriter();
        $writer->setAuthor('Belife_Indonesia');

        $writer->writeSheetHeader('Sheet1', $header, $styles);
        $no = 1;


        foreach ($data as $row) {
            $writer->writeSheetRow('Sheet1', [

                $row['username'],
                $row['name'],
                $row['email'],
                $row['phone'],

                $row['nik'],
                $row['tgl_lahir'],
                $row['tempat_lahir'],
                $row['jenis_kelamin'],
                $row['nama_provinsi'],
                $row['nama_kota_kabupaten'],
                $row['address_ktp'],
                $row['limit'],
                $row['patner_name']


            ], $styles1);
            $no++;
        }
        $writer->writeToStdOut();
    }




    public function ViewDetailCustomer($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Detail Personal Customer";
        $data['datadetailregister'] = $this->User_manage_m->get_all_detaildataregister($id);



        $this->load->view('User_Manage/ViewDetailCustomer_v', $data);
    }


    public function GeneratePdfRegister($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Detail Personal Customer";
        $data['datadetailregister'] = $this->User_manage_m->get_all_detaildataregister_generate($id);




        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Print_" . $id . ".pdf";
        $this->pdf->load_view('PDF/PersonalCustomer', $data);
    }

    public function GeneratePdfviewdetail($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "Detail Personal Customer";
        $data['datadetailregister'] = $this->User_manage_m->get_all_detailuser_generate($id);



        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Print_" . $id . ".pdf";
        $this->pdf->load_view('PDF/PersonalCustomer', $data);
    }




    public function ViewUserActivity_d($id = NULL)
    {
        $id = Decrypt_url($id);

        $data['title']      = "User Activity";
        $data['dtActivity'] = $this->Log_activity_m->get_data($id);
        $this->load->view('User_Manage/ViewUserActivityd_v', $data);
    }





    public function approvedpostlimit()
    {

        $data = array(
            'username'          => $this->input->post('username'),
            'limit'             => $this->input->post('limit'),
            'status_register'   => 'approved'
        );


        $this->Users_m->update_actived_user($data['username']);
        $this->User_manage_m->update_limitstatuspesonalcustomer($data);


        // KIRIM EMail Ke customer kalau sduah di approve usernya
        $data = $this->db->get_where('users', ['username' => $data['username']])->row_array();
        $email  = $data['email'];


        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $email,
            'token' => $token,
            'date_create' => time()
        ];

        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token, 'approvedregister');


        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Approved and Update Register Customer ',
            'url'        => base_url('User_Manage/approvedpostlimit'),
            'object'     => $data['username'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $Datanotification = [
            "user_receive"  => $this->input->post('username'),
            'massage'     =>  'Akun Anda Sudah Di Approve Admin Belife, Silakan Melakukan Transaksi',
            'is_view' => 0,
            'date_notif'  => date('Y-m-d H:i:s')

        ];

        $this->db->insert('notification', $Datanotification);


        $this->session->set_flashdata('message', '
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been Updated.
            </div>
        ');

        redirect('User_Manage/ValidasiRegister');
    }





    public function Changelimit()
    {

        $data = array(
            'username'          => $this->input->post('username'),
            'limit'             => $this->input->post('limit'),

        );



        $this->User_manage_m->update_limitstatuspesonalcustomer2($data);



        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Chnge Limit Customer ',
            'url'        => base_url('User_Manage/Changelimit'),
            'object'     => $data['username'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                Data has been Updated.
            </div>
        ');

        redirect('User_Manage/ListUser');
    }



    public function RejectRegister($username = NULL)
    {
        $username = Decrypt_url($username);



        $data = $this->db->get_where('users', ['username' => $username])->row_array();
        $email  = $data['email'];


        // KIRIM EMail Ke customer kalau sduah di reject


        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $email,
            'token' => $token,
            'date_create' => time()
        ];

        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($token, 'rejectregister');



        //data hanya di update tidak di hapus

        $this->User_manage_m->reject_limitstatuspesonalcustomer($username);





        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Reject Register Customer ',
            'url'        => base_url('User_Manage/RejectRegister'),
            'object'     =>  $username,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
           <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Reject!</h5>
                Data has been Reject.
            </div>
        ');

        redirect('User_Manage/ValidasiRegister');
    }








    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol'         => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_user'     => 'belifeindonesia@gmail.com',
            'smtp_pass'     => 'Belife!23',
            'smtp_port'     => 465,
            'mailtype'         => 'html',
            'charset'         => 'utf-8',
            'smtp_timeout'     => '7',
            'newline'         => "\r\n"

        ];

        $email = $this->input->post('email');
        $this->email->initialize($config);

        $this->email->from('noreplay@belife.co.id', 'Test');
        $this->email->to($this->input->post('email'));

        if ($type == 'approvedregister') {
            $this->email->subject('Account Approved Register');
            $this->email->message('
                <b>Dear Sahabat Belife </b><br>
                <br>
                    Akun Anda Sudah Aktif Silakan Melakukan Trasaksi Di Belife.'
                . base_url() . '

                <br> <br>
                Best Regards<br>
                Betterlife Jaya indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/belife-logo-2.png') . '"   width="190" height="40"  class="img-fluid" >
                <hr><b> 
                PT Betterlife Jaya indonesia<br>
                Jl. Ciputat Raya No.28D, RT.3/RW.10, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan<br>
                Daerah Khusus Ibukota Jakarta 12240</b>
                ');



            if ($this->email->send()) {

                return true;
            } else {

                return true;
            }
        } else if ($type == 'rejectregister') {

            $this->email->subject('Acount Reject');
            $this->email->message('
                <b>Dear Sahabat Belife </b><br>
                <br>
                Data Anda Belum Sesuai dengan,
                <br>
                <br>
                Best Regards<br>
                Betterlife Jaya indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/belife-logo-2.png') . '"   width="190" height="40"  class="img-fluid" >
                <hr><b>
                PT Betterlife Jaya indonesia<br>
                Jl. Ciputat Raya No.28D, RT.3/RW.10, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan<br>
                Daerah Khusus Ibukota Jakarta 12240</b>

               
                ');


            if ($this->email->send()) {

                return true;
            } else {

                return true;
            }
        }
    }
}
