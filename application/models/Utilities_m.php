<?php
class Utilities_m extends CI_Model
{




    function get_all_shipping()
    {
        $query = "SELECT 
        a.kode_shipping,
		b.kode_order,
        date(b.date_order) as date_order,
        c.name_full,
        c.phone,
        a.nama_penerima,
		a.kontak_penerima,
		a.alamat_pengiriman,
		a.status_pengiriman       
        from shipping a
		left join orders b on a.kode_shipping = b.kode_shipping
        left join personal_customer c on b.user_order = c.username
        where a.status_pengiriman = 'REQ'

        ";
        return $this->db->query($query)->result_array();
    }

    function get_all_waiting()
    {
        $query = "SELECT 
        a.kode_shipping,
		b.kode_order,
        date(b.date_order) as date_order,
        c.name_full,
        c.phone,
        a.nama_penerima,
		a.kontak_penerima,
		a.alamat_pengiriman,
		a.status_pengiriman
               
        FROM shipping a
		left join orders b on a.kode_shipping = b.kode_shipping
        left join personal_customer c on b.user_order = c.username
        where a.status_pengiriman = 'WAITING'
        ";
        return $this->db->query($query)->result_array();
    }


    function get_all_delivery()
    {
        $query = "SELECT 
        a.kode_shipping,
		b.kode_order,
       date(b.date_order) as date_order,
        c.name_full,
        c.phone,
        a.nama_penerima,
		a.kontak_penerima,
		a.alamat_pengiriman,
		a.status_pengiriman,
        a.user_pengiriman,
        a.date_pengiriman
        
        
        FROM shipping a
		left join orders b on a.kode_shipping = b.kode_shipping
        left join personal_customer c on b.user_order = c.username
        where a.status_pengiriman = 'DELIVERY'

        ";
        return $this->db->query($query)->result_array();
    }



    function get_all_shipping_detail($id)
    {
        $query = "SELECT 
        a.kode_shipping,
		b.kode_order,
       date(b.date_order) as date_order,
        c.name_full,
        c.phone,
        a.nama_penerima,
		a.kontak_penerima,
		a.alamat_pengiriman,
		a.status_pengiriman
        
        
        FROM shipping a
		left join orders b on a.kode_shipping = b.kode_shipping
        left join personal_customer c on b.user_order = c.username
        where a.kode_shipping = '$id'
        ";
        return $this->db->query($query)->result_array();
    }


    function get_all_shipping__item_detail($id)
    {
        $query = "SELECT
        a.id,
        a.kode_product,
        b.nama_product,
        a.qty,
        a.price,
        date(a.date_order) as date_order
        FROM order_detail a
        left join product b on a.kode_product = b.kode_product
        where a.kode_order = (select kode_order from orders where kode_shipping='$id')
        ";
        return $this->db->query($query)->result_array();
    }




    function get_data_totalharga($id)
    {
        $query = "select 
        sum(price) as totalharga
        from order_detail
        where kode_order=(select kode_order from orders where kode_shipping='$id') ";

        return $this->db->query($query);
    }

    function update_shipping_delivery($id, $username)
    {
        $query = "update shipping set status_pengiriman ='DELIVERY' , user_pengiriman='$username' ,date_pengiriman= now() where kode_shipping='$id'";

        return $this->db->query($query);
    }

    function update_shipping_delivery_done($kode_shipping, $username, $no_resi)
    {
        $query = "update shipping set status_pengiriman ='DONE' ,user_pengiriman='$username' ,no_resi='$no_resi',date_pengiriman=now() where kode_shipping='$kode_shipping'";

        return $this->db->query($query);
    }


    function update_shipping_delivery_cancel($kode_shipping, $username)
    {
        $query = "update shipping set status_pengiriman ='CANCEL' ,user_pengiriman='$username' ,date_pengiriman=now() where kode_shipping='$kode_shipping'";

        return $this->db->query($query);
    }

    function chekcuserorder($kode_shipping)
    {

        $query = "  select user_order from orders
        where kode_shipping='$kode_shipping'";

        return $this->db->query($query)->row_array();
    }

    function getShippingDetail($id)
    {
        $query = "SELECT 
            a.kode_shipping,
		    b.kode_order,
            DATE(b.date_order) AS date_order,
            c.name_full,
            c.phone,
            a.nama_penerima,
		    a.kontak_penerima,
		    a.alamat_pengiriman,
		    a.status_pengiriman,
            cnt.contract_no,
            pt.partner_name
        FROM shipping a
		LEFT JOIN orders b ON a.kode_shipping = b.kode_shipping
        LEFT JOIN personal_customer c ON b.user_order = c.username
        LEFT JOIN partner pt ON c.id_partner = pt.id
        LEFT JOIN contract cnt on a.kode_shipping = cnt.kode_shipping
        WHERE a.kode_shipping = '$id'";
        return $this->db->query($query)->row_array();
    }
}
