<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		if($_SESSION['role_id'] != '2' && $_SESSION['role_id'] != '1'){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url('Auth'));
		}
		else{
			$this->load->model('MessageModel');
			$this->load->helper(array('form', 'url'));
		}
    }

    public function index()
    {
		$id = $this->session->userdata('id');
		$data['title'] = 'Message';
		$data['recipients'] = $this->MessageModel->getUsers($_SESSION['role_id']);
		
		$this->load->view('layouts/header', $data);
		if($_SESSION['role_id'] == 2){
			$this->load->view('layouts/student_sidebar', $data);
		}
		if($_SESSION['role_id'] == 1){
			$this->load->view('layouts/admin_sidebar', $data);
		}
		$this->load->view('layouts/topbar', $data);
		$this->load->view('message/index', $data);
	}

	public function store()
	{
		try {
			$message = $_POST['message'] ? $_POST['message'] : "";
			$recipient_no = $_POST['recipient'];
			$user_no = $this->session->userdata('user_no');
			$role_id = $this->session->userdata('role_id');
			$filename = "";
			
			if($_FILES) {
				$filename = $this->uploadFile($_FILES);
				if(!$filename){
					$result = [
						'message' => 'Failed to upload your file!'
					];
					return json_encode($result);
				}
			}
			
			$data = [
				'content' => $message,
				'file_path' => $filename,
				'sender_no' => $user_no,
				'receiver_no' => $recipient_no,
				'created_at' => date('Y-m-d H:i:s'),
			];
			
			if($this->MessageModel->sendMessage($data)){
				return json_encode(array("status" => "OK", "message" => "FIle successfully uploaded!"));
			};
		}
		catch (Exception $e) {
			var_dump($e);die;
		}
	}

	public function showChat($recipient_id)
	{
		$user_no = $this->session->userdata('user_no');
		$role_id = $this->session->userdata('role_id');

		$data['recipients'] = $this->MessageModel->getUsers($_SESSION['role_id']);
		$data['chats'] = $this->MessageModel->getMessage($user_no, $recipient_id, $role_id);
		$data['receiver'] = $this->MessageModel->getRecipient($recipient_id, $role_id);
		echo json_encode($data);
	}

	public function newMessage($recipient_id, $lastID)
	{
		$user_no = $this->session->userdata('user_no');
		$role_id = $this->session->userdata('role_id');

		$data['recipients'] = $this->MessageModel->getUsers($_SESSION['role_id']);
		$data['new_chats'] = $this->MessageModel->getNewMessage($user_no, $recipient_id, $role_id, $lastID);
		$data['receiver'] = $this->MessageModel->getRecipient($recipient_id, $role_id);
		echo json_encode($data);
	}

	private function uploadFile($file)
	{
		$namafile = $file['file_path']['name'];
		$ext = explode(".",$namafile);
		$file['upload_path']          = './uploads/file';
		$file['allowed_types']        = 'pdf|doc|docx|xlsx|xls|png|jpg|jpeg';
		$file['file_name']            = date('d_m_Y_h_i_s_').uniqid(true).'.'.$ext[count($ext)-1];
		$file['max_size']             = 2048;
		
		$this->load->library('upload', $file);
		
		if (!$this->upload->do_upload('file_path'))
		{
			$error = array('error' => $this->upload->display_errors());
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $file['file_name'];
		}
	}

	public function download($filename)
	{
		$this->load->helper('download');
		$data = file_get_contents(base_url('/uploads/file/'.$filename));
		force_download($filename, $data);
	}
}