<?php

class Admin extends Back_end_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        if ($this->session->userdata('is_logged_in')) {
            redirect('404');
        }
    }

    function index() {
        $this->admin_can_log_in();
        $data['title'] = 'Главно табло';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['counts'] = $this->admin_model->count_new_comments();
        $data['last_users'] = count($this->admin_model->get_last_users());
        $this->load->view('admin/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/footer');
    }

    function login() {
        if ($this->session->userdata('admin_logged')) {
            redirect('admin');
        }
        $this->load->view('admin/login');
    }

    public function validate() {
        if ($this->session->userdata('admin_logged')) {
            redirect('admin');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|callback__validate_admin');
        $this->form_validation->set_rules('admin_pass', 'Admin password', 'trim');

        if ($this->form_validation->run()) {
            redirect('admin/index');
        } else {
            $this->load->view('admin/login');
        }
    }

    function messages() {

        $this->admin_can_log_in();
        $data['title'] = 'Съобщения';
        $data['all_messages'] = $this->admin_model->all_messages();
        $data['messages'] = $this->admin_model->messages();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/messages', $data);
        $this->load->view('admin/footer');
    }

    function test() {
        //   $this->output->set_header('application/json');
        $data['all_messages'] = $this->admin_model->all_messages();
        $this->load->view('admin/messages', $data);

        //echo json_encode($arr);
    }

    function reply_message() {
        $this->load->model('data_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subjectPM', 'Заглавие', 'required|trim|xss_clean');
        $this->form_validation->set_rules('messagePM', 'Съобщение', 'required|trim|xss_clean');
        $this->form_validation->set_rules('toUserId', 'Потребител', 'required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Съобщения';
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/read_message', $data);
            $this->load->view('admin/footer');
        } else {

            if ($this->data_model->send_msg_email()) {
                $this->_send_email();
            }
            $this->data_model->send_message();
            $this->load->view('send_success');
        }
    }

    function mark_as_read() {
        //$this->output->set_header('application/json');
        $result = $this->admin_model->mark_as_read();
        if ($result) {
            $data['all_messages'] = $this->admin_model->all_messages();
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $data['link'] = site_url('admin/read_message');
            echo json_encode($data);
        } else {
            echo 'no ok';
        }
    }

    function mark_as_seen() {
        $users = $this->input->post('checked');
        $update = $this->admin_model->update_as_seen($users);
        if($update){
            $data['msg'] = 'Маркирахте тези потребители като прочетени';
        }else{
            $data['msg'] = 'Нещо се обърка.fОпитайте пак!';
        }
    }

    function delete_messages() {
        $messages = $this->input->post('messages');
        $data['delete_messages'] = $this->admin_model->delete_messages($messages);
        $data['all_messages'] = $this->admin_model->all_messages();
        echo json_encode($data);
    }

    function recycle_bin() {
        $data['deleted_msg'] = $this->admin_model->recycle_bin();
        $data['link'] = site_url('admin/read_message');
        echo json_encode($data);
    }

    function delete_from_recycle_bin() {
        $checked_messages = $this->input->post('checked_messages');
        var_dump($checked_messages);
        die();
        $this->admin_model->delete_from_recycle_bin($checked_messages);
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
                . 'Ако не желаете да получавате съобщения,можете да промените настройките от вашият профил.<br/>'
                . 'Поздрави от екипа на Налбантов!';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function read_message($id) {
        $this->admin_can_log_in();

        $id = (int) $this->uri->segment(3);
        if (!$id) {
            redirect('admin/messages');
        }
        if ($this->admin_model->read_message($id)) {
            $this->admin_model->update_message($id);
            foreach ($this->admin_model->read_message($id) as $row) {
                $data['title'] = $row->subject . ' ' . 'Съобщения';
            }
            $data['messages'] = $this->admin_model->messages();
            $data['message'] = $this->admin_model->read_message($id);
            $this->load->view('admin/header', $data);
            $this->load->view('admin/read_message', $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('admin/messages');
        }
    }

    function _validate_admin() {
        $data = $this->admin_model->admin_log_in();
        if ($data) {
            foreach ($data as $v) {
                $sess_array = array(
                    'id' => $v->user_id,
                    'name' => $v->username,
                    'email' => $v->email,
                    'first_name' => $v->first_name,
                    'last_name' => $v->last_name,
                    'company' => $v->company,
                    'phone' => $v->phone,
                    'type' => $v->type,
                    'admin_logged' => 1
                );

                $this->session->set_userdata($sess_array);
            }
            return true;
        } else {
            $this->form_validation->set_message('validate_admin', 'Грешно име/парола!');
            return false;
        }
    }

    public function logOut() {

        $this->admin_can_log_in();
        $this->session->sess_destroy();
        redirect('pages');
    }

    public function charts() {
        $this->admin_can_log_in();
        $data['title'] = 'Диаграми';
        $data['messages'] = $this->admin_model->messages();
        $data['counts'] = $this->db->count_all_results('comment');
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/charts');
        $this->load->view('admin/footer');
    }

    function posts() {
        $this->admin_can_log_in();
        $data['title'] = 'Публикации';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['categories'] = $this->admin_model->get_categories();
        $data['images'] = $this->admin_model->get_image();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/posts', $data);
        $this->load->view('admin/footer');
    }

    function activity() {
        $this->admin_can_log_in();
        $data['title'] = 'Последна активност';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['last_comments'] = $this->admin_model->get_last_comments();
        $data['last_users'] = $this->admin_model->get_last_users();
        $data['num_rows'] = $this->admin_model->get_last_users();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/activity');
        $this->load->view('admin/footer');
    }

    function update_comments() {
        $comment_id = $this->input->post('comment_id');
        $data['link'] = site_url('admin/profile');
        $data['blog_link'] = site_url('blog/post');
        $data['comment'] = $this->admin_model->get_comment($comment_id);
        $data['update_comment'] = $this->admin_model->update_comment($comment_id);
        echo json_encode($data);
    }

    function users($sort_by = 'username', $sort_order = 'asc') {
        $this->load->library('pagination');
        $this->admin_can_log_in();
        $data['title'] = 'Потребители';
        $total_rows = $this->admin_model->get_num_rows();

        $config['base_url'] = base_url() . 'admin/users/' . $sort_by . '/' . $sort_order . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 5;
        $config['uri_segment'] = 6;

        $this->pagination->initialize($config);
        $data['users'] = $this->admin_model->getAllUsers($sort_by, $sort_order, $config['per_page'], $this->uri->segment($config['uri_segment']));
        $data['links'] = $this->pagination->create_links();
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        $data['total_rows'] = $total_rows;
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users');
        $this->load->view('admin/footer');
    }

    function create_user() {
        $this->admin_can_log_in();
        $data['title'] = 'Добавяне на потребител';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/create');
        $this->load->view('admin/footer');
    }

    function profile_edit($id) {
        $this->admin_can_log_in();
        $data['title'] = 'Редактиране на потребител';
        $data['profile'] = $this->admin_model->get_user($id);
        $data['profile_id'] = $id;
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/profile_edit');
        $this->load->view('admin/footer');
    }

    function delete_user($id) {
        $this->admin_can_log_in();
        $data['title'] = 'Изтриване на потребител';
        $data['profile'] = $this->admin_model->get_user($id);
        $data['profile_id'] = $id;
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/delete_user');
        $this->load->view('admin/footer');
    }

    function confirm_delete($id) {
        $this->admin_model->delete_user($id);
        redirect('admin/users');
    }

    function profile_validate($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Потребителско име', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('email', 'Email адрес', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('f_name', 'Име', 'required|trim|xss_clean');
        $this->form_validation->set_rules('l_name', 'Фамилия', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Парола', 'required|trim|xss_clean|min_length[4]');
        $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean');

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Редактиране на потребител';
            $data['profile'] = $this->admin_model->get_user($id);
            $data['profile_id'] = $id;
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/profile_edit', $data);
            $this->load->view('admin/footer');
        } else {
            $this->admin_model->update_user($id);
            $this->session->set_flashdata('message', 'Успешно променихте информацията за този потребител!');
            redirect('admin/profile_edit/' . $id);
        }
    }

    function validate_user() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Потребителско име', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('email', 'Email адрес', 'required|trim|xss_clean|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('f_name', 'Име', 'required|trim|xss_clean');
        $this->form_validation->set_rules('l_name', 'Фамилия', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Парола', 'required|trim|xss_clean|min_length[4]');
        $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean');
        $this->form_validation->set_message('is_unique', 'Този email адрес е зает!');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Добавяне на потребител';
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/create');
            $this->load->view('admin/footer');
        } else {
            $this->admin_model->add_new_user();
            $this->session->set_flashdata('message', 'Успешно добавен потребител!');
            redirect('admin/create_user');
        }
    }

    function profile($id) {
        $this->admin_can_log_in();

        foreach ($this->admin_model->get_user($id) as $row) {
            $data['title'] = $row->first_name;
        }
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['profile'] = $this->admin_model->get_user($id);
        $data['last_activity'] = $this->admin_model->get_last_activity($id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/profile');
        $this->load->view('admin/footer');
    }

    function edit_entry() {
        $this->load->model('data_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('post', 'Статия', 'trim|xss_clean');
        $id = $this->input->post('post_id');
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $data['err'] = 0;
            $data['post'] = $this->admin_model->edit_post();
            $data['show_post'] = $this->data_model->get_post($id);

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    function delete_entry() {
        $id = $this->input->post('post_id');
        $request = $this->admin_model->delete_entry($id);
        if (!$request) {
            $msg = 'Тази публкация е изтрита успешно';
        } else {
            $msg = 'Нещо се обърка. Опитай пак!';
        }
        echo json_encode($msg);
    }

    function delete_comment() {
        $this->load->model('data_model');
        $id = $this->input->post('post_id');
        $comment_id = $this->input->post('comment_id');
        $this->admin_model->delete_comment($comment_id);
        $data['comments'] = $this->data_model->get_post_comment($id);
        $data['total_comments'] = $this->data_model->total_comments($id);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    function add_new_entry() {
        $this->admin_can_log_in();
        $data['title'] = 'Добавяне на публикация';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['images'] = $this->admin_model->get_image();
        $this->load->view('admin/header', $data);
        $this->load->library('form_validation');
        // set rules 
        //$this->form_validation->set_error_delimiters('<p class="error">','</p>');
        $this->form_validation->set_rules('entry_name', 'Заглавие', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('entry_body', 'Публикация', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            // if is not valid 
            $data['categories'] = $this->admin_model->get_categories();
            $this->load->view('admin/header');
            $this->load->view('admin/posts', $data);
            $this->load->view('admin/footer');
        } else {
            //if is valid 
            $name = $this->input->post('entry_name');
            $body = $this->input->post('entry_body');
            $id = $this->session->userdata('id');
            $category = $this->input->post('category');
            if ($this->input->post('pic_id') > 0) {
                $picture = $this->input->post('pic_id');
            } else {
                $picture = 0;
            }
            $this->admin_model->add_new_entry($name, $body, $id, $category, $picture);
            $this->session->set_flashdata('message', '<p class="alert alert-success">Успешно публикувахте статия!</p>');
            redirect('admin/add_new_entry');
        }
    }

    function add_new_category() {
        $this->admin_can_log_in();
        $data['title'] = 'Добавяне на категория';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['images'] = $this->admin_model->get_image();
        $this->load->view('admin/header', $data);
        $this->load->library('form_validation');
        //set rules 
        $this->form_validation->set_rules('category_name', 'Категория', 'required|trim|min_length[4]|max_length[200]|is_unique[categories_blog.category_name]');
        $this->form_validation->set_message('is_unique', 'Не може да има категория със същото име!');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $data['categories'] = $this->admin_model->get_categories();
            $this->load->view('admin/posts', $data);
            $this->load->view('admin/footer');
        } else {
            $this->admin_model->add_new_category();
            $this->session->set_flashdata('message', '<p class="alert alert-success">Успешно добавихте категория!</p>');
            redirect('admin/add_new_category');
        }
    }

    public function upload() {
        $this->admin_can_log_in();
        $data['title'] = 'Качване на файл';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/upload', array('error' => ''));
        $this->load->view('admin/footer');
    }

    public function do_upload() {
        $this->admin_can_log_in();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $data['title'] = 'Качване на файл';
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/upload', $error);
            $this->load->view('admin/footer');
        } else {
            $file_data = $this->upload->data();
            $file_name = $file_data['file_name'];
            $full_path = $file_data['full_path'];
            $this->admin_model->upload_image($file_name, $full_path);
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
            $data['messages'] = $this->admin_model->messages();
            $data['questions'] = $this->db->count_all_results('consultations');
            $data['img'] = base_url() . 'uploads/thumbs/' . $file_data['file_name'];

            $this->load->view('admin/header', $data);
            $this->load->view('admin/upload_success', $data);
            $this->load->view('admin/footer');
        }
    }

    function gallery() {
        $this->admin_can_log_in();
        $data['title'] = 'Галерия';
        $data['messages'] = $this->admin_model->messages();
        $data['questions'] = $this->db->count_all_results('consultations');
        $data['images'] = $this->admin_model->get_image();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/gallery', $data);
        $this->load->view('admin/footer');
    }

    function delete_all_images() {
        $this->load->helper('file');
        header('Content-Type: image/');
        $path = base_url('uploads');
        $file = base_url('uploads/IMG_5502.jpg');
        echo $file;
        //     $delete = read_file($path);
        // $files = scandir($dir);
    }

    function sentbox() {
        $user_id = $this->session->userdata('id');
        $data['link'] = site_url('admin/read_message');
        $data['sentbox'] = $this->admin_model->get_sentbox($user_id);
        echo json_encode($data);
    }

    function search_message() {
        $search = $this->input->post('search');
        $data['link'] = site_url('admin/read_message');
        $data['search'] = $this->admin_model->search($search);
        echo json_encode($data);
    }

}
