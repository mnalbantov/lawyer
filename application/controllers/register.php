<?php

class Register extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('data_model');
        if ($this->session->userdata('is_logged_in')) {
            redirect('members');
        }
    }

    function index() {
        $data['message'] = "";
        $data['title'] = 'Регистрация';
        $this->load->view('templates/header', $data);
        $this->load->view('register', $data);
        $this->load->view('templates/footer');
        if ($this->session->userdata('admin_logged')) {
            redirect('admin');
        }
    }

    function validate_reg() {
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|max_length[20]|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Потребителско име', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('password', 'Парола', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Повторна парола', 'required|matches[password]|trim');
        $this->form_validation->set_rules('f_name', 'Вашето име', 'required|trim');
        $this->form_validation->set_rules('l_name', 'Фамилия', 'required|trim');
        $this->form_validation->set_rules('address', 'Адрес', '|trim');
        $this->form_validation->set_rules('phone', 'Телефон', '|trim');
        $this->form_validation->set_error_delimiters('<div  id="errMsg">', '</div>');
        $this->form_validation->set_message('is_unique', 'Този email адрес е зает!');
        $activation_code = $this->_gen_pass(32);

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "";
            $data['title'] = 'Регистрация';
            $this->load->view('templates/header', $data);
            $this->load->view('register', $data);
            $this->load->view('templates/footer');
        } else {

            $this->_send_mail($activation_code);
            $this->data_model->add_user($activation_code);
            $data['title'] = 'Успешна регистрация';
            $data['message'] = 'Успешно изпратен email.Проверете вашата интернет поща и активирайте акаунта си!';
            $this->load->view('templates/header', $data);
            $this->load->view('register', $data);
            $this->load->view('templates/footer');
        }
    }

    function _send_mail($activation_code) {

        $username = $this->input->post(
                'username');
        $mail_to = $this->input->post('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'mnalbantov@gmail.com',
            'smtp_pass' => '0898656630.',
            'wordwrap' => true,
            'mailtype' => 'html',
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mnalbantov@gmail.com', 'Admin - Налбантов');
        $this->email->to($mail_to);
        $this->email->subject('Активиране на потребителски акаунт');
        $message = 'Здравейте ' 
                . $username.'<br/>'
                .'Вашата регистрация е почти готова.<br/>'
                . 'За да активирате профила си отворете <br/>' 
                .'<a href="'.site_url('register/activate') . '/' . $username . '/' . $activation_code.'">този линк</a>';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function _gen_pass($len) {
        $key = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKMMNOPKQRSTUVWXYZL';
        $str = '';
        for ($i = 0; $i < $len; $i+= 1) {
            $str .=substr($key, mt_rand(0, strlen($key) - 1), 1);
        }
        return $str;
    }

    function activate() {
        $username = $this->uri->segment(3);
        $activation_code = $this->uri->segment(4);

        if ($username != NULL && $activation_code != NULL) {
            if ($this->data_model->activate_account($username, $activation_code)) {
                $data['title'] = 'Активиран акаунт';
                $data['message'] = 'Вашият акаунт беше успешно активиран!';
                $this->load->view('templates/header', $data);
                $this->load->view('members/activate', $data);
                $this->load->view('templates/footer');
            } else {
                redirect('pages');
            }
        } else {
            redirect('register');
        }
    }

}
