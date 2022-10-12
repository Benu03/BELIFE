<?php
class Po_do_m extends CI_Model
{




    function list_wating_podo()
    {


        $query = "SELECT  distinct
                        contract.kode_order,
                        user_order,
                        date(date_order) as date_order,
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
        $query = "SELECT * from supplier where is_active = 1 ";
        return $this->db->query($query)->result_array();
    }



    function kode_podo_seq()
    {


        // $q = $this->db->query("SELECT MAX(RIGHT(kode_po_do,4)) as kode_po_do  from po_do
        // where date(date_request) = date(now())");

        // var_dump($q);
        // die();

        // $kd = "";
        // if ($q->num_rows() > 0) {
        //     foreach ($q->result() as $k) {
        //         $tmp = ((int)$k->kode_po_do) + 1;
        //         $kd = sprintf("%04s", $tmp);
        //     }
        // } else {
        //     $kd = "0001";
        // }
        // date_default_timezone_set('Asia/Jakarta');
        // $date = date("ymd");
        // return "PODO" . "-" . $date . $kd;


        $this->db->select('RIGHT(po_do.kode_po_do,4) as kode_po_do', FALSE);
        $this->db->where('date(date_request)', date('Y-m-d'));
        $this->db->order_by('date_request', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('po_do');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_po_do) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $date = date("Ymd");
        $kodetampil = "PODO-" . $date . "-" . $batas;
        return $kodetampil;
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
            date(date_post) as date_post
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
                    date(date_post) as date_post
                    from po_do_supplier_detail a
                    left join supplier b on a.kode_parent = b.id
          
      
            where a.is_add=  1 and a.kode_po_do='$kode_po_do' and a.po_do_type = 2";
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


        $query = "SELECT * from supplier      
        where id ='$id_supplier'";
        return $this->db->query($query)->row_array();
    }






    function sum_wating_podo_add($kode_po_do)
    {

        $query = "SELECT sum(price) as price
            from po_do_detail      
            where is_add = 1 and kode_po_do='$kode_po_do'";
        return $this->db->query($query)->row_array();
    }

    function del_wating_podo($id)
    {

        $query = "delete from po_do_detail where id= '$id'";
        return $this->db->query($query);
    }

    function del_wating_podo_sup($id)
    {

        $query = "delete  from po_do_supplier_detail where id='$id'";
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


    function get_data_polist_supplier()
    {
        $query = "SELECT     *
        from po_do pd  
        where pd.po_do_type = 2
        and status_po_do ='APV' and is_print =0";
        return $this->db->query($query);
    }



    function get_data_polist_supplier_d($kode_po_do)
    {
        $query = "select 
        pd.kode_po_do,
        pd.total_req,
        pd.note_review,
        pd.date_approve
        from po_do pd 
        where pd.kode_po_do='$kode_po_do'";
        return $this->db->query($query);
    }


    function get_data_polist_supplier_d2($kode_po_do)
    {
        $query = "select
        pdsd.kode_po_do,
        sup.supplier_name,
        pdsd.price,
        sup.alamat,
        sup.nama_kontak_supplier,
        sup.kontak_supplier,
        sup.bank_supplier,
        sup.norek_supplier,
        pdsd.date_post
        from po_do_supplier_detail pdsd 
        left join po_do_type pdt  on pdsd.po_do_type = pdt.id 
        left join supplier sup on pdsd.kode_parent = sup.id 
        where pdsd.kode_po_do ='$kode_po_do'";
        return $this->db->query($query);
    }

    function update_polist_supplier($kode_po_do, $username)
    {

        $query = "update  po_do set is_print= 1 ,is_podo_done = 1 where kode_po_do='$kode_po_do'";
        return $this->db->query($query);

    }


    function HistoryPODO()
    {
        $query = 'SELECT 
                    a.kode_po_do,
                    b."Description"  as type,
                    a.po_do_type,
                    a.total_req,
                    a.date_request,
                    a.status_po_do
                    from public.po_do a
                    left join public.po_do_type b on a.po_do_type = b.id 
                    ';
        return $this->db->query($query)->result_array();
    }


    function ChekctypePoDO($kode_po_do)
    {

        $query = "select  po_do_type from po_do where kode_po_do='$kode_po_do'";
        return $this->db->query($query);
            

    }
    



}
