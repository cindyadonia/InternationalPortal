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
			$this->load->model('StudyProgramModel');
			$this->load->model('TimeTableModel');
			$this->load->model('ExamScheduleModel');
		}
	}
	
	private function loadLayout($type, $data)
	{
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/student/'.$type, $data);
		$this->load->view('layouts/footer');
	}
    
    public function index()
    {
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['students'] = $this->StudentModel->getStudents();
		$this->loadLayout('index', $data);
    }

    public function create()
    {
		$data['title'] = 'Add New Student';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['study_programs'] = $this->StudyProgramModel->getStudyPrograms();
		$this->loadLayout('add', $data);
    }

    public function store()
	{
        $this->form_validation->set_rules('student_no', 'Student No', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'required|trim');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required|trim');
        $this->form_validation->set_rules('university_origin', 'University Origin', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('study_program', 'StudyProgram', 'required|trim');
        $this->form_validation->set_rules('joined_at', 'Join date', 'required|trim');

		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add new student </div>');
			return $this->create();
        }
		else {
			$student = [
				'student_no' => $this->input->post('student_no'),
				'name' => $this->input->post('name'),
				'birth_date' => $this->input->post('birth_date'),
				'nationality' => $this->input->post('nationality'),
				'university_origin' => $this->input->post('university_origin'),
				'semester' => $this->input->post('semester'),
				'is_active' => TRUE,
				'joined_at' => $this->input->post('joined_at'),
				'password' => password_hash($this->input->post('student_no'), PASSWORD_DEFAULT),
				'created_at' => date('Y-m-d H:i:s'),
				'study_program_id' => $this->input->post('study_program'),
				'role_id' => 2,
			];
			if($this->StudentModel->addStudent($student)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add new student </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add new student </div>');
			}
			return $this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Student';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student'] = $this->StudentModel->getStudent($id);
		$data['study_programs'] = $this->StudyProgramModel->getStudyPrograms();
		$data['schedules'] = $this->TimeTableModel->getSchedules($id);
		$data['totalcredit'] = $this->TimeTableModel->totalCredits($id);
		$data['midterms'] = $this->ExamScheduleModel->getExamSchedules($id,$type=1);
		$data['finals'] = $this->ExamScheduleModel->getExamSchedules($id,$type=2);
		$this->loadLayout('edit', $data);
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'required|trim');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required|trim');
        $this->form_validation->set_rules('university_origin', 'University Origin', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('joined_at', 'Join date', 'required|trim');
		$this->form_validation->set_rules('is_active', 'Status', 'required');
		
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|matches[password_c]',[
			'matches' => 'Password doesnt match',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password_c', 'Confirm Password', 'trim|matches[password]');
		
		if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update student </div>');
			return $this->show($id);
        }
		else {
			$student = array(
				'student_no' => $this->input->post('student_no'),
				'name' => $this->input->post('name'),
				'birth_date' => $this->input->post('birth_date'),
				'nationality' => $this->input->post('nationality'),
				'university_origin' => $this->input->post('university_origin'),
				'semester' => $this->input->post('semester'),
				'study_program_id' => $this->input->post('study_program'),
				'joined_at' => $this->input->post('joined_at'),
				'is_active' => $this->input->post('is_active'),
			);
			$password = $this->input->post('password');
			if($password !== ""){
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$student['password'] = $password;
			}

			if($this->StudentModel->updateStudent($id, $student)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update student information </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update student </div>');
			}
			return $this->show($id);
        }
	}

	public function destroy($id)
	{
		$child = $this->StudentModel->checkHasSchedule($id);
        if(count($child) > 0){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Failed to delete student! Some subject has been registered to this student! </div>');
		}
		else{
			if($this->StudentModel->deleteStudent($id)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete student </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to delete student </div>');
			}
		}
		redirect('admin/student/index');
	}
}