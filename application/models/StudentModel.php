<?php

class StudentModel extends CI_Model
{
    public function getStudents()
    {
        return $this->db->select('students.*, courses.name AS `course_name`')->from('students')->join('courses', 'students.course_id = courses.id')->where('students.deleted_at',NULL)->get()->result_array();
    }

    public function addStudent()
    {
        $student = [
            'student_no' => $this->input->post('student_no'),
            'name' => $this->input->post('name'),
            'birth_date' => $this->input->post('birth_date'),
            'nationality' => $this->input->post('nationality'),
            'university_origin' => $this->input->post('university_origin'),
            'semester' => $this->input->post('semester'),
            'is_active' => TRUE,
            'joined_at' => $this->input->post('joined_at'),
            'password' => password_hash($this->input->post('student_no'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'course_id' => $this->input->post('course'),
            'role_id' => 2,
        ];
        return $this->db->insert('students', $student);
    }
    
    public function getStudent($id)
    {
        return $this->db->select('*')->from('students')->where('id',$id)->get()->row_array();
    }

    public function updateStudent($id)
    {
        $id = $this->input->post('id');
        $student_no = $this->input->post('student_no');
        $name = $this->input->post('name');
        $birth_date = $this->input->post('birth_date');
        $nationality = $this->input->post('nationality');
        $university_origin = $this->input->post('university_origin');
        $semester = $this->input->post('semester');
        $is_active = $this->input->post('is_active');
        $joined_at = $this->input->post('joined_at');
        $password = $this->input->post('password');
        $course = $this->input->post('course');

        if($password !== "")
        {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $user = array(
                'password' => $password
            );
            
            $where = array(
                'id' => $id
            );

            $this->db->update('students',$user,$where);
        }

        $student = array(
            'student_no' => $student_no,
            'name' => $name,
            'birth_date' => $birth_date,
            'nationality' => $nationality,
            'university_origin' => $university_origin,
            'semester' => $semester,
            'course_id' => $course,
            'joined_at' => $joined_at,
            'is_active' => TRUE,
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('students',$student,$where);
        if($this->db->trans_status() === TRUE)
        {
            redirect('admin/student/index');
        }
    }

    public function deleteStudent($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('students',$data, $where);
        if($this->db->trans_status() === TRUE){
            redirect('admin/student/index');
        }
    }
}
?>