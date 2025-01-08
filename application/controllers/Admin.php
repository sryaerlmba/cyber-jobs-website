<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();

    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $data['total_user'] = $this->db->get('user')->num_rows();
        

        $this->db->select('user.id, user.name, user.email, user.is_active, user.date_created, user_role.role');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $data['users'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    
    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer');
    }

    public function deleteUser($userId)
    {
        $this->db->where('id', $userId);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User has been deleted!</div>');
        redirect('Admin');
    }

    public function deleteRole($roleId)
    {
        $this->db->where('id', $roleId);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role has been deleted!</div>');
        redirect('admin/role');
    }
    
    public function roleaccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role Access';

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_acccess_menu', $data);

        if($result->num_rows() < 1){
            $this->db->insert('user_acccess_menu', $data);
        } else {
            $this->db->delete('user_acccess_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!</div>');
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');    
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|matches[new_password1]');

        if($this->form_validation->run()==false){
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if(!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong Current Password! </div>');
                redirect('user/changepassword');
            } else {
                if($new_password == $current_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password! </div>');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password has been changed! </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function jobPosting()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Job Posting';

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('short_description', 'Short Description', 'required|trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');
        $this->form_validation->set_rules('contact', 'contact', 'required|trim');
        $this->form_validation->set_rules('location', 'location', 'required|trim');
        $this->form_validation->set_rules('salary', 'salary', 'numeric|required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('company/job-posting', $data);
            $this->load->view('template/footer');
        } else {
            $data_insert = [
                'title' => $this->input->post('title'),
                'short_description' => $this->input->post('short_description'),
                'details' => $this->input->post('details'),
                'contact' => $this->input->post('contact'),
                'location' => $this->input->post('location'),
                'salary' => $this->input->post('salary'),
                'date_created' => time(),
                'user_id' => $data['user']['id']
            ];


            $this->db->insert('post', $data_insert);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Job Posted Successfully!</div>');
            redirect('admin/managePosts');
        }
    }

    public function managePosts()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Manage Post';
        $data['posts'] = $this->Company_model->getAllPost();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/manage-posts', $data);
        $this->load->view('template/footer');
    }

    public function deletePost($idPost)
    {
        $this->db->delete('post', ['id' => $idPost]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Post Deleted Successfully!</div>');    
        redirect('admin/managePosts');
        
    }

}