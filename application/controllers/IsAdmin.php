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
		if($_SESSION['role_id'] == '2'){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url('IsStudent'));
		}
		else if(!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != '2' && $_SESSION['role_id'] !='1') ){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url());
		}
		else{
			$data['title'] = 'Dashboard';
			$this->load->view('layouts/header', $data);
			$this->load->view('layouts/admin_sidebar', $data);
			$this->load->view('layouts/topbar', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('layouts/footer');
		}
	}
}