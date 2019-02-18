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
class EmailController extends AdminController {
	
	/* public function _filter(&$sqlWhere){
		
		if(!empty($_GET['name'])){
			
			$sqlWhere['name'] = array('like','%' . $_GET['name'] . '%');
		}	
		
		return $sqlWhere;
		
	} */
	public function _before_add(){
		if(IS_POST){
			$_POST['authorid']=is_login();
			$_POST['addtime']=time();
		}else{
			$this->assign('emialtypes',C('WEB_EMAIL_CONFIG_TYPE'));
		}
	}
	public function _before_edit(){
		if(!IS_POST){
			$this->assign('emialtypes',C('WEB_EMAIL_CONFIG_TYPE'));
		}
	}
}
