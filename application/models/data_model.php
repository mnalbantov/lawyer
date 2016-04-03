<?php

// The model for the blog
class data_model extends CI_Model {

    function getUserActivity() {
        $this->db->join('comment', 'comment.user_id=users.user_id', 'left');
        $this->db->join('entry', 'entry.entry_id=comment.entry_id');
        $this->db->where('users.user_id', $this->session->userdata('id'));
        $this->db->order_by('comment_date', 'desc');
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function getUserPosts() {
        $this->db->join('users', 'comment.user_id = users.user_id');
        $this->db->where('users.user_id', $this->session->userdata('id'));
        $q = $this->db->get('comment');
        if ($q->result()) {
            return $q->result();
        } else {
            return false;
        }
    }

    function send_msg_email() {
        $this->db->select('send_msg_email');
        $this->db->where('user_id', $this->input->post('toUserId'));
        $this->db->where('send_msg_email', '1');
        $q = $this->db->get('users');
        if ($q->result()) {
            return $q->result();
        } else {
            return false;
        }
    }

    function checkNotify() {
        $this->db->select('send_msg_email');
        $this->db->where('user_id', $this->session->userdata('id'));
        $q = $this->db->get('users');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function changeNotify() {
        $this->db->select('send_msg_email');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->limit(1);
        $q = $this->db->get('users');
        if ($q->result() > 0) {
            $this->db->where('user_id', $this->session->userdata('id'));
            $update_date = array(
                'send_msg_email' => $this->input->post('notifyCH')
            );
            $this->db->update('users', $update_date);
            if ($this->db->affected_rows() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getUsers() {

        $query1 = $this->db->get('users');
        foreach ($query1->result() as $v) {
            $data[] = $v;
        }
        return $data;
    }

    function getLastNews() {
        $q = $this->db->get('products');
        foreach ($q->result() as $val) {
            $data[] = $val;
        }
        return $data;
    }

    function getQuotes() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $sql = $this->db->get('quotes');
        foreach ($sql->result() as $v) {
            $data[] = $v;
        }
        return $data;
    }

    function can_log_in() {
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('is_active', 1);
        $query = $this->db->get('users');
        foreach ($query->result() as $row) {
            $data[] = $row;
            $hash = $row->password;
        }
        if ($query->result()) {
            if (password_verify($this->input->post('password'), $hash)) {
                return $data;
            } else {
                return false;
            }
        }
    }

    function get_all_posts() {
        // $this->db->select('*');
        // $this->db->from('entry');
        $this->db->order_by('entry_date', 'desc');
        $this->db->join('categories_blog', 'categories_blog.category_id = entry.category_id');
        $this->db->join('pictures', 'pictures.pic_id = entry.pic_id', 'left');
        $query = $this->db->get('entry');
        return $query->result();
    }

    function send_message() {
        $data = array(
            'from_id' => $this->session->userdata('id'),
            'to_id' => $this->input->post('toUserId'),
            'subject' => $this->input->post('subjectPM'),
            'message' => $this->input->post('messagePM')
        );
        $this->db->insert('messages', $data);
    }

    function order_by_category($category_id) {
        $this->db->join('entry', 'categories_blog.category_id = entry.category_id');
        $this->db->where('categories_blog.category_id', $category_id);
        $q = $this->db->get('categories_blog');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function messages() {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $this->db->where('to_id', $this->session->userdata('id'));
        $this->db->where('messages.opened', '0');
        $q = $this->db->get('messages');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
    

    function viewed_messages() {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $this->db->where('to_id', $this->session->userdata('id'));
        $this->db->where('messages.opened', '1');
        $q = $this->db->get('messages');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function read_message($id) {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $this->db->where('messages.id', $id);
        $this->db->where('messages.to_id', $this->session->userdata('id'));
        $this->db->limit(1);
        $q = $this->db->get('messages');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function chat() {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $this->db->where('messages.to_id', $this->session->userdata('id'));
        $this->db->where('messages.from_id', 2);
        $q = $this->db->get('messages');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function update_message($id) {
        $this->db->where('id', $id);
        $this->db->where('to_id', $this->session->userdata('id'));
        $update_data = array(
            'opened' => '1'
        );
        $this->db->update('messages', $update_data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function add_question() {
        $data = array(
            'title' => $this->input->post('title'),
            'subject' => $this->input->post('subject'),
            'user_id' => $this->session->userdata('id')
        );
        $this->db->insert('consultations', $data);
    }

    function add_user($activation_code) {
        $data = array(
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'first_name' => $this->input->post('f_name'),
            'last_name' => $this->input->post('l_name'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'activation_code' => $activation_code
        );
        $this->db->insert('users', $data);
    }

    function activate_account($username, $activation_code) {
        $this->db->select('username', 'activation_code');
        $this->db->where('username', $username);
        $this->db->where('activation_code', $activation_code);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            $update_data = array(
                'is_active' => 1,
                'activation_code' => ''
            );
            $update_where = array(
                'username' => $username,
                'activation_code' => $activation_code
            );
            $this->db->update('users', $update_data, $update_where);
            if ($this->db->affected_rows() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function add_new_comment($post_id, $user_id, $commentor, $email, $comment) {
        $data = array(
            'entry_id' => $post_id,
            'user_id' => $user_id,
            'comment_name' => $commentor,
            'comment_email' => $email,
            'comment_body' => $comment
        );

        $this->db->insert('comment', $data);
    }

    function get_profile($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');
        if ($query->result() !== 0) {

            return $query->result();
        } else {
            return false;
        }
    }
    function get_profile_comments($id) {
        $this->db->join('comment','comment.user_id = users.user_id');
        $this->db->where('users.user_id',$id);
        $query = $this->db->get('users');
        if($query->num_rows() > 0) {
            return $query->result();
        }else {
            return false;
        }
    }

    function get_post($id) {
        $this->db->join('users', 'users.user_id = entry.user_id');
        $this->db->join('categories_blog', 'categories_blog.category_id = entry.category_id');
        $this->db->join('pictures', 'pictures.pic_id = entry.pic_id', 'left');
        $this->db->where('entry.entry_id', $id);
        $query = $this->db->get('entry');
        if ($query->result() !== 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_post_comment($post_id) {
        $this->db->where('entry_id', $post_id);
        $this->db->order_by('comment_date', 'desc');
        $query = $this->db->get('comment');
        return $query->result();
    }

    function total_comments($id) {
        $this->db->like('entry_id', $id);
        $this->db->from('comment');
        return $this->db->count_all_results();
    }

    function upload_image($file_name) {
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->limit(1);
        $q = $this->db->get('users');
        if ($q->result() > 0) {
            $update_where = array(
                'profile_pic' => $file, name
            );
            $update_data = array(
                'user_id' => $this->session->userdata('id')
            );
            $this->db->update('users', $update_where, $update_data);
        } else {
            return false;
        }
    }

}
