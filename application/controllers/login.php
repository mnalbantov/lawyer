<?php

class Login extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data_model');
    }

    function index() {
        $data['title'] = 'Вход';
        if ($this->session->userdata('is_logged_in')) {
            redirect('members');
        }
     
        $this->load->view('login');
        if ($this->session->userdata('admin_logged')) {
            redirect('admin');
        }
    }

    function validate() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email адрес', 'required|trim|valid_email|callback__validate_user');
        $this->form_validation->set_rules('password', 'Парола', 'required|trim');

        if ($this->form_validation->run()) {
            redirect('members');
        } else {
            $this->load->view('login');
        }
    }

    function _validate_user() {
        $data = $this->data_model->can_log_in();
        if ($data) {
            foreach($data as $v) {
                $session_arr = array(
                    'id' => $v->user_id,
                    'username' =>$v->username,
                    'email' =>$v->email,
                    'first_name' =>$v->first_name,
                    'last_name' =>$v->last_name,    
                    'company' =>$v->company,
                    'phone' =>$v->phone,
                    'address' =>$v->address,
                    'type' =>$v->type,
                    'created_on' =>$v->created_on,
                    'profile_pic' =>$v->profile_pic,
                    'website' =>$v->website,
                    'is_logged_in' => 1
                );
                $this->session->set_userdata($session_arr);
            }
            return true;
        } else {
            $this->form_validation->set_message('validate_user', 'Greshno ime/parola!');
            return false;
        }
    }

}
