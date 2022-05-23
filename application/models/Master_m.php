<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class master_m extends CI_Model
{

   

    function get_spred_harga_product()
    {
        $query = "select * from ms_general
        where code='PRCHRG'";
        return $this->db->query($query)->row_array();  
    }

   

    
    function ratetenor($tenor)
    {
        $query = "select rate from ms_tenor
        where tenor='$tenor'";
        return $this->db->query($query)->row_array();  
    }


    function vouchervalue($kode_voucher)
    {
        $query = "select value_voucher from voucher
        where kode_voucher='$kode_voucher' and is_used=0 and is_get=0";
        return $this->db->query($query)->row_array();  
    }


    
    function voucherupdateget($kode_voucher)
    {
        $query = "update voucher set is_get=0  where kode_voucher='$kode_voucher'";
        return $this->db->query($query)->row_array();  
    }






}
