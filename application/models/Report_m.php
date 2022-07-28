<?php
class Report_m extends CI_Model
{

    function get_all_product()
    {

        $query = "SELECT a.kode_product, a.nama_product, b.category_name, a.price_buy as Harga_Beli, 
                qty as jumlah_stok, a.user_create, date(a.date_create) as date_create, 
                a.user_update, date(a.date_update) as date_update 
                from product a left join product_category b on a.id_category_product = b.id order by a.qty desc";
        return $this->db->query($query)->result_array();
    }



    function get_all_shipping()
    {

        $query = "SELECT kode_shipping,
        nama_penerima,
        kontak_penerima,
        alamat_pengiriman,
        status_pengiriman,
        user_pengiriman,
       date_pengiriman
          FROM shipping
          where date_pengiriman is not null ";
        return $this->db->query($query)->result_array();
    }



    function get_all_shipping_param($startdate, $enddate)
    {

        $query = "SELECT kode_shipping,
        nama_penerima,
        kontak_penerima,
        alamat_pengiriman,
        status_pengiriman,
        user_pengiriman,
        date_pengiriman
          FROM shipping
          where date_pengiriman >= '$startdate'  and  date_pengiriman <= '$enddate' ";
        return $this->db->query($query)->result_array();
    }




    function get_all_transaction()
    {

        $query = "SELECT a.kode_order
        ,a.total_order
        ,a.tenor
        ,a.angsuran
        ,a.status_order
        ,a.note_order
        ,b.fintech_name
        ,a.user_order
        ,a.date_order
        ,a.user_proses
        ,a.date_proses  
    FROM orders a
    left join fintech b on a.id_fintech = b.id
    where a.status_order not in ('ORDER')  ";
        return $this->db->query($query)->result_array();
    }





    function get_all_transaction_param($startdate, $enddate)
    {

        $query = "SELECT a.kode_order
        ,a.total_order
        ,a.tenor
        ,a.angsuran
        ,a.status_order
        ,a.note_order
        ,b.fintech_name
        ,a.user_order
        ,a.date_order
        ,a.user_proses
        ,a.date_proses  
    FROM orders a
    left join fintech b on a.id_fintech = b.id
    where a.status_order not in ('ORDER') and  a.date_proses >= '$startdate'  and  a.date_proses <= '$enddate' ";
        return $this->db->query($query)->result_array();
    }
}
