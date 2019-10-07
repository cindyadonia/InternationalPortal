<?php

class CourseModel extends CI_Model
{
    public function getCourses()
    {
        return $this->db->select('*')->from('courses')->get()->result_array();
    }
}

?>