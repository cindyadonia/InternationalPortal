<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeTable extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('TimeTableModel');
    }
    
    public function index()
    {	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
        $data['students'] = $this->db->select('students.*, courses.name AS `course_name`')->from('students')->join('courses', 'students.course_id = courses.id')->where('deleted_at',NULL)->get()->result_array();
        
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/time_table/index', $data);
		$this->load->view('layouts/footer');
    }

    public function create($student_id)
    {
		$data['title'] = 'Add New Subject';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student_id'] = $student_id;
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/time_table/add', $data);
		$this->load->view('layouts/footer');
    }

    public function store($student_id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('credits', 'Credits', 'required|trim');
        $this->form_validation->set_rules('lecturer', 'Lecturer', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('day', 'Day', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			echo "Gagal";
        }
        
		else {
			$this->TimeTableModel->addSchedulebyStudentId($student_id);
			$this->show($student_id);
        }
	}

    public function show($id)
    {
        $data['title'] = 'Edit Schedule';
		$data['user'] = $this->db->select('name, admin_no')->from('admins')->where('admins.admin_no',$this->session->userdata('admin_no'))->get()->row_array();
		$data['student'] = $this->db->select('*')->from('students')->where('id',$id)->get()->row_array();
		$data['schedule'] = $this->TimeTableModel->getSchedule($id);
        
        $this->load->view('layouts/header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/topbar', $data);
		$this->load->view('admin/time_table/edit', $data);
		$this->load->view('layouts/footer');
	}
	
	public function update($id)
	{
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|is_unique[students.student_no]');
        $this->form_validation->set_rules('credits', 'Credits', 'required|trim');
        $this->form_validation->set_rules('lecturer', 'Lecturer', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('day', 'Day', 'required|trim');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required|trim');
        $this->form_validation->set_rules('end_time', 'End Time', 'required|trim');
		
		
		if($this->form_validation->run() == FALSE){
			echo "Gagal";
        }
        
		else {
			$this->TimeTableModel->updateSchedule($id);
        }
	}

	public function destroy($id)
	{
		echo $id;die;
		// $this->db->update('student')
	}
}