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


class CultureController extends HomeController {

	public function _initialize()
	{

		$twoid = I('request.twoid',20,'intval');
		$this->assign('twoid',$twoid);

		$nav = M('category')->where('pid=5 and isnav=1')->order('sort asc')->select();
		foreach($nav as $k=>$v){
            if($v['id'] == 40){
                $nav[$k]['href']=U($v['url'],array('navid'=>51));
            }else if($v['id'] == 39){
                $nav[$k]['href']=U($v['url'],array('navid'=>73));
            }else{
                $nav[$k]['href']=U($v['url'],array('navid'=>$v['id']));
            }

		}
		$this->assign('nav',$nav);

		$id=$_GET['navid'];
		$this->assign('navid',$id);
		
		

		$ele = M('category')->where('id='.$id)->find();
		$this->assign('ele',$ele);
		parent::_initialize();
	}



	public function index(){
		if (IS_POST) {
			$list = I('post.');
			$start = ($list['page'] * 10);

			$arr[status] = 1;

			$article = M('localhistory')->where($arr)->order('id desc')->limit($start, 10)->select();
			if ($article) {
				$li = "";
				foreach ($article as $k => $v) {

					$li .= '<li>
                        <a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=localhistory') . '">
                        <img src="' . picture($v['icon']) . '" ></a>
                        <span>
                            <p><a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=localhistory') . '">'.$v['name'].'</a></p>
                            <i>'.$v['content'].'</i>
                            <p>'.date('Y-m-d',$v['create_time']).'</p>
                        </span>
                    </li>';
				}

				exit(json_encode(array('code' => 200, 'msg' => $li)));
			} else {
				exit(json_encode(array('code' => 400)));
			}
		} else {



			$where[status] = 1;


			$lists = M('localhistory')->where($where)->order('id desc')->limit(10)->select();

			$this->assign('lists',$lists);

			$this->display();
		}
	}
	public function culture(){
		if (IS_POST) {
			$list = I('post.');
			$start = ($list['page'] * 10);

			$arr[status] = 1;

			$article = M('jpculture')->where($arr)->order('id desc')->limit($start, 10)->select();
			if ($article) {
				$li = "";
				foreach ($article as $k => $v) {

					$li .= '<li>
                        <a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=jpculture') . '">
                        <img src="' . picture($v['icon']) . '" ></a>
                        <span>
                            <p><a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=jpculture') . '">'.$v['name'].'</a></p>
                            <i>'.$v['content'].'</i>
                            <p>'.date('Y-m-d',$v['create_time']).'</p>
                        </span>
                    </li>';
				}

				exit(json_encode(array('code' => 200, 'msg' => $li)));
			} else {
				exit(json_encode(array('code' => 400)));
			}
		} else {



			$where[status] = 1;


			$lists = M('jpculture')->where($where)->order('id desc')->limit(10)->select();

			$this->assign('lists',$lists);

			$this->display();
		}
	}
	public function famous(){
		if (IS_POST) {
			$list = I('post.');
			$start = ($list['page'] * 10);

			$arr[status] = 1;

			$article = M('famous')->where($arr)->order('id desc')->limit($start, 10)->select();
			if ($article) {
				$li = "";
				foreach ($article as $k => $v) {

					$li .= '<li>
                        <a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=famous') . '">
                        <img src="' . picture($v['icon']) . '" ></a>
                        <span>
                            <p><a href="' . U('Wap/food/detail?id=' . $v["id"].'&model=famous') . '">'.$v['name'].'</a></p>
                            <i>'.$v['content'].'</i>
                            <p>'.date('Y-m-d',$v['create_time']).'</p>
                        </span>
                    </li>';
				}

				exit(json_encode(array('code' => 200, 'msg' => $li)));
			} else {
				exit(json_encode(array('code' => 400)));
			}
		} else {



			$where[status] = 1;


			$lists = M('famous')->where($where)->order('id desc')->limit(10)->select();

			$this->assign('lists',$lists);

			$this->display();
		}
	}
	
	public function habit(){$this->redirect('wap/culture/index',array('navid'=>$_GET['navid']));return;


		$where[id] = 39;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}
	public function food(){$this->redirect('wap/culture/index',array('navid'=>$_GET['navid']));return;


		$where[id] = 40;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}
	public function gk(){


		$where[id] = 75;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}

	public function gl(){


		$where[id] = 40;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}

	public function cs(){


		$where[id] = 78;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}
	public function travelself(){


		$where[id] = 77;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}
	public function guide(){


		$where[id] = 76;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
	}



}