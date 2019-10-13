<?php

class ExamScheduleModel extends CI_Model
{
    public function getExamSchedules($student_id, $type)
    {
        return $this->db->select("exam_schedules.id as mid_id, student_schedules.name, student_schedules.class, student_schedule_id, table_no, date, CONCAT(exam_schedules.location,' (',exam_schedules.start_time,' - ',exam_schedules.end_time,')') as `timeandlocation`")->from('exam_schedules')->join('student_schedules','student_schedules.id = exam_schedules.student_schedule_id')->where('student_schedules.student_id',$student_id)->where('exam_schedules.deleted_at', NULL)->where('exam_type',$type)->get()->result_array();
    }

    public function getExamSchedule($id)
    {
        return $this->db->select('*')->from('exam_schedules')->where('id',$id)->get()->row_array();
    }

    public function addExamSchedule()
    {
        $d = date("Y-m-d");
        $midterm = [
            'table_no' => $this->input->post('table_no'),
            'date' => date($this->input->post('date')),
            'location' => $this->input->post('location'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'exam_type' => $this->input->post('exam_type'),
            'created_at' => date('Y-m-d H:i:s'),
            'student_schedule_id' => $this->input->post('subject'),
        ];

        return $this->db->insert('exam_schedules', $midterm);
    }
    
    public function updateExamSchedule($id)
    {
        $student_schedule_id = $this->input->post('subject');
        $date = $this->input->post('date');
        $table_no = $this->input->post('table_no');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $location = $this->input->post('location');
        $student_id = $this->input->post('student_id');
        $exam_type = $this->input->post('exam_type');
        
        $schedule = array(
            'student_schedule_id' => $student_schedule_id,
            'date' => $date,
            'table_no' => $table_no,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'location' => $location,
            'exam_type' => $exam_type
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('exam_schedules',$schedule,$where);
        if($this->db->trans_status() === TRUE)
        {
            // redirect('student/show/'.$student_id);
            redirect('admin/student/index');

        }
    }

    public function deleteExamSchedule($id, $student_id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('exam_schedules',$data, $where);
        if($this->db->trans_status() === TRUE){
            redirect('admin/student/show/'.$student_id);
        }
    }
}
?>