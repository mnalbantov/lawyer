<?php

class admin_model extends CI_Model {

    public function admin_log_in() {
        $this->db->where('username', $this->input->post('admin_name'));
        $this->db->where('type', 'admin');
        $query = $this->db->get('users');
        foreach ($query->result() as $row) {
            $data[] = $row;
            $hash = $row->password;
        }
        if ($query->result()) {
            if (password_verify($this->input->post('admin_pass'), $hash)) {
                return $data;
            } else {
                return false;
            }
        }
    }

    function get_num_rows() {
        $q = $this->db->get('users');
        return $q->num_rows;
    }

    function mark_as_read() {
        $this->db->where_in('id', $this->input->post('messages'));
        $this->db->where_in('to_id', $this->session->userdata('id'));
        $q = $this->db->get('messages');
        if ($q->result() > 0) {
            $this->db->where_in('id', $this->input->post('messages'));
            $this->db->where('to_id', $this->session->userdata('id'));
            $update_data = array(
                'opened' => '1'
            );
            $this->db->update('messages', $update_data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_categories() {
        $this->db->order_by('category_name', 'desc');
        $q = $this->db->get('categories_blog');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function getAllUsers($sort_by, $sort_order, $per_page, $offset) {
        $this->db->order_by($sort_by, $sort_order);
        $q = $this->db->get('users', $per_page, $offset);
        return $q->result();
    }

    function get_user($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');
        if ($query->result() !== 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_sentbox($user_id) {
        $this->db->join('users', 'messages.to_id=users.user_id');
        $this->db->where('from_id', $user_id);
        $q = $this->db->get('messages');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function all_messages() {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $this->db->where('messages.to_id', $this->session->userdata('id'));
        $this->db->where('messages.recipientDelete', '0');
        $this->db->order_by('date_sended', 'desc');
        $q = $this->db->get('messages');
        if ($q->num_rows() > 0) {
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

    function search($search) {
        $this->db->join('users', 'users.user_id = messages.to_id');
        $this->db->where('users.user_id', $this->session->userdata('id'));
        $this->db->like('first_name OR users.email OR messages.subject OR messages.message', $search, 'both');
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

    function messages() {
        $this->db->join('users', 'messages.from_id=users.user_id');
        $where_clause = array(
            'to_id' => $this->session->userdata('id'),
            'messages.recipientDelete' => '0',
            'messages.opened' => '0'
        );
        $q = $this->db->get_where('messages', $where_clause);
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function delete_messages($messages) {
        $this->db->where_in('id', $messages);
        $this->db->where('to_id', $this->session->userdata('id'));
        $q = $this->db->get_where('messages');
        if ($q->result() > 0) {
            $update_data = array(
                'recipientDelete' => '1'
            );
            $this->db->where_in('id', $messages);
            $this->db->where('to_id', $this->session->userdata('id'));
            $this->db->update('messages', $update_data);
        } else {
            return false;
        }
    }

    function recycle_bin() {
        $this->db->join('users', 'users.user_id = messages.from_id');
        $this->db->where('to_id', $this->session->userdata('id'));
        $this->db->where('recipientDelete', '1');
        $q = $this->db->get('messages');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function get_last_activity($id) {
        $this->db->join('users', 'comment.user_id = users.user_id');
        $this->db->join('entry', 'comment.entry_id = entry.entry_id');
        $this->db->where('users.user_id', $id);
        $query = $this->db->get('comment');
        if ($query->result() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_last_users() {
        $this->db->where('is_seen_by_admin', '0');
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function update_as_seen($users) {
        $this->db->where_in('user_id', $users);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            $update = array(
                'is_seen_by_admin' => '1'
            );
            $this->db->where_in('user_id', $users);
            $this->db->update('users', $update);
        } else {
            return false;
        }
    }

    function get_comment($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $q = $this->db->get('comment');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function update_comment($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $q = $this->db->get('comment');
        if ($q->num_rows() > 0) {
            $update_data = array(
                'is_seen' => '1'
            );
            $this->db->where('comment_id', $comment_id);
            $this->db->update('comment', $update_data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function delete_entry($id) {
        $this->db->join('comment', 'comment.entry_id = entry.entry_id');
        $this->db->where('entry_id', $id);
        $tables = array('entry', 'comment');
        $this->db->delete($tables);
    }

    function add_new_user() {
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('f_name'),
            'last_name' => $this->input->post('l_name'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'phone' => $this->input->post('phone'),
            'type' => $this->input->post('type'),
            'is_active' => $this->input->post('is_active'),
        );

        $this->db->insert('users', $data);
    }

    function update_user($id) {
        $this->db->where('user_id', $id);
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('f_name'),
            'last_name' => $this->input->post('l_name'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'phone' => $this->input->post('phone'),
            'type' => $this->input->post('type'),
            'is_active' => $this->input->post('is_active'),
        );
        $this->db->update('users', $data);
    }

    function delete_user($id) {
        $this->db->where('user_id', $id);
        $this->db->join('comment', 'comment.user_id = users.user_id');
        $tables = array('users', 'comment');
        $this->db->delete($tables);
    }

    function add_new_entry($name, $body, $id, $category, $picture) {
        $data = array(
            'entry_name' => $name,
            'entry_body' => $body,
            'user_id' => $id,
            'category_id' => $category,
            'pic_id' => $picture
        );
        $this->db->insert('entry', $data);
    }

    function add_new() {
        $data = array(
            'pic_id' => $this->input->post('pic_id'),
            'category_id' => 2,
            'entry_name' => 'Тема някаква',
            'entry_body' => 'Тема на темата',
        );
        $this->db->insert('entry', $data);
    }

    function add_new_category() {
        $data = array(
            'category_name' => $this->input->post('category_name')
        );
        $this->db->insert('categories_blog', $data);
    }

    function get_last_comments() {
        $this->db->where('is_seen', '0');
        $this->db->order_by('comment_date', 'desc');
        $query = $this->db->get('comment');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_new_comments() {
        $this->db->where('is_seen', '0');
        $this->db->order_by('comment_date', 'desc');
        $query = $this->db->get('comment');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function upload_image($file_name, $full_path) {
        $this->db->where('pic_name', $file_name);
        $this->db->where('user_id', $this->session->userdata('id'));
        $q = $this->db->get('pictures');
        if ($q->num_rows() > 0) {
            return false;
        } else {
            $data = array(
                'pic_name' => $file_name,
                'user_id' => $this->session->userdata('id'),
                'image' => $full_path
            );
            $this->db->insert('pictures', $data);
        }
    }

    function get_images() {

        $files = scandir('./uploads');
        $files = array_diff($files, array('.', '..', 'thumbs'));

        $images = array();

        foreach ($files as $file) {
            $images[] = array(
                'url' => base_url() . 'uploads' . '/' . $file,
                'thumb_url' => base_url() . 'uploads/thumbs' . '/' . $file,
            );
        }
        return $images;
    }

    function edit_post() {
        $this->db->where('entry_id', $this->input->post('post_id'));
        $this->db->limit(1);
        $query = $this->db->get('entry');
        if ($query->num_rows() > 0) {

            $this->db->where('entry_id', $this->input->post('post_id'));

            $update_where = array(
                'entry_body' => $this->input->post('post')
            );
            $this->db->update('entry', $update_where);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function delete_comment($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('comment');
    }

    function get_image() {
        $this->db->where('user_id', $this->session->userdata('id'));
        $q = $this->db->get('pictures');
        if ($q->result() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

}
