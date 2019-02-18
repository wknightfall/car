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
class ScenicController extends HomeController
{
    public function _initialize()
    {
        $nav = M('category')->where('pid=48')->order('sort asc')->select();
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
            $arr[isshop] = 0;
            $article = M('scenic')->where($arr)->order('id desc')->limit($start, 8)->select();
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
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=scenic') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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
            $this->assign('indexnav', 2);

            $adarr[status] = 1;
            $adarr[isshop] = 0;
            $food = M('scenic')->where($adarr)->order('id desc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='scenic';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='scenic';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);
            

            $this->display();
        }

    }

    public function route(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;

            $article = M('route')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='route';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='route';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=route') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('route')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='route';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='route';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);
            

            $this->display();
        }
    }
    public function rural(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $arr[isrural] = 1;
            $arr[isshop] = 0;
            $article = M('scenic')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid'] = $v['id'];
                    $com['type'] = 'scenic';
                    $pl = M('comment')->where($com)->count();
                    $article[$k]['pl'] = $pl;

                    $col['tid'] = $v['id'];
                    $col['type'] = 'scenic';
                    $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
                    $article[$k]['collection']=$collection;

                    $collectionnum = M('collection')->where($col)->count();
                    $article[$k]['collectionnum'] = $collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=scenic') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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
            $this->assign('indexnav', 2);

            $adarr[status] = 1;
            $adarr[isrural] = 1;
            $adarr[isshop] = 0;
            $food = M('scenic')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='scenic';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='scenic';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }


    }
    public function tourist(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;

            $article = M('tourist')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                $cpy=M('travelcpy')->where("id=".$v['cid'])->find()['name'];

                    /*$li .= "
                    <li>
            <a href=\"{:U('Food/detail?id='.$vo['id'].'&model=tourist')}\">
                <img src=\"{$vo . icon | picture}\" alt=\"\"></a>
            <span>
                <p><em>{$vo . name}</em><i>
                        <if condition=\"$vo.star eq 1\"><img src=\"__IMG__/star1.png\" style='width:120px' alt=\"\">
                            <elseif condition=\"$vo.star eq 2\"/><img src=\"__IMG__/star2.png\" style='width:120px'alt=\"\">
                            <elseif condition=\"$vo.star eq 3\"/><img src=\"__IMG__/star3.png\" style='width:120px'alt=\"\">
                            <elseif condition=\"$vo.star eq 4\"/><img src=\"__IMG__/star4.png\" style='width:120px'alt=\"\">
                            <elseif condition=\"$vo.star eq 5\"/><img src=\"__IMG__/star5.png\" style='width:120px' alt=\"\">
                        </if>
                    </i>
                </p>
                <p><i>任职单位：</i>{$vo . cid | modelField = 'travelcpy','name'}</p>
                <p><i>入行简介：</i>{$vo . description}</p>
            </span>
        </li>
                    ";*/

                    $li .='<li>
                <a href="'.U('Food/detail?id='.$v['id'].'&model=tourist').'"><img src="' . picture($v['icon']) . '" alt=""></a>
               <span>
                   <p><em>' . $v['name'] . '</em><i>';
                    $img='';

                   if($v['star']==1){
                       $img='<img src="/Public/Wap/image/star1.png" style="width:120px" alt="">';
                    }elseif($v['star']==2){
                       $img='<img src="/Public/Wap/image/star2.png" style="width:120px" alt="">';
                   }elseif($v['star']==3){
                       $img='<img src="/Public/Wap/image/star3.png" style="width:120px" alt="">';
                   }elseif($v['star']==4){
                       $img='<img src="/Public/Wap/image/star4.png" style="width:120px" alt="">';
                   }elseif($v['star']==5){
                       $img='<img src="/Public/Wap/image/star5.png" style="width:120px" alt="">';
                   }
                    $li.=$img;
                   $li.='</i></p>
                
                       <p><i>任职单位：</i>' . $cpy . '</p>
                       <p><i>入行简介：</i>' . $v['description'] . '</p>
                  
               </span>
            </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('tourist')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {

               /* $arr=array();
                for($i=0;$i<$v['star'];$i++){

                    $food[$k]['star'][]=array(array());
                }*/
            }
            $this->assign('food', $food);
            $this->assign('type','res');

            $this->display();
        }


    }
    public function travelcpy(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 4);

            $arr[status] = 1;

            $article = M('travelcpy')->where($arr)->order('id desc')->limit($start, 4)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li.='
                    <li>
            <a href="'.U('Food/detail?id='.$v['id'].'&model=travelcpy').'">
                <img src="' . picture($v['icon']) . '" alt="">
            </a>
            <p>'. $v['name'] . '</p>
            <ul>
                <li>
                    <img src="/Public/Wap/image/icon/adds.png" alt="">
                    <i>旅行社地址：</i>
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

            $food = M('travelcpy')->where($adarr)->order('sort asc')->limit(4)->select();
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



            $this->display('cpy');
        }


    }
}