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
			if(empty($_FILES['file_path']['name'])){
				$this->NewsModel->addNews(null);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add news </div>');
				$this->index();
			}
			else{
				$filename = $this->uploadFile($_FILES);
				if($filename !== false){
					$this->NewsModel->addNews($filename);
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully add news </div>');
					$this->index();
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Failed to upload image! </div>');
				}
			}
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
	}

	private function uploadFile($file)
	{
		$namafile = $file['file_path']['name'];
		$ext = explode(".",$namafile);
		$file['upload_path']          = './uploads/news';
		$file['allowed_types']        = 'jpg|jpeg|png';
		$file['file_name']            = date('d_m_Y_h_i_s_').uniqid(true).'.'.$ext[count($ext)-1];
		$file['max_size']             = 2048;
		$file['max_width']            = 1024;
		$file['max_height']           = 1024;
		
		$this->load->library('upload', $file);
		
		if (!$this->upload->do_upload('file_path'))
		{
			$error = array('error' => $this->upload->display_errors());
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $file['file_name'];
		}
	}
}