<?php

// The blog system 

class About extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
    }
    
    function index($page = 'About') {
        $this->load->model('data_model');
        $data['info'] =  $this->data_model->getUserActivity();
        $data['title'] = $page;
        $data['rows'] = $this->data_model->getUsers();
        $data['quote'] = $this->data_model->getQuotes();
        $this->load->view('templates/header',$data);
        $this->load->view('about',$data);
         $this->load->view('templates/footer');
    }
}

