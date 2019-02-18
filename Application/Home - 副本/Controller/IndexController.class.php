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
class IndexController extends HomeController {

    public function index(){


        //查询品牌分类
        $type['pid'] = array('eq',26);
        $this->assign("brand",M('category')->where($type)->order('sort asc')->select());
        //查询车型级别
        $type['pid'] = array('eq',44);
        $this->assign("jibie",M('category')->where($type)->order('sort asc')->select());
		
		//查询测评动态
		$map = array();
		$map['typeid'] = array('eq',14);$map['status'] = array('eq',1);
		$map['flag'] = array('like','%1%');
		
		$this -> assign('cpdt',M('article')->where($map)->limit(4)->order('create_time desc')->select());
		
		$this -> assign('video',M('video')->where('typeid=25')->find());

        $this->newsList();

        $this->display();
    }

    public function newsList(){
        $where['c.pid'] = array('eq',3);
        $where['a.status'] = array('eq',1);
        $img_news = M('article as a')->join('bhy_category as c on c.id=a.typeid')->where($where)->order('a.id desc')->field('a.*')->limit(5)->select();

        $this->assign('img_news',$img_news);
        //二
        $idarr = implode(',',array_column($img_news,'id'));
        $where['a.id'] = array('not in',$idarr);
        $two_news = M('article as a')->join('bhy_category as c on c.id=a.typeid')->where($where)->order('a.id desc')->field('a.*')->limit(4)->select();
        $this->assign('two_news',$two_news);
        //三
        $idarrb = implode(',',array_column($two_news,'id'));
        $where['a.id'] = array(array('not in',$idarr),array('not in',$idarrb));
        $thr_news = M('article as a')->join('bhy_category as c on c.id=a.typeid')->where($where)->order('a.id desc')->field('a.*')->limit(5)->select();
        $this->assign('thr_news',$thr_news);

    }


    public function changelist(){

        if(IS_POST){

            $bid = I('post.bid');
            $list = M('category')->where('pid='.$bid)->order('sort asc')->select();
            $ret = '';
            foreach($list as $k => $v){

                $ret .= '<option value="'.$v['id'].'">'.$v['title'].'</option>';

            }

            echo $ret;
        }

    }
	

}