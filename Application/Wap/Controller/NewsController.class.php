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
class NewsController extends HomeController {

    public function _initialize()
    {
        $nav = M('category')->where('pid=2')->order('sort asc')->select();
        foreach($nav as $k=>$v){
            $nav[$k]['href']=U($v['url'],array('navid'=>$v['id']));
        }
        $this->assign('nav',$nav);

        $this->assign('navid',$_GET['navid']);
        parent::_initialize();
    }

    //新闻首页、
    public function index(){
        if (IS_POST) {
            $list = I('post.');
            $start = ($list['page'] * 10);

            $arr[status] = 1;
            $arr[typeid] = $list['navid'];
            $article = M('article')->where($arr)->order('id desc')->limit($start, 10)->select();
            if ($article) {
                $li = "";
                foreach ($article as $k => $v) {
       
                    $li .= '<li>
                        <a href="' . U('Wap/News/newsdetail?id=' . $v["id"]) . '">
                        <img src="' . picture($v['icon']) . '" ></a>
                        <span>
                            <p><a href="' . U('Wap/News/newsdetail?id=' . $v["id"]) . '">'.$v['title'].'</a></p>
                            <i>'.$v['descriptions'].'</i>
                            <p>'.date('Y-m-d',$v['create_time']).'</p>
                        </span>
                    </li>';
                }

                exit(json_encode(array('code' => 200, 'msg' => $li)));
            } else {
                exit(json_encode(array('code' => 400)));
            }
        } else {
           

            $where[typeid] = $_GET['navid'];
            $where[status] = 1;
            

            $lists = M('article')->where($where)->order('id desc')->limit(10)->select();

            $this->assign('lists',$lists);

            $this->display();
        }
    }
    public function hy(){
        $where[typeid] = $_GET['navid'];
        $where[status] = 1;


        $lists = M('article')->where($where)->order('id desc')->limit(10)->select();

        $this->assign('lists',$lists);

        $this->display('index');
    }
    public function notice(){
        $where[typeid] = $_GET['navid'];
        $where[status] = 1;


        $lists = M('article')->where($where)->order('id desc')->limit(10)->select();

        $this->assign('lists',$lists);

        $this->display('index');
    }
   
    public function newsdetail(){
        $id=$_GET['id'];
        M('article')->where("id=".$id)->setInc('view');

        $news = M('article')->where("id=".$id)->find();
        $typeid=$news['typeid'];


        $w['id'] = array('lt',$id);
        $w['status'] = 1;
        $w[typeid] = $typeid;
        $p=M('article')->where($w)->order("id desc")->limit(1)->select();
        if($p){
            $prev=$p[0];
        }else{
            $prev=0;
        }
        $wh['id'] = array('gt',$id);
        $wh['status'] = 1;
        $wh[typeid] = $typeid;
        $n=M('article')->where($wh)->order("id asc")->limit(1)->select();
        if($n){
            $next=$n[0];
        }else{
            $next=0;
        }
        $this->assign('news', $news);
        $this->assign('prev', $prev);
        $this->assign('next', $next);

        $this->display();
    }

}