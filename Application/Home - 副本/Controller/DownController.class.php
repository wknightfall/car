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
class DownController extends HomeController {


    public function _initialize()
    {
        $twonav=M('category')->where("pid=5 and isnav=1 and status=1")->order('sort asc')->select();
        $this->twonav= $twonav;
        $this->assign('twonav',$twonav);
        parent::_initialize();
    }

    public function index(){

        $get = $_GET;
        $get['typeid'] = $get['typeid']>0?$get['typeid']:19;
        $this->assign('get',$get);

        //体系规程
        $txlist=M('category')->where("pid=19 and status=1")->order('sort asc')->select();
        $this->assign('txlist',$txlist);

        //另外三个
        $where['status'] = array('eq',1);
        $where['id'] = array('in','20,21,22');
        $list = M('category')->where($where)->order('sort asc')->select();
        foreach ($list as $ke=>$ve){
            $whe['typeid'] = array('eq',$ve['id']);
            $whe['status'] = array('eq',1);
            $son_list = M('enclosure')->where($whe)->order('sort asc,id desc')->select();
            foreach ($son_list as $ks=>$vs){
                $voo = M('file')->find($vs['file']);
                $son_list[$ks]['file_url'] = '/Uploads/Download/'.$voo['savepath'].$voo['savename'];
            }
            $list[$ke]['son_list'] = $son_list;
        }
        $this->assign('list',$list);
        $this->display();
    }


    //体系规程下载列表
    public function lists(){
        $get = $_GET;
        $get['id'] = $get['id']>0?$get['id']:55;
        $this->assign('get',$get);

        $whe['typeid'] = array('eq',$get['id']);
        $whe['status'] = array('eq',1);
        $list = M('enclosure')->where($whe)->order('sort asc,id desc')->select();
        foreach ($list as $ks=>$vs){
            $voo = M('file')->find($vs['file']);
            $list[$ks]['file_url'] = '/Uploads/Download/'.$voo['savepath'].$voo['savename'];
        }
        $this->assign('list',$list);
        $this->display();
    }

	

}