<?php

class MessageModel extends CI_Model
{
    public function getMessage($sender_id, $receiver_id, $role)
    {
        if($role == "2") //Student
        {
            return $this->db->select('sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')->where('messages.receiver_no', $sender_id)->where('messages.sender_no', $receiver_id)->or_Where('messages.receiver_no', $receiver_id)->where('messages.sender_no', $sender_id)->get()->result_array();

            // SELECT * FROM (
            //     SELECT admins.name, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at FROM messages
            //     INNER JOIN admins on admins.admin_no = messages.receiver_no
            //     where messages.sender_no = 1731032 AND messages.receiver_no = 1731119
            //     UNION ALL
            //     SELECT students.name, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at FROM messages
            //     INNER JOIN students on students.student_no = messages.receiver_no
            //     where messages.sender_no = 1731119 AND messages.receiver_no = 1731032
            // ) tb
            // ORDER BY created_at ASC;
        }
        else if($role == "1") //Admin
        {
            return $this->db->select('sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')->where('messages.receiver_no', $sender_id)->where('messages.sender_no', $receiver_id)->or_Where('messages.receiver_no', $receiver_id)->where('messages.sender_no', $sender_id)->get()->result_array();
        }
    }

    public function getRecipient($receiver_id, $role)
    {
        if($role == "2") //Student
        {
            return $this->db->select('name')->from('admins')->where('admin_no', $receiver_id)->get()->row_array();
        }
        else if($role == "1") //Admin
        {
            return $this->db->select('name')->from('students')->where('student_no', $receiver_id)->get()->row_array();
        }
    }

    public function sendMessage()
    {
        $message = [
            'content' => $this->input->post('content'),
            // 'file_path' => $this->input->post('file_path'),
            'sender_no' => $this->input->post('sender_no'),
            'receiver_no' => $this->input->post('receiver_no'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $this->db->insert('messages', $message);
    }

    public function getUsers($role)
    {
        if($role == "2")
        {
            return $this->db->select('admins.name, admins.id, admins.admin_no as user_no')->from('admins')->where('deleted_at', NULL)->get()->result_array();
        }
        else if($role == "1")
        {
            return $this->db->select('students.name, students.id, students.student_no as user_no')->from('students')->where('deleted_at', NULL)->get()->result_array();
        }
    }
}
?>