<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    public function getPost($id)
    {
        $this->db->select('post.*, user.image, user.name');
        $this->db->from('user');
        $this->db->join('post', 'post.user_id = user.id');
        $this->db->where('post.user_id', $id);

        return $this->db->get()->result_array(); // Untuk mengambil satu baris data
    }

    public function getPostDetails($idPost)
    {
        $this->db->select('post.*, user.image, user.name');
        $this->db->from('user');
        $this->db->join('post', 'post.user_id = user.id');
        $this->db->where('post.id', $idPost);

        return $this->db->get()->row_array(); // Untuk mengambil satu baris data
    }

    public function getAllPost()
    {
        $this->db->select('post.*, user.image, user.name');
        $this->db->from('post');
        $this->db->join('user', 'post.user_id = user.id');
        $this->db->order_by('post.date_created', 'DESC');  // Menambahkan pengurutan berdasarkan waktu

        return $this->db->get()->result_array();
    }

    public function getAllPosts()
    {
        $this->db->select('post.*, user.image, user.name');
        $this->db->from('user');
        $this->db->join('post', 'post.user_id = user.id');

        return $this->db->get()->result_array(); // Untuk mengambil semua data
    }

    public function getPostById($idPost)
    {
        return $this->db->get_where('post', ['id' => $idPost])->row_array();
    }

    public function getApplybyUserId($user_id)
    {
        $this->db->select('
            post.*, 
            user_profile.*, 
            user.name, 
            application.id as application_id,
            application.status as application_status, 
            application.date_created as application_date_created
        ');
        $this->db->from('application');
        $this->db->join('post', 'application.post_id = post.id');
        $this->db->join('user_profile', 'user_profile.user_id = application.user_id');
        $this->db->join('user', 'user.email = user_profile.email');
        $this->db->where('post.user_id', $user_id);  // Perbaikan di sini
        return $this->db->get()->result_array();
    }

    public function getApplicationById($ApplicationId)
    {
        $this->db->select('
            application.*,
            application.date_created as application_date_created,
            application.id as application_id, 
            application.application_letter as app_letter,
            user_profile.*, 
            user.*, 
            post.*
        ');
        $this->db->from('application');
        $this->db->join('post', 'application.post_id = post.id');
        $this->db->join('user', 'application.user_id = user.id');
        $this->db->join('user_profile', 'user.email = user_profile.email');
        $this->db->where('application.id', $ApplicationId);
        return $this->db->get()->row_array();
    }

    public function searchPost($keyword)
    {
        $this->db->select('post.*, user.image, user.name');
        $this->db->distinct();
        $this->db->like('post.title', $keyword);
        $this->db->or_like('post.details', $keyword);
        $this->db->or_like('user.name', $keyword);
        $this->db->or_like('post.location', $keyword);
        $this->db->from('user');
        $this->db->join('post', 'post.user_id = user.id');

        return $this->db->get()->result_array();
    }
}
