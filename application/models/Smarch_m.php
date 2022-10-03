<?php
class Smarch_m extends CI_Model
{


  
    function checkcontract($contract_no)
    {

        $query = "SELECT contract_no, user_order, date_order, kode_order, total_amount, tenor, angsuran, admin_cost, shipping_cost, status_contract, fintech_name, ekspedisi_name, user_approve, date_approve, kode_shipping, status_pengiriman, user_shipping, date_shipping, user_post, date_post
        FROM contract c
        left join fintech f on c.id_fintech = f.id 
        left join ekspedisi e on c.id_ekspedisi = e.id 
        where contract_no ='$contract_no'";

        return $this->db->query($query);
    }

    


    function personaldata($usercontract)
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
        left join partner e on b.id_org = e.id
          
        where a.username ='$usercontract'";

        return $this->db->query($query);
    }


    
    function installmentdata($contract_no)
    {

        $query = "select * from installment_customer where contract_no ='$contract_no' order by installment_no asc";

        return $this->db->query($query);
    }


    
    function history_contract($usercontract)
    {

        $query = "select * from contract c 
        where user_order ='$usercontract'";

        return $this->db->query($query);
    }


    


}
