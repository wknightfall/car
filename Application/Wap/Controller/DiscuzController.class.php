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
class DiscuzController extends HomeController
{
    //系统首页
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 6);

            $arr[status] = 1;
            $arr[type] = array('eq',$list['type']);
            $article = M('discuz')->where($arr)->order('id desc')->limit($start, 6)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $com['tid']=$v['id'];
                    $com['type']=$list['type'];
                    $pl=M('comment')->where($com)->count();
                    $article[$k]['pl']=$pl;

                    $col['tid']=$v['id'];
                    $col['type']='discuz';
                    $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                    $article[$k]['collection']=$collection;

                    $collectionnum=M('collection')->where($col)->count();
                    $article[$k]['collectionnum']=$collectionnum;

                    $t=format_date($v['create_time']);
                    $article[$k]['day']=$t;
                    $article[$k]['miao']=date('h:i',$v['create_time']);

                    $username=M('usermember')->where("id=".$v['uid'])->find()['name'];


                    $li .= '<li>
            <a href="'.U('discuz/detail?id='.$v['id']).'">
                <p>' . $v['name'] .'</p>
                <em>' . $v['content'] . '</em>
            </a>
            <span>
                    <i>' . $username . '</i>
                    <p>
                        <i>' . $v['view'] . '</i>
                        <i><img src="/Public/Wap/image/icon/ht.png" alt="" class="collection_bt">' . $collectionnum . '</i>
                        <i>' . $article[$k]['day'] .  $article[$k]['miao'].'</i>
                    </p>
                </span></li>';


                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;
            $type=$_GET['type'];
          
            if($type==1){
                $now = M('discuz')->where($adarr)->order('create_time desc')->limit(6)->select();
            }else if($type==2){
                $now = M('discuz')->where($adarr)->order('view desc')->limit(6)->select();
            }else if($type==3){
                $now = M('discuz')->where($adarr)->order('create_time asc')->limit(6)->select();
            }

            /* $ok =  M('discuz')->where($adarr)->where("ok=1")->order('create_time desc')->limit(4)->select();*/
            foreach ($now as $k => $v) {
                $col['tid']=$v['id'];
                $col['type']='discuz';
                $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
                $now[$k]['collection']=$collection;

                $collectionnum=M('collection')->where($col)->count();
                $now[$k]['collectionnum']=$collectionnum;

                $t=format_date($v['create_time']);
                $now[$k]['day']=$t;
                $now[$k]['miao']=date('h:i',$v['create_time']);
            }
            $this->assign('now', $now);


            $today=strtotime(date('Y-m-d',time()));
            $www['status']=array('eq',1);
            $www['create_time']=array('gt',$today);
            $nownum=M('discuz')->where($www)->count();
            $tiezinum=M('discuz')->where("status=1")->count();
            $zhutinum=M('discuz')->where("status=1")->count();

            $this->assign('nownum',$nownum);
            $this->assign('zhutinum',$zhutinum);
            $this->assign('tiezinum',$tiezinum);
            

            $this->display();
        }

    }

    public function detail(){
        $id=$_GET['id'];
        M('discuz')->where("id=".$id)->setInc('view');

        $adarr[status] = 1;
        $adarr[tid] = $id;
        $adarr[type] = 'discuz';
        $listsCount =  M('comment')->where($adarr)->count();
        $pagesize=3;
        $p = getpage($listsCount,$pagesize);
        $show = $p->showHome();
        if($listsCount>$pagesize){
            $this->assign('page',$show);
        }

        $comment = M('comment')->where($adarr)->order('time desc')->select();
        foreach ($comment as $k => $v) {
            $col['tid']=$v['id'];
            $col['type']='discuz';
            $collection=M('collection')->where($col)->where("uid=".session('user'))->find()? 1:0;
            $comment[$k]['collection']=$collection;
            $usericon=M('usermember')->where("id=".$v['uid'])->find()['icon'];
            $comment[$k]['usericon']=$usericon;
        }


        $tiezi=M('discuz')->where("id=".$id)->find();
        $tiezi['usericon']=M('usermember')->where("id=".$tiezi['uid'])->find()['icon'];
        $col['tid']=$id;
        $col['type']='discuz';
        $collectionnum=M('collection')->where($col)->count();
        $pl=M('comment')->where($col)->count();
        $tiezi['collectionnum']=$collectionnum;
        $tiezi['pl']=$pl;

        $tiezinum=M('discuz')->where("uid=".$tiezi['uid'])->count();
        $zhutinum=M('discuz')->where("uid=".$tiezi['uid'])->count();


        $this->assign('tiezi',$tiezi);

        $this->assign('tiezinum',$tiezinum);
        $this->assign('zhutinum',$zhutinum);
        $this->assign('comment',$comment);
        $this->display();
    }
  
}