<?php

class NewsModel extends CI_Model
{
    public function getAllNews()
    {
        return $this->db->select('news.*, admins.name AS `author`')->from('news')->join('admins', 'admins.id = news.user_id')->where('news.deleted_at',NULL)->get()->result_array();
    }

    public function addNews($news)
    {
        return $this->db->insert('news', $news);
    }
    
    public function getNews($id)
    {
        return $this->db->select('news.*, admins.name AS `author`')->from('news')->join('admins', 'admins.id = news.user_id')->where('news.id',$id)->get()->row_array();
    }

    public function updateNews($id, $news)
    {
        $where = array(
            'id' => $id
        );
        return $this->db->update('news', $news, $where);
    }

    public function deleteNews($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        return $this->db->update('news',$data, $where);
    }

    public function oldFile($id)
    {
        return $this->db->select('news.file_path')->from('news')->where('news.id',$id)->get()->row()->file_path;
    }
}
?>