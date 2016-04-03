<?php

class my404 extends MY_Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->output->set_status_header('404');
        $data['heading'] = 'Упс...';
        $data['message'] = 'Страницата,която се опитвате да достъпите не е налична!';
        $this->load->view('errors/html/error_404',$data);
    }
}
