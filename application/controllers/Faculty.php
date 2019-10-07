<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('FacultyModel');
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
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');
        $this->form_validation->set_rules('category', 'News Category', 'required|trim');
		$this->form_validation->set_rules('user_id', 'Author', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$this->create();
        }
		else {
			$this->FacultyModel->addNews();
			$this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit News';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['news'] = $this->FacultyModel->getNews($id);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/faculty/edit', $data);
		$this->load->view('layouts/footer');
	}
	
	public function update($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');
        $this->form_validation->set_rules('category', 'News Category', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->show($id);
        }
		else {
			$this->FacultyModel->updateNews($id);
        }
	}

	public function destroy($id)
	{
		$this->FacultyModel->deleteNews($id);
		// $this->db->update('student')
	}
}