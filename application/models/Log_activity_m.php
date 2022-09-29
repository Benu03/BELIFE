<?php
class Log_activity_m extends CI_Model
{
    private $table_name  = 'log_activity';
    private $primary_key = 'id';

    function get_all()
    {


        $query = "
            select distinct a.username,b.name,a.at_time from log_activity a
            left join users b on a.username = b.username
            where id_role in ('3','5')";


        return $this->db->query($query)->result_array();
    }




    function get_data($id)
    {

        $query = "select * from log_activity where username='$id'";


        return $this->db->query($query)->result_array();
    }
}
