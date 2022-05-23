<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv


class api_model  extends CI_Model {




    
public function get_secret_key($compay_id)
{

        $query = "SELECT * FROM ms_key WHERE CompanyID = '$compay_id'";

    
        return $this->db->query($query)->result_array();  

       
}

 

public function datauser ($email)
{
 
 

    $query = "SELECT 
    a.id,
    a.username,
    a.name,
    a.email,
    a.id_role,
    b.role,
    a.is_active,
    
	c.organization_name,
	d.location_name

    
      FROM users a
      left join user_roles b on a.id_role = b.id 
	  left join organization  c on a.id_org = c.id
	  left join worklocation d on a.id_loc = d.id 
      where  a.email='$email' ";

    
    return $this->db->query($query)->result_array();  



}







}