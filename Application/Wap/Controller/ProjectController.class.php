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
class ProjectController extends HomeController
{
    public function _initialize()
    {

        $twoid = I('request.twoid',20,'intval');
        $this->assign('twoid',$twoid);

        $nav = M('category')->where('pid=4')->order('sort asc')->select();
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

            $arr[isdel] = 0;
            $arr[status] = 1;
            $arr[issale] = 1;
            $arr[type] = 3;
            $article = M('room')->where($arr)->order('id desc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']=3;
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']=3;
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    $li .='<li>
                           <a href="' . U('project/scenicdetail?id=' . $v['id'] .'&type=3') . '"><img src="'.picture($v['icon']).'" alt=""></a>
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

            $arr[isdel] = 0;
            $arr[status] = 1;
            $arr[issale] = 1;
            $arr[type] = 3;
            $food = M('room')->where($arr)->order('id desc')->limit(8)->select();

            foreach ($food as $k => $v) {
                $com['tid']=$v['id'];
                $com['type']=3;
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']=3;
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;
            }
            $this->assign('food', $food);


            $this->display();
        }

    }
    public function scenicdetail()
    {

        $id = $_GET['id'];
        $this->assign('id',$id);
        $this->assign('type',$_GET['type']);
        M('room')->where("id=".$id)->setInc('view');

        $hid=M('room')->where("id=".$id)->find()['hid'];
        $cp = M('coupon')->where('hid=' . $hid)->select();
        if($cp){
            $this->assign('huodong',0);
        }else{
            $this->assign('huodong',0);
        }
        
        $com['status'] = array('eq', 1);
        $com['tid'] = array('eq', $id);
        $com['type'] = array('eq', 3);
        $total =  M('comment')->where($com)->count();
        $this->assign('total',$total);

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
                $com['star'] = array(array('lt', 4),array('egt', 2));
            }elseif($pl==3){
                $com['star'] = array('lt',2);
            }
        }
        $listsCount =  M('comment')->where($com)->count();
      /*  $pagesize=3;
        $p = getpage($listsCount,$pagesize);
        $show = $p->showHome();
        if($listsCount>$pagesize){
            $this->assign('page',$show);
        }*/
        $comment = M('comment')->where($com)->order('time desc')->select();
        foreach ($comment as $k => $v) {
            $user= M('usermember')->where("id=".$v['uid'])->find();
            $comment[$k]['usericon']=$user['icon'];
            $comment[$k]['username']=$user['name'];
        }
        $this->assign('comment', $comment);
        //dump($comment);

        $w['id'] = $id;
        $room = M('room')->where($w)->find();
        $room['oldprice']=$room['price']+30;
        $room['oldchildprice']=$room['childprice']+30;
        $this->assign('room', $room);
       

        $ww['status'] = 1;
        $ww['type'] = 3;
        //$ww['recommend'] = array('eq', 2);
        $tj = M('room')->where($ww)->limit(2)->select();
        foreach ($tj as $k => $v) {
            $com['tid'] = $v['id'];
            $com['type'] = 'hotel';
            $pl = M('comment')->where($com)->count();
            $tj[$k]['pl'] = $pl;

            $col['tid'] = $v['id'];
            $col['type'] = 'hotel';
            $collection = M('collection')->where($col)->where("uid=" . session('user'))->find() ? 1 : 0;
            $tj[$k]['collection'] = $collection;

            $collectionnum = M('collection')->where($col)->count();
            $tj[$k]['collectionnum'] = $collectionnum;
        }
        $this->assign('tj', $tj);

        $this->display();
    }
    public function menpiaopay()
    {
        $id = $_GET['id'];
        $type = $_GET['type'];

        $room = M('room')->where("id=".$id)->find();
        $this->assign('room', $room);


        $price=$type==1?$room['price']:$room['childprice'];
        $this->assign('price',$price);
        $this->assign('id', $id);
        $this->assign('hid', $room['hid']);

      
        $this->display();
    }
    public function videolist(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('video')->where($arr)->order('sort asc')->limit($start, 8)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li .= '<li>
                        <a href="' . U('Wap/Project/videodetail?id=' . $v["id"]) . '">
                        <img src="' . picture($v['icon']) . '" >
                        <span></span>
                        <p>'.$v['title'].'</p>
                        </a>
                    </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('video')->where($adarr)->order('sort asc')->limit(8)->select();
            foreach ($food as $k => $v) {

            }
            $this->assign('food', $food);


            $this->display();
        }

    }
    public function videodetail(){
            $id=$_GET['id'];
            M('video')->where("id=".$id)->setInc('view');

            $w['id'] = array('lt',$id);
            $w['status'] = 1;
            $p=M('video')->where($w)->order("id desc")->limit(1)->select();
            if($p){
                $prev=$p[0]['id'];
            }else{
                $prev=0;
            }
            $wh['id'] = array('gt',$id);
            $wh['status'] = 1;
            $n=M('video')->where($wh)->order("id asc")->limit(1)->select();
            if($n){
                $next=$n[0]['id'];
            }else{
                $next=0;
            }

            $adarr['id'] = $id;
            $food = M('video')->where($adarr)->find();


            $this->assign('food', $food);
            $this->assign('prev', $prev);
            $this->assign('next', $next);
            $list = M('video')->field('id,title')->where("status=1")->order("id asc")->select();
            $this->assign('list', $list);
            $this->display();
        

    }

    public function note(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $article = M('travelnote')->where($arr)->order('sort asc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $col['tid']=$v['id'];
                    $col['type']='travelnote';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;
                    //$author=M('usermember')->where("uid=".$v['uid'])->find()['username'];
                    $li .= '<li>
               
                    <a href="'.U('Wap/project/notedetail?id='.$v["id"]).'">
                    <img src="' . picture($v['icon']) . '" alt="">
                    </a>
                <span>
                    <p>' . '<a href="'.U('Wap/project/notedetail?id='.$v["id"]).'">'.mb_substr($v['name'],0,45). '</a></p>
                    <i>'.$v['description'] .'</i>
                    <em>
                    <p><img src="/Public/Wap/image/icon/aaa_seee.png">'.$v['view'].'</p>' ;


                    if($collection){
                        $li.='<p><img src="/Public/Wap/image/icon/hert.png"  data-id="{$vo.id}" >'.$article[$k]['collectionnum'].'</p>';
                    }else{
                        $li.='<p><img src="/Public/Wap/image/icon/aattt.png"  data-id="{$vo.id}" >'.$article[$k]['collectionnum'].'</p>';
                    }
                    $li.= '<p>'.date('Y-m-d',$v['create_time']).'</p>';
                    $li.='</em></span></li>';
                 }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('travelnote')->where($adarr)->order('sort asc')->limit(10)->select();
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

            $this->display('');
        }

    }
    public function notedetail(){
        M('travelnote')->where("id=".$_GET['id'])->setInc('view');
        $note = M('travelnote')->where("id=".$_GET['id'])->find();


        $col['tid']=$_GET['id'];
        $col['type']='travelnote';
        $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
        $note['collection']=$collection;

        $this->assign('vo', $note);
        $this->display();
    }
    public function travelself(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $article = M('travelself')->where($arr)->order('id desc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                   /* $col['tid']=$v['id'];
                    $col['type']='travelnote';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;*/
                    //$author=M('usermember')->where("uid=".$v['uid'])->find()['username'];
                    $li .= '<li>
               
                    <a href="'.U('Wap/project/selfdetail?id='.$v["id"]).'">
                    <img src="' . picture($v['icon']) . '" alt="">
                    </a>
                <span>
                    <p>' . '<a href="'.U('Wap/project/selfdetail?id='.$v["id"]).'">'.mb_substr($v['name'],0,45). '</a></p>
                    <i>'.$v['content'] .'</i>
                    <em>';
                   


                    
                    $li.= '<p>'.date('Y-m-d',$v['create_time']).'</p>';
                    $li.='</em></span></li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $food = M('travelself')->where($adarr)->order('id desc')->limit(10)->select();
            foreach ($food as $k => $v) {
                /*$com['tid']=$v['id'];
                $com['type']='food';
                $pl=M('comment')->where($com)->count();
                $food[$k]['pl']=$pl;

                $col['tid']=$v['id'];
                $col['type']='food';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $food[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $food[$k]['collectionnum']=$collectionnum;*/
            }
            $this->assign('food', $food);


            $this->display('');
        }

    }
    public function selfdetail(){
        M('travelself')->where("id=".$_GET['id'])->setInc('view');
        $note = M('travelself')->where("id=".$_GET['id'])->find();


      /*  $col['tid']=$_GET['id'];
        $col['type']='travelnote';
        $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
        $note['collection']=$collection;*/

        $this->assign('vo', $note);
        $this->display();
    }

    public function travelnews(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $article = M('travelnews')->where($arr)->order('sort asc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li.='<li>
                        <a href="' . U('Wap/project/travelnewsdetail?id=' . $v["id"]).'">
                            <p>'.$v['name'].'</p>
                            <em>' . $v['description'] . '</em>
                            <i>' . date('Y-m-d', $v['create_time']) . '</i>
                        </a>
                    </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            

            $adarr[status] = 1;

            $food = M('travelnews')->where($adarr)->order('sort asc')->limit(10)->select();
           
            $this->assign('food', $food);
            

            $this->display();
        }

    }
    public function travelnewsdetail(){
        M('travelnews')->where("id=".$_GET['id'])->setInc('view');
        $note = M('travelnews')->where("id=".$_GET['id'])->find();


        $col['tid']=$_GET['id'];
        $col['type']='travelnews';
        $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
        $note['collection']=$collection;

        $this->assign('vo', $note);
        $this->display();
    }
    public function travelgl(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $article = M('travelgl')->where($arr)->order('sort asc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li.='<li>
                        <a href="' . U('Wap/project/travelgldetail?id=' . $v["id"]).'">
                            <p>'.$v['name'].'</p>
                            <em>' . $v['description'] . '</em>
                            <i>' . date('Y-m-d', $v['create_time']) . '</i>
                        </a>
                    </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {


            $adarr[status] = 1;

            $food = M('travelgl')->where($adarr)->order('sort asc')->limit(10)->select();

            $this->assign('food', $food);


            $this->display();
        }
    }
    public function travelgldetail(){
            M('travelgl')->where("id=".$_GET['id'])->setInc('view');
            $note = M('travelgl')->where("id=".$_GET['id'])->find();


            $col['tid']=$_GET['id'];
            $col['type']='travelgl';
            $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
            $note['collection']=$collection;

            $this->assign('vo', $note);
            $this->display();
        }

    


}