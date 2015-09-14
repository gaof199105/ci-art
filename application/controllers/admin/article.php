<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Article extends CI_Controller{
        /**
         * 构造函数
         */
        public function __construct(){
            parent::__construct();
            $this->load->model('article_model','art');
            $this->load->model('category_model','cate');
        }
        /**
         * 成功跳转
         */
        public function index(){
            //载入分页
            $this->load->library('pagination');
            $per_page=3;
            $config['base_url'] = site_url('admin/article/index');
            $config['total_rows'] = $this->db->count_all_results('article');
            $config['per_page'] = $per_page;
            $config['next_link'] = '下一页';
            $config['last_link'] = '最后';
            $config['first_link'] = '第一页';
            $config['prev_link'] = '上一页';
            $config['uri_segment']=4;

            $this->pagination->initialize($config);

            $data['links'] =$this->pagination->create_links();
          //  p($data);die;
            $offset = $this->uri->segment(4);
            $this->db->limit($per_page,$offset);
            $data['article']=$this->art->article_category();
            //p($data);die;
            $this->load->view('admin/check_article.html',$data);
            //echo "success";
        }
        /*
        
         */
        public function send_article(){
            $this->load->helper('form');
            $data['category']=$this->cate->check();
         //   p($data);die;
            $this->load->view('admin/article.html',$data);
        }
        /*
        发表文章
         */
        public function send(){
            $config['upload_path']      = './uploads/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']     = 1000;
            $config['max_width']        = 1024;
            $config['max_height']       = 768;
            $config['file_name']= time().mt_rand(1,1000);

            $this->load->library('upload', $config);

            $status=$this->upload->do_upload('thumb');
            if(!$status){
                error('上传失败');
            }
          //  p($status);die;
            $wrong = $this->upload->display_errors();
            if($wrong){
                error($wrong);
            }
            //返回信息
            $info=$this->upload->data();
            //($info);die;

            //缩略图
            $arr['source_image'] = $info['full_path'];
            $arr['create_thumb'] = FALSE;
            $arr['maintain_ratio'] = TRUE;
            $arr['width']     = 100;
            $arr['height']   = 100;
            $this->load->library('image_lib', $arr);

            $status=$this->image_lib->resize();
          //  var_dump($status);die;
            if(!$status){
                error('wrong');
            }
            //载入表单验证类
            $this->load->library('form_validation');


            //设置规则
            $this->form_validation->set_rules('title','文章标题','required|min_length[5]');
            $this->form_validation->set_rules('type','类型','required|integer');
            $this->form_validation->set_rules('cid','栏目','integer');
            $this->form_validation->set_rules('info','摘要','required|max_length[120]');
            $this->form_validation->set_rules('content','内容','required|max_length[10]');           
             //执行验证，返回boolen
            $status = $this->form_validation->run('title');

           // var_dump($status);
            if($status){
                
                $data=array(
                    'title' => $this->input->post('title'),
                    'type'=>$this->input->post('type'),
                    'info'=>$this->input->post('info'),
                    'content'=>$this->input->post('content'),
                    'cid'=>$this->input->post('cid'),
                    'thumb'=>$info['file_name']
                    );
               // p($data);die;
               $this->art->insert_art($data);
               success('admin/article/index','success');
            }else{
                $this->load->helper('form');
                $this->load->view('admin/article.html');
            }
        }   
        /*
        编辑文章
         */
        public function edit(){
            $this->load->helper('form');
            $this->load->view('admin/edit_article.html');
        }

        public function edit_article(){
            $this->load->library('form_validation');
            $status=$this->form_validation->run('adfd');
            if($status){
                echo "success";

            }else{
                $this->load->helper('form');
                echo "string";
                $this->load->view('admin/edit_article.html');
            }
        }
   

   }     