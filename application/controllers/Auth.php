<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}
		else {
			$this->login();
		}
	}

	private function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('admins',[
			'admin_no' => $username
		])->row_array();
		
		if($user != NULL) 
		{
			$this->checkIdentity($user);
		}
		else if ($user == NULL) 
		{
			$user = $this->db->get_where('students',[
				'student_no' => $username
			])->row_array();

			if($user != NULL) 
			{
				$this->checkIdentity($user);
			}
			else 
			{
				$this->load->view('auth/login');
			}
		}
	}

	private function checkIdentity($user)
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($user){
			if($user['deleted_at'] == NULL)
			{
				if($user['is_active']){
					if(password_verify($password, $user['password'])){
						if($user['role_id'] == 1){						
							$query = $this->db->select('name')->from('admins')->where('admins.id', $user['id'])->get()->row_array();
							
							$data = [
								'id' => $user['id'],
								'name' => $query['name'],
								'user_no' => $user['admin_no'],
								'admin_no' => $user['admin_no'],
								'role_id' => $user['role_id']
							];
							$this->session->set_userdata($data);
							redirect('IsAdmin');
						}
						else if($user['role_id'] == 2){
							$query = $this->db->select('name')->from('students')->where('students.id', $user['id'])->get()->row_array();
							
							$data = [
								'id' => $user['id'],
								'name' => $query['name'],
								'user_no' => $user['student_no'],
								'student_no' => $user['student_no'],
								'role_id' => $user['role_id']
							];
							
							$this->session->set_userdata($data);
							redirect('IsStudent');
						}
					}
					else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Incorrect password! </div>');
						redirect('auth');
					}
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Your account no longer active. </div>');
					redirect('auth');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Your account does not exist! </div>');
				redirect('auth');	
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Username / Password is incorrect! </div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('username');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> You have logged out! </div>');
		redirect('auth');
	}
}
