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


class ProductController extends HomeController {

	
   public function _initialize()
    {

        $twoid = I('request.twoid',17,'intval');
        $this->assign('twoid',$twoid);

        parent::_initialize();
    }

    
    public function index(){
        $twoid = I('request.twoid',27,'intval');
        $this->assign('twoid',$twoid);
       
        $where[typeid] = $twoid;
        $where[status] = 1;
        //分页
        $listsCount =  M('product')->where($where)->count();
        $p = getpage($listsCount,9);
        $show = $p->showHome();// 分页显示输出

        $lists =  M('product')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

        $this->assign('lists',$lists);
        $this->assign('listsCount',$listsCount);
        if($listsCount>9){
			$this->assign('page',$show);
		}
		
        $this->display();
    }

	
    
    //详情页
    public function details(){
        $where["status"] = 1;
        $where["id"] = $_GET['id'];


        M('product')->where($where)->setInc('view',1);//修改浏览次数、

        $vo= M('product')->where($where)->find();
        $this->assign('vo',$vo);

        $this->display();
    }

	
	
	

}