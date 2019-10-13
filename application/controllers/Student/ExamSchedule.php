<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamSchedule extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		if($_SESSION['role_id'] == '1'){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url('IsAdmin'));
		}
		else if(!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != '2' && $_SESSION['role_id'] !='1') ){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url());
		}
		else{
			$this->load->model('ExamScheduleModel');
		}
    }

    public function index()
    {
		$id = $this->session->userdata('id');
		$data['title'] = 'Exam Schedule';
		$data['midterms'] = $this->ExamScheduleModel->getExamSchedules($id,$type=1);
		$data['finals'] = $this->ExamScheduleModel->getExamSchedules($id,$type=2);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/student_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('student/exam/index', $data);
		$this->load->view('layouts/footer');
	}
}