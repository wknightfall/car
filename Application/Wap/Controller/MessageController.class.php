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
class MessageController extends HomeController
{



    public function index(){
        if (IS_POST) {
            $list = I('post.');
            if($list['type']=='load'){
                $start = ($list['page'] * 4);

                $arr[status] = 1;
                $article = M('messages')->where($arr)->order('id desc')->limit($start, 4)->select();
                if ($article) {
                    $li = "";
                    foreach ($article as $k => $v) {
                        $usericon=M('usermember')->where("id=",$v['uid'])->find()['icon'];


                        $li.='
                                        <li>
                            <ul>
                                <li class="oeher_aa">
                                    <img src="'.picture($usericon).'" alt="">
                                    <span>';

                                     if($v['uid']==999999999){
                                         $li.=' <p><i>系统管理员</i></p>';
                                     }elseif($v['uid']==0){
                                         $li.=' <p><i>游客</i></p>';
                                     }else{
                                         $li.=' <p><i>'.modelField($v['uid'],'usermember','name').'</i></p>';
                                     }
                        
                                    $li.='<p>发表于'.date('Y-m-d h:i',$v['create_time']).'</p>
                                    </span>
                                </li>
                                <li>' . $v['content'] . '</li>
                                </ul>
                            </li>';
                     }

                    exit(json_encode(array('code' => 200, 'msg' => $li)));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }else{
                $adarr[uid] = empty(session('user'))? 0 : session('user');
                $adarr[content] =  $list['content'];
                $adarr[create_time] =  time();
                $article = M('messages')->add($adarr);
                if ($article) {
                    exit(json_encode(array('code' => 200 ,'msg'=>'发布成功')));
                } else {
                    exit(json_encode(array('code' => 400)));
                }
            }

        } else {
            $message = M('messages')->order('create_time desc')->limit(4)->select();
            foreach ($message as $k=>$v) {
                $message[$k]['usericon']=M('usermember')->where("id=".$v['uid'])->find()['icon'];
            }
            $this->assign('message', $message);

            $this->display('');
        }
    }

}