<?php

class CourseModel extends CI_Model
{
    public function getCourses()
    {
        return $this->db->select('*')->from('courses')->get()->result_array();
    }

    public function getCoursesByFaculty($faculty_id)
    {
        return $this->db->select('*')->from('courses')->where('faculty_id', $faculty_id)->get()->result_array();
    }

    public function getCoursesById($id)
    {
        return $this->db->select('*')->from('courses')->where('id', $id)->get()->row_array();
    }

    public function addCourse($faculty_id)
    {
        $d = date("Y-m-d");
        $course = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'faculty_id' => $faculty_id
        ];

        return $this->db->insert('courses', $course);
    }
    
    public function updateCourse($id)
    {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $course = array(
            'code' => $code,
            'name' => $name
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('courses',$course,$where);
        if($this->db->trans_status() === TRUE)
        {
            redirect('faculty/index');

        }
    }

    public function deleteCourse($id)
    {
        echo "Belum bisa woi. masalah pop up";
        echo $id;die;
    }
}
?>