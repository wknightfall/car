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
class TranspotController extends HomeController
{
    public function _initialize()
    {
        $nav = M('category')->where('pid=47')->order('sort asc')->select();
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
            $start = ($list['page'] * 4);

            $arr[status] = 1;
            $article = M('food')->where($arr)->order('id desc')->limit($start, 4)->select();
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
                <p></p>
                <img src="' . picture($v['icon']) . '" alt="">
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

            $food = M('food')->where($adarr)->order('sort asc')->limit(4)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='food';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='food';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);
            $this->assign('type','index');

            $this->display();
        }

    }
    public function car(){
        $adarr[status] = 1;
        if (isset($_GET['date1'])) {
            $date1 = strtotime($_GET['date1']);
            $where['time'] = array('gt', $date1);

            $this->assign('state', 2);
        }
        if (isset($_GET['date2'])) {
            $date2 = strtotime($_GET['date2']);
            $where['time'] = array('lt', $date2);
            $this->assign('state', 2);
            $where['time'] = array(array('gt', $date1),array('lt', $date2));
        }
        $car= M('specialcar')->where($adarr)->limit(4)->select();
        /*foreach ($car as $k => $v) {

            $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
            $food[$k]['collection']=$collection;

            $collectionnum=M('collection')->where($col)->count();
            $food[$k]['collectionnum']=$collectionnum;
        }*/
        $this->assign('car', $car);


        $this->display();


    }
    public function cardetail(){

           

            $adarr[status] = 1;
            $adarr[id] = $_GET['id'];
            $car= M('specialcar')->where('id='.$_GET['id'])->find();
            /*foreach ($food as $k => $v) {

                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }*/
            $this->assign('car', $car);


            $this->display();


    }
    public function plane(){
         $this->display();

    }
    public function train(){
        $this->display();

    }




}