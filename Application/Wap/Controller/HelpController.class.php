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
class HelpController extends HomeController
{
    //系统首页
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('normalqa')->where($arr)->order('sort asc')->limit($start, 4)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li .= '<li>
                    <p><i>' . $v['name'] . '</i></p>
                    <div>' . $v['content'] . '</div>
                </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $list = M('normalqa')->where($adarr)->order('sort asc')->limit(8)->select();

            $this->assign('list', $list);


            $this->display();
        }

    }
    public function cs(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('travelknow')->where($arr)->order('sort asc')->limit($start, 4)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {

                    $li .= '<li>
                    <p><i>' . $v['name'] . '</i></p>
                    <div>' . $v['content'] . '</div>
                </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $list = M('travelknow')->where($adarr)->order('sort asc')->limit(8)->select();

            $this->assign('list', $list);


            $this->display();
        }

    }
    public function tel(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 8);

            $arr[status] = 1;
            $article = M('normaltel')->where($arr)->order('sort asc')->limit($start, 4)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
                    $li.='<li>
                                <p>' . $v['name'] . '</p>
                                <div>
                                    <p>公司地址：' . $v['addr'] . '</p>
                                    <p>电话：' . $v['tel'] . '</p>
                                    <p>邮箱：' . $v['email'] . '</p>
                                </div>
                            </li>';

                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
            $this->assign('indexnav', 2);

            $adarr[status] = 1;

            $list = M('normaltel')->where($adarr)->order('sort asc')->limit(8)->select();

            $this->assign('list', $list);


            $this->display();
        }

    }
    





}