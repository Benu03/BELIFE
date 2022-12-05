<?php
class Feature_m extends CI_Model
{
    private $table_name  = 'product';
    private $primary_key = 'kode_product';



    function get_data_keranjang($username)
    {
        $query = "select 

        a.kode_product,
        b.nama_product,
        a.qty,
        a.price,
        a.price_buy*a.qty as price_buy,
        b.image_product,
        b.qty as stok,
        a.subtotal
        from keranjang a
        left join product b  on a.kode_product = b.kode_product
        where a.user_order='$username' and is_order= 0";
        return $this->db->query($query);
    }



    function get_data_biayaadmin()
    {
        $query = "select * from ms_general  where code='ADM_COST' ";
        return $this->db->query($query);
    }

    function Checkorder($kodeord,$username)
    {
        $query = "select * from orders  where kode_order='$kodeord' and user_order='$username' ";
        return $this->db->query($query);
    }



    function get_data_totalharga($username)
    {
        $query = "select 
        sum(subtotal) as totalharga
        from keranjang
        where user_order='$username' and is_order= 0        ";


        return $this->db->query($query);
    }





    function getkodeorder()
    {

        $q = $this->db->query("select MAX(RIGHT(kode_order,4)) as kode_order  from orders
        where date(date_order) = date(now()) ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_order) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Ymd");
        return "ORD" . "-" . $date . $kd;
    }


    function getkodeshipping()
    {




        $q = $this->db->query("select MAX(RIGHT(kode_shipping,4)) as kode_shipping  from shipping
        where date(date_post) = date(now()) ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_shipping) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Ymd");
        return "BL" . "-" . $date . $kd;
    }



    function gettenor()
    {
        $query = "select * from ms_tenor";
        return $this->db->query($query)->result_array();
    }


    function check_contract($username)
    {
        $query = "select count(*) as countdata from contract   where user_ordeR='$username'
        and status_contract <> 'LUNAS'";
        return $this->db->query($query);
    }

    function check_order_validasi($username)
    {
        $query = " select count(*) as countdata  from orders 
        where user_ordeR='$username' and user_proses is null ";
        return $this->db->query($query);
    }



    function checkkeanjang($username)
    {
        $query = "select * from keranjang where  user_order='$username' and is_order=0 ";


        return $this->db->query($query)->num_rows();
    }


    function checkdatakeranjang($id)
    {
        $query = "select * from keranjang where id='$id' and is_order=0 ";

        return $this->db->query($query)->row_array();
    }



    function check_keranjang($id, $username)
    {
        $query = "select * from keranjang where kode_product='$id' and user_order='$username' and is_order=0 ";


        return $this->db->query($query)->num_rows();
    }


    function check_stokproduct($id)
    {
        $query = "select qty from product where kode_product='$id'";


        return $this->db->query($query)->row_array();
    }



    function preparedatakeranjang($id, $username)
    {
        $query = "select * from keranjang where kode_product='$id' and user_order='$username' and is_order=0 ";


        return $this->db->query($query)->row_array();
    }


    function update_add_keranjang($id, $dataupdate)
    {


        $this->db->where('id', $id);
        return $this->db->update('keranjang', $dataupdate);
    }







    function getdatecustomerorder($username)
    {
        $query = "select * from personal_customer where username='$username'";

        return $this->db->query($query)->result_array();
    }


    function UpdateKeranjang($username)
    {
        $query = " update keranjang set is_order=1 where user_order='$username' and is_order=0";

        return $this->db->query($query);
    }



    function UpdateVoucher($kode_voucher, $username)
    {
        $query = "   update voucher set is_used=1 , user_used='$username', date_used=now() where kode_voucher='$kode_voucher'";

        return $this->db->query($query);
    }






    function HistoryOrder($username)
    {
        $query = "select * from order_history where kode_order in (select kode_order from orders  where user_order='$username')
        
        ";

        return $this->db->query($query)->result_array();
    }
}
