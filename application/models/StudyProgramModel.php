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

    public function addStudyProgram($study_program)
    {
        return $this->db->insert('study_programs', $study_program);
    }
    
    public function updateStudyProgram($id, $study_program)
    {
        $where = array(
            'id' => $id
        );
        return $this->db->update('study_programs',$study_program,$where);
    }

    public function deleteStudyProgram($id, $faculty_id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        return $this->db->update('study_programs',$data, $where);
    }

    public function getFacultyId($study_program_id)
    {
        return $this->db->select("faculty_id")->from('study_programs')->where('id', $study_program_id)->get()->row()->faculty_id;
    }
}
?>