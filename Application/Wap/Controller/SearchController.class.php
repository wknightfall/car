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


class SearchController extends HomeController {

	
    public function index(){
		
		$title = I('request.title');
		
		//新闻
		//$where[title]  = array('like','%'.$title.'%');
		//$where[status] = 1;
		//$lists = M('article')->where($where)->select();
		//$this->assign('lists',$lists);
		
		//分页
		$where[title]  = array('like','%'.$title.'%');
		$where[status] = 1;
        $listsCount =  M('product')->where($where)->count();
        $p = getpage($listsCount,8);
        $show = $p->showHome();// 分页显示输出
		
		$listarr = M('product')->where($where)->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('listarr',$listarr);
		
		//echo  M('product')->getLastSql();
		
		
		if($listsCount>8){
			$this->assign('page',$show);
		}
        $this->display();
    }
	

}