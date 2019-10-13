<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeTable extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		if($_SESSION['role_id'] == '1'){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url('IsStudent'));
		}
		else if(!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != '2' && $_SESSION['role_id'] !='1') ){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url());
		}
		else{
			$this->load->model('TimeTableModel');
		}
    }

    public function index()
    {
		$id = $this->session->userdata('id');
		$data['title'] = 'Time Table';
		$data['totalcredit'] = $this->TimeTableModel->totalCredits($id);
		$data['schedules'] = $this->TimeTableModel->getSchedules($id);
        
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/student_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('student/time_table/index', $data);
		$this->load->view('layouts/footer');
	}
}