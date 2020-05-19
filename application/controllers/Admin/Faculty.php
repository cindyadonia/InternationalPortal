<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller
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
			$this->load->model('StudyProgramModel');
		}
	}
	
	private function loadLayout($type, $data)
	{
		$this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/faculty/'.$type, $data);
		$this->load->view('layouts/footer');
	}
    
    public function index()
    {
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['faculties'] = $this->FacultyModel->getFaculties();

		$this->loadLayout('index', $data);
    }

    public function create()
    {
		$data['title'] = 'Add Faculty';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$this->loadLayout('add', $data);
    }

    public function store()
	{
        $this->form_validation->set_rules('code', 'Faculty Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Faculty Name', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add new faculty </div>');
			$this->create();
        }
		else {
			$this->FacultyModel->addFaculty();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add new faculty </div>');
			$this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Faculty';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['faculty'] = $this->FacultyModel->getFaculty($id);
		$data['study_programs'] = $this->StudyProgramModel->getStudyProgramsByFaculty($id);
		$this->loadLayout('edit', $data);
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('code', 'Faculty Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Faculty Name', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update faculty </div>');
			$this->show($id);
        }
		else {
			$this->FacultyModel->updateFaculty($id);
        }
	}

	public function destroy($id)
	{
		$this->FacultyModel->deleteFaculty($id);
	}
}