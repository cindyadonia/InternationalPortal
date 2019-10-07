<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IsAdmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		// $data['title'] = 'Dashboard';
		// $data['user'] = $this->db->select('name, admin_no')->from('admins')->join('users', 'admins.user_id = users.id')->where('users.username',$this->session->userdata('username'))->get()->row_array();
		// $this->load->view('layouts/header', $data);
		// $this->load->view('layouts/admin_sidebar', $data);
		// $this->load->view('layouts/topbar', $data);
		// $this->load->view('admin/index', $data);
		// $this->load->view('layouts/footer');

		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('id, name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('layouts/footer');
	}
}