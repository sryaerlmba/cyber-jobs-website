<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
    public function get_user_with_profile($user_email)
    {

        $this->db->select('user.*, user_profile.*');
        $this->db->from('user');
        $this->db->join('user_profile', 'user.email = user_profile.email');
        $this->db->where('user.email', $user_email);
        
        // Debugging: tampilkan query yang dijalankan
        return $this->db->get()->row_array(); // Untuk mengambil satu baris data
    }

    public function getApplyByUserId($user_id) {
        $this->db->select('application.*, post.title, post.short_description, user.name');
        $this->db->from('application');
        $this->db->join('post', 'application.post_id = post.id');
        $this->db->join('user', 'application.user_id = user.id');
        $this->db->where('application.user_id', $user_id);
        return $this->db->get()->result_array();
    }
    

}