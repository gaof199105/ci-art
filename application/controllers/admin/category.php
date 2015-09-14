<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller{
    /**
     * 构造函数
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model','cate');
    }
    /*
    add category
     */
    public function add_cate(){
        $this->load->helper('form');
        $this->load->view('admin/add_cate.html');   
    }
    /**
     * 显示category列表
     * @return [看model里是返回数组还是对象,一般返回的是数组] [description]
     */
    public function index(){
        $this->load->model('category_model','cate');
        $data['category'] = $this->cate->check();
     //   p($data);
        $this->load->view('admin/cate.html',$data);
        
            }
    /*
    tianjia dongzuo
     */
    public function add(){
        $this->load->library('form_validation');
        $this->output->enable_profiler(TRUE);
        $this->form_validation->set_rules('cname','目录','required|max_length[5]');//栏目名不能超过5个，而且为必填
        $status=$this->form_validation->run('cname');
        if($status){
            $data=array(
                'cname' =>$this->input->post('cname')
                );      
     //       $this->load->model('category_model','cate');
            $this->cate->add($data);
            success('admin/category/index','添加成功');
            echo "little";
        }else{
            $this->load->helper('form');
            $this->load->view('admin/add_cate.html');
        }
    }
    public function edit_category($cid){
      //  echo $cid;die;
        $data['category']=$this->cate->check_cate($cid);
        $this->load->helper('form');
        $this->load->view('admin/edit_cate.html',$data);
    }

    /*
    编辑方法
     */
    public function edit(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('cname','目录','required|max_length[5]');
        $status=$this->form_validation->run('cname');
       
        if($status){
            $cid=$this->input->post('cid');
            $cname=$this->input->post('cname');
            $data=array(
               'cname'=>$cname
            );
          
          //  p($cid);die;
            $data['category']= $this->cate->update_cate($cid,$data);
            success('admin/category/index','edit success');
        }else{
            $this->load->helper('form');
            $this->load->view('admin/edit_cate.html');
        }
    }
    /*
    删除方法
     */
    public function del($cid){
        $this->cate->del_cate($cid);
        success('admin/category/index','delete success');
    }
}