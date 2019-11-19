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

	public function showChat($recipient_id)
	{
		$user_no = $this->session->userdata('user_no');
		$role_id = $this->session->userdata('role_id');

		$data['title'] = 'Message';
		$data['recipients'] = $this->MessageModel->getUsers($_SESSION['role_id']);
		$data['chats'] = $this->MessageModel->getMessage($user_no, $recipient_id, $role_id);
		$data['receiver'] = $this->MessageModel->getRecipient($recipient_id, $role_id);


		$this->load->view('layouts/header', $data);
		if($_SESSION['role_id'] == 2){
			$this->load->view('layouts/student_sidebar', $data);
		}
		if($_SESSION['role_id'] == 1){
			$this->load->view('layouts/admin_sidebar', $data);
		}
		$this->load->view('layouts/topbar', $data);
		$this->load->view('message/view', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('admin_id', ' Admin Id', 'required|trim');
		$this->form_validation->set_rules('student_id', 'Student Id', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
		

		if($this->form_validation->run() == FALSE){
			$this->create();
        }
		else {
			$this->CourseModel->addCourse($faculty_id);
			redirect('admin/faculty/show/'.$faculty_id);
        }
	}
}