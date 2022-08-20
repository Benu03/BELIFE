<?php

defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize', '524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '524288'); // Setting to 512M - for pdo_sqlsrv


class Finance_m  extends CI_Model
{





        public function get_all_coa()
        {
                $query = "SELECT * FROM coa ";
                return $this->db->query($query)->result_array();
        }

        function get_Coa_byid($id)
        {
                $this->db->select('*');
                $this->db->from('coa');
                $this->db->where('id', $id);
                $query = $this->db->get();
                return $query->row_array();
        }

        function edit_Coa($id, $data)
        {
                $this->db->where('id', $id);
                return $this->db->update('coa', $data);
        }

        function delete_Coa($id)
        {
                return $this->db->delete('coa', array('id' => $id));
        }

        public function get_all_po_do_list_req()
        {

                $query = "SELECT 
                        a.kode_po_do,
                        a.total_req,
                        a.count_detail,
                        b.*,
                        a.user_request,
                        date(a.date_request)  as  date_request
                        
        
        from po_do  a 
        left join po_do_type  b on a.po_do_type =b.id
        where a.status_po_do ='REQ'";


                return $this->db->query($query)->result_array();
        }





        public function get_all_po_do_list_apv()
        {

                $query = "SELECT 
                a.kode_po_do,
                a.total_req,
                a.count_detail,
                b.*,
                a.user_request,
                a.is_podo_done,
                date(a.date_request) as date_request             
                from po_do  a 
                left join po_do_type  b on a.po_do_type =b.id
                where a.status_po_do ='APV'
	            and a.is_podo_done isnull
                ORDER BY a.date_request desc
";


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

        public function get_all_list_file_upload()
        {

                $query = "SELECT id
                                ,nama_file
                                ,user_upload
                                ,date(date_upload ) as date_upload
                                ,is_posting
                                ,user_posting
                                ,date(date_posting ) as date_posting
                                FROM billing_upload
                                order by id desc";
                return $this->db->query($query)->result_array();
        }







        public function get_all_po_do_list_D1($kode_po_do)
        {

                $query = "SELECT distinct
                        a.kode_po_do,
                        b.kode_order,
                        a.price as amount_req,
                        b.total_amount as total_transaksi,
                        b.angsuran,
                        b.tenor,
                        c.fintech_name,
                        b.user_order,
                        date(b.date_order ) as date_order
     
                        
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
                        date(a.date_post) as date_post
                        
                
                        
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




        public function importdatabilling($databilling)
        {


                $countbilling = count($databilling);
                if ($countbilling > 0) {

                        $this->db->insert('billing_list_contract', $databilling);
                }
        }



        public function get_data_upload_unposting()
        {

                $query = "SELECT 

                        a.nama_file,
                        count(b.id) as countdata,
                        sum(b.amount) as amount,
                        a.user_upload,
                        date(date_upload) as date_upload
                
                        
                        FROM BILLING_UPLOAD a
                        left join billing_list_contract b on a.nama_file = b.nama_file
                        where is_posting=0
                        
                        group by a.nama_file,a.user_upload,a.date_upload";
                      return $this->db->query($query)->row_array();
        }

        public function checkposting()
        {

                $query = "SELECT * FROM BILLING_UPLOAD  where is_posting=0";
                return $this->db->query($query);
        }


        public function cleasingdata_dataupload($namafile)
        {

                $query = " DELETE  from BILLING_UPLOAD  where nama_file ='$namafile'
                    and is_posting=0";
                return $this->db->query($query);
        }


        public function cleasingdata_dataupload_list($namafile)
        {

                $query = " DELETE from billing_list_contract  where nama_file ='$namafile'";
                return $this->db->query($query);
        }




        public function update_dataupload($namafile, $dataupdate1)
        {

                $this->db->where('nama_file', $namafile);
                return $this->db->update('BILLING_UPLOAD', $dataupdate1);
        }

        public function update_dataupload_list($namafile, $dataupdate2)

        {
                $this->db->where('nama_file', $namafile);
                return $this->db->update('billing_list_contract', $dataupdate2);
        }

        public function get_all_po_do_list_DONE($id)
        {
                $query = "      UPDATE  shipping SET status_pengiriman='REQ' 
                                WHERE kode_shipping IN (SELECT kode_shipping FROM contract WHERE kode_order IN (select kode_parent from po_do_detail
                                WHERE kode_po_do='$id'))";
                return $this->db->query($query);
        }


        public function update_isprint_podo($kode_po_do)
        {

                $query = "UPDATE po_do set is_print = 1 where kode_po_do='$kode_po_do'";
                return $this->db->query($query);
        }

        public function get_all_po_do_list_f_done($kode_po_do)
        {

                $query = "UPDATE po_do set is_podo_done = 1 where kode_po_do='$kode_po_do'";
                return $this->db->query($query);
        }




        public function pododatamain($kode_po_do)
        {

                $query = "SELECT * from po_do where kode_po_do='$kode_po_do'";
                return $this->db->query($query)->row_array();;
        }


        public function pododatasupplier($kode_po_do)
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
                date(a.date_post) as date_post
        
    
        
        from po_do_supplier_detail a
        left join supplier b on a.kode_parent = b.id
        
        where a.kode_po_do='$kode_po_do'";
                return $this->db->query($query)->result_array();;
        }



        public function podopermohonandana($kode_po_do)
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
       date(b.date_order) as date_order
        
        from po_do_detail a
        left join contract b on a.kode_parent = b.kode_order
        left join fintech c on b.id_fintech = c.id
        
        where a.kode_po_do='$kode_po_do'";
                return $this->db->query($query)->result_array();;
        }
}
