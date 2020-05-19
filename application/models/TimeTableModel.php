<?php

class TimeTableModel extends CI_Model
{
    public function getSchedules($student_id)
    {
        return $this->db->select("id, class, name, lecturer, credits, CONCAT(day,', ',location,' (',start_time,' - ',end_time,')') as `timeandlocation`")->from('student_schedules')->where('student_id',$student_id)->where('deleted_at', NULL)->get()->result_array();
    }

    public function getSchedule($id)
    {
        return $this->db->select('*')->from('student_schedules')->where('id',$id)->get()->row_array();
    }

    public function addSchedulebyStudentId($student_id)
    {
        $subjectSchedule = [
            'name' => $this->input->post('subject'),
            'credits' => $this->input->post('credits'),
            'lecturer' => $this->input->post('lecturer'),
            'day' => $this->input->post('day'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'class' => $this->input->post('class'),
            'location' => $this->input->post('location'),
            'created_at' => date('Y-m-d H:i:s'),
            'student_id' => $student_id
        ];
        return $this->db->insert('student_schedules', $subjectSchedule);
    }
    
    public function updateSchedule($id)
    {
        $name = $this->input->post('subject');
        $credits = $this->input->post('credits');
        $lecturer = $this->input->post('lecturer');
        $day = $this->input->post('day');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $class = $this->input->post('class');
        $location = $this->input->post('location');
        
        $schedule = array(
            'name' => $name,
            'credits' => $credits,
            'lecturer' => $lecturer,
            'day' => $day,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'class' => $class,
            'location' => $location,
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('student_schedules',$schedule,$where);
        if($this->db->trans_status() === TRUE)
        {
            $student_id = $this->getStudentId($id);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update student time table </div>');
            redirect('Admin/Student/show/'.$student_id);
        }
    }

    public function totalCredits($id)
    {
        return $this->db->select("SUM(credits) as `totalcredit` ")->from('student_schedules')->where('student_id', $id)->where('deleted_at',NULL)->get()->row_array();
    }

    public function selectSchedule($student_id)
    {
        return $this->db->select("id, CONCAT(class, ' - ', name) as subject")->from('student_schedules')->where('student_id',$student_id)->where('deleted_at',NULL)->get()->result_array();
    }

    public function deleteSchedule($id, $student_id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('student_schedules',$data, $where);
        if($this->db->trans_status() === TRUE){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete student time table </div>');
            redirect('Admin/Student/show/'.$student_id);
        }
    }

    public function getStudentId($time_table_id)
    {
        return $this->db->select("student_id")->from('student_schedules')->where('id', $time_table_id)->get()->row()->student_id;
    }
}
?>