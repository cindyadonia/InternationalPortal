<?php

class StudentModel extends CI_Model
{
    public function getStudents()
    {
        return $this->db->select('students.*, study_programs.name AS `study_program_name`')->from('students')->join('study_programs', 'students.study_program_id = study_programs.id')->where('students.deleted_at',NULL)->get()->result_array();
    }

    public function getActiveStudents()
    {
        return $this->db->select('students.*, study_programs.name AS `study_program_name`')->from('students')->join('study_programs', 'students.study_program_id = study_programs.id')->where('students.deleted_at',NULL)->where('is_active', TRUE)->get()->result_array();
    }

    public function addStudent($student)
    {
        return $this->db->insert('students', $student);
    }
    
    public function getStudent($id)
    {
        return $this->db->select('*')->from('students')->where('id',$id)->get()->row_array();
    }

    public function updateStudent($id, $student)
    {
        $where = array(
            'id' => $id
        );

        return $this->db->update('students',$student,$where);
    }

    public function deleteStudent($id)
    {
        $schedules = $this->checkHasSchedule($id);
        if(count($schedules) > 0){

        }

        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        return $this->db->update('students',$data, $where);
    }

    public function checkHasSchedule($id)
    {
        return $this->db->select('student_schedules.id AS `schedule_id`')->from('student_schedules')
        ->where('student_schedules.deleted_at', NULL)
        ->where('student_id', $id)
        ->get()->result_array();
    }

    // public function checkHasExam($schedule_id)
    // {
    //     return $this->db->select('exam_schedules.id AS `exam_id`')->from('student_schedules')
    //     ->join('exam_schedules', 'student_schedules.id = exam_schedules.student_schedule_id')
    //     ->where('exam_schedules.deleted_at', NULL)
    //     ->where('student_schedules.id', $schedule_id)
    //     ->get()->result_array();
    // }
}
?>