<?php

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ContactController extends AdminController {
	
	public function _initialize(){
		$arr[pid] = 2;
		$arr[status] = 1;
		$typelist = M('category')->where($arr)->order('sort asc')->select();
		$this->assign('typelist',$typelist);
		parent::_initialize();
	}

    public function index(){
        $get = $_GET;
        $this->assign('get',$_GET);
        if($get['title']!=''){
            $where['title'] = array('like','%'.$get['title'].'%');
        }
        $where['status'] = array('neq',-1);

        //分页
        $listsCount = M('contact')->where($where)->count();
        $Page       = new \Think\Page($listsCount,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $lists = M('contact')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
        $this->assign('list',$lists);
        $this->assign('_page',$show);
        $this->display();

    }

    

     //删除
	public function del(){
		$id = I('request.id');

		if($id>0){
		  $lists = M('contact')->where('id='.$id)->save(array('status'=>-1));
		  if($lists){
			  $this->success('删除成功');
		  }
		}else{
				$this->error('参数错误');
		}
		$this->display();
	}


	
	public function _before_add(){
		if(IS_POST){
		  $_POST['create_time']=time();

		}
		
		
	}
    public function _before_edit(){

        $_POST['update_time']=time();

    }

}
