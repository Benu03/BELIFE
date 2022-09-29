<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_m extends CI_Model
{



    function get_all_orders()
    {
        $query = "SELECT 
        a.kode_order,
        date(a.date_order) as date_order, 
        b.name_full,
        b.phone,
        a.total_order,
        a.tenor,
        a.angsuran
        
        
         FROM orders a
        left join personal_customer b on a.user_order = b.username
        where a.status_order = 'ORDER'
        ";
        return $this->db->query($query)->result_array();
    }



    function get_all_kontaks()
    {

        $query = "SELECT 
        *
         FROM kontak 
        where is_reply = '0'
        ";
        return $this->db->query($query)->result_array();
    }

    function getdataorderdetail($kode_order)
    {

        $query = "SELECT * FROM orders where kode_order = '$kode_order' ";
        return $this->db->query($query)->row_array();
    }


    function getcontrackno()
    {


        $q = $this->db->query("select MAX(RIGHT(contract_no,4)) as contract_no  from contract
        where date(date_post) = date(now()) ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->contract_no) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $date = date("ymd");
        return $date . $kd;
    }



    function get_all_detail_kontak($id)
    {

        $query = "SELECT * FROM kontak 
        where is_reply = '0' and id='$id' ";
        return $this->db->query($query)->row_array();
    }


    function update_kontak_reply($id, $replykontak)
    {

        $query = "update kontak  set is_reply=1 , reply='$replykontak' where   id='$id' ";
        return $this->db->query($query);
    }








    function getkodeshipping($kode_order)
    {
        $query = "SELECT 
       kode_shipping FROM orders 
        where kode_order = '$kode_order'";
        return $this->db->query($query)->row_array();
    }

    function updateshipping($kode_shipping)
    {
        $query = "Update shipping set status_pengiriman ='WAITING'
        where kode_shipping = '$kode_shipping'
        ";
        return $this->db->query($query);
    }

    function updateshippingreject($kode_shipping)
    {
        $query = "Update shipping set status_pengiriman ='CANCEL'
        where kode_shipping = '$kode_shipping'
        ";
        return $this->db->query($query);
    }





    function get_all_detail_orders($id)
    {
        $query = "SELECT
        a.kode_shipping,
        a.kode_order,
        a.total_order,
        a.tenor,
        a.angsuran,
        a.status_order,
        a.note_order,
        a.id_fintech,
        a.user_order,
        a.date_order,
        b.kode_shipping,
        b.nama_penerima,
        b.kontak_penerima,
        b.alamat_pengiriman,
        b.status_pengiriman
         FROM orders a 
        LEFT JOIN shipping  b on a.kode_shipping = b.kode_shipping
         where a.kode_order = '$id' ";
        return $this->db->query($query)->row_array();
    }



    function get_all_detail_order_item($id)
    {
        $query = "
          select 

        a.kode_product,
        b.nama_product,
        sum(a.qty) as qty,
        b.price_sell as price,
        b.image_product,
        a.price as subtotal
        from order_detail a
        left join product b  on a.kode_product = b.kode_product
        where a.kode_order='$id'
        group by a.kode_product,a.qty,a.price,b.price_sell, b.image_product,b.nama_product
        ";
        return $this->db->query($query)->result_array();
    }




    function get_data_totalharga($id)
    {
        $query = "select 
        sum(price) as totalharga
        from order_detail
        where kode_order='$id' ";

        return $this->db->query($query);
    }


    function updateapproval($kode_order, $dataupdate)
    {
        $this->db->where('kode_order', $kode_order);
        return $this->db->update('orders', $dataupdate);
    }
}
