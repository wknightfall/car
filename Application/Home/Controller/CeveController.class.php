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
class CeveController extends HomeController {

    public function _initialize()
    {

        $twonav=M('category')->where("pid=1 and isnav=1 and status=1")->order('sort asc')->select();
        $this->twonav= $twonav;
        $this->assign('twonav',$twonav);
        parent::_initialize();
    }

    public function index(){

        $get = $_GET;
        $get['typeid'] = $get['typeid']>0?$get['typeid']:11;
        $this->assign('get',$get);

        //指数介绍
        $zhishu_list = M('article')->where('typeid=10 and status=1')->order('sort asc')->select();
        $this->assign('zhishu_list',$zhishu_list);
        //精彩视频
        $where['status'] = array('eq',1);
        $where['typeid'] = array('eq',24);
        $video = M('video')->where($where)->limit(3)->order('sort asc')->select();
        foreach ($video as $ke=>$ve){
            $vo = M('file')->find($ve['file']);
            $video[$ke]['file_url'] = '/Uploads/Download/'.$vo['savepath'].$vo['savename'];
        }
        dump($video);
        $this->assign('video',$video);

        //合作企业
        $hezuo_lise = M('contact')->where('type=1 and status=1')->order('sort asc,id asc')->select();
        $this->assign('hezuo_lise',$hezuo_lise);
        $this->display();
    }



}