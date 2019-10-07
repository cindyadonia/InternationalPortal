<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('FacultyModel');
		$this->load->model('CourseModel');

    }
    
    public function index()
    {
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['faculties'] = $this->FacultyModel->getFaculties();
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/faculty/index', $data);
		$this->load->view('layouts/footer');
    }

    public function create()
    {
		$data['title'] = 'Add Faculty';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/faculty/add', $data);
		$this->load->view('layouts/footer');
    }

    public function store()
	{
        $this->form_validation->set_rules('code', 'Faculty Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Faculty Name', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->create();
        }
		else {
			$this->FacultyModel->addFaculty();
			$this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit News';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['faculty'] = $this->FacultyModel->getFaculty($id);
		$data['courses'] = $this->CourseModel->getCoursesByFaculty($id);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/faculty/edit', $data);
		$this->load->view('layouts/footer');
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('code', 'Faculty Code', 'required|trim');
        $this->form_validation->set_rules('name', 'Faculty Name', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->show($id);
        }
		else {
			$this->FacultyModel->updateFaculty($id);
        }
	}

	public function destroy($id)
	{
		$this->FacultyModel->deleteFaculty($id);
		// $this->db->update('student')
	}
}