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
class MerController extends HomeController
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
        $article = M('hotel')->where($arr)->order('id desc')->limit($start, 4)->select();
        if ($article) {
            $li = "";
            foreach ($article as $k => $v) {

                $com['tid']=$v['id'];
                $com['type']=$list['type'];
                $pl=M('comment')->where($com)->count();
                $article[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']=$list['type'];
                $collection=M('collection')->where($col)->where("id=".session('user'))->find()? 1:0;
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
            $collection=M('collection')->where($col)->where("id=".session('user'))->find()? 1:0;
            $food[$k]['collection']=$collection;

            $collectionnum=M('collection')->where($col)->count();
            $food[$k]['collectionnum']=$collectionnum;
        }
        $this->assign('food', $food);
        $this->assign('type','index');

        $this->display();
    }

}

    public function edit(){
        if (IS_POST) {
            $list = I('post.');
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
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
    public function fapinlun(){
        $id=$_GET['id'];
        $article = M('room')->where("id=".$id)->find();
        $this->display();


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
                            <p>' . $v['name'] . '</p>
                            <em>
                                <i><a href="javascript:">' . $article[$k]['pl'] . '回应</a></i>';
                        if($article[$k]['lasttime'] == 0){
                            $li.='<li>暂无回应</li>';
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
                $where['create_time'] = array('gt', $date1);

                $this->assign('state', 2);
            }
            if (isset($_GET['date2'])) {
                $date2 = strtotime($_GET['date2']);
                $where['time'] = array('lt', $date2);
                $this->assign('state', 2);
                $where['create_time'] = array(array('gt', $date1),array('lt', $date2));
            }

            $listsCount = M('discuz')->where($where)->count();
            $lists = M('discuz')->where($where)->order('id desc')->limit(5)->select();
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
                            <p>' . $v['name'] . '</p>
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
                $where['create_time'] = array('gt', $date1);

                $this->assign('state', 2);
            }
            if (isset($_GET['date2'])) {
                $date2 = strtotime($_GET['date2']);
                $where['time'] = array('lt', $date2);
                $this->assign('state', 2);
                $where['create_time'] = array(array('gt', $date1),array('lt', $date2));
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
    public function fatie(){
         $this->display();
    }
    public function xiugai(){
        if (IS_POST) {
            $list = I('post.');
            $arr[oldpass] = $list['oldpass'];
            $arr[newpass] = $list['newpass'];
            $user = M('usermember')->where("id=".session('user'))->find();
            if($list['oldpass'] != $user['password']){
                exit(json_encode(array('code'=>401,'msg'=>'密码错误')));
            }
            if(session($user['phone']) != $list['code']){
                exit(json_encode(array('code'=>402,'msg'=>'验证码错误')));
            }
            if (M('usermember')->where("id=".session('user'))->save(array('password'=>$list['newpass']))) {
                exit(json_encode(array('code' => 200,'msg'=>'修改成功' )));
            } else {
                exit(json_encode(array('code' => 400, 'msg'=>'修改失败')));
            }
        } else {


            $this->display();
        }
    }

    public function xiugshouji(){
        if (IS_POST) {
            $list = I('post.');
            if(session($list['phone']) != $list['code']){
                exit(json_encode(array('code'=>402,'msg'=>'验证码错误')));
            }
            if (M('usermember')->where("id=".session('user'))->save(array('phone'=>$list['phone']))) {
                exit(json_encode(array('code' => 200, 'msg'=>'修改成功' )));
            } else {
                exit(json_encode(array('code' => 400, 'msg'=>'修改失败')));
            }
        } else {


            $this->display();
        }
    }
    public function congzhi(){
        $twoid = I('request.twoid',14,'intval');
        $this->assign('twoid',$twoid);

        $where[uid] = session('user');
        $where[status] = 1;
        //分页
        $listsCount =  M('discuz')->where($where)->count();
        $p = getpage($listsCount,6);
        $p ->setConfig('prev','上一页');
        $p-> setConfig('next','下一页');
        $p = getpage($listsCount,6);
        $show = $p->showHome();// 分页显示输出

        $lists =  M('discuz')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

        $this->assign('lists',$lists);
        $this->assign('listsCount',$listsCount);
        if($listsCount>6){
            $this->assign('page',$show);
        }

        $this->display();
    }
    public function tixian(){
        $twoid = I('request.twoid',14,'intval');
        $this->assign('twoid',$twoid);

        $where[uid] = session('user');
        $where[status] = 1;
        //分页
        $listsCount =  M('discuz')->where($where)->count();
        $p = getpage($listsCount,6);
        $p ->setConfig('prev','上一页');
        $p-> setConfig('next','下一页');
        $p = getpage($listsCount,6);
        $show = $p->showHome();// 分页显示输出

        $lists =  M('discuz')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

        $this->assign('lists',$lists);
        $this->assign('listsCount',$listsCount);
        if($listsCount>6){
            $this->assign('page',$show);
        }
        $this->assign('balance', M('usermember')->where("id=".session('user'))->find()['balance']/100);
        $this->display();
    }
    public function dingdan(){
        if (IS_POST) {
            $list = I('post.');
            $arr[id] = $list['id'];
            $type=$list['type'];
            if($type=='del'){
                $article = M('order')->where($arr)->save(array('isshopdel'=>1));
                if ($article) {
                    exit(json_encode(array('code' => 200 ,'msg'=>M('order')->getLastSql())));
                } else {
                    exit(json_encode(array('code' => 400,'msg'=>M('order')->getLastSql())));
                }
            }else if($type=='over'){
                $article = M('order')->where($arr)->save(array('isover'=>1));
                if ($article) {
                    exit(json_encode(array('code' => 200 )));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{
                $state = $list['state'];
                if ($state == 0 || $state == 1) {
                    $whe['state'] = array('eq', $state);
                }
                $start = ($list['page'] * 4);

                $whe[hid] = array('eq', session('user'));
                $whe[isshopdel] = array('eq', 0);
                $whe[actiontype] = 3;

                $article = M('order')->where($whe)->order('id desc')->limit($start, 4)->select();
              
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $hotel = M('usermember')->where("id=" . $v['hid'])->find();
                        $article[$k]['name'] = $hotel['name'];
                        $article[$k]['content'] = mb_substr($hotel['content'],0,60);
                        $article[$k]['icon'] = $hotel['icon'];

                        $hotel = M('usermember')->where("id=" . $v['hid'])->find();

                        $goodsid=M('orderdetail')->where("orderno=" . $v['orderno'])->order('id desc')->find()['goodsid'];
                        $s = M('room')->where("id=" .$goodsid)->find();
                        $article[$k]['price'] = $s['price'];

                        if($hotel['shoptype']==3){
                            $article[$k]['shopid'] = $s['id'];
                            $article[$k]['name'] = $s['name'];
                            $article[$k]['content'] = mb_substr($s['content'],0,60);
                            $article[$k]['icon'] = $s['icon'];
                        }else{
                            $article[$k]['shopid'] = $hotel['id'];
                            $article[$k]['name'] = $hotel['name'];
                            $article[$k]['content'] = mb_substr($hotel['content'],0,60);
                            $article[$k]['icon'] = $hotel['icon'];
                        }

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
                            if($v['isover']==0){
                                $li.=' <span><input type="button" value="确认完成" class="ovfuk" data-id="' . $v['id'] . '" ></span>';
                            }

                        }else{
                            //$li.='<span><input type="button" value="查看评价" class="checkpl" data-id="' . $article[$k]['shopid'] . '"></span>';
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
            if(isset($_GET['isover'])){
                $state = 3;
            }
            $this->assign('state', $state);

            if (isset($_GET['state'])) {
                if ($_GET['state'] == 0 || $_GET['state'] == 1) {
                    $where['state'] = array('eq', $state);
                }
            }

            $isover = $_GET['isover'];
            $this->assign('isover', $isover);
            if (isset($_GET['isover'])) {
                if ($_GET['isover'] == 0 || $_GET['isover'] == 1) {
                    $where['isover'] = array('eq', $isover);
                }
            }

            if (isset($_GET['date1'])) {
                $date1 = strtotime($_GET['date1']);
                $where['time'] = array('gt', $date1);
                $this->assign('isover', 2);
            }
            if (isset($_GET['date2'])) {
                $date2 = strtotime($_GET['date2']);
                $where['time'] = array('lt', $date2);
                $this->assign('isover', 2);
                $where['time'] = array(array('gt', $date1),array('lt', $date2));
            }


            $where[hid] = array('eq', session('user'));
            $where['isshopdel'] = array('eq', 0);
            $where['actiontype'] = array('eq', 3);
            $listsCount = M('order')->where($where)->count();


            $lists = M('order')->where($where)->order('id desc')->limit(4)->select();
            foreach ($lists as $k => $v) {

                $hotel = M('usermember')->where("id=" . $v['hid'])->find();

                $goodsid=M('orderdetail')->where("orderno=" . $v['orderno'])->order('id desc')->find()['goodsid'];
                $s = M('room')->where("id=" .$goodsid)->find();
                $lists[$k]['price'] = $s['price'];
                $lists[$k]['hid'] = $hotel['id'];
                if($hotel['shoptype']==3){
                    $lists[$k]['shopid'] = $s['id'];
                    $lists[$k]['name'] = $s['name'];
                    $lists[$k]['content'] = mb_substr($s['content'],0,60);
                    $lists[$k]['icon'] = $s['icon'];
                }else{
                    $lists[$k]['shopid'] = $hotel['id'];
                    $lists[$k]['name'] = $hotel['name'];
                    $lists[$k]['content'] = mb_substr($hotel['content'],0,60);
                    $lists[$k]['icon'] = $hotel['icon'];
                }
                $user =  M('usermember')->where("id=" . $v['uid'])->find();
                $lists[$k]['usericon'] = $user['icon'];
                $lists[$k]['username'] = $user['name'];

            }
            $this->assign('lists', $lists);


            $this->display();
        }
    }
    public function goods(){
    if (IS_POST) {
        $list = I('post.');
        $arr[id] = array('eq',$list['id']);
        $type=$list['type'];
        if($type=='del'){
            $article = M('room')->where($arr)->save(array('isdel'=>1));
            if ($article) {
                exit(json_encode(array('code' => 200 )));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        }elseif($type=='onsale'){
            $article = M('room')->where($arr)->save(array('issale'=>1));
            if ($article) {
                exit(json_encode(array('code' => 200 )));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        }elseif($type=='notsale'){
            $article = M('room')->where($arr)->save(array('issale'=>0));
            if ($article) {
                exit(json_encode(array('code' => 200 )));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        }else{

            $shoptype=$list['shoptype'];
            $issale=$list['issale'];
            if ($list['issale']==0 || $list['issale']==1) {
                $where['issale'] = array('eq', $issale);

            }
            $where[hid] = array('eq', session('user'));
            $where['isdel'] = array('eq', 0);
            $where['istao'] = array('eq', 0);

            $start = ($list['page'] * 3);
            $article = M('room')->where($where)->order('id desc')->limit($start,3)->select();


            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='
                    <li>
                <p class="list_tt">
                    <i>ID号:'.$v['id'].'</i>
                    <em>数量：'.$v['goodsnum'].'</em>
                </p>
                <span class="list_ma">
                    <img src="'.picture($v['icon']).'" alt="">
                    <span>
                        <p>'.$v['name'].'</p>
                        <p>'.mb_substr($v['content'],0,60).'</p>
                        <em>
                            
                        </em>
                    </span>
                </span>';
                    if($shoptype==3) {
                        $li .= '
                            <p class="list_ft">
                                <i>成人票单价：<em>￥' . $v['price'] . '</em></i>
                                <i>儿童票单价：<em>￥' . $v['childprice'] . '</em></i>
                            </p>

                        <p class="list_ft">';
                           if ($v['issale'] == 1) {
                               $li .= '<span class="mer_ii">
    
                                    <input type="button" value="下架" class="actgoods" data-id="' . $v['id'] . '" acttype="notsale"/>
                                    </span> </p>';
                           } else {

                                $li .= '<span class="mer_ii">
                                    <input type="button" value="删除" id="shanchu_dd" class="actgoods" data-id="' . $v['id'] . '" acttype="del"/>
                                    <input type="button" value="编辑" id="bianjis_dd" class="editgoods" data-id="' . $v['id'] . '"/>
                                    <input type="button" value="上架" class="actgoods" data-id="' . $v['id'] . '" acttype="onsale"/>
                                </span> </p>';
                           }


                    }else{
                       $li.='<p class="list_ft">
                        <i>商品价格：<em>￥'.$v['price'].'</em></i>';

                       if($v['issale']==1){
                           $li.='<span class="xiaj">
                            <input type="button" value="下架" class="actgoods" data-id="'.$v['id'].'" acttype="notsale"/>
                            </span></p>';
                       }else{
                           $li.=' <span class="mer_ii">
                            <input type="button" value="上架" class="actgoods" data-id="'.$v['id'].'" acttype="onsale"/>
                            <input type="button" value="编辑" class="editgoods" data-id="'.$v['id'].'"/>
                            <input type="button" value="删除" class="actgoods" data-id="'.$v['id'].'" acttype="del"/>
                            </span></p>';
                       }
                   }
                   $li.='</li>';


                }
                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        }


    } else {


        $issale = $_GET['issale'];
        $this->assign('issale', $issale);
        if (isset($_GET['issale'])) {
            if ($_GET['issale'] == 0 || $_GET['issale'] == 1) {
                $where['issale'] = array('eq', $issale);
            }
        }



        $where[hid] = session('user');
        $where['isdel'] = array('eq', 0);
        $where['istao'] = array('eq', 0);
        //$where['type'] = $shoptype;
        $listsCount = M('room')->where($where)->count();

        $lists = M('room')->where($where)->order('id desc')->limit(3)->select();
        foreach ($lists as $k => $v) {
            //$room = M('room')->where("id=" . $v['goodsid'])->find();
            //$hotel = M('usermember')->where("id=" . $room['hid'])->find();
            //$user = M('usermember')->where("id=" . $v['id'])->find();

            //$lists[$k]['content'] = $hotel['content'];



            //$lists[$k]['usericon'] = $user['icon'];
            //$lists[$k]['username'] = $user['username'];
        }
        $this->assign('lists', $lists);
        //dump($lists);


        $this->display();
    }
}
    public function youhui(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 9);

            
            $where[hid] = session('user');
            $where[state] = array('eq', 1);

            $article = M('coupon')->where($where)->order('id desc')->limit($start, 9)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                   $li.='
                   <li>
                <span>
                    <i>￥<em>'.$v['price'].'</em></i>
                    <p>满'.$v['topmoney'].'可用</p>
                </span>
                <span>
                    <p>满减优惠</p>
                    <i>适用于所有商品使用</i>
                </span>
                <p>有效期：'.date('Y-m-d',$v['usestime']).'至 '.date('Y-m-d',$v['useetime']).'</p>
            </li>';
                    
                }
                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }



        } else {


            $issale = $_GET['issale'];
            $this->assign('issale', $issale);
            if (isset($_GET['issale'])) {
                if ($_GET['issale'] == 0 || $_GET['issale'] == 1) {
                    $where['issale'] = array('eq', $issale);
                }
            }



            $where[hid] = session('user');
            $where['isdel'] = array('eq', 0);
            //$where['type'] = $shoptype;
            $listsCount = M('coupon')->where($where)->count();


            $lists = M('coupon')->where($where)->order('id desc')->limit(5)->select();
            foreach ($lists as $k => $v) {

            }
            $this->assign('lists', $lists);
            //dump($lists);

            $this->display();
        }
    }

    public function addgoods(){
        if (IS_POST) {
            $list = I('post.');
            $arr[type] = 1;
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            //$arr[detail] = $list['detail'];
            $arr[roomnum] = $list['num'];
            $arr[device] = $list['device'];
            $arr[price] = $list['price'];
            $arr[icon] = $list['icon'];
            $arr[hid] = session('user');
            $arr[idno] = str_shuffle(time());
            if(M('room')->add($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {

            $this->display();
        }
    }
    public function editgoods(){
        if (IS_POST) {
            $list = I('post.');
            $mer=M('room')->where("id=" . $list['id'])->find();
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if($list['name']!=$mer['name']){
                $arr[name] = $list['name'];
            }
            if($list['content']!=$mer['content']){
                $arr[content] = $list['content'];
            }
            if($list['roomnum']!=$mer['num']){
                $arr[roomnum] = $list['num'];
            }
            if($list['device']!=$mer['device']){
                $arr[device] = $list['device'];
            }
            if($list['price']!=$mer['price']){
                $arr[price] = $list['price'];
            }
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if(empty($arr)){
                exit(json_encode(array('code' => 401)));
            }

            if(M('room')->where("id=".$list['id'])->save($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $room =  M('room')->where("id=".$_GET['id'])->find();
            $this->assign('vo',$room);
            $this->display();
        }
    }
    public function addmenpiao(){
        if (IS_POST) {
            $list = I('post.');
            $arr[type] = 3;
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            $arr[detail] = $list['detail'];
            $arr[icon] = $list['icon'];
            $arr[price] = $list['price'];
            $arr[childprice] = $list['childprice'];
            $arr[howuse] = $list['howuse'];
            $arr[piaoaddr] = $list['piaoaddr'];

            $arr[hid] = session('user');
            $arr[idno] = str_shuffle(time());
            if(M('room')->add($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {

            $this->display();
        }
    }
    public function editmenpiao(){
        if (IS_POST) {
            $list = I('post.');
            $mer=M('room')->where("id=" . $list['id'])->find();
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if($list['name']!=$mer['name']){
                $arr[name] = $list['name'];
            }
            if($list['content']!=$mer['content']){
                $arr[content] = $list['content'];
            }
            if($list['detail']!=$mer['detail']){
                $arr[detail] = $list['detail'];
            }
            if($list['roomnum']!=$mer['num']){
                $arr[roomnum] = $list['num'];
            }

            if($list['price']!=$mer['price']){
                $arr[price] = $list['price'];
            }
            if($list['childprice']!=$mer['childprice']){
                $arr[childprice] = $list['childprice'];
            }
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if(empty($arr)){
                exit(json_encode(array('code' => 401)));
            }

       
          /*  $arr[howuse] = $list['howuse'];
            $arr[piaoaddr] = $list['piaoaddr'];*/
          
           
            if(M('room')->where("id=".$list['id'])->save($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $room =  M('room')->where("id=".$_GET['id'])->find();
            $this->assign('vo',$room);
            $this->display();
        }
    }
    public function addfood(){
        if (IS_POST) {
            $list = I('post.');
            $arr[type] = 2;
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            $arr[detail] = $list['detail'];

            $arr[price] = $list['price'];
            $arr[cheapprice] = $list['cheapprice'];
            $arr[icon] = $list['icon'];
            $arr[roomnum] = $list['num'];

            $arr[hid] = session('user');
            $arr[idno] = str_shuffle(time());
            if(M('room')->add($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {

            $this->display();
        }
    }
    public function editfood(){
        if (IS_POST) {
            $list = I('post.');
            $mer=M('room')->where("id=" . $list['id'])->find();
           
            if($list['name']!=$mer['name']){
                $arr[name] = $list['name'];
            }
            if($list['content']!=$mer['content']){
                $arr[content] = $list['content'];
            }
            
            if($list['price']!=$mer['price']){
                $arr[price] = $list['price'];
            }
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if(empty($arr)){
                exit(json_encode(array('code' => 401)));
            }


            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            //$arr[detail] = $list['detail'];
            $arr[price] = $list['price'];
            
            $arr[num] = $list['num'];
            $arr[icon] = $list['icon'];


            if(M('room')->where("id=".$list['id'])->save($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $room =  M('room')->where("id=".$_GET['id'])->find();
            $this->assign('vo',$room);
            $this->display();
        }
    }
    public function taochan(){
        if (IS_POST) {
            $list = I('post.');
            $arr[id] = array('eq',$list['id']);
            $type=$list['type'];
            if($type=='del'){
                $article = M('room')->where($arr)->save(array('isdel'=>1));
                if ($article) {
                    exit(json_encode(array('code' => 200 )));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }elseif($type=='onsale'){
                $article = M('room')->where($arr)->save(array('issale'=>1));
                if ($article) {
                    exit(json_encode(array('code' => 200 )));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }elseif($type=='notsale'){
                $article = M('room')->where($arr)->save(array('issale'=>0));
                if ($article) {
                    exit(json_encode(array('code' => 200 )));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            

            }else{

                
                $issale=$list['issale'];
                if ($list['issale']==0 || $list['issale']==1) {
                    $where['issale'] = array('eq', $issale);

                }
                $where[hid] = array('eq', session('user'));
                $where['isdel'] = array('eq', 0);
                $where['istao'] = array('eq', 1);

                $start = ($list['page'] * 3);
                $article = M('room')->where($where)->order('id desc')->limit($start,3)->select();


                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $li.='
                    <li>
                <p class="list_tt">
                    <i>ID号:'.$v['id'].'</i>
                    <em>数量：'.$v['goodsnum'].'</em>
                </p>
                <span class="list_ma">
                    <img src="'.picture($v['icon']).'" alt="">
                    <span>
                        <p>'.$v['name'].'</p>
                        <p>'.mb_substr($v['content'],0,60).'</p>
                        <em>
                            
                        </em>
                    </span>
                </span>';
                       
                            $li.='<p class="list_ft">
                        <i>套餐价格：<em>￥'.$v['price'].'</em></i>';

                            if($v['issale']==1){
                                    $li.='<span class="xiaj">
                                <input type="button" value="下架" class="actgoods" data-id="'.$v['id'].'" acttype="notsale"/>
                                </span></p>';
                            }else{
                                    $li.=' <span class="mer_ii">
                                <input type="button" value="上架" class="actgoods" data-id="'.$v['id'].'" acttype="onsale"/>
                                <input type="button" value="编辑" class="editgoods" data-id="'.$v['id'].'"/>
                                <input type="button" value="删除" class="actgoods" data-id="'.$v['id'].'" acttype="del"/>
                                </span></p>';
                            }
                        
                        $li.='</li>';


                    }
                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }

            }


        } else {


            $issale = $_GET['issale'];
            $this->assign('issale', $issale);
            if (isset($_GET['issale'])) {
                if ($_GET['issale'] == 0 || $_GET['issale'] == 1) {
                    $where['issale'] = array('eq', $issale);
                }
            }



            $where[hid] = session('user');
            $where['isdel'] = array('eq', 0);
            $where['istao'] = array('eq', 1);
            //$where['type'] = $shoptype;
            $listsCount = M('room')->where($where)->count();

            $lists = M('room')->where($where)->order('id desc')->limit(3)->select();
            foreach ($lists as $k => $v) {
                //$room = M('room')->where("id=" . $v['goodsid'])->find();
                //$hotel = M('usermember')->where("id=" . $room['hid'])->find();
                //$user = M('usermember')->where("id=" . $v['id'])->find();

                //$lists[$k]['content'] = $hotel['content'];



                //$lists[$k]['usericon'] = $user['icon'];
                //$lists[$k]['username'] = $user['username'];
            }
            $this->assign('lists', $lists);
            //dump($lists);
            $this->display();
        }
    }
    public function addtao(){
    if (IS_POST) {
        $list = I('post.');

            $arr[name] = $list['name'];
            $arr[price] = $list['price'];
            $arr[cheapprice] = $list['cheapprice'];
            $arr[icon] = $list['icon'];
            $arr[istao] = 1;
            $arr[hid] = session('user');
            $arr[idno] = str_shuffle(time());
            if(M('room')->add($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

    } else {

        $this->display();
    }
}
    public function edittao(){
        if (IS_POST) {
            $list = I('post.');

            $arr[name] = $list['name'];
            $arr[price] = $list['price'];
            $arr[cheapprice] = $list['cheapprice'];
            $arr[icon] = $list['icon'];

            if(M('room')->where("id=".$list['id'])->save($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $room =  M('room')->where("id=".$_GET['id'])->find();
            $this->assign('vo',$room);
            $this->display();
        }
    }
    public function addyh(){
        if (IS_POST) {
            $list = I('post.');
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            //$arr[detail] = $list['detail'];
            $arr[roomnum] = $list['num'];
            $arr[getstime] = strtotime($list['getstime']);
            $arr[getetime] = strtotime($list['getetime']);
            $arr[usestime] = strtotime($list['usestime']);
            $arr[useetime] = strtotime($list['useetime']);
            $arr[price] = $list['price'];
            $arr[topmoney] = $list['topmoney'];
            $arr[hid] = session('user');
            $arr[idno] = str_shuffle(time());
            if(M('coupon')->add($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {

            $this->display();
        }
    }
    public function edityh(){
        if (IS_POST) {
            $list = I('post.');
            $arr[name] = $list['name'];
            $arr[content] = $list['content'];
            //$arr[detail] = $list['detail'];
            $arr[roomnum] = $list['num'];
            $arr[getstime] = strtotime($list['getstime']);
            $arr[getetime] = strtotime($list['getetime']);
            $arr[usestime] = strtotime($list['usestime']);
            $arr[useetime] = strtotime($list['useetime']);
            $arr[price] = $list['price'];
            $arr[topmoney] = $list['topmoney'];
            $arr[hid] = session('user');

            if(M('coupon')->where("id=".$list['id'])->save($arr)){
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $room =  M('coupon')->where("id=".$_GET['id'])->find();
            $this->assign('vo',$room);
            $this->display();
        }
    }

    public function pl(){
        $twoid = I('request.twoid',14,'intval');
        $this->assign('twoid',$twoid);

        $where[id] = session('user');
        $where[status] = 1;
        //分页
        $listsCount =  M('discuz')->where($where)->count();
        $p = getpage($listsCount,6);
        $p ->setConfig('prev','上一页');
        $p-> setConfig('next','下一页');
        $p = getpage($listsCount,6);
        $show = $p->showHome();// 分页显示输出

        $lists =  M('discuz')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

        $this->assign('lists',$lists);
        $this->assign('listsCount',$listsCount);
        if($listsCount>6){
            $this->assign('page',$show);
        }

        $this->display();
    }
    public function caiwu(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 9);

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
            $where[state] = array('eq', 1);

            $article = M('water')->where($where)->order('id desc')->limit($start, 9)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    if ($v['type'] == 1) {
                        $article[$k]['payment'] = '充值';
                    } elseif ($v['type'] == 2) {
                        $article[$k]['payment'] = '提现';
                    } elseif ($v['type'] == 3) {
                        $article[$k]['payment'] = '消费收益';
                    }
                    if($v['income'==1]){
                        $li.='<p><i class="txz">+'.$v['money'].'</i><em>'.$article[$k]['payment'].'</em></p>
                                <p><i class="txz">成功</i><em>'.date('Y-m-d h:i',$v['time']).'</em></p>';
                    }else{
                        $li.='
                                <p><i class="xfcg">-'.$v['money'].'</i><em>'.$article[$k]['payment'].'</em></p>
                                <p><i>消费成功</i><em>'.date('Y-m-d h:i',$v['time']).'</em></p>';
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


            //$where[uid] = session('user');
            $where[state] = array('eq', 1);

            $listsCount = M('water')->where($where)->count();


            $lists = M('water')->where($where)->order('id desc')->limit(9)->select();

            foreach ($lists as $k => $v) {
                if ($v['type'] == 1) {
                    $lists[$k]['payment'] = '充值';

                } elseif ($v['type'] == 2) {
                    $lists[$k]['payment'] = '提现';

                } elseif ($v['type'] == 3) {

                    $lists[$k]['payment'] = '消费收益';

                }
            }
            $this->assign('lists', $lists);
            $this->assign('listsCount', $listsCount);

            $this->assign('balance', M('usermember')->where("id=" . session('user'))->find()['balance'] / 100);
            $this->display();
        }
    }
    public function index()
    {
        if (IS_POST) {
            $list = I('post.');
            $arr[name] = $list['name'];
            $arr[password] = $list['password'];
          
            $arr[zzname] = $list['zzname'];
            $arr[zzno] = $list['zzno'];
            $arr[zzaddr] = $list['zzaddr'];
            $arr[icon] = $list['icon'];
            $arr[zzicon] = $list['zzicon'];
            $arr[overdue] = $list['overdue'];
            $arr[faren] = $list['faren'];


            if (M('usermember')->where("id=" . session('user'))->save($arr)) {
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
        $this->assign('vo',M('usermember')->where("id=".session('user'))->find());


            $this->display();
        }

    }
    public function shangjia()
    {
        if (IS_POST) {
            $list = I('post.');
            $mer=M('usermember')->where("id=" . session('user'))->find();
            if($list['name']!=$mer['name']){
                $arr[name] = $list['name'];
            }
            if($list['icon']!=$mer['icon']){
                $arr[icon] = $list['icon'];
            }
            if($list['zzicon']!=$mer['zzicon']){
                $arr[zzicon] = $list['zzicon'];
            }
            if (M('usermember')->where("id=" . session('user'))->save($arr)) {
                exit(json_encode(array('code' => 200)));
            } else {
                exit(json_encode(array('code' => 400)));
            }

        } else {
            $this->assign('vo',M('usermember')->where("id=".session('user'))->find());


            $this->display();
        }

    }
}