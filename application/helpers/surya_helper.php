<?php

function is_logged_in()
{
    $ci = get_instance();
    if(!$ci->session->userdata('email')){
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id'); // 2
        $menu = $ci->uri->segment(1); // user

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array(); //user

        $menu_id = $queryMenu['id']; // 2

        $userAccess = $ci->db->get_where('user_acccess_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);


        if($userAccess->num_rows() < 1){    
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_acccess_menu');

    if($result->num_rows() > 0){
        return "checked='checked'";
    }
}