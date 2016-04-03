<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed!');

class Blog extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
    }

    function index($page = 'Блог') {
        $data['title'] = $page;
        $data['posts'] = $this->data_model->get_all_posts();
        $this->load->view('templates/header', $data);
        $this->load->view('blog/blog', $data);
        $this->load->view('templates/footer');
    }

    public function add_comment() {
        $this->load->library('form_validation');
        // set validation rules 
        $post_id = $this->form_validation->set_rules('post_id', 'Post_ID', 'trim');
        $user_id = $this->form_validation->set_rules('user_id', 'User_ID', 'trim');
        $commentor = $this->form_validation->set_rules('commentor', 'Име', 'required|xss_clean');
        $email = $this->form_validation->set_rules('email', 'Email адрес', 'required|valid_email');
        $comment = $this->form_validation->set_rules('comment', 'Коментар', 'required|xss_clean|min_length[10]');
        $this->form_validation->set_error_delimiters('<p class="icon icon-remove alert alert-warning">', '</p>');


        if ($this->form_validation->run() == FALSE) {
            // if is not valid
            $id = $this->input->post('post_id');
            $data['post_id'] = $id;
            $data['err'] = 1;
            $data['error'] = validation_errors();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            //var_dump($this->data_model->add_new_comment($post_id, $user_id, $commentor, $email, $comment));
            $data['err'] = 0;
            $id = $this->input->post('post_id');
            $post_id = $this->input->post('post_id');
            $user_id = $this->input->post('user_id');
            $commentor = $this->input->post('commentor');
            $email = $this->input->post('email');
            $comment = $this->input->post('comment');
            $data['success'] = $this->data_model->add_new_comment($post_id, $user_id, $commentor, $email, $comment);
            $data['comments'] = $this->data_model->get_post_comment($id);
            $data['total_comments'] = $this->data_model->total_comments($id);

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    function post($id) {
        $this->load->library('pagination');

        $config['base_url'] = base_url('blog/post') . '/' . $id.'/page/';
        $config['total_rows'] = count($this->data_model->get_post_comment($id));
        $config['per_page'] = 5;
        $config['uri_segment'] = 6;

        var_dump($config['total_rows']);
        $page = 'Налбантов';
        foreach ($this->data_model->get_post($id) as $row) {
            $data['title'] = $row->entry_name . '-' . $page;
        }
        $data['post'] = $this->data_model->get_post($id);
        $data['comments'] = $this->data_model->get_post_comment($id, $config['per_page'], $this->uri->segment($config['uri_segment']));
        $data['links'] = $this->pagination->create_links();
        $data['post_id'] = $id;
        $data['total_comments'] = $this->data_model->total_comments($id);
        $this->pagination->initialize($config);
        $this->load->view('templates/header', $data);
        $this->load->view('blog/post', $data);
        $this->load->view('templates/footer');
    }

    function category($category_id) {
        foreach ($this->data_model->order_by_category($category_id) as $row) {
            $data['title'] = 'Кагегория' . ' ' . $row->category_name;
        }
        $data['posts_orders'] = $this->data_model->order_by_category($category_id);
        $this->load->view('templates/header', $data);
        $this->load->view('blog/category', $data);
        $this->load->view('templates/footer');
    }

}
