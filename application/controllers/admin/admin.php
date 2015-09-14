<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 后台控制器进入
 */
    /**
    * 
    */
    class Admin extends CI_Controller
    {
        /**
         * index
         * @return [type] [description]
         */
        public function index()
        {
            # code...
            echo base_url().'style/admin/';
            $this->load->view('admin/index.html');
        }
        /**
         * copy 
         * @return [type] [description]
         */
        public function copy(){
            $this->load->view('admin/copy.html');
        }
    }
    
