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
            'created_at' => date('Y-m-d H:i:s'),
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
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update faculty </div>');
            redirect('Admin/Faculty/index');
        }
    }

    public function deleteFaculty($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('faculties',$data, $where);
        if($this->db->trans_status() === TRUE){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete faculty </div>');
            redirect('Admin/Faculty/index');
        }
    }
}
?>