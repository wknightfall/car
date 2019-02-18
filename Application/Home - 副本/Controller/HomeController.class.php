<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){

        header("Content-type:text/html;charset=utf-8");

        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config);

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
		
        $this->head();


    }

	
	//头部
	public function head(){
		
       //查询顶部网站LOGO
	   $lg['typeid'] = array('eq',13);
	   $lg['status'] = array('eq',1);
	   $logo = M('ad')->where($lg)->order('sort asc')->find();
	   $this -> assign('logo',$logo);
      
	   
	   //查询导航
        $nav = M("category")->where(array('pid'=>0,'isnav'=>1))->order("sort asc")->select();
        foreach ($nav as $k=>$v){
            $where['pid']=$v['id'];
            $where['isnav']=1;
            $nav[$k]['nav_son']=M("category")->where($where)->order("sort asc")->select();
        }
	    $this -> assign('navs',$nav);

        //友情链接
        $links_list = M('links')->where('status=1')->order('sort asc,id asc')->select();
        $this -> assign('links_list',$links_list);
	   //查询网页左边导航
	   $arrte[typeid] = 16;
	   $arrte[status] = 1;
       $leftads = M('ad')->where($arrte)->order('id desc')->find();
	   $this -> assign('leftads',$leftads);	
	}
	

}
