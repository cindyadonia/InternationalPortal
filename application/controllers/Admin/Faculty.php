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
			return $this->create();
        }
		else {
			$faculty = [
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'),
				'created_at' => date('Y-m-d H:i:s'),
			];
			if($this->FacultyModel->addFaculty($faculty)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add new faculty </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add faculty </div>');
			}
			return $this->index();
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
			return $this->show($id);
        }
		else {
			$faculty = array(
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name')
			);
			if($this->FacultyModel->updateFaculty($id, $faculty)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update faculty </div>');
				return $this->index();
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update faculty </div>');
				return $this->show($id);
			}
        }
	}

	public function destroy($id)
	{
		$child = $this->FacultyModel->checkHasChild($id);
        if(count($child) > 0){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Failed to delete faculty! Some study program currently being registered to this faculty </div>');
		}
		else{
			if($this->FacultyModel->deleteFaculty($id)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete faculty </div>');            
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to delete faculty </div>');
			}
		}
		redirect('admin/faculty/index');
	}
}