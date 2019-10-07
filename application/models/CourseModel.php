<?php

class CourseModel extends CI_Model
{
    public function getCourses()
    {
        return $this->db->select('*')->from('courses')->get()->result_array();
    }

    public function getCoursesByFaculty($id)
    {
        return $this->db->select('*')->from('courses')->where('faculty_id', $id)->get()->result_array();
    }
}

?>