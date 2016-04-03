<?php

class Members extends Public_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        if ($this->session->userdata('admin_logged')) {
            redirect('admin');
        }
    }

    function index() {
        $this->members_can_log_in();
        $this->load->library('pagination');

        $config['base_url'] = base_url('members');
        $config['total_rows'] = 200;
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        echo $this->pagination->create_links();


        $data['title'] = $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');
        $data['messages'] = $this->data_model->messages();
        $data['activity'] = $this->data_model->getUserActivity();
        $data['posts'] = $this->data_model->getUserPosts();
        $this->load->view('templates/header', $data);
        $this->load->view('members', $data);
        $this->load->view('templates/footer');
    }

    function logOut() {
        $this->members_can_log_in();
        $this->session->sess_destroy();
        redirect('pages');
    }

    function profile($id) {
        $this->members_can_log_in();
        foreach ($this->data_model->get_profile($id) as $row) {
            $data['title'] = $row->first_name . ' ' . $row->last_name;
        }
        if ($id == $this->session->userdata('id')) {
            redirect('members');
        }
        $data['comments'] = $this->data_model->get_profile_comments($id);
        $data['details'] = $this->data_model->get_profile($id);
        $this->data_model->get_profile($id);
        $this->load->view('templates/header', $data);
        $this->load->view('members/profile', $data);
        $this->load->view('templates/footer');
    }

    function consult() {
        $this->members_can_log_in();
        $data['title'] = 'Онлайн Консултация';
        $this->load->view('templates/header', $data);
        $this->load->view('members/consult');
        $this->load->view('templates/footer');
    }

    function add_question() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Заглавие', 'required|trim|xss_clean');
        $this->form_validation->set_rules('subject', 'Тема', 'required|trim|xss_clean|min_length[50]');
        if ($this->form_validation->run()) {
            $this->data_model->add_question();
            $this->session->set_flashdata('message', '<p class="alert alert-success">Вашето запитване е изпратено успешно!</p>');
            redirect('members/add_question');
        } else {
            $data['title'] = 'Запитване';
            $this->load->view('templates/header', $data);
            $this->load->view('members/consult');
            $this->load->view('templates/footer');
        }
    }

    function messages() {
        $this->members_can_log_in();
        $data['title'] = 'Съобщения';
        $data['messages'] = $this->data_model->messages();
        $this->load->view('templates/header', $data);
        $this->load->view('members/messages', $data);
        $this->load->view('templates/footer');
    }

    function read_message($id) {
        $id = (int) $this->uri->segment(3);
        if (!$id) {
            redirect('members/messages');
        }
        if ($this->data_model->read_message($id)) {
            $data['title'] = 'Съобщения';
            $this->data_model->update_message($id);
            $data['message'] = $this->data_model->read_message($id);
            $this->load->view('templates/header', $data);
            $this->load->view('members/read_message', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('members/messages');
        }
    }

    function viewed_messages() {
        $data['viewed_messages'] = $this->data_model->viewed_messages();
        $this->load->view('members/view_messages', $data);
    }

    function settings() {
        $this->members_can_log_in();
        $data['title'] = 'Настройки';
        $this->load->view('templates/header', $data);
        $this->load->view('members/settings');
        $this->load->view('templates/footer');
    }

    function notifications() {
        $data['message'] = '';
        $data['notify'] = $this->data_model->checkNotify();
        $this->load->view('notify', $data);
    }

    function changeNotifications() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('notifyCH', 'Настройка', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
            $this->load->view('notify', $data);
        } else {
            $this->data_model->changeNotify();
            $data['notify'] = '';
            $data['message'] = 'Успешно променени данни!';
            $this->load->view('notify', $data);
        }
    }

    function send_message() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subjectPM', 'Заглавие', 'required|trim|xss_clean');
        $this->form_validation->set_rules('messagePM', 'Съобщение', 'required|trim|xss_clean');
        $this->form_validation->set_rules('toUserId', 'Потребител', 'required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Съобщения';
            $this->load->view('templates/header', $data);
            $this->load->view('members', $data);
            $this->load->view('templates/footer');
        } else {


            $this->data_model->send_message();
            if ($this->data_model->send_msg_email()) {
                $this->_send_email();
            }
            $this->load->view('send_success');
        }
    }

    function reply_message() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subjectPM', 'Заглавие', 'required|trim|xss_clean');
        $this->form_validation->set_rules('messagePM', 'Съобщение', 'required|trim|xss_clean');
        $this->form_validation->set_rules('toUserId', 'Потребител', 'required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Съобщения';
            $this->load->view('templates/header', $data);
            $this->load->view('members/read_message', $data);
            $this->load->view('templates/footer');
        } else {

            if ($this->data_model->send_msg_email()) {
                $this->_send_email();
            }
            $this->data_model->send_message();
            $this->load->view('send_success');
        }
    }

    function chat() {
        $data['chats'] = $this->data_model->chat();
        $this->load->view('members/chat', $data);
    }

    function _send_email() {
        $to_user_email = $this->input->post('recEmail');
        $to_user = $this->input->post('recName');
        $from_user = $this->input->post('senderName');
        $site = site_url('members');
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
        $this->email->from('mnalbantov@gmail.com', 'Налбантов');
        $this->email->to($to_user_email);
        $this->email->subject('Получено ново съобщение');
        $message = 'Здравейте ' . $to_user . '.<br/>'
                . 'Получихте ново съобщение от ' . $from_user . '<br/>'
                . 'За да видите това, влезте в <a href="' . $site . '">профила си!</a><br/>' .
                'Това е автоматично съобщение.Не сте длъжни да отговаряте.<br/>'
                . 'Поздрави от екипа на Налбантов!';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function do_upload() {
        $this->members_can_log_in();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $data['error'] = $this->upload->display_errors();
            $data['title'] = 'Качване на файл';
            $data['img'] = '';
            $this->load->view('members/upload', $data);
        } else {
            $data['error'] = '';
            $file_data = $this->upload->data();
            $file_name = $file_data['file_name'];
            $this->data_model->upload_image($file_name);
            $config = array(
                'source_image' => $file_data['full_path'],
                'new_image' => './uploads/thumbs',
                'maintain_ratio' => TRUE,
                'width' => 300,
                'height' => 200
            );

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $data['title'] = 'Успешно качен файл';
            $data['img'] = base_url() . 'uploads/thumbs/' . $file_data['file_name'];
            $this->load->view('members/upload', $data);
        }
    }

}
