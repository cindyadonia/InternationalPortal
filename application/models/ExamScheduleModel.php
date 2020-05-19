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

    public function addExamSchedule($midterm)
    {
        return $this->db->insert('exam_schedules', $midterm);
    }
    
    public function updateExamSchedule($id, $schedule)
    {
        $where = array(
            'id' => $id
        );

        return $this->db->update('exam_schedules',$schedule,$where);
    }

    public function deleteExamSchedule($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        return $this->db->update('exam_schedules',$data, $where);
    }

    public function getStudentId($exam_schedule_id)
    {
        return $this->db->select("student_schedules.student_id")->from('exam_schedules')->join('student_schedules','student_schedules.id = exam_schedules.student_schedule_id')->where('exam_schedules.id', $exam_schedule_id)->get()->row()->student_id;
    }
}
?>