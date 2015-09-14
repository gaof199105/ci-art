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
}