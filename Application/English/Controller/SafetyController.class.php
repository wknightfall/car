<?php

namespace English\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class SafetyController extends HomeController {

    public function index(){
		
		$sid = I('get.sid');
		$sid = empty($sid)?14:$sid;
        $get = $_GET;
        $get['typeid'] = $get['typeid']>0?$get['typeid']:14;
        $this->assign('gets',$get);

        //精彩视频
        $where['status'] = array('eq',1);
        $where['typeid'] = array('eq',24);
        $video = M('video')->where($where)->limit(3)->order('sort asc')->select();
        foreach ($video as $ke=>$ve){
            $vo = M('file')->find($ve['file']);
            $video[$ke]['file_url'] = '/Uploads/Download/'.$vo['savepath'].$vo['savename'];
        }
        $this->assign('video',$video);
		
		//查询测评动态
		$map = array();
		$map['typeid'] = array('eq',14);$map['status'] = array('eq',1);
		
		$this -> assign('cpdt',M('article')->where($map)->limit(6)->order('create_time desc')->select());

		$map['flag'] = array('like','%2%');
		
		$this -> assign('cpdtflag',M('article')->where($map)->limit(4)->order('create_time desc')->select());
		
		//查询最新车型
		
		$this -> assign('newcar',M('car')->limit(10)->order('create_time desc')->select());
		
		if(!empty($_GET['year'])){
			
			$where['year'] = array('in',$_GET['year']);
			
		}
		if(!empty($_GET['bid'])){
			
			$where['bid'] = array('eq',$_GET['bid']);
			
		}
		if(!empty($_GET['cid'])){
			
			$where['cid'] = array('eq',$_GET['cid']);
			
		}
		if(!empty($_GET['jid'])){
			
			$where['jid'] = array('eq',$_GET['jid']);
			
		}
		
        $where['status'] = array('eq',1);
        $listsCount =  M('car')->where($where)->count();
        $p = getpage($listsCount,6);
        $show = $p->show();
        $lists =  M('car')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('lists',$lists);
        $this->assign('page',$show);
		
		//查询年份
		$type['pid'] = array('eq',48);
		$this->assign("year",M('category')->where($type)->order('sort asc')->select());
		
		$type['pid'] = array('eq',2);$type['status'] = array('eq',1);
		$this->assign("catelist",M('category')->where($type)->order('sort asc')->select());
		
		$this -> assign('sid',$sid);
		$this -> assign('get',$_GET);
		
        $this->display();
    }



}