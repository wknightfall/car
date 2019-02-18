<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class MediaController extends HomeController {

    public function _initialize()
    {
		

        $twonav=M('category')->where("pid=4 and isnav=1 and status=1")->order('sort asc')->select();
        $this->twonav= $twonav;
        $this->assign('twonav',$twonav);
        parent::_initialize();
    }

    public function index(){

        $get = $_GET;
        $get['typeid'] = $get['typeid']>0?$get['typeid']:53;
        $this->assign('get',$get);
		$this -> assign('typeInfo',M('category')->where('id='.$get['typeid'])->find());
        //
        $where['status'] = array('eq',1);
        $where['typeid'] = array('eq',$get['typeid']);
        $listsCount =  M('article')->where($where)->count();
        $p = getpage($listsCount,10);
        $showb = $p->show();
        $listb =  M('article')->where($where)->order('id desc')->select();
        $this->assign('list',$listb);

        $this->display();
    }


    public function details(){

        $get = $_GET;
        $this->assign('get',$get);
        $vo = M('article')->find($get['id']);
        $this->assign('vo', $vo);
        M('news')->where("id=".$get['id'])->setInc('view');

        //上一篇
        $maps['id'] = array('gt',$vo['id']);
        $maps['typeid'] = array('eq',$get['typeid']);
        $maps['status'] = 1;
        $prepage= M('article')->where($maps)->order('id asc')->find();
        $this->assign('prepage',$prepage);

        //下一篇
        $mapss['id']     = array('lt',$vo['id']);
        $mapss['typeid'] = array('eq',$get['typeid']);
        $mapss['status'] = 1;
        $nextpage= M('article')->where($mapss)->order('id desc')->find();
        $this->assign('nextpage',$nextpage);

        //最新消息
        $where['typeid'] = array('eq',$get['typeid']);
        $where['status'] = array('eq',1);
        $where['id']     = array('neq',$vo['id']);
        $list =  M('article')->where($where)->limit(6)->order('id desc')->select();
        $this->assign('list',$list);

        $this->display();
    }


}