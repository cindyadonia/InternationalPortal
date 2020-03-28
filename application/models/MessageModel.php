<?php

class MessageModel extends CI_Model
{
    public function getMessage($sender_id, $receiver_id, $role)
    {
        if($role == "2") //Student
        {
            return $this->db->select('messages.id, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')->where('messages.receiver_no', $sender_id)->where('messages.sender_no', $receiver_id)->or_Where('messages.receiver_no', $receiver_id)->where('messages.sender_no', $sender_id)->get()->result_array();
        }
        else if($role == "1") //Admin
        {
            return $this->db->select('messages.id, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')->where('messages.receiver_no', $sender_id)->where('messages.sender_no', $receiver_id)->or_Where('messages.receiver_no', $receiver_id)->where('messages.sender_no', $sender_id)->get()->result_array();
        }
    }

    public function getNewMessage($sender_id, $receiver_id, $role, $last_id)
    {
        if($role == "2") //Student
        {
            return $this->db->select('messages.id, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')
            ->where('messages.receiver_no', $sender_id)
            ->where('messages.sender_no', $receiver_id)
            ->where('messages.id >', $last_id)
            ->or_Where('messages.receiver_no', $receiver_id)
            ->where('messages.sender_no', $sender_id)
            ->where('messages.id >', $last_id)
            ->get()->result_array();
        }
        else if($role == "1") //Admin
        {
            
            return $this->db->select('messages.id, sender_no, receiver_no, messages.content, messages.file_path, messages.created_at')->from('messages')
            ->where('messages.receiver_no', $sender_id)
            ->where('messages.sender_no', $receiver_id)
            ->where('messages.id >', $last_id)
            ->or_Where('messages.receiver_no', $receiver_id)
            ->where('messages.sender_no', $sender_id)
            ->where('messages.id >', $last_id)
            ->get()->result_array();
        }
        
    }

    public function getRecipient($receiver_id, $role)
    {
        if($role == "2") //Student
        {
            return $this->db->select('name, admin_no as receiver_no')->from('admins')->where('admin_no', $receiver_id)->get()->row_array();
        }
        else if($role == "1") //Admin
        {
            return $this->db->select('name, student_no as receiver_no')->from('students')->where('student_no', $receiver_id)->get()->row_array();
        }
    }

    public function sendMessage($message, $recipient_no, $user_no)
    {
        $data = [
            'content' => $message,
            // 'file_path' => $this->input->post('file_path'),
            'sender_no' => $user_no,
            'receiver_no' => $recipient_no,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $this->db->insert('messages', $data);
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