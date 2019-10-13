<?php

class CourseModel extends CI_Model
{
    public function getCourses()
    {
        return $this->db->select('*')->from('courses')->get()->result_array();
    }

    public function getCoursesByFaculty($faculty_id)
    {
        return $this->db->select('*')->from('courses')->where('faculty_id', $faculty_id)->where('deleted_at', NULL)->get()->result_array();
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
            'faculty_id' => $faculty_id,
            'created_at' => date('Y-m-d H:i:s'),
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
            redirect('admin/faculty/index');

        }
    }

    public function deleteCourse($id, $faculty_id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('courses',$data, $where);
        if($this->db->trans_status() === TRUE){
            redirect('admin/faculty/show/'.$faculty_id);
        }
    }
}
?>