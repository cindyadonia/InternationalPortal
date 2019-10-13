<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
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
			$this->load->model('StudentModel');
			$this->load->model('CourseModel');
			$this->load->model('TimeTableModel');
			$this->load->model('ExamScheduleModel');
		}
    }
    
    public function index()
    {
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['students'] = $this->StudentModel->getStudents();
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/student/index', $data);
		$this->load->view('layouts/footer');
    }

    public function create()
    {
		$data['title'] = 'Add New Student';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['courses'] = $this->CourseModel->getCourses();

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/student/add', $data);
		$this->load->view('layouts/footer');
    }

    public function store()
	{
        $this->form_validation->set_rules('student_no', 'Student No', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'required|trim');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required|trim');
        $this->form_validation->set_rules('university_origin', 'University Origin', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('course', 'Course', 'required|trim');
        $this->form_validation->set_rules('joined_at', 'Join date', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->create();
        }
		else {
			$this->StudentModel->addStudent();
			$this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Student';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student'] = $this->StudentModel->getStudent($id);
		$data['courses'] = $this->CourseModel->getCourses();
		$data['schedules'] = $this->TimeTableModel->getSchedules($id);
		$data['totalcredit'] = $this->TimeTableModel->totalCredits($id);
		$data['midterms'] = $this->ExamScheduleModel->getExamSchedules($id,$type=1);
		$data['finals'] = $this->ExamScheduleModel->getExamSchedules($id,$type=2);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/student/edit', $data);
		$this->load->view('layouts/footer');
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'required|trim');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required|trim');
        $this->form_validation->set_rules('university_origin', 'University Origin', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('joined_at', 'Join date', 'required|trim');
		
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|matches[password_c]',[
			'matches' => 'Password doesnt match',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password_c', 'Confirm Password', 'trim|matches[password]');
		
		if($this->form_validation->run() == FALSE){
			$this->show($id);
        }
		else {
			$this->StudentModel->updateStudent($id);
        }
	}

	public function destroy($id)
	{
		$this->StudentModel->deleteStudent($id);
		// $this->db->update('student')
	}
}