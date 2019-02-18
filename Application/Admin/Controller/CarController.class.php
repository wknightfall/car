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
class CarController extends AdminController {
	
	public function _initialize(){
		
		//查询品牌分类
		$type['pid'] = array('eq',22);
		$this->assign("brand",M('category')->where($type)->order('sort asc')->select());
		//查询车型级别
		$type['pid'] = array('eq',23);
		$this->assign("jibie",M('category')->where($type)->order('sort asc')->select());

		//查询车型年份
		$type['pid'] = array('eq',44);
		$this->assign("year",M('category')->where($type)->order('sort asc')->select());
		parent::_initialize();
	}

	public function _filter(&$sqlWhere){
		
		if(!empty($_GET['name'])){
			
			$sqlWhere['name'] = array('like','%' . $_GET['name'] . '%');
		}	
		
		return $sqlWhere;
		
	}

	public function changelist(){

		if(IS_POST){

			$bid = I('post.bid');
			$sid = I('post.sid');
			$list = M('category')->where('pid='.$bid)->order('sort asc')->select();
			$ret = '';
			foreach($list as $k => $v){
				if($v['id'] == $sid){
					
					$selectd = 'selected';
					
				}else{
					
					$selectd = '';
					
				}
				$ret .= '<option value="'.$v['id'].'" '.$selectd.'>'.$v['title'].'</option>';

			}

			echo $ret;
		}

	}
}
