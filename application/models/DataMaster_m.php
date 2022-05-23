<?php
class DataMaster_m extends CI_Model
{
    /* DATA WORKLOCATION */
    function get_all_worklocation()
    {
        $this->db->select('*');
        $this->db->from('worklocation');
        $this->db->order_by('location_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    

    function get_worklocation_byid($id)
    {
        $this->db->select('*');
        $this->db->from('worklocation');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function insert_worklocation($data)
    {
        return $this->db->insert('worklocation', $data);
    }

    function edit_worklocation($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('worklocation', $data);
    }

    function delete_worklocation($id)
    {
        return $this->db->delete('worklocation', array('id' => $id));
    }
    /* DATA WORKLOCATION */

    /* DATA ORGANIZATION */
    function get_all_organization()
    {
        $this->db->select('*');
        $this->db->from('organization');
        $this->db->order_by('organization_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_all_rate()
    {
        $this->db->select('*');
        $this->db->from('ms_tenor');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    


    function get_all_fintect()
    {
        $this->db->select('*');
        $this->db->from('fintech');
        $this->db->order_by('fintech_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_Patner()
    {
        $this->db->select('*');
        $this->db->from('patner');
        $this->db->order_by('patner_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_all_Ekspedisi()
    {
        $this->db->select('*');
        $this->db->from('ekspedisi');
        $this->db->order_by('ekspedisi_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_all_Supplier()
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->order_by('supplier_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_organization_byid($id)
    {
        $this->db->select('*');
        $this->db->from('organization');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    
    function get_Ekspedisi_byid($id)
    {
        $this->db->select('*');
        $this->db->from('ekspedisi');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    function get_Supplier_byid($id)
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }



    function get_fintech_byid($id)
    {
        $this->db->select('*');
        $this->db->from('fintech');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_tenor_byid($id)
    {
        $this->db->select('*');
        $this->db->from('ms_tenor');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        return $query->row_array();
    }



    function get_patner_byid($id)
    {
        $this->db->select('*');
        $this->db->from('patner');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    function insert_organization($data)
    {
        return $this->db->insert('organization', $data);
    }


    function insert_Supplier($data)
    {
        return $this->db->insert('supplier', $data);
    }
    function insert_Ekspedisi($data)
    {
        return $this->db->insert('ekspedisi', $data);
    }

    function insert_tenor($data)
    {
        return $this->db->insert('ms_tenor', $data);
    }

    function insert_fintech($data)
    {
        return $this->db->insert('fintech', $data);
    }

    function insert_patner($data)
    {
        return $this->db->insert('patner', $data);
    }


    function edit_tenor($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_tenor', $data);
    }

    function edit_organization($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('organization', $data);
    }

    function edit_Supplier($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('supplier', $data);
    }

    function edit_Ekspedisi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('ekspedisi', $data);
    }


    
    function edit_fintech($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('fintech', $data);
    }


    function delete_organization($id)
    {
        return $this->db->delete('organization', array('id' => $id));
    }
    /* DATA ORGANIZATION */

    function delete_fintech($id)
    {
        return $this->db->delete('fintech', array('id' => $id));
    }


    function delete_Supplier($id)
    {
        return $this->db->delete('supplier', array('id' => $id));
    }


    function delete_tenor($id)
    {
        return $this->db->delete('ms_tenor', array('ID' => $id));
    }
    /* DATA ORGANIZATION */

    function delete_Ekspedisi($id)
    {
        return $this->db->delete('ekspedisi', array('ID' => $id));
    }

    function get_all_provinsi()
    {
        $query = "SELECT * FROM ms_provinsi ";
    
        
        return $this->db->query($query)->result_array();  
    
    }

    function get_all_kota()
    {
        $query = "SELECT * FROM ms_kota_kabupaten " ;
        return $this->db->query($query)->result_array();  
    
    }


    function edit_patner($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('patner', $data);
    }



    function delete_patner($id)
    {
        return $this->db->delete('patner', array('id' => $id));
    }



    
    function get_all_general_setting()
    {
        $this->db->select('*');
        $this->db->from('ms_general');
        $this->db->order_by('date_update', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }


    function insert_general($data)
    {
        return $this->db->insert('ms_general', $data);
    }


    function edit_general($id, $dataupdate)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_general', $dataupdate);
    }


    function get_general_byid($id)
    {
        $this->db->select('*');
        $this->db->from('ms_general');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete_general($id)
    {
        return $this->db->delete('ms_general', array('id' => $id));
    }




    function get_all_voucher()
    {
        $query = "select * from voucher where is_used=0 " ;
        return $this->db->query($query)->result_array();  
    
    }



    
    function get_code_voucher()
    {
        $query = "select * from voucher where is_used=0" ;
        return $this->db->query($query)->result_array();  
    
    }

    function insert_Voucher($data)
    {
        return $this->db->insert('voucher', $data);
    }


    
    
    function get_voucher_byid($id)
    {
        $this->db->select('*');
        $this->db->from('voucher');
        $this->db->where('kode_voucher', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    


    
    function delete_voucher($id)
    {
        return $this->db->delete('voucher', array('kode_voucher' => $id));
    }

    



}
