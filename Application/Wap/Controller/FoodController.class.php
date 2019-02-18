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
class FoodController extends HomeController
{
    public function _initialize()
    {
        $nav = M('category')->where('pid=45')->order('sort asc')->select();
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
            $article = M('food')->where($arr)->order('sort asc')->limit($start, 8)->select();

            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='food';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='food';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;

                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=food') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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

            $food = M('food')->where($adarr)->order('sort asc')->limit(8)->select();
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


            $this->display();
        }

    }
    public function detail(){
        $id=$_GET['id'];
        $model=$_GET['model'];
        $model=M($model);

        $model->where("id=".$id)->setInc('view');

        $adarr[status] = 1;
        $adarr[tid] = $id;
        $adarr[type] = $_GET['model'];
        $listsCount =  M('comment')->where($adarr)->count();
        $pagesize=3;
        $p = getpage($listsCount,$pagesize);
        $show = $p->showHome();

        if($listsCount>$pagesize){
            $this->assign('page',$show);
        }
        $comment = M('comment')->where($adarr)->order('time desc')->limit($p->firstRow . ',' . $p->listRows)->select();
        foreach ($comment as $k => $v) {
            $col['tid']=$v['id'];
            $col['type']=$_GET['model'];
            $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
            $comment[$k]['collection']=$collection;
            $comment[$k]['usericon']=M('usermember')->where("id=".$v['uid'])->find()['icon'];

        }

        $ele=$model->where("id=".$id)->find();

        $col['tid']=$id;
        $col['type']=$_GET['model'];

        $ele['collectionnum']=M('collection')->where($col)->count();
        $ele['pl']=M('comment')->where($col)->count();

        $this->assign('ele',$ele);
        $this->assign('comment',$comment);

        if(isset($_GET['plid'])){
            $this->assign('plcontent',M('comment')->where("id=".$_GET['plid'])->find()['content']);
        }
        $this->display();
    }
    public function dingcan(){
        if (IS_POST) {
            $list = I('post.');
            $id = $list['id'];
            $food = M('room')->where("id=".$id)->find();
            $food['icon']=picture($food['icon']);
            if ($food) {
                exit(json_encode($food));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $id = $_GET['id'];
            $this->assign('id', $id);
            $this->assign('type', $_GET['type']);
            $model = $_GET['model'];

            $model = M($model);

            M('usermember')->where("id=" . $id)->setInc('view');
            $res = M('usermember')->where("id=" . $id)->find();
            $this->assign('res', $res);

            $tao[istao] = 1;
            $tao[issale] = 0;
            $tao[isdel] = 0;
            $tao[hid] = $id;
            $this->assign('tao', M('room')->where($tao)->select());

            $dan[istao] = 0;
            $dan[issale] = 1;
            $dan[isdel] = 0;
            $dan[hid] = $id;
            $this->assign('dan', M('room')->where($dan)->select());


            $adarr['status'] = 1;
            $adarr['tid'] = $id;
            $adarr['type'] = array('eq', 2);
            $total = M('comment')->where($adarr)->count();
            $this->assign('total', $total);


            $p['icon'] = array('gt', 0);
            $g['star'] = array('egt', 4);
            $m1['star'] = array('lt', 4);
            $m2['star'] = array('egt', 2);
            $b['star'] = array('lt', 2);
            $pic = M('comment')->where($adarr)->where($p)->count();
            $good = M('comment')->where($adarr)->where($g)->count();
            //$middle = M('comment')->where($adarr)->where($m1)->where($m2)->count();
            $bad = M('comment')->where($adarr)->where($b)->count();
            $middle = $total-$good-$bad;

            $this->assign('pic', $pic);
            $this->assign('good', $good);
            $this->assign('middle', $middle);
            $this->assign('bad', $bad);


            if (isset($_GET['pl'])) {
                $pl = $_GET['pl'];
                if ($pl == 0) {
                    $adarr['icon'] = array('gt', 0);
                } elseif ($pl == 1) {
                    $adarr['star'] = array('egt', 4);
                } elseif ($pl == 2) {
                    $adarr['star'] = array(array('lt', 4),array('egt', 2));

                } elseif ($pl == 3) {
                    $adarr['star'] = array('lt', 2);
                }
            }

            $listsCount = M('comment')->where($adarr)->count();
            /*$pagesize = 3;
            $p = getpage($listsCount, $pagesize);
            $show = $p->showHome();
            if ($listsCount > $pagesize) {
                $this->assign('page', $show);
            }*/

            $comment = M('comment')->where($adarr)->order('time desc')->select();
            foreach ($comment as $k => $v) {
                $col['tid'] = $v['id'];
                $col['type'] = $_GET['model'];
                $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
                $comment[$k]['collection'] = $collection;

                $user = M('usermember')->where("id=" . $v['uid'])->find();
                $comment[$k]['usericon'] = $user['icon'];
                $comment[$k]['username'] = $user['name'];
            }
            $this->assign('comment', $comment);
            /* $ele=$model->where("id=".$id)->find();

             $col['tid']=$id;
             $col['type']=$_GET['model'];
             $ele['collectionnum']=M('collection')->where($col)->count();
             $ele['pl']=M('comment')->where($col)->count();
             $this->assign('ele',$ele);*/


            $this->display();
        }
    }
    public function danpin(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            /*$room = M('room')->where('id=' . $id)->find();
            $this->assign('room', $room);*/

            $order = M('order')->where('orderno=' . $_GET['orderno'])->find();
            $food = M('orderdetail')->where('orderno=' . $_GET['orderno'])->select();

            $this->assign('food', $food);
            $this->assign('money', $order['money']);
            /*$goodsid = $order['goodsid'];
            if ($goodsid == $id) {
                $this->assign('valid', 1);
            } else {
                $this->assign('valid', 0);
            }*/


        }else{
            
            $where['uid'] = session('user');
            $where['orderno'] = array('eq',$_GET['orderno']);
            $order = M('order')->where($where)->find();
            $money = $order['money'];


            $food = M('orderdetail')->where($where)->select();
            foreach ($food as $k=>$v) {

            }
            $this->assign('food', $food);
            $this->assign('money', $money);
        }
        $room = M('room')->where("id=".$_GET['id'])->find();
       
        $this->assign('room', $room);


        $this->display();

    }
    public function foodpay(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            /*$room = M('room')->where('id=' . $id)->find();
            $this->assign('room', $room);*/

            $order = M('order')->where('orderno=' . $_GET['orderno'])->find();
            $food = M('orderdetail')->where('orderno=' . $_GET['orderno'])->select();

            $this->assign('food', $food);
            $this->assign('money', $order['money']);
            /*$goodsid = $order['goodsid'];
            if ($goodsid == $id) {
                $this->assign('valid', 1);
            } else {
                $this->assign('valid', 0);
            }*/


        }else{
            $where['uid'] = session('user');
            $where['orderno'] = array('eq',$_GET['orderno']);
            
            $order = M('order')->where($where)->find();
            $money = $order['money'];
            $this->assign('money', $money);

            $food = M('orderdetail')->where($where)->select();
            foreach ($food as $k=>$v) {
                $food[$k]['goodsicon']=M('room')->where("id=".$v['goodsid'])->find()['icon'];
            }
            $this->assign('food', $food);
           
        }
        $room = M('usermember')->where("id=".$order['hid'])->find();
        $this->assign('room', $room);


        $this->display();

    }
    public function local(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $arr[islocal] = 1;
            $article = M('food')->where($arr)->order('id desc')->limit($start, 8)->select();
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
                <a href="'.U('Food/detail?id='.$v['id'].'&model=food').'"><img src="' . picture($v['icon']) . '" alt=""></a></p>
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
            $adarr[islocal] = 1;
            $food = M('food')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='local';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='local';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);
            $this->assign('type','local');

            $this->display();
        }
    }
    public function culture(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;

            $article = M('foodculture')->where($arr)->order('id desc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='foodculture';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='foodculture';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=foodculture') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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

            $food = M('foodculture')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']='foodculture';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='foodculture';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }


    }
    public function res(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[state] = 1;
            $arr[shoptype] = 2;
            $article = M('usermember')->where($arr)->order('id asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid'] = $v['id'];
                    $com['type'] = 2;
                    $pl = M('comment')->where($com)->count();
                    $article[$k]['pl'] = $pl;

                    $col['tid'] = $v['id'];
                    $col['type'] = 2;
                    $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
                    $article[$k]['collection']=$collection;

                    $collectionnum = M('collection')->where($col)->count();
                    $article[$k]['collectionnum'] = $collectionnum;
                    $li .='<li>
                           <a href="' . U('food/dingcan?id=' . $v['id'] .'&type=2') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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


            $adarr[state] = 1;
            $adarr[shoptype] = 2;
            $food = M('usermember')->where($adarr)->order('id asc')->limit(8)->select();
            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']=2;
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=array('eq',$v['id']);
                $col['type']=array('eq',2);
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }


    }
    public function talent(){

        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;

            $article = M('talent')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']='talent';
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='talent';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    //$article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('Food/detail?id=' . $v['id'] .'&model=talent') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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