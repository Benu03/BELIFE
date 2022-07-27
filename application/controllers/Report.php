<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('Users_m');
        $this->load->model('Report_m');
        $this->load->model('Master_m');
    }


    public function ReportProduct()
    {
        $data['title']      = "Report Data Product";
        $data['product'] = $this->Report_m->get_all_product();
        $data['spread'] = $this->Master_m->get_spred_harga_product();
        $this->load->view('Report/ReportProduct', $data);
    }


    public function ReportCustomers()
    {
        $data['title']      = "Report Data Customer";

        $this->load->view('Report/ReportCustomers', $data);
    }


    public function ReportShipping()
    {
        $data['title']      = "Report Data Pengiriman Barang";
        $data['shiping'] = $this->Report_m->get_all_shipping();

        $this->load->view('Report/ReportShipping', $data);
    }


    public function Transaction()
    {
        $data['title']      = "Report Data Transaksi";
        $data['transaksi'] = $this->Report_m->get_all_transaction();

        $this->load->view('Report/Transaction', $data);
    }


    public function GenerateReportProduct()
    {

        $data = $this->Report_m->get_all_product();


        $spread = $this->Master_m->get_spred_harga_product();



        include_once APPPATH . '/third_party/xlsxwriter.class.php';
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);

        $filename = "ReportProduct-" . date('d-m-Y-H-i-s') . ".xlsx";

        ob_end_clean();
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $styles = array('widths' => [35, 45, 25, 15, 15, 15, 15, 15, 15, 15], 'font' => 'Arial', 'font-size' => 11, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'left,right,top,bottom');


        $header = array(
            'kode_product' => 'string',
            'nama_product' => 'string',
            'category_name' => 'string',
            'Harga_Beli' => 'string',
            'Harga_Jual' => 'string',
            'jumlah_stok' => 'string',
            'user_create' => 'string',
            'date_create' => 'string',
            'user_update' => 'string',
            'date_update' => 'string',



        );

        $writer = new XLSXWriter();
        $writer->setAuthor('Belife_Indonesia');

        $writer->writeSheetHeader('Sheet1', $header, $styles);
        $no = 1;


        foreach ($data as $row) {
            $writer->writeSheetRow('Sheet1', [

                $row['kode_product'],
                $row['nama_product'],
                $row['category_name'],
                $row['Harga_Beli'],
                (($row['Harga_Beli'] * $spread['value']) / 100) + $row['Harga_Beli'],
                $row['jumlah_stok'],
                $row['user_create'],
                $row['date_create'],
                $row['user_update'],
                $row['date_update']


            ], $styles1);
            $no++;
        }
        $writer->writeToStdOut();
    }


    public function GenerateReporttransaction()
    {

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');


        $data = $this->Report_m->get_all_transaction_param($startdate, $enddate);






        include_once APPPATH . '/third_party/xlsxwriter.class.php';
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);

        $filename = "ReportTransaction-" . date('d-m-Y-H-i-s') . ".xlsx";

        ob_end_clean();
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $styles = array('widths' => [35, 25, 25, 35, 25, 25, 45, 25, 25, 25, 25], 'font' => 'Arial', 'font-size' => 11, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'left,right,top,bottom');


        $header = array(
            'KODE ORDER' => 'string',
            'TOTAL ORDER' => 'string',
            'TENOR' => 'string',
            'ANGSURAN' => 'string',
            'STATUS' => 'string',
            'FINTECH' => 'string',
            'NOTE' => 'string',
            'USER ORDER' => 'string',
            'TANGGAL ORDER' => 'string',
            'USER PROSES' => 'string',
            'TANGGAL PROSES' => 'string',





        );

        $writer = new XLSXWriter();
        $writer->setAuthor('Belife_Indonesia');

        $writer->writeSheetHeader('Sheet1', $header, $styles);
        $no = 1;


        foreach ($data as $row) {
            $writer->writeSheetRow('Sheet1', [

                $row['kode_order'],
                $row['total_order'],
                $row['tenor'],
                $row['angsuran'],
                $row['status_order'],
                $row['fintech_name'],
                $row['note_order'],
                $row['user_order'],
                $row['date_order'],
                $row['user_proses'],

                $row['date_proses']


            ], $styles1);
            $no++;
        }
        $writer->writeToStdOut();
    }


    public function GenerateReportshipping()
    {


        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');


        $data = $this->Report_m->get_all_shipping_param($startdate, $enddate);




        include_once APPPATH . '/third_party/xlsxwriter.class.php';
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);

        $filename = "ReportShipping-" . date('d-m-Y-H-i-s') . ".xlsx";

        ob_end_clean();
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $styles = array('widths' => [35, 25, 25, 45, 25, 25, 25], 'font' => 'Arial', 'font-size' => 11, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'left,right,top,bottom');


        $header = array(
            'KODE SHIPPING' => 'string',
            'NAMA PENERIMA' => 'string',
            'KONTAK PENERIMA' => 'string',
            'ALAMAT PENERIMA' => 'string',
            'STATUS' => 'string',
            'USER PENGIRIMAN' => 'string',
            'TANGGAL PENGIRIMAN' => 'string',




        );

        $writer = new XLSXWriter();
        $writer->setAuthor('Belife_Indonesia');

        $writer->writeSheetHeader('Sheet1', $header, $styles);
        $no = 1;


        foreach ($data as $row) {
            $writer->writeSheetRow('Sheet1', [

                $row['kode_shipping'],
                $row['nama_penerima'],
                $row['kontak_penerima'],
                $row['alamat_pengiriman'],
                $row['status_pengiriman'],
                $row['user_pengiriman'],

                $row['date_pengiriman']


            ], $styles1);
            $no++;
        }
        $writer->writeToStdOut();
    }



    public function SmartSearch()
    {
        $data['title']          = "Smart Search";

        $data['usrProfile']     = $this->Users_m->get_user_profile($this->session->userdata('username'));
        $this->load->view('Smart_Search/index', $data);
    }
}
