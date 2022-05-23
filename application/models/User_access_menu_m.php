<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_access_menu_m extends CI_Model
{

    private $table_name  = 'user_access_menu';
    private $primary_key = 'id';

    function get_all()
    {
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    function get_data($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table_name);

        return $query->row_array();
    }

    function count_all()
    {
        return $this->db->count_all($this->table_name);
    }

    function insert($data)
    {
        return $this->db->insert($this->table_name, $data);
    }

    function edit($id, $data)
    {
        $this->db->where($this->primary_key, $id);

        return $this->db->update($this->table_name, $data);
    }

    function delete($id)
    {
        return $this->db->delete($this->table_name, array($this->primary_key => $id));
    }
}
