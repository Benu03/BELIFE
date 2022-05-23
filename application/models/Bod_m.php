<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv


class Bod_m  extends CI_Model {




    


 
    public function get_all_po_do_list_req_apv()
    {
    
            $query = "SELECT 
            a.kode_po_do,
            a.total_req,
            a.count_detail,
             b.Description,
            a.user_request,
            convert(SmallDateTime,a.date_request) as date_request
            
            
            from po_do  a 
            left join po_do_type  b on a.po_do_type =b.id
            where a.status_po_do ='REQ APV'";
    
        
            return $this->db->query($query)->result_array();  
    
           
    }
    

    
public function chekcpodotype($kode_po_do)
{

    $query = "SELECT   po_do_type  from po_do     where kode_po_do='$kode_po_do'";
    return $this->db->query($query)->row_array();  

}

public function get_podo_data($kode_po_do)
{

    $query = "SELECT   *  from po_do     where kode_po_do='$kode_po_do'";
    return $this->db->query($query)->row_array();  

}

 



    
public function get_all_po_do_list_D1($kode_po_do)
{

        $query = "SELECT 
        a.kode_po_do,
        b.kode_order,
        a.price as amount_req,
        b.total_amount as total_transaksi,
        b.angsuran,
        b.tenor,
        c.fintech_name,
        b.user_order,
       
        convert(SmallDateTime, b.date_order) as date_order
        
        from po_do_detail a
        left join contract b on a.kode_parent = b.kode_order
        left join fintech c on b.id_fintech = c.id
        
        where a.kode_po_do='$kode_po_do'";

    
        return $this->db->query($query)->result_array();  

       
}


public function get_all_po_do_list_D2($kode_po_do)
{

        $query = "SELECT 
        a.kode_po_do,
        a.price as amount_req,
        b.supplier_name,
        b.nama_kontak_supplier,
        b.kontak_supplier,
        b.bank_supplier,
        b.norek_supplier,
        a.user_post,
        convert(SmallDateTime, a.date_post) as date_post
        
    
        
        from po_do_supplier_detail a
        left join supplier b on a.kode_parent = b.id
        
        where a.kode_po_do='$kode_po_do'";

    
        return $this->db->query($query)->result_array();  

       
}



public function PostPoDo_Review_Upd_M($kode_po_do, $dataupdate)
{
    $this->db->where('kode_po_do', $kode_po_do);
    return $this->db->update('po_do', $dataupdate);


}






}