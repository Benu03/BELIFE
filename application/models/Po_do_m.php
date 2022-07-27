<?php
class Po_do_m extends CI_Model
{




    function list_wating_podo()
    {


        $query = "
            SELECT 
            contract.kode_order,
            user_order,
            convert(date,date_order,103) as date_order,
            contract.total_amount,
            angsuran,
            b.price_buy as total_harga_beli,
            c.fintech_name
            FROM contract
            left join (select kode_order,sum(price_buy) as price_buy  from order_detail
            group by kode_order) b on contract.kode_order = b.kode_order
            left join fintech c on contract.id_fintech = c.id
            WHERE 
            kode_shipping IN (SELECT kode_shipping  from shipping where status_pengiriman='WAITING')
			and contract.kode_order not in (select kode_parent from po_do_detail where is_add=1)";
        return $this->db->query($query)->result_array();
    }


    function list_supplier()
    {
        $query = "
            SELECT 
            * from supplier where is_active =1 ";
        return $this->db->query($query)->result_array();
    }



    function kode_podo_seq()
    {


        $q = $this->db->query("select MAX(RIGHT(kode_po_do,4)) as kode_po_do  from po_do
        where convert(date,date_request,103) = convert(date,getdate(),103) ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kode_po_do) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $date = date("ymd");
        return "PODO" . "-" . $date . $kd;
    }



    function list_wating_podo_add($kode_po_do)
    {

        $query = "SELECT id,
            kode_po_do,
            kode_parent,
            price,
            is_request,
            is_add,
            user_post,
            convert(date,date_post,103) as date_post
            from po_do_detail
      
            where is_add=1 and kode_po_do='$kode_po_do' and  po_do_type=1";
        return $this->db->query($query);
    }

    function list_wating_podo_add_supplier($kode_po_do)
    {

        $query = " SELECT 
            a.id,
            a.kode_po_do,
            a.kode_parent,
            b.supplier_name,
            a.price,
            b.bank_supplier,
            b.norek_supplier,
            a.user_post,
            convert(date,a.date_post,103) as date_post
            
             from po_do_supplier_detail a
             left join supplier b on a.kode_parent = b.id
          
      
            where a.is_add=1 and a.kode_po_do='$kode_po_do' and a.po_do_type=2";
        return $this->db->query($query);
    }

    function sum_wating_podo_add_supplier($kode_po_do)
    {

        $query = "SELECT sum(price) as price
            from po_do_supplier_detail      
            where is_add=1 and kode_po_do='$kode_po_do'";
        return $this->db->query($query)->row_array();
    }

    function getdatasupplier($id_supplier)
    {


        $query = "SELECT *
        from supplier      
        where id ='$id_supplier'";
        return $this->db->query($query)->row_array();
    }






    function sum_wating_podo_add($kode_po_do)
    {

        $query = "SELECT sum(price) as price
            from po_do_detail      
            where is_add=1 and kode_po_do='$kode_po_do'";
        return $this->db->query($query)->row_array();
    }

    function del_wating_podo($id)
    {

        $query = "delete po_do_detail where id='$id'";
        return $this->db->query($query);
    }

    function del_wating_podo_sup($id)
    {

        $query = "delete po_do_supplier_detail where id='$id'";
        return $this->db->query($query);
    }


    function update_po_do_request($kode_po_do)
    {

        $query = "update  po_do_detail  set is_request = 1 where kode_po_do='$kode_po_do'";
        return $this->db->query($query);
    }

    function update_po_do_request_sup($kode_po_do)
    {

        $query = "update  po_do_supplier_detail  set is_request = 1 where kode_po_do='$kode_po_do'";
        return $this->db->query($query);
    }
}
