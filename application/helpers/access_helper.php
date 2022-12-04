<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                Please login first!
            </div>
        ');

        redirect('Auth');
    } else {
        $id_role    = $ci->session->userdata('id_role');
        $menu       = $ci->uri->segment(1);
        $queryMenu  = $ci->db->get_where('user_menu', ['url' => $menu])->row_array();
        $menu_id    = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $id_role,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('Auth/Blocked');
        }
    }
}

function check_access($roleId, $menuId) //Digunakan oleh Views('user/role_access_v') untuk edit role group
{
    $ci = get_instance();

    $ci->db->where('role_id', $roleId);
    $ci->db->where('menu_id', $menuId);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}


function get_signature_login($get_array = array(), $secret_key)
{
    $email = $get_array['email'];

    $belife_signature = sha1($email . $secret_key);

    return $belife_signature;
}



function Count_item($username)
{

    $ci = get_instance();

    $query = "select  * from keranjang where user_order='$username' and is_order= 0 ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}

function Count_notification($username)
{

    $ci = get_instance();

    $query = "select  * from notification where user_receive='$username' and id not in (
        select id_notif  from public.notification_view 
        where username ='$username')";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}




function is_login()
{
    $ci = get_instance();
    $is_login = $ci->session->userdata('is_login');


    return ($is_login === TRUE);
}



function count_orderprocess()
{

    $ci = get_instance();

    $query = "select  * from orders where status_order='ORDER' ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}

function count_kontak()
{

    $ci = get_instance();

    $query = "select  * from kontak where is_reply=0 ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}


function count_validasiregister()
{

    $ci = get_instance();

    $query = "select  * from personal_customer where status_register='update'";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}


function count_shipping()
{

    $ci = get_instance();

    $query = "select * FROM shipping where status_pengiriman = 'REQ' ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}

function count_shipping_waiting()
{

    $ci = get_instance();

    $query = "select * FROM shipping where status_pengiriman = 'WAITING' ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}

function count_delivery()
{

    $ci = get_instance();

    $query = "select * FROM shipping where status_pengiriman = 'DELIVERY' ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}


function count_productlow()
{

    $ci = get_instance();

    $query = "select * FROM product where qty <= '3' ";
    $result =   $ci->db->query($query)->num_rows();
    return $result;
}










function get_spred_harga_product($price)
{



    $ci = get_instance();

    $query = "select (($price * value)/100) + $price  from ms_general
      where code='PRCHRG'";
    $result =   $ci->db->query($query)->result_array();



    return $result;
}
