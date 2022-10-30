<?php
class Users_m extends CI_Model
{

    private $primary_key = 'id';
    private $table_name  = 'users';

    function get_all()
    {
        $this->db->select('users.id,  users.name, users.username, user_roles.role, users.is_active');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.id_role', 'left');
        $this->db->where('users.id_role !=', 1);
        $this->db->where('users.username !=', $this->session->userdata('username'));
        $this->db->order_by('users.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_row_data($id)
    {
        $this->db->select('users.*, user_roles.role, organization.organization_name, worklocation.location_name');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.id_role', 'left');
        $this->db->join('organization', 'organization.id = users.id_org', 'left');
        $this->db->join('worklocation', 'worklocation.id = users.id_loc', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_to_session($username)
    {
        $this->db->select('users.id, users.name, users.username, users.email, users.password, users.img_user, users.created_at, users.id_role, user_roles.role, users.is_active');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.id_role', 'left');
        $this->db->where('users.username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_user_profile($username)
    {
          
        $query = "SELECT *,user_roles.role,personal_customer.phone,personal_customer.limit_user  from users 
        left join user_roles  on users.id_role  = user_roles.id
        left join personal_customer on personal_customer.username = users.username and personal_customer.email = users.email
        where users.username = '$username'";     

        return $this->db->query($query)->row_array(); 
    


    }

    function get_user_contract($username)
    {
          
        $query = "select * from contract
        where user_order ='$username' and status_contract ='GOLIVE'";     

        return $this->db->query($query)->row_array();     

    }


    



 

    /* FOR USER SESSION DATA */
    function get_session($username)
    {
        $query = "SELECT users.username, users.name, users.email,personal_customer.phone, users.password, users.img_user, 
        users.id_role, users.is_active, user_roles.role,partner.partner_name
        from users 
        left join user_roles on user_roles.id = users.id_role
        left join partner on partner.id = users.id_partner
        left join personal_customer on personal_customer.username = users.username and personal_customer.email = users.email
        where upper(users.email)  = '$username'
        or personal_customer.phone ='$username'";     

        return $this->db->query($query)->row_array(); 
    }

    /* FOR CHECK USER PASSWORD DATA */
    function get_password($username)
    {
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row()->password;
    }

    function count_all()
    {
        return $this->db->count_all($this->table_name);
    }

    function insert($dataregister)
    {
        return $this->db->insert($this->table_name, $dataregister);
    }

    function insert_datapersonal($datapersonal)
    {
        return $this->db->insert('personal_customer',$datapersonal);
        $this->db->error(); 
    }

    function edit($id, $data)
    {
        $this->db->where('username', $id);
        return $this->db->update($this->table_name, $data);
    }

    function edit_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }

    function edit_password($id, $password_hash)
    {
        $this->db->set('password', $password_hash);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('username', $id);
        $this->db->update('users');
    }

    function delete($id)
    {
        return $this->db->delete($this->table_name, array($this->primary_key => $id));
    }


    function personal_customer_check($username)
    {

        $query = "select * from personal_customer
        where username ='$username' ";
        return $this->db->query($query);  

    }


    function personal_customer_get($username)
    {

        $query = "SELECT username, name_full, email, phone, nik, tgl_lahir, tempat_lahir, jenis_kelamin,
        mp.nama_provinsi, mkk.nama_kota_kabupaten , address_ktp, ktp_image, selfie_ktp_image, limit_user, 
        id_loc, id_partner, date(datetime_post) as datetime_post, status_register, buku_tabungan, slip_gaji,selfie
        FROM public.personal_customer a
        left join ms_provinsi mp ON a.provinsi_id = mp.id_provinsi 
        left join ms_kota_kabupaten mkk on a.kota_id = mkk.id_kota_kabupaten 
        where a.username ='$username' ";
        return $this->db->query($query); 


    }



    function Banner($id)
    {
        $query = "select file_upload from ms_general
        where code ='$id' ";
        return $this->db->query($query)->row_array(); 

    }
    

    function update_actived_user($username)
    {

        $query = "update users set is_active=1
        where username ='$username' ";
        return $this->db->query($query);  

    }

    function contract_check($username)
    {

        $query = "select * from contract 
        where user_order ='$username' and status_contract ='GOLIVE'";
        return $this->db->query($query);  

    }

    

    function update_selfie_image($username,$default_name_selfie)
    {

        $query = "update personal_customer set selfie_image='$default_name_selfie'
        where username ='$username' ";
        return $this->db->query($query);  


    }

    function upload_ktp($username,$default_name)
    {

        $query = "update personal_customer set ktp_image='$default_name'
        where username ='$username' ";
        return $this->db->query($query); 


    }
    

    
    function upload_selfie($username,$default_name)
    {

        $query = "update personal_customer set selfie='$default_name'
        where username ='$username' ";
        return $this->db->query($query); 


    }
    
      
    function upload_selfie_ktp($username,$default_name)
    {

        $query = "update personal_customer set selfie_ktp_image='$default_name'
        where username ='$username' ";
        return $this->db->query($query); 


    }

         
    function upload_buku_tabungan($username,$default_name)
    {

        $query = "update personal_customer set buku_tabungan='$default_name'
        where username ='$username' ";
        return $this->db->query($query); 


    }

    function upload_slip_gaji($username,$default_name)
    {

        $query = "update personal_customer set slip_gaji='$default_name'
        where username ='$username' ";
        return $this->db->query($query); 


    }

    function upload_status_register($username,$statusregister)
    {

        $query = "update personal_customer set status_register='$statusregister'
        where username ='$username' ";
        return $this->db->query($query); 


    }
 
 
 

    

    
}
