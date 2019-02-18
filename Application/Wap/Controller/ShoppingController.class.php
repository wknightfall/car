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
class ShoppingController extends HomeController
{
    public function _initialize()
    {
        $nav = M('category')->where('pid=49')->order('sort asc')->select();
        foreach($nav as $k=>$v){
            $nav[$k]['href']=U($v['url'],array('navid'=>$v['id']));
        }
        $this->assign('nav',$nav);
        $this->assign('navid',$_GET['navid']);

        parent::_initialize();
    }
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('specialgoods')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='specialgoods';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='specialgoods';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=specialgoods') . '"><img src="'.picture($v['icon']).'" alt=""></a>
                            <span>
                                <p>' . $v['name'] . '</p>
                                <i>' . $v['content'] . '</i>
                            </span>
                            <div>
                                <p><img src="/Public/Wap/image/icon/aaa_seee.png" alt="">'.$v['view'].'</p>
                                <p><img src="/Public/Wap/image/icon/aa_ssoo.png" alt="">'.$article[$k]['pl'].'</p>';
                    if($collection){
                        $li.='<p><img src="/Public/Wap/image/icon/hert.png" class="icon2" data-id="{$vo.id}" ><i>'.$article[$k]['collectionnum'].'</i></p>';
                    }else{
                        $li.='<p><img src="/Public/Wap/image/icon/aattt.png" class="icon2" data-id="{$vo.id}" ><i>'.$article[$k]['collectionnum'].'</i></p>';
                    }
                    $li.='</div></li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {


            $adarr[status] = 1;

            $food = M('specialgoods')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='specialgoods';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='specialgoods';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }

    }

    public function guide(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('shopguide')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='shopguide';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='shopguide';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=shopguide') . '"><img src="'.picture($v['icon']).'" alt=""></a>
                            <span>
                                <p>' . $v['name'] . '</p>
                                <i>' . $v['content'] . '</i>
                            </span>
                            <div>
                                <p><img src="/Public/Wap/image/icon/aaa_seee.png" alt="">'.$v['view'].'</p>
                                <p><img src="/Public/Wap/image/icon/aa_ssoo.png" alt="">'.$article[$k]['pl'].'</p>';
                    if($collection){
                        $li.='<p><img src="/Public/Wap/image/icon/hert.png" class="icon2" data-id="{$vo.id}" ><i>'.$article[$k]['collectionnum'].'</i></p>';
                    }else{
                        $li.='<p><img src="/Public/Wap/image/icon/aattt.png" class="icon2" data-id="{$vo.id}" ><i>'.$article[$k]['collectionnum'].'</i></p>';
                    }
                    $li.='</div></li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {


            $adarr[status] = 1;

            $food = M('shopguide')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='shopguide';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='shopguide';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }

    }
    public function addr(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 3);

            $arr[status] = 1;
            $article = M('shoppingaddr')->where($arr)->order('sort asc')->limit($start,3)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
                        <a href="'.U('Food/detail?id='.$v['id'].'&model=shoppingaddr').'">
                            <img src="'.picture($v['icon']).'" alt="">
                        </a>
                        <p>'.$v['name'].'</p>
                        <ul>
                            <li>
                                <img src="/Public/Wap/image/icon/adds.png" alt="">
                                <i>店铺地址：</i>
                                <em>'.$v['addr'].'</em>
                            </li>
                            <li>
                                <img src="/Public/Wap/image/icon/aphon.png" alt="">
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

            $food = M('shoppingaddr')->where($adarr)->order('sort asc')->limit(3)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }



    }
    
    public function cheap(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 6);

            $arr[status] = 1;
            $article = M('shoppingaddr')->where($arr)->order('sort asc')->limit($start,6)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {


                    $li.='
                    <li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=shoppingaddr').'">
                <img src="' . picture($v['icon']) . '" alt="">
            </a>
            <p>'. $v['name'] . '</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>店铺地址：</i>
                    <em>' . $v['addr'] . '</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/aphon.png" alt="">
                    <i>联系电话：</i>
                    <em>' . $v['tel'] . '</em>
                </li>
                <li>
                    <img src="/Public/Wap/image/icon/activ.png" alt="">
                    <i>活动：</i>
                    <em>' . $v['activity'] . '</em>
                </li>
            </ul>
        </li>
                    ';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('shoppingaddr')->where($adarr)->order('sort asc')->limit(6)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);
            $this->assign('type','index');

            $this->display();
        }



    }
    public function talent(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;

            $article = M('talent')->where($arr)->order('id desc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']=$list['type'];
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']=$list['type'];
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    //$article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .= '<li>
                <p>
                <img src="' . picture($v['icon']) . '" alt=""></p>
                <div>
                    <em>' . $v['name'] . '</em>
                    <p>' . $v['content'] . '</p>
                </div>
                <span>
                    <p class="jdll">'.$v['view'].'</p>
                    <p class="jdpl">'.$article[$k]['pl'].'</p>';
                    if($collection){

                        $li.='<p class="jddz icon2" data-id="'.$v['id'].'" style="background: url(/Public/Home/img/gud/ligcjj_03.jpg) no-repeat center;background-position:28px;background-size:16px 14px" >'.$article[$k]['collectionnum'].'</p>';
                    }else{
                        $li.='<p class="jddz icon2" data-id="'.$v['id'].'" style="background: url(/Public/Home/img/gud/dtjg_05.jpg) no-repeat center;background-position:28px;background-size:16px 14px" >'.$article[$k]['collectionnum'].'</p>';
                    }


                    $li.='</span></li>';
                    //$li.='<li class="col-md-12" id="'.$v['id'].'" onclick="location.href='.U('Index/intro?id='.$v['id']).'"><div class="fix"><div class="col-sm-2 nosN1"><a href="Home/Index/intro/id/'.$v['id'].'"><img src="'.picture($v['icon']).'"></a></div><div class="col-sm-10 nosN2"><h2><a href="'.U('Index/intro?id='.$v['id']).'" style="color:#000">'.$v['name'].'</a></h2><div class="ln-1 ln-1jh fix"><span class="vip">'.system_users($v['author'],'name').'</span>'.$ll.'</div><div class="ln-2 ln-2jh"><a href="Home/Index/intro/id/'.$v['id'].'">'.$v['text'].'</a></div><div class="ln-3 ln-3jh"><div class="ln-3ic"><a class="icn1" href="javascript:void(0);">'.$v['browsingvolume'].'</a><a class="icn2" href="javascript:void(0);">'.$collection.'</a><a class="icn3" href="javascript:void(0);">'.$comment.'</a></div><div class="ln-ft">'.date('Y-m-d',$v['time']).'</div><div class="ln-cnts"><a href="javascript:delcollection('.$v['cid'].','.$v['id'].')">取消收藏</a> </div></div></div></div></li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('talent')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='talent';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='talent';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);



            $this->display();
        }


    }
}