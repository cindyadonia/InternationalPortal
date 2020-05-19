<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudyProgram extends CI_Controller
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
		$this->load->view('admin/study_program/'.$type, $data);
		$this->load->view('layouts/footer');
	}

    public function create($faculty_id)
    {
		$data['title'] = 'Add Study Program';
        $data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['faculty_id'] = $faculty_id;
		$this->loadLayout('add', $data);
    }

    public function store($faculty_id)
	{
        $this->form_validation->set_rules('code', 'StudyProgram Code', 'required|trim');
        $this->form_validation->set_rules('name', 'StudyProgram Name', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add study program </div>');
			return 	$this->create($faculty_id);
        }
		else {
			$study_program = [
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name'),
				'faculty_id' => $faculty_id,
				'created_at' => date('Y-m-d H:i:s'),
			];
			if($this->StudyProgramModel->addStudyProgram($study_program)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add new study program </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to add study program </div>');
			}
			redirect('Admin/Faculty/show/'.$faculty_id);
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Study Program';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['study_program'] = $this->StudyProgramModel->getStudyProgramsById($id);
		$this->loadLayout('edit', $data);
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('code', 'StudyProgram Code', 'required|trim');
        $this->form_validation->set_rules('name', 'StudyProgram Name', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update study program </div>');
			return $this->show($id);
        }
		else {
			$study_program = array(
				'code' => $this->input->post('code'),
				'name' => $this->input->post('name')
			);
			if($this->StudyProgramModel->updateStudyProgram($id, $study_program)){
				$faculty_id = $this->StudyProgramModel->getFacultyId($id);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update study program </div>');
				redirect('admin/faculty/show/'.$faculty_id);
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update study program </div>');
				return $this->show($id);
			}
		}
	}

	public function destroy($id, $faculty_id)
	{
		$child = $this->StudyProgramModel->checkHasChild($id);
        if(count($child) > 0){
			$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"> Failed to delete study program! Some study program currently being registered to student(s)! </div>');
		}
		else{
			if($this->StudyProgramModel->deleteStudyProgram($id, $faculty_id)){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete study program </div>');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to update study program </div>');
			}
		}
		redirect('admin/faculty/show/'.$faculty_id);
	}
}