<?php
class Product_m extends CI_Model
{
    private $table_name  = 'product';
    private $primary_key = 'kode_product';

    function get_all_product()
    {


        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    function get_all_product_pag($limit, $start, $cari = null)
    {

        if ($cari) {


            $this->db->like('nama_product', $cari);
        }



        $this->db->select('product.*,ms_general.value diskon_value');
        $this->db->from($this->table_name);
        $this->db->join('ms_general', 'product.diskon_id = ms_general.id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }



    function get_all_product_home()
    {



        $this->db->select('product.*,ms_general.value diskon_value');
        $this->db->from($this->table_name);
        $this->db->join('ms_general', 'product.diskon_id = ms_general.id', 'left');
        $this->db->limit(8);
        $query = $this->db->get();
        return $query->result_array();
    }



    function count_all_product()
    {

        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }




    function get_data($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table_name);
        return $query->row_array();
    }



    function find_product($id)
    {
        $query = "SELECT * FROM product where  kode_product='$id' ";


        return $this->db->query($query)->row_array();
    }


    function get_all_kategori()
    {
        $query = "SELECT * FROM product_category  ";


        return $this->db->query($query)->result_array();
    }




    function get_data_keranjang($username)
    {
        $query = "select 
        a.id,
        a.kode_product,
        b.nama_product,
        a.qty,
        a.price,
        b.image_product,
        b.qty as stok,
        a.user_order,
		a.subtotal
        from keranjang a
        left join product b  on a.kode_product = b.kode_product
        where a.user_order='$username' and is_order= 0";
        return $this->db->query($query);
    }


    function updateKeranjang($qty, $datasubtotal, $id)
    {

        $query = " update keranjang set qty='$qty',subtotal='$datasubtotal'  where id='$id' and is_order=0 ";
        return $this->db->query($query);
    }

    function datatotalkeranjang($username)
    {

        $hsl = $this->db->query("select sum(subtotal) as totaltransaksi from keranjang
        where user_order='$username' and is_order=0");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'totaltransaksi' => $data->totaltransaksi
                );
            }
        }
        return $hasil;
    }






    function get_data_countitemkeranjang($username)
    {
        $query = "select        *
        from keranjang
        where user_order='$username' and is_order= 0 
        ";


        return $this->db->query($query);
    }



    function get_data_totalharga($username)
    {
        $query = "select 
        sum(subtotal) as totalharga
        from keranjang
        where user_order='$username' and is_order= 0";

        return $this->db->query($query);
    }



    function delete_data_keranjang($username)
    {

        $this->db->where('user_order', $username);
        $this->db->delete('keranjang');
    }


    function delete_dataproduct_keranjang($id, $username)
    {

        $query = "delete from keranjang 
        where user_order ='$username' and id='$id' ";
        return $this->db->query($query);
    }

    function delete_data_keranjang_detail($id)
    {

        $query = "delete from keranjang 
        where id ='$id' ";
        return $this->db->query($query);
    }




    function get_data_productdetail($kode_product)
    {

        $query = "select * from product where kode_product='$kode_product' ";
        return $this->db->query($query);
    }


    function updateqtyproduct($kodeprd)
    {

        $query = " update product set qty = qty-1  where kode_product='$kodeprd'";
        return $this->db->query($query);
    }





    function get_data_productdetail_keranjang($kode_product, $username)
    {
        $query = "select 
		a.id,
        a.kode_product,
        b.nama_product,
        a.qty,
        b.price_buy,
        b.price_sell,
        b.nama_product,
        b.title_product,
		a.user_order
       
        from keranjang a
        left join product b  on a.kode_product = b.kode_product
        where a.user_order='$username' and a.kode_product='$kode_product' and is_order=0
        ";
        return $this->db->query($query);
    }




    function get_all_kategoriproduct()
    {
        $query = "select * from product_category";


        return $this->db->query($query);
    }

    function get_all_diskon()
    {
        $query = "select * from ms_general where code like 'Diskon_%'";


        return $this->db->query($query);
    }

    function insert_kategorproduct($data)
    {
        return $this->db->insert('product_category', $data);
    }


    function get_kategoiproduct_byid($id)
    {
        $query = "select * from product_category where id='$id' ";
        return $this->db->query($query)->row_array();
    }


    function get_all_productshow_byid($id)
    {
        $query = "select * from product where kode_product='$id' ";
        return $this->db->query($query)->row_array();
    }


    function edit_kategoriproduct($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('product_category', $data);
    }

    function delete_kategoriproduct($id)
    {
        return $this->db->delete('product_category', array('id' => $id));
    }





    function get_all_productshow()
    {
        $query = "select 

        kode_product
        ,title_product
              ,nama_product
              ,description
              ,a.id_category_product
              ,b.category_name
              ,price_buy
              ,price_sell
              ,status
              ,qty
              ,image_product
              ,user_create
              ,date_create
              ,user_update
              ,date_update
        
        
        
        from product a
        left join  product_category  b on a.id_category_product = b.id";


        return $this->db->query($query);
    }

    function insert_product($data)

    {


        return $this->db->insert('product', $data);
    }


    function get_product_byid($kode_product)
    {
        $query = "select * from product where kode_product='$kode_product' ";
        return $this->db->query($query)->row_array();
    }


    function edit_product($kode_product, $data)
    {
        $this->db->where('kode_product', $kode_product);
        return $this->db->update('product', $data);
    }

    function delete_product($id)
    {
        return $this->db->delete('product', array('kode_product' => $id));
    }

    function getkodeproductseq()
    {




        $this->db->select('RIGHT(product.kode_product,4) as kode_product', FALSE);
        $this->db->order_by('kode_product', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('product');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_product) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $date = date("Ym");
        $kodetampil = "PRD-" . $date . "-" . $batas;
        return $kodetampil;
    }
}
