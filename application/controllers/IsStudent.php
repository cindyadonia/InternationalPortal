<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IsStudent extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	public function index(){
		// $data['title'] = 'Student Portal';
		// $data['user'] = $this->db->select('name, student_no')->from('students')->join('users', 'students.user_id = users.id')->where('users.username',$this->session->userdata('username'))->get()->row_array();
		
		// $this->load->view('layouts/header', $data);
		// $this->load->view('layouts/student_sidebar', $data);
		// $this->load->view('layouts/topbar', $data);
		// $this->load->view('student/index', $data);
		// $this->load->view('layouts/footer');


		$data['title'] = 'Student Portal';
		$data['user'] = $this->db->select('name, student_no')->from('students')->where('students.student_no',$this->session->userdata('student_no'))->get()->row_array();
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/student_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('layouts/footer');

	}
}