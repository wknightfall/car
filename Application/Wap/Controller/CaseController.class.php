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


class CaseController extends HomeController {


  
     public function _initialize()
    {

        $twoid = I('request.twoid');
        $this->assign('twoid',$twoid);

        parent::_initialize();
    }
   
   
	
    public function index(){
		
		//$twoid = I('request.twoid',3,'intval');
        //$this->assign('twoid',$twoid);
       
        
        $where[status] = 1;
        //分页
        $listsCount =  M('case')->where($where)->count();
        $p = getpage($listsCount,4);
        $show = $p->showHome();// 分页显示输出

        $lists =  M('case')->where($where)->order('sort asc')->limit($p->firstRow.','.$p->listRows)->select();

        
        $this->assign('lists',$lists);
		if($listsCount>4){
			$this->assign('page',$show);
		}
        
		

        $this->display();
    }
	
	

}