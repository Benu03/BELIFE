<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize', '524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '524288'); // Setting to 512M - for pdo_sqlsrv

class User_manage_m extends CI_Model
{


    function get_all_detaildataregister($id)
    {


        $query = "SELECT 
        a.id,
        a.username,
        b.name_full,
        a.email,
        b.phone,
        b.nik,
        date(b.tgl_lahir) as tgl_lahir,
        b.tempat_lahir,
        b.jenis_kelamin,
        c.nama_provinsi,
        d.nama_kota_kabupaten,
        b.address_ktp,
        b.selfie,
        b.ktp_image,
        b.selfie_ktp_image,
        b.buku_tabungan,
        b.slip_gaji,
        b.limit_user,
        b.id_loc,
        e.partner_name,
        b.nama_ibu,
        b.marital_status,
        b.nama_pasangan,
        b.phone_pasangan,
        b.nama_saudara,
        b.phone_saudara,
        b.tgl_mulai_bekerja,
        a.is_active,
        b.datetime_post
        
         from users a
        left join personal_customer b on a.username = b.username 
        left join ms_provinsi c on b.provinsi_id = c.id_provinsi
        left join ms_kota_kabupaten d on b.kota_id = d.id_kota_kabupaten
        left join partner e on b.id_partner = e.id
         where a.id_role=2 and a.id = '$id'";
        return $this->db->query($query)->row_array();
    }



    function get_all_detailuser($id)
    {


        $query = "SELECT 
        a.id,
        a.username,
        b.name_full,
        a.email,
        b.phone,
        b.nik,
        date(b.tgl_lahir) as tgl_lahir,
        b.tempat_lahir,
        b.jenis_kelamin,
        c.nama_provinsi,
        d.nama_kota_kabupaten,
        b.address_ktp,
        b.selfie,
        b.ktp_image,
        b.selfie_ktp_image,
        b.buku_tabungan,
        b.slip_gaji,
        b.limit_user,
        b.id_loc,
        e.partner_name,
        a.is_active,
        b.datetime_post
        
         from users a
        left join personal_customer b on a.username = b.username 
        left join ms_provinsi c on b.provinsi_id = c.id_provinsi
        left join ms_kota_kabupaten d on b.kota_id = d.id_kota_kabupaten
        left join partner e on b.id_partner = e.id
         where a.id_role=2 and a.id ='$id'    ";
        return $this->db->query($query)->row_array();
    }





    function get_all_detaildataregister_generate($id)
    {


        $query = "
        select 
        a.id,
        a.username,
        b.name_full,
        a.email,
        b.phone,
        b.nik,
        date(b.tgl_lahir) as tgl_lahir,
        b.tempat_lahir,
        b.jenis_kelamin,
        c.nama_provinsi,
        d.nama_kota_kabupaten,
        b.address_ktp,
        b.nama_ibu,
        b.marital_status,
        b.nama_pasangan,
        b.phone_pasangan,
        b.nama_saudara,
        b.phone_saudara,
        b.tgl_mulai_bekerja,
        b.selfie,
        b.ktp_image,
        b.selfie_ktp_image,
        b.buku_tabungan,
        b.slip_gaji,
        b.limit_user,
        b.id_loc,
        e.partner_name,
        a.is_active,
        b.datetime_post
        
         from users a
        left join personal_customer b on a.username = b.username 
        left join ms_provinsi c on b.provinsi_id = c.id_provinsi
        left join ms_kota_kabupaten d on b.kota_id = d.id_kota_kabupaten
        left join partner e on b.id_partner = e.id
         where a.id_role= 2 and a.username ='$id'   ";
        return $this->db->query($query)->row_array();
    }

    function get_all_detailuser_generate($id)
    {


        $query = "
        select 
        a.id,
        a.username,
        b.name_full,
        a.email,
        b.phone,
        b.nik,
        date(b.tgl_lahir) as tgl_lahir,
        b.tempat_lahir,
        b.jenis_kelamin,
        c.nama_provinsi,
        d.nama_kota_kabupaten,
        b.address_ktp,
        b.selfie,
        b.ktp_image,
        b.selfie_ktp_image,
        b.buku_tabungan,
        b.slip_gaji,
        b.limit_user,
        b.id_loc,
        e.partner_name,
        a.is_active,
        b.datetime_post
        
         from users a
        left join personal_customer b on a.username = b.username 
        left join ms_provinsi c on b.provinsi_id = c.id_provinsi
        left join ms_kota_kabupaten d on b.kota_id = d.id_kota_kabupaten
        left join partner e on b.id_partner = e.id
         where a.id_role=2 and  a.username ='$id'   ";
        return $this->db->query($query)->row_array();
    }




    function get_all_dataregister()
    {


        $query = "SELECT 
                    a.id,
                    a.username,
                    b.name_full,
                    a.email,
                    b.phone,                    
                    e.partner_name,
                    a.is_active                    
                    from users a
                    left join personal_customer b on a.username = b.username 
                    --left join ms_provinsi c on b.provinsi_id = c.id_provinsi
                    --left join ms_kota_kabupaten d on b.kota_id = d.id_kota_kabupaten
                    left join partner e on b.id_partner = e.id
                    where a.id_role= 2 
                    and b.status_register ='update'
        ";
        return $this->db->query($query)->result_array();
    }


    function update_limitstatuspesonalcustomer($data)
    {
        $username = $data['username'];
        $limit = $data['limit'];
        $status_register = $data['status_register'];


        $query = "update personal_customer set limit_user = $limit, status_register='$status_register' where username ='$username' ";
        return $this->db->query($query);
    }

    function update_limitstatuspesonalcustomer2($data)
    {
        $username = $data['username'];
        $limit = $data['limit'];

        $query = "update personal_customer set limit_user=$limit where username ='$username' ";
        return $this->db->query($query);
    }


    function reject_limitstatuspesonalcustomer($username)
    {


        $query = "update personal_customer set limit_user = 0,status_register='reject' where username ='$username' ";
        return $this->db->query($query);
    }


    function get_list_user()
    {


        $query = "select 
        a.id,
        a.username,
        a.name,
        a.email,
        b.phone,
        d.partner_name
        
        
        
         from users a
         left join personal_customer b on a.username = b.username
         left join partner d on b.id_partner = d.id
        
        
        where a.id_role=2 and status_register='approved'";
        return $this->db->query($query)->result_array();
    }

    function get_all_user_generate()
    {

        $query = "select 
        a.id,
        a.username,
        a.name,
        a.email,
        b.phone,
		b.nik,
		b.tgl_lahir,
		b.tempat_lahir,
		b.jenis_kelamin,
		e.nama_provinsi ,
		f.nama_kota_kabupaten,
		b.address_ktp,
		b.limit_user,
        d.partner_name        
        
        
         from users a
         left join personal_customer b on a.username = b.username
         left join partner d on b.id_partner = d.id
	     left join ms_provinsi e on b.provinsi_id = e.id_provinsi
		 left join ms_kota_kabupaten f on b.kota_id = f.id_kota_kabupaten
        
        where a.id_role=2";
        return $this->db->query($query)->result_array();
    }
}
