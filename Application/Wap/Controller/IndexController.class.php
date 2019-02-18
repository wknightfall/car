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

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {
	//系统首页
    public function index(){

        //banner图
        $adarr[status] = 1;
        $adarr[typeid] = 11;
        $banner = M('ad')->where($adarr)->order('sort asc')->select();
        $this->assign('banner',$banner);


        $newstype = M('category')->where('pid=2 and id<27')->order('sort asc')->select();
        $this->assign('newstype',$newstype);
        //新闻
        $jt[status] = 1;
        $jt[typeid] = 27;
        $headnews = M('article')->where($jt)->order('id desc')->limit(3)->select();
        $this->assign('headnews',$headnews);
		$xw[status] = 1;
        $xw[typeid] = 26;
		$news = M('article')->where($xw)->order('id desc')->limit(5)->select();
		$this->assign('news',$news);
        $gs[status] = 1;
        $gs[typeid] = 25;
        $notice = M('article')->where($gs)->order('id desc')->limit(5)->select();
        $this->assign('notice',$notice);
        //景区
		$jq[status] = 1;
        $jq[recommend] = 1;
        $count=M('scenic')->where($jq)->count();
        if($count<4){
            if($count==0){
                $scenic = M('scenic')->where("status=1")->order('id desc')->limit(4)->select();
                $this->assign('scenic',$scenic);
            }else{
                $head=M('scenic')->where($jq)->select();
                $tail = M('scenic')->where("status=1")->order('id desc')->limit((4-$count))->select();
                foreach ($tail as $k=>$v){
                    array_push($head,$v);
                }
                $this->assign('scenic',$head);
            }
        }else{
            $scenic = M('scenic')->where($jq)->order('id desc')->limit(4)->select();
            $this->assign('scenic',$scenic);

        }

        //酒店
        $jd[state] = 1;
        $jd[shoptype] = 1;
        $jd[recommend] = 1;
        if(M('usermember')->where($jd)->count()){
            $coverhotel = M('usermember')->where($jd)->order('id asc')->find();
        }else{
            $coverhotel = M('usermember')->where("state=1 and shoptype=1")->order('id asc')->find();
        }
        $hotel = M('usermember')->where("state=1 and shoptype=1")->order('id asc')->limit(2)->select();

        $this->assign('hotel',$hotel);
        $this->assign('coverhotel',$coverhotel);
        //餐厅
        $ct[state] = 1;
        $ct[shoptype] = 2;
        $ct[recommend] = 1;
        if(M('usermember')->where($ct)->count()){
            $coverres = M('usermember')->where($ct)->order('id asc')->find();
        }else{
            $coverres = M('usermember')->where("state=1 and shoptype=2")->order('id asc')->find();
        }
        $res = M('usermember')->where("state=1 and shoptype=2")->order('id asc')->limit(2)->select();

        $this->assign('res',$res);
        $this->assign('coverres',$coverres);
        //旅行社
        $lxs[status] = 1;
        $lxs[recommend] = 1;
        if(M('travelcpy')->where($lxs)->count()){
            $coverlxs = M('travelcpy')->where($lxs)->order('id asc')->find();
        }else{
            $coverlxs = M('travelcpy')->where("status=1")->order('id asc')->find();
        }
        $lxslist = M('travelcpy')->where("status=1")->order('id asc')->limit(2)->select();
        $this->assign('lxs',$lxslist);
        $this->assign('coverlxs',$coverlxs);

        //娱乐场所
        $fun[status] = 1;
        $fun[recommend] = 1;
        if(M('funaddr')->where($fun)->count()){
            $coverfun = M('funaddr')->where($fun)->order('id asc')->find();
        }else{
            $coverfun = M('funaddr')->where('status=1')->order('id  asc')->find();
        }
        $funlist = M('funaddr')->where('status=1')->order('id asc')->limit(4)->select();
        $this->assign('fun',$funlist);
        $this->assign('coverfun',$coverfun);
        //资讯
        $zx[status] = 1;
        $zxtj = M('travelnews')->where($zx)->order('id desc')->limit(2)->select();
        $this->assign('zx',$zxtj);
        $zxlist = M('travelnews')->where($zx)->order('id desc')->limit(5,7)->select();
        $this->assign('zxlist',$zxlist);
        //交通指南
        $jt[status] = 1;
        $jtlist = M('route')->where($jt)->order('id desc')->limit(2)->select();
        $this->assign('routeguide',$jtlist);
        //民俗视频
        $ms[status] = 1;
        $ms[type] = 1;
        $msvideo = M('video')->where($ms)->order('id desc')->limit(4)->select();
        $this->assign('msvideo',$msvideo);
        //活动视频
        $hd[status] = 1;
        $hd[type] = 2;
        $hdvideo = M('video')->where($hd)->order('id desc')->limit(4)->select();
        $this->assign('hdvideo',$hdvideo);
        //节庆视频
        $jq[status] = 1;
        $jq[type] = 3;
        $jqvideo = M('video')->where($jq)->order('id desc')->limit(4)->select();
        $this->assign('jqvideo',$jqvideo);

        //推荐视频
        $tjv[status] = 1;
        $tjv[recommend] = 1;
        if(M('video')->where($tjv)->count()){
            $tjvideo = M('video')->where($tjv)->order('id desc')->find();
        }else{
            $tjvideo = M('video')->order('id desc')->find();
        }
        $this->assign('tjvideo',$tjvideo);


		//关于我们
		$about[status] = 1;
		$about[id] = 1;
		$abo = M('category')->where($about)->find();
        $this->assign('abo',$abo);
		
		//新闻列表
		$newarr[flag] = array(array('eq',3),array('like','%,3%'),array('like','%3,%'),'or');
		$newarr[status] = 1;
		$newarr[typeid] = 14;
		$newslist = M('article')->where($newarr)->order('id desc')->limit(4)->select();
		$this->assign('newslist',$newslist);
		

        //游记
        $yj[status] = 1;
        $travelnote = M('travelnote')->where($yj)->order('id desc')->limit(7)->select();
        $this->assign('travelnote',$travelnote);
        //美景图片
        $bp[status] = 1;
        $bp[recommend] = 1;
        $beautypic = M('beautypic')->where($bp)->order('id desc')->limit(7)->select();
        $this->assign('beautypic',$beautypic);
		
        $this->display();
    }
	public function tousu(){
        if(IS_POST){
            $list=I('post.');
            $add['uid ']=session('user');
            $add['tid ']=$list['id'];
            $add['name']=$list['name'];

            $add['content']=$list['content'];
            $add['icon ']=$list['icon'];
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