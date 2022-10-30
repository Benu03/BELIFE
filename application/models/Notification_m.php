<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv


class Notification_m  extends CI_Model {




    
public function getdatanotif($username)
{

        $query = "SELECT * FROM notification WHERE user_receive='$username'
        and date_notif >= now() - interval '6 month' and  category_notification in ('akun','info')   order by date_notif  desc";

    
        return $this->db->query($query)->result_array();  
       
}
                
public function getdatanotifpesanan($username)
{

        $query = "SELECT * FROM notification WHERE user_receive='$username'
        and date_notif >= now() - interval '6 month' and  category_notification='pesanan' order by date_notif  desc";
    
        return $this->db->query($query)->result_array();  
       
}



    
public function updateisview($id)
{

        $query = "update notification set is_view=1 where id='$id' ";

    
        return $this->db->query($query);  

       
}

 

function checknotif($username)
{
    $query = "select * from notification where  user_receive='$username' and is_view=0 ";

    
    return $this->db->query($query)->num_rows();  

}






}