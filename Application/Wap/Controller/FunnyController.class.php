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
class FunnyController extends HomeController
{
    public function _initialize()
    {header("Content-type:text/html;charset=utf-8");
        $nav = M('category')->where('pid=50')->order('sort asc')->select();
        foreach($nav as $k=>$v){
            $nav[$k]['href']=U($v['url'],array('navid'=>$v['id']));
        }
        $this->assign('nav',$nav);//dump($nav) ;
        $this->assign('navid',$_GET['navid']);

        parent::_initialize();
    }
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $article = M('festival')->where($arr)->order('sort asc')->limit($start,10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=festival').'">
                <img src="'.picture($v['icon']).'" alt="">
            </a>
            <p>'.$v['name'].'</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>举办地址：</i>
                    <em>'.$v['actaddr'].'</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/aa_tim11.png" alt="">
                    <i>节庆时间：</i>
                    <em>'.$v['acttime'].'</em>
                </li>
            </ul>
        </li>';


                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('festival')->where($adarr)->order('sort asc')->limit(10)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }

    }

    public function act(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;

            $article = M('act')->where($arr)->order('sort asc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=act').'">
                <img src="'.picture($v['icon']).'" alt="">
            </a>
            <p>'.$v['name'].'</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>演出地址：</i>
                    <em>'.$v['actaddr'].'</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/aa_tim11.png" alt="">
                    <i>演出时间：</i>
                    <em>'.$v['acttime'].'</em>
                </li>
            </ul>
        </li>';

                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('act')->where($adarr)->order('sort asc')->limit(10)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }
    }
    public function habit(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;

            $article = M('habit')->where($arr)->order('sort asc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='
                    <li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=habit').'">
                <img src="'.picture($v['icon']).'" alt="">
            </a>
            <div>
                <p>'.$v['name'].'</p>
                <i>'.$v['content'].'</i>
            </div>
        </li>';


                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('habit')->where($adarr)->order('sort asc')->limit(10)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }


    }
    public function sport(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;

            $article = M('sport')->where($arr)->order('sort asc')->limit($start,10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=sport').'">
                <img src="'.picture($v['icon']).'" alt="">
            </a>
            <p>'.$v['name'].'</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>比赛地址：</i>
                    <em>'.$v['sportaddr'].'</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/aa_tim11.png" alt="">
                    <i>比赛时间：</i>
                    <em>'.$v['sporttime'].'</em>
                </li>
            </ul>
        </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('sport')->where($adarr)->order('sort asc')->limit(10)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);
          

            $this->display();
        }


    }
    public function addr(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;

            $article = M('funaddr')->where($arr)->order('sort asc')->limit($start,10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=funaddr').'">
                <img src="'.picture($v['icon']).'" alt="">
            </a>
            <p>'.$v['name'].'</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>所在地址：</i>
                    <em>'.$v['addr'].'</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/aa_tim11.png" alt="">
                    <i>联系电话：</i>
                    <em>'.$v['tel'].'</em>
                </li>
            </ul>
        </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('funaddr')->where($adarr)->order('sort asc')->limit(10)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }


    }

}