<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamSchedule extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		if($_SESSION['role_id'] == '2'){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url('IsStudent'));
		}
		else if(!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != '2' && $_SESSION['role_id'] !='1') ){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Sorry, you are not allowed to access the page you are requested! </div>');
			redirect(base_url());
		}
		else{
			$this->load->library('form_validation');
			$this->load->model('TimeTableModel');
			$this->load->model('ExamScheduleModel');
		}
    }
    
    public function index()
    {	
	}
	
	private function loadLayout($type, $data)
	{
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/exam/'.$type, $data);
		$this->load->view('layouts/footer');
	}

    public function create($student_id)
    {
		$data['title'] = 'Add New Exam Schedule';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
        $data['student_id'] = $student_id;
		$data['subjects'] = $this->TimeTableModel->selectSchedule($student_id);
		
		$this->loadLayout('add', $data);
    }

    public function store($student_id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		$this->form_validation->set_rules('table_no', 'Table No', 'required|trim');
        $this->form_validation->set_rules('exam_type', 'Exam Type', 'required|trim');
		
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add student exam schedule! </div>');
			redirect('Admin/Student/show/'.$student_id);
        }
        
		else {
			$midterm = [
				'table_no' => $this->input->post('table_no'),
				'date' => date($this->input->post('date')),
				'location' => $this->input->post('location'),
				'start_time' => $this->input->post('start_time'),
				'end_time' => $this->input->post('end_time'),
				'exam_type' => $this->input->post('exam_type'),
				'created_at' => date('Y-m-d H:i:s'),
				'student_schedule_id' => $this->input->post('subject'),
			];
			if($this->ExamScheduleModel->addExamSchedule($midterm)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add student exam schedule! </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add student exam schedule! </div>');
			}
			redirect('Admin/Student/show/'.$student_id);
        }
	}

    public function show($student_id, $id)
    {
        $data['title'] = 'Edit Exam Schedule';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
        $data['student'] = $this->db->select('*')->from('students')->where('id',$id)->get()->row_array();
        $data['exam'] = $this->ExamScheduleModel->getExamSchedule($id);
        $data['subjects'] = $this->TimeTableModel->selectSchedule($student_id);

		$this->loadLayout('edit', $data);
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		$this->form_validation->set_rules('table_no', 'Table No', 'required|trim');
        $this->form_validation->set_rules('exam_type', 'Exam Type', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update student exam schedule! </div>');
			$this->show($id);
        }
        
		else {
			$schedule = array(
				'student_schedule_id' => $this->input->post('subject'),
				'date' => $this->input->post('date'),
				'table_no' => $this->input->post('table_no'),
				'start_time' => $this->input->post('start_time'),
				'end_time' => $this->input->post('end_time'),
				'location' => $this->input->post('location'),
				'exam_type' => $this->input->post('exam_type')
			);
			$student_id = $this->ExamScheduleModel->getStudentId($id);
			if($this->ExamScheduleModel->updateExamSchedule($id, $schedule)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update student exam schedule! </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update student exam schedule! </div>');
			}
			redirect('Admin/Student/show/'.$student_id);
        }
	}

	public function destroy($id)
	{
		$student_id = $this->ExamScheduleModel->getStudentId($id);
		if($this->ExamScheduleModel->deleteExamSchedule($id)){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete student exam schedule! </div>');
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to delete student exam schedule! </div>');
		}
		redirect('Admin/Student/show/'.$student_id);
	}
}