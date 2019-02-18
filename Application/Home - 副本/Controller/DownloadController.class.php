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
class DownloadController extends HomeController {

    public function index(){
        $regular = M('regular')->where("status=1")->order("id asc")->limit(5)->select();
        $this->assign('regular',$regular);
        
      
        
        $this->display();
    }

	public function detail(){
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
            $hotel = M('reg')->where("typeid=".$_GET[id])->select();
            $this->assign('reg',$hotel);
            $this->display();
        }
	}
	

}