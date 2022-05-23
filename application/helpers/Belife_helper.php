<?php


class Belife_helper {
    function get_signature_login($get_array = array(), $secret_key)
    {
        $email = $get_array['email'];      

        $belife_signature = sha1($email.$secret_key);

        return $belife_signature;
    }



   


   





}