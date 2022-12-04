<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');

ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv


class Notification_m  extends CI_Model {




    
public function getdatanotif($username)
{

        $query = "
        select * from (
        select  
                a.id,
                a.user_receive,
                a.message,
                a.date_notif,
                a.tag_notification,
                a.category_notification,
                b.id as id_view
                           from notification  a
                left join notification_view  b on a.id = b.id_notif         
                where a.user_receive='IBNU0847'  and a.date_notif >= now() - interval '3 month'
                and  a.category_notification ='pemberitahuan' 
         union all 
          select  
                a.id,
                a.user_receive,
                a.message,
                a.date_notif,
                a.tag_notification,
                a.category_notification,
                b.id as id_view       
                from notification  a
                left join notification_view  b on a.id = b.id_notif         
                where  a.date_notif >= now() - interval '3 month'
                and  a.category_notification ='general' ) t order by date_notif  desc ";

        return $this->db->query($query)->result_array();  
       
}
                
public function getdatanotifpesanan($username){

        $query = "select  
        a.id,
        a.user_receive,
        a.message,
        a.date_notif,
        a.tag_notification,
        a.category_notification,
        b.id as id_view
        
        
        from notification  a
        left join notification_view  b on a.id = b.id_notif 
        
        where a.user_receive='$username' and a.date_notif >= now() - interval '3 month'
        and  a.category_notification ='pesanan' order by a.date_notif  desc";
    
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