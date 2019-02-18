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
class HouseController extends HomeController
{

    public function index()
    {
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            if (isset($list['type'])) {
                $type = $list['type'];
                if ($list['type'] == 1 || $list['type'] == 2 || $list['type'] == 3) {
                    $arr['hoteltype'] = array('eq', $type);
                }
            }

            $arr[state] = 1;
            $arr[isshop] = 1;
            $arr[shoptype] = 1;
            $article = M('usermember')->where($arr)->order('id asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid'] = $v['uid'];
                    $com['type'] = 1;
                    $pl = M('comment')->where($com)->count();
                    $article[$k]['pl'] = $pl;

                    $col['tid'] = $v['uid'];
                    $col['type'] = 1;
                    $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
                    $article[$k]['collection']=$collection;

                    $collectionnum = M('collection')->where($col)->count();
                    $article[$k]['collectionnum'] = $collectionnum;

                    $li .='<li>
                           <a href="' . U('house/hoteldetail?id=' . $v['id'] .'&type='.$type) . '"><img src="'.picture($v['icon']).'" alt=""></a>
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

            if (isset($_GET['key'])) {//搜索
                /*if (isset($_GET['price'])) {
                    $whe['r.price'] = array('lt', $_GET['price']);
                }
                if (isset($_GET['housetype'])) {
                    $whe['r.name'] = array('like', '%'.$_GET['housetype'].'%');
                }
                if (isset($_GET['device'])) {
                    $whe['r.device'] = array('like',  '%'.$_GET['device'].'%');
                }
                if (isset($_GET['key'])) {
                    $whe['u.name'] = array('like', '%'.$_GET['key'].'%');
                }*/
                if (isset($_GET['star'])) {
                    if($_GET['star']==3){
                        $star='三星级';
                    }else if($_GET['star']==4){
                        $star='四星级';
                    }else if($_GET['star']==5){
                        $star='五星级';
                    }
                    $this->assign('star',$star);
                }
                if (isset($_GET['price'])) {
                    if($_GET['price']==1){
                        $price='200元以下';
                    }else if($_GET['price']==2){
                        $price='200元-500元';
                    }else if($_GET['price']==3){
                        $price='500元-800元';
                    }else if($_GET['price']==4){
                        $price='800元以上';
                    }
                    $this->assign('price',$price);
                }
                if (isset($_GET['housetype'])) {
                    if($_GET['housetype']==1){
                        $housetype='单人间';
                    }else if($_GET['housetype']==2){
                        $housetype='双人间';
                    }else if($_GET['housetype']==3){
                        $housetype='标准房';
                    }else if($_GET['housetype']==4){
                        $housetype='豪华套房';
                    }
                    $this->assign('housetype',$housetype);
                }
                if (isset($_GET['device'])) {
                    if($_GET['device']==1){
                        $device='浴场';
                    }else if($_GET['device']==2){
                        $device='台球房';
                    }else if($_GET['device']==3){
                        $device='保龄球房';
                    }
                    $this->assign('device',$device);
                }
                if (isset($_GET['key'])) {
                    $whe[state] = 1;
                    //$whe[isshop] = 1;
                    $whe[shoptype] = 1;
                    //$whe['hoteltype'] = 1;
                    $whe['name'] = array('like', '%'.$_GET['key'].'%');
                }
                $food = M('usermember')->where($whe)->order('id desc')->select();

                //$food = M('room')->alias('r')->field('u.*')->join('bhy_usermember u on u.id=r.hid')->where($whe)->group('r.hid')->order('u.id asc')->select();
                /* $str=implode(',',array_column($room,'hid'));
                 $in['id']=array('in',$str);
                 $food = M('usermember')->where($in)->order('sort asc')->select();*/

            } else {
                $type = $_GET['type'];
                $this->assign('type', $type);
                if (isset($_GET['type'])) {
                    if ($_GET['type'] == 1 || $_GET['type'] == 2 || $_GET['type'] == 3) {
                        $adarr['hoteltype'] = array('eq', $type);
                    }
                }
                $adarr[state] = 1;
                //$adarr[isshop] = 1;
                $adarr[shoptype] = 1;
                $food = M('usermember')->where($adarr)->order('id asc')->limit(8)->select();
            }
            foreach ($food as $k => $v) {
                $com['tid'] = $v['id'];
                $com['type'] = 1;
                $pl = M('comment')->where($com)->count();
                $food[$k]['pl'] = $pl;

                $col['tid'] = $v['id'];
                $col['type'] = 1;
                $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
                $food[$k]['collection'] = $collection;

                $collectionnum = M('collection')->where($col)->count();
                $food[$k]['collectionnum'] = $collectionnum;
            }
            //dump($food);
            $this->assign('food', $food);


            $this->display();
        }

    }

    public function hoteldetail()
    {
        $id = $_GET['id'];
        $this->assign('id',$id);
        $this->assign('type',$_GET['type']);

        M('usermember')->where("id=".$id)->setInc('view');

        $cp = M('coupon')->where('hid=' . $id)->select();
        if($cp){
            $this->assign('huodong',0);
        }else{
            $this->assign('huodong',0);
        }
        
        $hotel = M('usermember')->where('id=' . $id)->find();
        $this->assign('hotel', $hotel);

        $com['status'] = 1;
        $com['tid'] = $id;
        $com['type'] = array('eq', 1);
        $total =  M('comment')->where($com)->count();
        $this->assign('total', $total);
        
        $p['icon']=array('gt', 0);
        $g['star']=array('egt', 4);
        $m['star']=array('lt', 4);
        $m['star']=array('egt', 2);
        $b['star']=array('lt', 2);
        $pic =  M('comment')->where($com)->where($p)->count();
        $good =  M('comment')->where($com)->where($g)->count();
        //$middle =  M('comment')->where($com)->where($m)->count();
        $bad =  M('comment')->where($com)->where($b)->count();
        $middle = $total-$good-$bad;
        $this->assign('pic', $pic);
        $this->assign('good', $good);
        $this->assign('middle', $middle);
        $this->assign('bad', $bad);

        if(isset($_GET['pl'])){
            $pl=$_GET['pl'];
            if($pl==0){
                $com['icon'] = array('gt',0);
            }elseif($pl==1){
                $com['star'] = array('egt',4);
            }elseif($pl==2){
                $com['star'] = array(array('lt',4),array('egt',2));
            }elseif($pl==3){
                $com['star'] = array('lt',2);
            }
        }


        
        /*$pagesize=3;
        $p = getpage($total,$pagesize);
        $show = $p->showHome();
        if($total>$pagesize){
            $this->assign('page',$show);
        }*/
        $comment = M('comment')->where($com)->order('time desc')->select();
        foreach ($comment as $k => $v) {
            $user=M('usermember')->where("id=".$v['uid'])->find();
            $comment[$k]['usericon']=$user['icon'];
            $comment[$k]['username']=$user['name'];
        }
        $this->assign('comment', $comment);
        //dump($comment);

        $w['status'] = 1;
        $w['hid'] = $id;
        $w['issale'] = 1;
        $room = M('room')->field('id,name')->where($w)->select();
        $this->assign('room', $room);//dump($room);


        $ww['state'] = 1;
        $ww['isshop'] = 1;
        $ww['shoptype'] = 1;
        $ww['recommend'] = array('eq', 1);
        $tj = M('usermember')->where($ww)->limit(2)->select();
        $this->assign('tj', $tj);

        $this->display();
    }
    
    public function yuding()
    {

        $id = $_GET['id'];
        
        $this->display();
    }

    public function pay(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $room = M('room')->where('id=' . $id)->find();
            $this->assign('room', $room);
            $this->assign('hid', $room['hid']);

            $rest = $room['roomnum'] - $room['usenum'];
            $this->assign('rest', $rest);



           /* $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
            $day = (strtotime($date2) - strtotime($date1)) / 24 / 3600;
            $this->assign('date1', $date1);
            $this->assign('date2', $date2);
            $this->assign('day', $day);*/

            $date1=format_date1(strtotime($_GET['date1']));
            $date2=format_date1(strtotime($_GET['date2']));
            $day=(strtotime($_GET['date2'])-strtotime($_GET['date1']))/3600/24;
            $this->assign('date1', $date1);
            $this->assign('date2', $date2);
            $this->assign('day', $day);

            $money = $room['price'] * intval($_GET['num'])*$day;
            $this->assign('num', $_GET['num']);
            $this->assign('money', $money);
        }
        if(isset($_GET['orderno'])) {
            $orderno = $_GET['orderno'];

            $re= M('order')->where('orderno=' . $orderno)->find();
            if($re){
                $this->assign('pass', 1);
               
            }else{
                $this->assign('pass', 0);
            }
        }
        $this->display();

    }



}