<?php

class AuthModel extends CI_Model
{
    public function updatePassword()
    {
        $user_id = $this->input->post('id');
        $type = $this->input->post('type');
        $password = $this->input->post('password');
        // echo $password;die;

        if($type == 1){
            $table = 'admins';
        }
        else if($type == 2){
            $table = 'students';
        }
        else{
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Oops! Something went wrong </div>');
            redirect('auth');
        }

        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );

        $where = array(
            'id' => $user_id
        );

        $this->db->update($table, $data, $where);
        if($this->db->trans_status() === TRUE)
        {
			$this->session->unset_userdata('id');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully change password! Please login again. </div>');
            redirect('auth');
        }
    }
}
?>