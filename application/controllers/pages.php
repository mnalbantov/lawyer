<?php

// Main  Home page 

Class Pages extends Public_Controller {

    public function __construct() {
        parent::__construct();
       
    }

    public function index() {
        $data['title'] = 'Начало';
        $this->load->view('templates/header', $data);
        $this->load->model('data_model');
        $data['quote'] = $this->data_model->getQuotes();
        $data['posts'] = $this->data_model->get_all_posts();
        $this->load->view('home', $data);
        $this->load->view('templates/footer');
    }

    function consult() {
        $data['title'] = 'Онлайн консултация';
        $this->load->view('templates/header', $data);
        $this->load->view('consult');
        $this->load->view('templates/footer');
    }

}
