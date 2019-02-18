<?php

namespace English\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class NewsController extends HomeController {

    public function _initialize()
    {

        $twonav=M('category')->where("pid=3 and isnav=1 and status=1")->order('sort asc')->select();
        $this->twonav= $twonav;
        $this->assign('twonav',$twonav);
        parent::_initialize();
    }

    //新闻首页、
    public function index(){
        $get = $_GET;
        $get['typeid'] = $get['typeid']>0?$get['typeid']:17;
        $this->assign('get',$get);

        $twoid = I('request.twoid',14,'intval');
        $this->assign('twoid',$twoid);
        //C-IASI要闻
        $where['typeid'] = array('eq',17);
        $where['status'] = array('eq',1);
        $listsCount =  M('article')->where($where)->count();
        $p = getpage($listsCount,5);
        $show = $p->show();
        $lists =  M('article')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('lists',$lists);
        $this->assign('page',$show);

        //行业新闻
        $where['typeid'] = array('eq',18);
        $where['status'] = array('eq',1);
        $listsCount =  M('article')->where($where)->count();
        $p = getpage($listsCount,5);
        $showb = $p->show();
        $listb =  M('article')->where($where)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('listb',$listb);
        $this->assign('pageb',$showb);
        $this->display();
    }
   
    public function details(){

        $get = $_GET;
        $this->assign('get',$get);
        $vo = M('article')->find($get['id']);
        $this->assign('vo', $vo);
        M('news')->where("id=".$get['id'])->setInc('view');

        //上一篇
        $maps['id'] = array('gt',$vo['id']);
        $maps['typeid'] = array('eq',$get['typeid']);
        $maps['status'] = 1;
        $prepage= M('article')->where($maps)->order('id asc')->find();
        $this->assign('prepage',$prepage);

        //下一篇
        $mapss['id']     = array('lt',$vo['id']);
        $mapss['typeid'] = array('eq',$get['typeid']);
        $mapss['status'] = 1;
        $nextpage= M('article')->where($mapss)->order('id desc')->find();
        $this->assign('nextpage',$nextpage);

        //最新消息
        $where['typeid'] = array('eq',$get['typeid']);
        $where['status'] = array('eq',1);
        $where['id']     = array('neq',$vo['id']);
        $list =  M('article')->where($where)->limit(6)->order('id desc')->select();
        $this->assign('list',$list);

        $this->display();
    }


    //搜索
    public function search(){
        $get = $_GET;
        $where['a.egname'] = array('like','%'.$get['keyword'].'%');
        $where['c.pid'] = array('in','3,4');
        $where['a.status'] = array('eq',1);
        $list = M('article as a')->join('bhy_category as c on c.id=a.typeid')->where($where)->order('a.id desc')->field('a.*')->select();

        $this->assign('list',$list);
        $this->display();
    }



    
}