<?php

class FacultyModel extends CI_Model
{
    public function getFaculties()
    {
        return $this->db->select('*')->from('faculties')->where('deleted_at', NULL)->get()->result_array();
    }

    public function getFaculty($id)
    {
        return $this->db->select('*')->from('faculties')->where('id',$id)->get()->row_array();
    }

    public function addFaculty()
    {
        $d = date("Y-m-d");
        $faculty = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
        ];

        return $this->db->insert('faculties', $faculty);
    }
    
    public function updateFaculty($id)
    {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $faculty = array(
            'code' => $code,
            'name' => $name
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('faculties',$faculty,$where);
        if($this->db->trans_status() === TRUE)
        {
            // redirect('student/show/'.$student_id);
            redirect('faculty/index');

        }
    }

    public function deleteFaculty($id)
    {
        echo "Belum bisa woi. masalah pop up";
        echo $id;die;
    }
}
?>