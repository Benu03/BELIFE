<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utilities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Transaction_m');
        $this->load->model('Users_m');
        $this->load->model('DataMaster_m');
        $this->load->model('Utilities_m');
    }

    public function index()
    {
        $this->Shipping();
    }



    public function Shipping()
    {
        $data['title']      = "Shipping Proses";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['shipping']  = $this->Utilities_m->get_all_shipping();

        $this->load->view('Utilities/Shipping', $data);
    }



    public function WaitingPODO()
    {
        $data['title']      = "Waiting Purchase Order & Delivery Order Proses";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['waiting']  = $this->Utilities_m->get_all_waiting();

        $this->load->view('Utilities/Waiting', $data);
    }




    public function Detailshipping($id)
    {
        $data['title']      = "Detail Pengiriman";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];
        $data['detailshipping']  = $this->Utilities_m->get_all_shipping_detail($id);


        $data['detailshipping_item']  = $this->Utilities_m->get_all_shipping__item_detail($id);
        $data['totalharga']    = $this->Utilities_m->get_data_totalharga($id)->row_array();



        $this->load->view('Utilities/Detail_Shipping', $data);
    }

    public function ShippingDelivery($id)
    {
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username           = $data['usrProfile']['username'];


        $this->Utilities_m->update_shipping_delivery($id, $username);

        $user_order = $this->Utilities_m->chekcuserorder($id);

        $Datanotification = [
            "user_receive"  => $user_order['user_order'],
            'massage'     =>  'Pesanan Anda Sedang Proses Delivery  dengan Kode Shipping ' . $id,
            'is_view' => 0,
            'date_notif'  => date('Y-m-d H:i:s')

        ];

        $this->db->insert('notification', $Datanotification);
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delivery Process',
            'object'     => $id,
            'url'        => base_url('Utilities/ShippingDelivery'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
            Pesanan Sudah Masuk Proses Delivery.
            </div> ');
        redirect('Utilities/Shipping');
    }


    public function Delivery()
    {
        $data['title']      = "Delivery Proses";
        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $username           = $data['usrProfile']['username'];
        $data['delivery']  = $this->Utilities_m->get_all_delivery();

        $this->load->view('Utilities/Delivery', $data);
    }


    public function GeneratePDFShipping($kode_shipping)
    {
        $data['title']                = "Report Pengiriman";
        $data['dtShippingCust']       = $this->Utilities_m->getShippingDetail($kode_shipping);
        $data['detailshipping_item']  = $this->Utilities_m->get_all_shipping__item_detail($kode_shipping);
        $data['totalharga']           = $this->Utilities_m->get_data_totalharga($kode_shipping)->row_array();

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Print_" . $kode_shipping . ".pdf";
        $this->pdf->load_view('PDF/ShippingProcess', $data);
    }



    public function DeliveryDone()
    {


        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username    = $data['usrProfile']['username'];
        $no_resi =  $this->input->post('no_resi');
        $kode_shipping =  $this->input->post('kode_shipping');

        $user_order = $this->Utilities_m->chekcuserorder($kode_shipping);
        $this->Utilities_m->update_shipping_delivery_done($kode_shipping, $username, $no_resi);



        $Datanotification = [
            "user_receive"  =>  $user_order['user_order'],
            'massage'     =>  'Pesanan Anda Sedang di kirim dengan No resi ' . $no_resi,
            'is_view' => 0,
            'date_notif'  => date('Y-m-d H:i:s')

        ];

        $this->db->insert('notification', $Datanotification);




        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delevery Process Done',
            'object'     => $kode_shipping,
            'url'        => base_url('Utilities/DeliveryDone'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);



        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
            Delivery Done.
            </div> ');
        redirect('Utilities/Delivery');
    }


    public function DeliveryCancel($kode_shipping)
    {


        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));

        $username    = $data['usrProfile']['username'];

        $this->Utilities_m->update_shipping_delivery_cancel($kode_shipping, $username);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'Delevery Process Cnncel',
            'object'     => $kode_shipping,
            'url'        => base_url('Utilities/DeliveryCancel'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Info !</h5>
            Delivery Cancel.
            </div> ');
        redirect('Utilities/Delivery');
    }
}
