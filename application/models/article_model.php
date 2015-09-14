<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Article_model extends CI_Model{
    
    /**
     * 插入操作     
     */
    public function insert_art($data){
        $this->db->insert('article',$data);
    }
    /**
     * 查看文章
     */
    public function article_category(){
        //两个表关联查询
        $data=$this->db->select('aid,title,cname,time')->from('article')->join('category','article.cid=category.cid')->order_by('aid','asc')->get()->result_array();
        return $data;
    }
}