<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeTable extends CI_Controller
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
		}
	}
	
	private function loadLayout($type, $data)
	{
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/time_table/'.$type, $data);
		$this->load->view('layouts/footer');
	}
    
    public function index()
    {	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
        $data['students'] = $this->db->select('students.*, study_programs.name AS `study_program_name`')->from('students')->join('study_programs', 'students.study_program_id = study_programs.id')->where('deleted_at',NULL)->get()->result_array();
		$this->loadLayout('index', $data);
    }

    public function create($student_id)
    {
		$data['title'] = 'Add New Subject';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student_id'] = $student_id;
		$this->loadLayout('add', $data);
    }

    public function store($student_id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('credits', 'Credits', 'required|trim');
        $this->form_validation->set_rules('lecturer', 'Lecturer', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('day', 'Day', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add student\'s time table</div>');
            redirect('Admin/Student/show/'.$student_id);
        }
        
		else {
			$this->TimeTableModel->addSchedulebyStudentId($student_id);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add new student time table</div>');
            redirect('Admin/Student/show/'.$student_id);
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Schedule';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student'] = $this->db->select('*')->from('students')->where('id',$id)->get()->row_array();
		$data['schedule'] = $this->TimeTableModel->getSchedule($id);
		$this->loadLayout('edit', $data);
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('credits', 'Credits', 'required|trim');
        $this->form_validation->set_rules('lecturer', 'Lecturer', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('day', 'Day', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Failed to update student\'s time table</div>');
			$this->show($student_id);
        }
        
		else {
			$this->TimeTableModel->updateSchedule($id);
        }
	}

	public function destroy($id, $student_id)
	{
		$this->TimeTableModel->deleteSchedule($id, $student_id);
	}
}