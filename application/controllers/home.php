<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * 默认前台控制器
     */
    class Home extends CI_Controller{
        public function index(){
          #  echo base_url()."stlye/index/";
          echo site_url().'/home/category';
          /**
           * 首页显示方法，通过$this—>load->view 跳转到想要展示的界面
           */
            $this->load->view('index/index.html');
                    }

        /**
         * 显示分类页category
         */
        public function category(){
            $this->load->view('index/category.html');
        }

        /**
         * details.html
         */
        public function details(){
            $this->load->view('index/details.html');
        }
    }
    