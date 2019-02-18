<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class CaseController extends AdminController {
	
	public function _initialize(){
		$arr[pid] = 2;
		$arr[status] = 1;
		$typelist = M('category')->where($arr)->order('sort asc')->select();
		$this->assign('typelist',$typelist);
		parent::_initialize();
	}

    

     //删除
	public function del(){
		$id = I('request.id');

		if($id>0){
		  $lists = M('product')->where('id='.$id)->save(array('status'=>-1));
		  if($lists){
			  $this->success('删除成功');
		  }
		}else{

				$this->error('参数错误');


		}

		$this->display();

	}


	
	public function _before_add(){
		
		$_POST['create_time']=time();
		
	}
	

}
