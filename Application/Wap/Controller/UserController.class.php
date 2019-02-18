<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wap\Controller;
use Home\AjaxUpload;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class UserController extends HomeController
{
    public function _initialize()
    {
        if(empty(session('user'))){
            $this->redirect('index/index');
        }
        parent::_initialize();
    }
    public function index1(){
    if (IS_POST) {
        $list = I('post.');
        $start = ($list['page'] * 4);

        $arr[status] = 1;
        $article = M('usermember')->where($arr)->order('id desc')->limit($start, 4)->select();
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
                <a href="' . U('Home/House/hoteldetail?id=' . $v["id"]) . '"><img src="' . picture($v['icon']) . '" alt=""></a></p>
                <div>
                    <em>' . $v['name'] . '</em>
                    <p>' . $v['description'] . '</p>
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

        $food = M('hotel')->where($adarr)->order('sort asc')->limit(4)->select();
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
    public function fatie(){
        $this->display();
    }
    public function fapinlun(){

        if(isset($_GET['edit'])){
            $comment=M('comment')->where("id=".$_GET['plid'])->find();
            $this->assign('comment',$comment);
        }

        $this->display();


    }
    public function edit(){
        if (IS_POST) {
            $list = I('post.');
            $arr[name] = $list['name'];
            $arr[detail] = $list['content'];
            $article = M('discuz')->where("id=".$list['id'])->save($arr);
            if ($article) {
                exit(json_encode(array('code' => 200 )));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $article = M('discuz')->where("id=" . $_GET['id'])->find();
            $this->assign('vo', $article);
            $this->display();
        }
    }
    public function luntan(){
        if (IS_POST) {
            $list = I('post.');
            if($list['type']=='del') {
                $arr[id] = $list['id'];
                $article = M('discuz')->where($arr)->delete();
                if ($article) {
                    exit(json_encode(array('code' => 200)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{
                $where[uid] = session('user');
                $where[status] = 1;

              
                $start = ($list['page'] * 5);
                $article = M('discuz')->where($where)->order('id desc')->limit($start, 5)->select();
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $com['tid'] = $v['id'];
                        $com['type'] = 'discuz';
                        $pl = M('comment')->where($com)->count();
                        $article[$k]['pl'] = $pl;
                        if ($pl == 0) {
                            $article[$k]['lasttime'] = 0;
                        } else {
                            $article[$k]['lasttime'] = M('comment')->where($com)->order("time desc")->find()['time'];
                        }

                        $li.='<li>
                            <p><a href="' . U('user/luntandetail?id=' . $v['id'] .'&type=1') . '" style="color:#676767">' . $v['name'] . '</a></p>
                            <em>
                                <i><a href="javascript:">' . $article[$k]['pl'] . '回应</a></i>';
                            if($article[$k]['lasttime'] == 0){
                                $li.='<i>暂无回应</i>';
                            }else{
                                $li.='<i>'.format_date($article[$k]['lasttime']).'</i>';
                            }
                         $li.='</em> </li>';


                    }
                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }


        } else {

            $where[uid] = session('user');
            $where[status] = 1;
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

            $listsCount = M('discuz')->where($where)->count();
            $lists = M('discuz')->where($where)->order('id desc')->limit(8)->select();
            foreach ($lists as $k => $v) {
                $com['tid'] = $v['id'];
                $com['type'] = 'discuz';
                $pl = M('comment')->where($com)->count();
                $lists[$k]['pl'] = $pl;
                if ($pl == 0) {
                    $lists[$k]['lasttime'] = 0;
                } else {
                    $lists[$k]['lasttime'] = M('comment')->where($com)->order("time desc")->find()['time'];
                }

            }
            $this->assign('lists', $lists);
            $this->assign('listsCount', $listsCount);

            $this->display();
        }
    }
    public function gentie(){
        if (IS_POST) {
            $list = I('post.');
            if($list['type']=='del') {
                $arr[id] = $list['id'];
                $article = M('discuz')->where($arr)->delete();
                if ($article) {
                    exit(json_encode(array('code' => 200)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{

                $where[status] = 1;
                $where[uid] = session('user');
                $where[type] = 'discuz';
                $re = M('comment')->where($where)->group('tid')->order('tid asc')->select();
                $ids = implode(',', array_column($re, 'tid'));

                $w[id] = array('in', $ids);

                $start = ($list['page'] * 5);
                $article =  M('discuz')->where($w)->order('id desc')->limit($start, 5)->select();
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $com['tid'] = $v['id'];
                        $com['type'] = 'discuz';
                        $pl = M('comment')->where($com)->count();
                        $article[$k]['pl'] = $pl;
                        if ($pl == 0) {
                            $article[$k]['lasttime'] = 0;
                        } else {
                            $article[$k]['lasttime'] = M('comment')->where($com)->order("time desc")->find()['time'];
                        }
                        $li='<li>
                            <p><a href="' . U('user/luntandetail?id=' . $v['id'] .'&type=2') . '" style="color:#676767">' . $v['name'] . '</a></p>
                            <em>
                                <i><a href="javascript:">'.modelField($v['uid'],'usermember','name').'</a></i>
                                <i><a href="javascript:">' . $article[$k]['pl'] . '回应</a></i>
                                <i>'.format_date($article[$k]['lasttime']).'</i>
                            </em>
                            <p class="list_nnr">
                                ' . mb_substr($v['content'],0,60) . '
                            </p>
                        </li>';

                    }
                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }


        } else {


            $where[status] = 1;
            $where[uid] = session('user');
            $where[type] = 'discuz';

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
            $re = M('comment')->where($where)->group('tid')->order('tid asc')->select();
            $ids = implode(',', array_column($re, 'tid'));

            $w[id] = array('in', $ids);

            $listsCount = M('discuz')->where($w)->count();


            $lists = M('discuz')->where($w)->order('id desc')->limit(5)->select();
            foreach ($lists as $k => $v) {
                $whe[tid] = $v['id'];
                $whe[type] = 'discuz';

                $pl = M('comment')->where($whe)->count();
                $last = M('comment')->where($whe)->order('time desc')->find();
                $lists[$k]['pl'] = $pl;
                $lists[$k]['lasttime'] = $last['time'];
                $lists[$k]['content'] = mb_substr($v['content'], 0, 45);


            }
            $this->assign('lists', $lists);
            $this->assign('listsCount', $listsCount);


            $this->display();
        }
    }
    public function luntandetail(){
        if (IS_POST) {
            $list = I('post.');




        } else {
            $this->assign('type',$_GET['type']);
            
            $tiezi=M('discuz')->where("id=".$_GET['id'])->find();
            
                $com['tid'] = $_GET['id'];
                $com['type'] = 'discuz';
                $pl = M('comment')->where($com)->count();
                $tiezi['pl'] = $pl;
                if ($pl == 0) {
                    $tiezi['lasttime'] = 0;
                } else {
                    $tiezi['lasttime'] = M('comment')->where($com)->order("time desc")->find()['time'];
                }

            
            $this->assign('tiezi',$tiezi);
            $this->display();
        }

    }
    public function congzhi(){
        

        $this->display();
    }
    public function tixian(){
        $twoid = I('request.twoid',14,'intval');
        $this->assign('twoid',$twoid);

        $where[uid] = session('user');
        $where[status] = 1;

        $listsCount =  M('discuz')->where($where)->count();
        $p = getpage($listsCount,6);
        $p ->setConfig('prev','上一页');
        $p-> setConfig('next','下一页');

        $show = $p->showHome();

        $lists =  M('discuz')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

        $this->assign('lists',$lists);
        $this->assign('listsCount',$listsCount);
        if($listsCount>6){
            $this->assign('page',$show);
        }

        $this->display();
    }
    public function dingdan(){
        if (IS_POST) {
            $list = I('post.');
            if($list['type']=='del'){
                $arr[id] = $list['id'];
                $article = M('order')->where($arr)->save(array('isuserdel'=>1));
                if ($article) {
                    exit(json_encode(array('code' => 200 )));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{

                $state = $list['state'];
                if ($state == 0 || $state == 1) {
                    $arr['state'] = array('eq', $state);
                }

                $start = ($list['page'] * 4);

                $arr[status] = 1;
                $article = M('order')->where($arr)->order('id desc')->limit($start, 4)->select();
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $hotel = M('usermember')->where("id=" . $v['hid'])->find();
                        $goodsid= M('orderdetail')->where("orderno=" . $v['orderno'])->find()['goodsid'];
                        $s = M('room')->where("id=" .$goodsid)->find();

                        if($hotel['shoptype']==3){

                            $article[$k]['name'] = $s['name'];
                            $article[$k]['content'] = mb_substr($s['content'],0,60);
                            $article[$k]['icon'] = $s['icon'];

                            $article[$k]['shopid'] = $s['id'];
                        }else{
                            $article[$k]['name'] = $hotel['name'];
                            $article[$k]['content'] = mb_substr($hotel['content'],0,60);
                            $article[$k]['icon'] = $hotel['icon'];

                            $article[$k]['shopid'] = $hotel['id'];
                        }
                        $article[$k]['shoptype'] = $hotel['shoptype'];
                        
                        $li.='<li>
                        <p class="list_tt">
                            <i>订单号:' . $v['orderno'] . '</i>';

                            if($v['state']==1){
                                $li.=' <em>已付款</em>';
                            }else{
                                $li.='<em class="daifu">待付款</em>';
                            }


                        $li.='</p>
                            <span class="list_ma">
                                <img src="'.picture($article[$k]['icon']).'" alt="">
                                <span>
                                    <p>' . $article[$k]['name'] . '</p>
                                    <p>' . $article[$k]['content'] . '</p>
                                    <em>
                                       
                                        <i>数量：' . $v['num'] . '</i>
                                    </em>
                                </span>
                            </span>
            
                            <p class="list_ft">
                                <i>订单金额：<em>￥' . $v['money'] . '</em></i>';

                        if($v['state']==1){
                            $li.='<span><input type="button" value=" 去评价" class="gopinlun" data-id="' . $article[$k]['shopid'] . '" shoptype="'.$article[$k]['shoptype'].'"></span>';
                        }else{
                            $li.=' <span>
                                    <input type="button" value="取消订单" data-id="' . $v['id'] . '" class="delorder" >
                                    <input type="button" value="付款" class="ovfuk payorder" orderno="' . $v['orderno'] . '" shoptype="'.$article[$k]['shoptype'].'" scenicid="'.$article[$k]['shopid'].'" >
                                    </span>';
                        }
                        $li.='</p></li>';


                    }

                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }
            
        } else {

            $state = $_GET['state'];
            $this->assign('state', $state);
            if (isset($_GET['state'])) {
                if ($_GET['state'] == 0 || $_GET['state'] == 1) {
                    $where['state'] = array('eq', $state);
                }
            }

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


            $where[uid] = array('eq', session('user'));
            $where['isuserdel'] = array('eq', 0);
            $where['actiontype'] = array('eq', 3);
            $lists = M('order')->where($where)->order('id desc')->limit(4)->select();
            foreach ($lists as $k => $v) {
                $hotel = M('usermember')->where("id=" . $v['hid'])->find();
                $goodsid= M('orderdetail')->where("orderno=" . $v['orderno'])->find()['goodsid'];
                $s = M('room')->where("id=" .$goodsid)->find();

                if($hotel['shoptype']==3){

                    $lists[$k]['name'] = $s['name'];
                    $lists[$k]['content'] = mb_substr($s['content'],0,60);
                    $lists[$k]['icon'] = $s['icon'];

                    $lists[$k]['shopid'] = $s['id'];
                }else{
                    $lists[$k]['name'] = $hotel['name'];
                    $lists[$k]['content'] = mb_substr($hotel['content'],0,60);
                    $lists[$k]['icon'] = $hotel['icon'];

                    $lists[$k]['shopid'] = $hotel['id'];
                }
                $lists[$k]['shoptype'] = $hotel['shoptype'];


            }
            $this->assign('lists', $lists);
            //dump($lists);


            $this->display('');
        }
    }
    public function pl(){
        if (IS_POST) {
            $list = I('post.');
            if($list['type']=='del') {
                $arr[id] = $list['id'];
                $article = M('comment')->where($arr)->delete();
                if ($article) {
                    exit(json_encode(array('code' => 200)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{
                $where[uid] = session('user');
                $where[status] = 1;
                $where[type] = array('in','1,2,3');

                $pl=$list['pl'];
                if ($pl == 0) {
                    //$where['icon'] = array('gt', 0);
                } elseif ($pl == 1) {
                    $where['star'] = array('egt', 4);
                } elseif ($pl == 2) {
                    $where['star'] = array(array('lt', 4),array('egt', 2));

                } elseif ($pl == 3) {
                    $where['star'] = array('lt', 2);
                }
                $start = ($list['page'] * 6);
                $article = M('comment')->where($where)->order('id desc')->limit($start, 6)->select();
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                       $hotel = M('usermember')->where("id=" . $v['uid'])->find();
                        $article[$k]['name'] = $hotel['name'];

                        $article[$k]['icon'] = $hotel['icon'];

                      $li.='
                      <li>
                <img src="'.picture($article[$k]['icon']).'"  style="border-radius: 50%">
                <span class="pllis_pp">
                    <p>
                        <i>
                            '.$article[$k]['name'].'
                        </i>
                        <em>
                            <input type="button" value="编辑" class="editcomment" data-id="'.$v['id'].'">
                            <input type="button" value="删除" class="delcomment" data-id="'.$v['id'].'">
                        </em>
                    </p>
                    <p>
                        <i>';
                        $img='';

                        if($v['star']==1){
                            $img='<img src="/Public/Wap/image/star1.png" style="width:75px" alt="">';
                        }elseif($v['star']==2){
                            $img='<img src="/Public/Wap/image/star2.png" style="width:75px" alt="">';
                        }elseif($v['star']==3){
                            $img='<img src="/Public/Wap/image/star3.png" style="width:75px" alt="">';
                        }elseif($v['star']==4){
                            $img='<img src="/Public/Wap/image/star4.png" style="width:75px" alt="">';
                        }elseif($v['star']==5){
                            $img='<img src="/Public/Wap/image/star5.png" style="width:75px" alt="">';
                        }
                        $li.=$img;
                            
                              $li.='<span>'.$v['star'].'</span>
                        </i>
                        <em>'.date('Y-m-d',$v['time']).'</em>
                        </p>
                        <i>
                            '.$v['content'].'
                        </i>
                            </span>
                        </li>';
                      }
                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }


        } else {
            $where[uid] = session('user');
            $where[status] = 1;
            $where[type] = array('in','1,2,3');
            $listsCount = M('comment')->where($where)->count();
            $this->assign('total', $listsCount);

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
            if (isset($_GET['pl'])) {
                $pl = $_GET['pl'];
                $this->assign('pl', $pl);
                if ($pl == 0) {
                    //$where['icon'] = array('gt', 0);
                } elseif ($pl == 1) {
                    $where['star'] = array('egt', 4);
                } elseif ($pl == 2) {
                    $where['star'] = array(array('lt', 4),array('egt', 2));

                } elseif ($pl == 3) {
                    $where['star'] = array('lt', 2);
                }
            }
            $p['icon']=array('gt', 0);
            $g['star']=array('egt', 4);
            $m['star']=array('lt', 4);
            $m['star']=array('egt', 2);
            $b['star']=array('lt', 2);
            $good =  M('comment')->where($where)->where($g)->count();
            //$middle =  M('comment')->where($where)->where($m)->count();
            $bad =  M('comment')->where($where)->where($b)->count();
            $middle =$listsCount-$good-$bad;
            $this->assign('good', $good);
            $this->assign('middle', $middle);
            $this->assign('bad', $bad);

            $lists = M('comment')->where($where)->order('id desc')->limit(6)->select();
            foreach ($lists as $k => $v) {
                $whe[id] = $v['uid'];

                $re =  M('usermember')->where($whe)->find();
                $lists[$k]['usericon'] = $re['icon'];
               /* if($v['type']==3){
                    $re =  M('room')->where('id='.$v['tid'])->find();

                }*/




               /* $lists[$k]['icon'] = $re['icon'];
                $lists[$k]['name'] = $re['name'];
                $lists[$k]['content'] = mb_substr($re['content'],0,90);*/


            }
            $this->assign('lists', $lists);
           

            $this->display('');
        }
    }
    public function rest(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 12);

            if (isset($list['date1'])) {
                $date1 = strtotime($list['date1']);
                $where['time'] = array('gt', $date1);


            }
            if (isset($list['date2'])) {
                $date2 = strtotime($list['date2']);
                $where['time'] = array('lt', $date2);
                $this->assign('state', 2);
                $where['time'] = array(array('gt', $date1),array('lt', $date2));
            }
            $where[uid] = session('user');
                $article = M('water')->where($where)->order('id desc')->limit($start, 12)->select();
                if ($article) {
                    $li='';

                    foreach ($article as $k => $v) {
                        if ($v['type'] == 1) {
                            $article[$k]['payment'] = '充值';
                        } elseif ($v['type'] == 2) {
                            $article[$k]['payment'] = '提现';
                        } elseif ($v['type'] == 3) {
                            $article[$k]['payment'] = '消费';
                        }
                       if($v['income'==1]){
                           $li.='<li><p><i class="txz">+'.$v['money'].'</i><em>'.$article[$k]['payment'].'</em></p>
                                <p><i class="txz">申请成功</i><em>'.date('Y-m-d h:i',$v['time']).'</em></p></li>';
                       }else{
                           $li.='<li>
                                <p><i class="xfcg">-'.$v['money'].'</i><em>'.$article[$k]['payment'].'</em></p>
                                <p><i>消费成功</i><em>'.date('Y-m-d h:i',$v['time']).'</em></p></li>';
                       }
                      

                    }
                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }



        } else {

            if (isset($_GET['date1'])) {
                $date1 = strtotime($_GET['date1']);
                $where['time'] = array('gt', $date1);
            }
            if (isset($_GET['date2'])) {
                $date2 = strtotime($_GET['date2']);
                $where['time'] = array('lt', $date2);
                $where['time'] = array(array('gt', $date1), array('lt', $date2));
            }


            $where[uid] = session('user');
            $where[state] = 1;

            $listsCount = M('water')->where($where)->count();


            $lists = M('water')->where($where)->order('id desc')->limit(12)->select();

            foreach ($lists as $k => $v) {
                if ($v['type'] == 1) {
                    $lists[$k]['payment'] = '充值';
                    
                } elseif ($v['type'] == 2) {
                   
                    $lists[$k]['payment'] = '提现';
                } elseif ($v['type'] == 3) {

                    $lists[$k]['payment'] = '消费';
                   
                }
            }
            $this->assign('lists', $lists);

            
            $this->display();
        }
    }
   
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $newicon=$list['icon'];
            $newname=$list['name'];
           $user=M('usermember')->where("id=".session('user'))->find();
            if($newicon != $user['icon']){
                $data['icon']=$newicon;
            }
            if($newname != $user['name']){
                $data['name']=$newname;
            }
            if (M('usermember')->where("id=".session('user'))->save($data)) {
                exit(json_encode(array('code' => 200, 'msg'=>'修改成功' )));
            } else {
                exit(json_encode(array('code' => 400, 'msg'=>'修改失败')));
            }
        } else {


            $this->display();
        }

    }

    public function geren()
    {
        if (IS_POST) {
            $list = I('post.');
            $newicon = $list['icon'];
            $newname = $list['name'];
            $user = M('usermember')->where("id=" . session('user'))->find();
            if ($newicon != $user['icon']) {
                $data['icon'] = $newicon;
            }
            if ($newname != $user['name']) {
                $data['name'] = $newname;
            }
            if (M('usermember')->where("id=" . session('user'))->save($data)) {
                exit(json_encode(array('code' => 200, 'msg' => '修改成功')));
            } else {
                exit(json_encode(array('code' => 400, 'msg' => '修改失败')));
            }
        } else {


            $this->display();
        }

    }
    public function verify(){
        $verify = new \Think\Verify();
        $verify->length   = 3;
        $verify->entry(1);
    }



    public function upload(){

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'Picture/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $arr = array('code'=>201,'msg'=>$upload->getError());
            $this->ajaxReturn($arr);
        }else{// 上传成功
            $path = "/Uploads/".$info['file']['savepath'].$info['file']['savename'];
            $file = file_get_contents('.'.$path);
            $where['sha1'] = array('eq',sha1($file));
            $where['md5'] = array('eq',md5($file));
            $vo = M('picture')->where($where)->find();
            if(!empty($vo)){
                @unlink('.'.$path); //删除图片路径
                $arr = array('code'=>200,'path'=>$vo['path'],'icon'=>$vo['id']);
            }else{
                $data['sha1'] = $info['file']['sha1'];
                $data['md5']  = $info['file']['md5'];
                $data['create_time'] = time();
                $data['path'] = $path;
                $res = M('picture')->add($data);
                if($res){
                    $arr = array('code'=>200,'path'=>$path,'icon'=>$res);
                }
            }
            $this->ajaxReturn($arr);
        }
    }

    public function uploadicon(){
        $id=session('user');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   = 3145728 ;// 设置附件上传大小
        $upload->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  = 'https://move20170828.oss-cn-shanghai.aliyuncs.com/files/system/avatar/';// 设置附件上传根目录
        if(strlen($id)>3){
            $upload->savePath  = substr($id,0,3);
        }else{
            $upload->savePath  = $id;
        }
        $upload->saveName = $id;/*上传文件的名称*/
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $arr = array('code'=>201,'msg'=>$upload->getError());
            $this->ajaxReturn($arr);
        }else{// 上传成功

            $arr = array('code'=>200,'path'=>"");
            $this->ajaxReturn($arr);
        }
    }

}