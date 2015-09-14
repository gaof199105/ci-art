<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model{
    public function add($data){
//   parent::add();
        $this->db->insert('category',$data);
       
    }
    /*
    查看栏目
     */
    public function check (){
        $data = $this->db->get('category')->result_array();
        return $data;
       // p($data);    
    }
    /**
     * 编辑1:获取需要修改的cid,通过cid来获取这个数组
     */
    public function check_cate($cid){
        $data=$this->db->where(array('cid'=>$cid))->get('category')->result_array();
       // p($data);die;
        return $data;
    }
    /**
     * 编辑2：利用updata进行数据库修改，有三个字段（需要修改的表明，修改后的数据，修改具体哪条数据）
     */
    public function update_cate($cid,$data){
        $this->db->update('category', $data, array('cid' => $cid));

    }
    /**
     * delete
     */
    public function del_cate($cid){
        $this->db->delete('category',array('cid'=>$cid));
    }
}