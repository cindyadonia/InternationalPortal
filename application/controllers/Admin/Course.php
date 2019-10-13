<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller
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
			$this->load->model('FacultyModel');
			$this->load->model('CourseModel');
		}

    }
    
    public function index()
    {
    }

    public function create($faculty_id)
    {
		$data['title'] = 'Add Course';
        $data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
        $data['faculty_id'] = $faculty_id;

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/course/add', $data);
		$this->load->view('layouts/footer');
    }

    public function store($faculty_id)
	{
        $this->form_validation->set_rules('code', 'Course Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Course Name', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->create();
        }
		else {
			$this->CourseModel->addCourse($faculty_id);
			redirect('admin/faculty/show/'.$faculty_id);
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Course';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['course'] = $this->CourseModel->getCoursesById($id);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/course/edit', $data);
		$this->load->view('layouts/footer');
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('code', 'Course Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Course Name', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->show($id);
        }
		else {
			$this->CourseModel->updateCourse($id);
	        }
	}

	public function destroy($id, $faculty_id)
	{
		$this->CourseModel->deleteCourse($id, $faculty_id);
	}
}