<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Transaction_m');
        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Feature_m');
    }

    public function index()
    {
        $this->OrderProcess();
    }

    public function OrderProcess()
    {
        $data['title']      = "List Data Orders";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Dataorders']  = $this->Transaction_m->get_all_orders();

        $this->load->view('Transaction/DataOrders', $data);
    }


    public function DetailOrder($id)
    {



        $data['title']      = "Detail Data Orders";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Dataorders']  = $this->Transaction_m->get_all_detail_orders($id);

        $data['Dataorders_item']  = $this->Transaction_m->get_all_detail_order_item($id);


        $data['totalharga']    = $this->Transaction_m->get_data_totalharga($id)->row_array();

        $data['fintech'] = $this->DataMaster_m->get_all_fintect();


        $this->load->view('Transaction/DetailDataOrders', $data);
    }


    public function ApproveOrder()
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username               = $data['usrProfile']['username'];
        $kode_order             = $this->input->post('kode_order');





        $this->form_validation->set_rules('fintech', 'Fintech', 'required');

        if ($this->form_validation->run() == false) {

            $this->DetailOrder($kode_order);
        } else {



            $dataupdate = [

                'status_order'  => 'APPROVE',
                'note_order'     => $this->input->post('noteorder'),
                'id_fintech'       => $this->input->post('fintech'),
                'user_proses'       => $this->session->userdata('username'),
                'date_proses'       => date('Y-m-d H:i:s')
            ];

            $kode_shipping =  $this->Transaction_m->getkodeshipping($kode_order);
            $kode_shippingpost =  $kode_shipping['kode_shipping'];
            $this->Transaction_m->updateapproval($kode_order, $dataupdate);
            $this->Transaction_m->updateshipping($kode_shippingpost);

            $contractno = $this->Transaction_m->getcontrackno();
            $dataorderdetail = $this->Transaction_m->getdataorderdetail($kode_order);



            $datacontract = [
                'contract_no'           => $contractno,
                'user_order'            => $dataorderdetail['user_order'],
                'date_order'            => $dataorderdetail['date_order'],
                'kode_order'            => $dataorderdetail['kode_order'],
                'total_amount'          => $dataorderdetail['total_order'],
                'tenor'                 => $dataorderdetail['tenor'],
                'angsuran'              => $dataorderdetail['angsuran'],
                'admin_cost'            => $dataorderdetail['admin_cost'],
                // 'shipping_cost'      => $dataorderdetail['date_order'],
                'status_contract'       => 'APPROVE_ADMIN',
                'id_fintech'            => $dataorderdetail['id_fintech'],
                // 'id_ekspedisi'       => $dataorderdetail['date_order'],
                'user_approve'          => $dataorderdetail['user_proses'],
                'date_approve'          => $dataorderdetail['date_proses'],
                'kode_shipping'         => $dataorderdetail['kode_shipping'],
                'status_pengiriman'     => 'PROSPECT',
                'user_post'             => $this->session->userdata('username'),
                'date_post'             => date('Y-m-d H:i:s')

            ];


            $this->db->insert('contract', $datacontract);

            $duedateadjustment =  date('Y-m-25');

            // $datainstallment = array();
            // $tenor = $dataorderdetail['tenor'];

            // for ($i = 1; $i <= $tenor; $i++) {
            //     $datainstallment[] = array(
            //         'contract_no'           => $contractno,
            //         'installment_no'        => $i,  // Ambil dan set data nama sesuai index array dari $index
            //         'due_date'              => date('Y-m-d', strtotime('+' . $i . ' month', strtotime($duedateadjustment))),  // Ambil dan set data telepon sesuai index array dari $index
            //         'amount'                => $dataorderdetail['angsuran'],  // Ambil dan set data alamat sesuai index array dari $index

            //     );
            // }



            // $this->db->insert_batch('installment_customer', $datainstallment);





            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Approve Order',
                'object'     => $this->input->post('kode_order'),
                'url'        => base_url('Transaction/ApproveOrder'),
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_activity', $logData);

            $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Approve.
         </div> ');
            redirect('Transaction/OrderProcess');
        }
    }



    public function RejectOrder($kode_order)
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];

        $kode_shipping =  $this->Transaction_m->getkodeshipping($kode_order);
        $kode_shippingpost =  $kode_shipping['kode_shipping'];
        $dataupdate = [

            'status_order'  => 'REJECT',
            'note_order'     => '',
            'id_fintech'       => '',
            'user_proses'       => $this->session->userdata('username'),
            'date_proses'       => date('Y-m-d H:i:s')
        ];

        $this->Transaction_m->updateapproval($kode_order, $dataupdate);
        $this->Transaction_m->updateshippingreject($kode_shippingpost);




        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Reject Order',
            'object'     => $this->input->post('kode_order'),
            'url'        => base_url('Transaction/RejectOrder'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Reject.
         </div> ');
        redirect('Transaction/OrderProcess');
    }






    public function Kontak()
    {
        $data['title']      = "List Data Kontak";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Kontaks']  = $this->Transaction_m->get_all_kontaks();

        $this->load->view('Transaction/Kontak', $data);
    }



    public function DetailKontak($id)
    {
        $id = Decrypt_url($id);

        $data['title']      = "DetailKontak";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['Kontakdetail']  = $this->Transaction_m->get_all_detail_kontak($id);





        $this->load->view('Transaction/DetailKontak', $data);
    }


    public function ReplyKontak()
    {

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $id = $this->input->post('id');
        $replykontak = $this->input->post('replykontak');
        $this->Transaction_m->update_kontak_reply($id, $replykontak);



        // kirim ke email, setealh di update ke table 




        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>Success!</h5>
           Pesanan Sudah Di Reply.
         </div> ');
        redirect('Transaction/Kontak');
    }
}
