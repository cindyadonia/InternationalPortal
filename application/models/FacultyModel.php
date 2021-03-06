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

    public function addFaculty($faculty)
    {
        return $this->db->insert('faculties', $faculty);
    }
    
    public function updateFaculty($id, $faculty)
    {
        $where = array(
            'id' => $id
        );
        return $this->db->update('faculties',$faculty,$where);
    }

    public function deleteFaculty($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );
        return $this->db->update('faculties',$data, $where);
    }

    public function checkHasChild($id)
    {
        return $this->db->select('study_programs.id AS `study_program_id`')->from('faculties')
        ->join('study_programs', 'faculties.id = study_programs.faculty_id')
        ->where('study_programs.deleted_at', NULL)
        ->where('faculties.id', $id)
        ->get()->result_array();
    }
}
?>