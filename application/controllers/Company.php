<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Company Profile';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('company/index', $data);
        $this->load->view('template/footer');
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
            redirect('company/managePosts');
        }
    }

    public function managePosts()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Manage Posts';
        $data['posts'] = $this->Company_model->getPost($data['user']['id']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('company/manage-posts', $data);
        $this->load->view('template/footer');
    }

    public function editPost($postId)
    {
        $data['post'] = $this->Company_model->getPostById($postId);

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Post';

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('short_description', 'Short Description', 'required|trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
        $this->form_validation->set_rules('salary', 'Salary', 'required|trim');
        $this->form_validation->set_rules('contact', 'Details', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('company/edit-post', $data);
            $this->load->view('template/footer');
        } else {
            $dataEdit = [
                'title' => $this->input->post('title'),
                'short_description' => $this->input->post('short_description'),
                'details' => $this->input->post('details'),
                'location' => $this->input->post('location'),
                'salary' => $this->input->post('salary'),
                'contact' => $this->input->post('contact'),
            ];

            $this->db->where('id', $this->input->post('post_id'));
            $this->db->update('post', $dataEdit);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Post Updated Successfully!</div>');
            redirect('company/managePosts');
        }
    }

    public function deletePost($idPost, $role= 'company')
    {
        $this->db->delete('post', ['id' => $idPost]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Post Deleted Successfully!</div>');
        if ($role == 'admin') {
            redirect('admin/managePosts', $data);
        } else {
            redirect('company/managePosts');
        }
    }

    public function applicants()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['apply'] = $this->Company_model->getApplybyUserId($data['user']['id']);
        $data['title'] = 'Applicants';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('company/applicants', $data);
        $this->load->view('template/footer');
    }

    public function detailsApplicants($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['apply'] = $this->Company_model->getApplicationById($id);
        $data['title'] = 'Detail Applicant';

        $status = $this->input->post('status');


        $this->form_validation->set_rules('message', 'message', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('company/details-applicants', $data);
            $this->load->view('template/footer');
        } else {
            if ($this->input->post('status') == 'Pending') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please update applicant status first!</div>');
                $this->load->view('template/header', $data);
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar', $data);
                $this->load->view('company/details-applicants', $data);
                $this->load->view('template/footer');
            } else {
                $dataUpdate = [
                    'message' => $this->input->post('message'),
                    'status' => $this->input->post('status'),
                ];

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('application', $dataUpdate);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Message Sent Successfully!</div>');
                redirect('company/applicants');
            }
        }
    }

    public function editProfile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('company/edit-profile', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->session->userdata('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->where('email', $email);
                    $this->db->update('user', ['image' => $new_image]);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Updated Successfully!</div>');
            redirect('company');
        }
    }
}
