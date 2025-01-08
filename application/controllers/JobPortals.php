<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobPortals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Your Post';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('jobPortal/your-posts', $data);
        $this->load->view('template/footer');
    }

    public function searchJobs()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Search Jobs';

        $data['posts'] = $this->Company_model->getAllPost();

        if ($this->input->post('keyword')) {
            $data['posts'] = $this->Company_model->searchPost($this->input->post('keyword'));
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('jobPortal/search-jobs', $data);
        $this->load->view('template/footer');
    }

    public function viewPost($id, $details = 'details')
    {
        $data['title'] = 'Job Details';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data post berdasarkan ID
        $data['post'] = $this->Company_model->getPostDetails($id);
        $data['profile'] = $this->Profile_model->get_user_with_profile($data['user']['email']);

        if ($details == 'details') {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('jobPortal/detail-post', $data);
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('jobPortal/view-post', $data);
            $this->load->view('template/footer');
        }
    }

    public function submitApplication($post_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $config['upload_path'] = './assets/application_letters/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('application_letter')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
            redirect('jobPortals/viewPost/' . $post_id);
        } else {
            $upload_data = $this->upload->data();
            $application_letter = $upload_data['file_name'];
        }

        $dataApply = [
        'post_id' => $post_id,
        'user_id' => $data['user']['id'],
        'status' => 'pending',
        'company' => $this->input->post('company_name'),
        'date_created' => time(),
        'message' => 'Please wait Until next Information.',
        'application_letter' => $application_letter
        ];

        $this->db->insert('application', $dataApply);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have successfully applied for this job! </div>');
        redirect('jobPortals/viewPost/' . $post_id);
    }

    public function yourApply()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Your Application';

        $data['apply'] = $this->Profile_model->getApplyByUserId($data['user']['id']);
        

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('jobPortal/your-apply', $data);
        $this->load->view('template/footer');
    }

    public function detailApplication()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Your Application';

        $data['apply'] = $this->Profile_model->getApplyByUserId($data['user']['id']);
        // var_dump($data['apply']);
        // die;
        // $data['post'] = $this->db->get_where('application', ['id' => $data['apply']['id']]);



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('jobPortal/detail-application', $data);
        $this->load->view('template/footer');
    }
}
