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
class CustomController extends HomeController {

    public function index(){
        $brand =  M('brand')->where("status=1")->order('sort asc')->select();

        $this->assign('brand',$brand);


        $lists =  M('normalqa')->where("status=1")->select();

        $this->assign('que',$lists);

        $this->display();
    }

	public function tousu(){
        if(IS_POST){
            $list=I('post.');
            $add['uid']=session('user');
            $add['tid ']=$list['id'];
            $add['name']=$list['name'];

            $add['content']=$list['content'];
            $add['icon']=$list['icon'];
            $add['create_time']=time();

            $useradd= M('advice')->add($add);
            if($useradd){
                exit(json_encode(array('code'=>200,'msg'=>'投诉成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'投诉失败')));
            }

        }else{
            $ct['state']=1;
            $ct['shoptype']=array('neq',0);
            $hotel = M('usermember')->where($ct)->order('id asc')->select();
            $this->assign('hotel',$hotel);
            $this->display();
        }
	}
	

}