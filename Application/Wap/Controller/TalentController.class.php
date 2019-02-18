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


class TalentController extends HomeController {

	//招聘列表
    public function index(){
		$where[status] = 1;
		
		//分页
        $listsCount =  M('zptalent')->where($where)->order('sort asc')->count();;
        $p = getpage($listsCount,4);
        $show = $p->showHome();// 分页显示输出
		
		$lists = M('zptalent')->where($where)->order('sort asc')->limit($p->firstRow.','.$p->listRows)->select();
		
        $this->assign('lists',$lists); 
         if($listsCount>4){
			$this->assign('page',$show);
		}
		
		if(ismobile()){
			 $this->display('recruit');
		}else{
			$this->display();
		}
		
       
    }
	
	//电脑应聘信息
	public function talent(){
		
		$id = I('request.id');
	    if($id>0){
			//应聘岗位
			$vo = M('zptalent')->where('id='.$id)->find();
			$this->assign('vo',$vo);
			
			
		}else{
			$this->error('非法操作！',U('index/index'));
			exit;
		}
		
		
		$this->display();
	}

    //电脑应聘信息
	public function teltalent(){
        $id = I('request.id');
	    if($id>0){
			//应聘岗位
			$vo = M('zptalent')->where('id='.$id)->find();
			$this->assign('vo',$vo);
			
			
		}else{
			$this->error('非法操作！',U('index/index'));
			exit;
		}


        $this->display();

	}



	//信息添加
	public function addtalent(){
	    
		$_POST[create_time] = time();
		$yingpin = M('talent')->add($_POST);
		
		if($yingpin){
			$msg['status'] = 1;
		}else{
			$msg['status'] = 2;
		}
		$this->ajaxReturn($msg);
	}
	
	

}