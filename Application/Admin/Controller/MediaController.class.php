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
class MediaController extends AdminController {
	
	public function _initialize(){
		
		//查询所有广告分类
		$type['pid'] = array('eq',7);
		$type['status'] = array('eq',1);
		$this->assign("typelist",M('category')->where($type)->order('sort asc')->select());
		parent::_initialize();
	}
	public function _filter(&$sqlWhere){
		
		if(!empty($_GET['name'])){
			
			$sqlWhere['name'] = array('like','%' . $_GET['name'] . '%');
		}	
		
		return $sqlWhere;
		
	}
	public function recommend(){
		$id=$_GET['id'];
		$recommend = M('media')->where("id=".$id)->find()['recommend'];
		$tj=$recommend==1?0:1;
		$re=M('media')->where("id=".$id)->save(array('recommend'=>$tj));
		if($re){

			$this->success('修改成功','/Admin/news/index.html');
		}else{
			$this->error('修改失败');
		}
	}
}
