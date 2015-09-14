<?php  
$config = array(
    'adfd' => array(
        array(
            'filed' =>'title',
            'lable'=>'文章标题',
            'rules'=>'required|min_length[5]'
        ),
        array(
            'filed'=>'type',
            'lable'=>'类型',
            'rules'=>'required|integer'
        ),
        array(
            'filed'=>'cid',
            'lable'=>'栏目',
            'rules'=>'integer'
        ),
        array(
            'filed'=>'info',
            'lable'=>'摘要',
            'rules'=>'required|max_length[120]'
        ),
        array(
            'filed'=>'content',
            'lable'=>'内容',
            'rules'=>'required|max_length[10]'
        )
    ),
    'cate' => array(
            'file'=>'cname',
            'lable'=>'栏目名称',
            'rules'=>'required|max_length[2]'
        )
);