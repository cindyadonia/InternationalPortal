<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('NewsModel');
    }
    
    public function index()
    {
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['newss'] = $this->NewsModel->getAllNews();
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/news/index', $data);
		$this->load->view('layouts/footer');
    }

    public function create()
    {
		$data['title'] = 'Add News';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/news/add', $data);
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
			$this->NewsModel->addNews();
			$this->index();
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit News';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['news'] = $this->NewsModel->getNews($id);

        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/news/edit', $data);
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
			$this->NewsModel->updateNews($id);
        }
	}

	public function destroy($id)
	{
		$this->NewsModel->deleteNews($id);
		// $this->db->update('student')
	}
}