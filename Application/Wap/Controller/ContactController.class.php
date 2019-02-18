<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wap\Controller;
use OT\DataDictionary;


class ContactController extends HomeController {

	
    public function index(){
		

        $this->display();
    }
	
	
	//留言
	public function addinfo(){
		
		$pt = $_POST;
		$pt[create_time] = time();
	    $resu = M('messages')->add($pt);
		if($resu){
			$msg[status] = 1;
			$msg[msg] = '留言成功！';
		}else{
			$msg[status] = 2;
			$msg[msg] = '留言失败！';
		}
	     $this->ajaxReturn($msg);
		
	}
	
	

}