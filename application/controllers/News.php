<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
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
			$this->load->model('NewsModel');
	
			$this->load->helper(array('form', 'url'));
		}
    }
    
    public function index()
    {
		$data['title'] = 'Dashboard';
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
			$this->uploadFile();die;
			$this->NewsModel->addNews();
			$this->index();
        }
	}
	
    public function show($id)
    {
        $data['title'] = 'Edit News';
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

	// private function uploadFile()
	// {
	// 	$file['upload_path']          = './uploads/news';
	// 	$file['allowed_types']        = 'jpg|jpeg|png';
	// 	$file['max_size']             = 1024000;
	// 	$file['max_width']            = 1024;
	// 	$file['max_height']           = 1024;
		
	// 	$this->load->library('upload', $file);
		
	// 	if ( !$this->upload->initialize($file))
	// 	// if ( !$this->uploadFile())
	// 	{
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$this->load->view('upload_form', $error);
	// 		echo "fail";die;
	// 	}
	// 	else
	// 	{
	// 		$data = array('upload_data' => $this->upload->data());
	// 		echo "oke";die;
	// 	}
	// 	echo "done";die;
	// }
}