<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Mnews extends MY_Model{
    

    function getCname(){
        $this->db->select('id_news_category,name');
        $query=$this->db->get('news_category');
        $record=array();
        foreach ($query->result() as $row){
            $record[$row->id_news_category]=$row->name;
        }
        return $record;
        //return $query->result_array();
    }
    function getNew($columm,$id){
        $this->db->where($columm,$id);
        $query=$this->db->get('news');        
        foreach ($query->result_array() as $row){
            $record=$row;
        }
        //return $query->result_array();
        return $record;
    }
    function insertNew($cate,$title,$desc,$keywords,$content,$link_rewrite,$active,$date_add,$date_upd){
        $record=array(
                'id_news_category'  =>  $cate,
                'meta_title'        =>  $title,
                'meta_description'  =>  $desc,
                'meta_keywords'     =>  $keywords,
                'content'           =>  $content,
                'link_rewrite'      =>  $link_rewrite,
                'active'            =>  $active,
                'date_add'          =>  $date_add,
                'date_upd'          =>  $date_upd);
        $this->db->insert('news',$record);
    }
    function editNew($cate,$title,$desc,$keywords,$content,$link_rewrite,$active,$date_upd,$id){
        $record=array(
                'id_news_category'  =>  $cate,
                'meta_title'        =>  $title,
                'meta_description'  =>  $desc,
                'meta_keywords'     =>  $keywords,
                'content'           =>  $content,
                'link_rewrite'      =>  $link_rewrite,
                'active'            =>  $active,                
                'date_upd'          =>  $date_upd);
            $this->db->where('id_news',$id);
            $this->db->update('news',$record);
    }
    function deleteNews($id_news){
        $this->db->where('id_news',$id_contact);
        $this->db->delete('news');
    }
}
?>
