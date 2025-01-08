<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        $data['profile'] = $this->Profile_model->get_user_with_profile($data['user']['email']);
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->Profile_model->get_user_with_profile($data['user']['email']);
        $data['title'] = 'Edit Profile';
        $data['statusList'] = [
            ['status' => 'Mahasiswa'],
            ['status' => 'Alumni']
        ];
        

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('portofolio', 'Portfolio', 'required|trim');
        $this->form_validation->set_rules('ipk', 'ipk', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        $this->form_validation->set_rules('about', 'about', 'required|trim');
        

        if($this->form_validation->run()==false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // check jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->where('email', $email);
                    $this->db->update('user', ['image' => $new_image]);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            
            $upload_cv = $_FILES['cv']['name'];
            if ($upload_cv) {
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = '5120'; // 5 MB
                $config['upload_path'] = './assets/cv/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('cv')) {
                    $old_cv = $data['profile']['cv'];
                    if ($old_cv) {
                        unlink(FCPATH . 'assets/cv/' . $old_cv);
                    }
                    $new_cv = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    $new_cv = $data['profile']['cv']; // Gunakan CV lama jika upload gagal
                }
            } else {
                $new_cv = $data['profile']['cv']; // Gunakan CV lama jika tidak ada upload baru
            }

            // Update tabel `user_profile`
            $update_data = [
                'portofolio' => $this->input->post('portofolio'),
                'ipk' => $this->input->post('ipk'),
                'status' => $this->input->post('status'),
                'about' => $this->input->post('about'),
                'cv' => $new_cv,
                'date_created' => date('Y-m-d H:i:s'),
                'user_id' => $data['user']['id']
            ];

            $this->db->where('email', $email);
            $this->db->update('user_profile', $update_data);          

            $this->db->where('email', $email);
            $this->db->update('user', ['name' => $name]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
            redirect('user');
        }
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
}