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

    public function addSchedulebyStudentId($subjectSchedule)
    {
        return $this->db->insert('student_schedules', $subjectSchedule);
    }
    
    public function updateSchedule($id, $schedule)
    {
        $where = array(
            'id' => $id
        );

        return $this->db->update('student_schedules',$schedule,$where);
    }

    public function totalCredits($id)
    {
        return $this->db->select("SUM(credits) as `totalcredit` ")->from('student_schedules')->where('student_id', $id)->where('deleted_at',NULL)->get()->row_array();
    }

    public function selectSchedule($student_id)
    {
        return $this->db->select("id, CONCAT(class, ' - ', name) as subject")->from('student_schedules')->where('student_id',$student_id)->where('deleted_at',NULL)->get()->result_array();
    }

    public function deleteSchedule($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        return $this->db->update('student_schedules',$data, $where);
    }

    public function getStudentId($time_table_id)
    {
        return $this->db->select("student_id")->from('student_schedules')->where('id', $time_table_id)->get()->row()->student_id;
    }
}
?>