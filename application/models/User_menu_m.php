<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_menu_m extends CI_Model
{

    private $table_name  = 'user_menu';
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

    function get_all_exc_usermenu()
    {
        $this->db->where('id !=', 2);
        $this->db->order_by('title', 'ASC');
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    function get_menu_by_role($id_role)
    {
        $query = $this->db->query("SELECT user_menu.id, user_menu.title, user_menu.url, user_menu.icon FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE user_access_menu.role_id = '{$id_role}' ORDER BY user_menu.title ASC ");
        return $query->result_array();
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
