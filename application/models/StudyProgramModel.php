<?php

class StudyProgramModel extends CI_Model
{
    public function getStudyPrograms()
    {
        return $this->db->select('*')->from('study_programs')->get()->result_array();
    }

    public function getStudyProgramsByFaculty($faculty_id)
    {
        return $this->db->select('*')->from('study_programs')->where('faculty_id', $faculty_id)->where('deleted_at', NULL)->get()->result_array();
    }

    public function getStudyProgramsById($id)
    {
        return $this->db->select('*')->from('study_programs')->where('id', $id)->get()->row_array();
    }

    public function addStudyProgram($faculty_id)
    {
        $d = date("Y-m-d");
        $study_program = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'faculty_id' => $faculty_id,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert('study_programs', $study_program);
    }
    
    public function updateStudyProgram($id)
    {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $study_program = array(
            'code' => $code,
            'name' => $name
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('study_programs',$study_program,$where);
        if($this->db->trans_status() === TRUE)
        {
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully update study program </div>');
            redirect('admin/faculty/index');
        }
    }

    public function deleteStudyProgram($id, $faculty_id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('study_programs',$data, $where);
        if($this->db->trans_status() === TRUE){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Successfully delete study program </div>');
            redirect('admin/faculty/show/'.$faculty_id);
        }
    }
}
?>