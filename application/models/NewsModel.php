<?php

class NewsModel extends CI_Model
{
    public function getAllNews()
    {
        return $this->db->select('news.*, admins.name AS `author`')->from('news')->join('admins', 'admins.id = news.user_id')->where('news.deleted_at',NULL)->get()->result_array();
    }

    public function addNews($filename)
    {
        $news = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'file_path' => $filename,
            'category' => $this->input->post('category'),
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $this->input->post('user_id'),
        ];

        // var_dump($news);die;
        return $this->db->insert('news', $news);
    }
    
    public function getNews($id)
    {
        return $this->db->select('news.*, admins.name AS `author`')->from('news')->join('admins', 'admins.id = news.user_id')->where('news.id',$id)->get()->row_array();
    }

    public function updateNews($id)
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $file_path = $this->input->post('file_path');
        $category = $this->input->post('category');

        $news = array(
            'title' =>  $title,
            'content' =>  $content,
            'file_path' =>  $file_path,
            'category' =>  $category,
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('news',$news,$where);
        if($this->db->trans_status() === TRUE)
        {
            redirect('admin/news/index');
        }
    }

    public function deleteNews($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $where = array(
            'id' => $id
        );

        $this->db->update('news',$data, $where);
        if($this->db->trans_status() === TRUE){
            redirect('admin/news/index');
        }
    }
}
?>