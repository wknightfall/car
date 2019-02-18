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


class AboutController extends HomeController {
  
    public function _initialize()
    {

        $twoid = I('request.twoid',20,'intval');
        $this->assign('twoid',$twoid);
		
		$nav = M('category')->where('pid=1')->order('sort asc')->select();
        foreach($nav as $k=>$v){
            $nav[$k]['href']=U($v['url'],array('navid'=>$v['id']));
        }
		$this->assign('nav',$nav);

        $id=$_GET['navid'];
        $this->assign('navid',$id);
        
        $ele = M('category')->where('id='.$id)->find();
        $this->assign('ele',$ele);
        parent::_initialize();
    }
   
	
    public function index(){
		$id=$_GET['id'];
		//集团公司简介
		$where[id] = 1;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display();
    }
	public function aboutlist(){
		if (IS_POST) {
			$list = I('post.');
			$start = ($list['page'] * 10);

			$arr[status] = 1;
			$arr[typeid] = $list['navid'];
			$article = M('aboutlist')->where($arr)->order('id desc')->limit($start, 10)->select();
			if ($article) {
				$li = "";
				foreach ($article as $k => $v) {

					$li .= '<li>
                        <a href="' . U('Wap/about/aboutdetail?id=' . $v["id"]) . '">
                        <img src="' . picture($v['icon']) . '" ></a>
                        <span>
                            <p><a href="' . U('Wap/about/aboutdetail?id=' . $v["id"]) . '">'.$v['name'].'</a></p>
                            <i>'.$v['description'].'</i>
                            <p>'.date('Y-m-d',$v['create_time']).'</p>
                        </span>
                    </li>';
				}

				exit(json_encode(array('code' => 200, 'msg' => $li)));
			} else {
				exit(json_encode(array('code' => 400)));
			}
		} else {
			$twoid = I('request.twoid', 14, 'intval');
			$this->assign('twoid', $twoid);

			$where[typeid] = $_GET['navid'];
			$where[status] = 1;


			$lists = M('aboutlist')->where($where)->order('id desc')->limit(10)->select();

			$this->assign('lists',$lists);

			$this->display();
		}
	}
	public function aboutdetail(){
		$id=$_GET['id'];
		M('aboutlist')->where("id=".$id)->setInc('view');
		
		$adarr['id'] = $id;
		$news = M('aboutlist')->where($adarr)->find();
		$typeid=$news['typeid'];
		
		$map['id'] = array('in',$news['file']);
		$this -> assign('fileList',M('file')->where($map)->select());

		

		$w['id'] = array('lt',$id);
		$w['status'] = 1;
		$w[typeid] = $typeid;
		$p=M('aboutlist')->where($w)->order("id desc")->limit(1)->select();
		if($p){
			$prev=$p[0];
		}else{
			$prev=0;
		}
		$wh['id'] = array('gt',$id);
		$wh['status'] = 1;
		$wh[typeid] = $typeid;
		$n=M('aboutlist')->where($wh)->order("id asc")->limit(1)->select();
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
	public function zuzhi(){
		$where[id] = 30;
		$where[status] = 1;
		$vo = M('category')->where($where)->find();
		$this->assign('vo',$vo);
		$this->display('index');
	}
	public function tel(){
		$vo = M('abouttel')->select();
		$this->assign('tel',$vo);
		$this->display();
	}
	public function legal(){
		$this->display('index');
	}
	public function coop(){
		$this->display('index');
	}
	public function leader(){
		if (IS_POST) {
			$list = I('post.');
			$start = ($list['page'] * 10);

			$arr[status] = 1;

			$article = M('leader')->where($arr)->order('sort asc')->limit($start, 10)->select();
			if ($article) {
				$li = "";
				foreach ($article as $k => $v) {

					$li .='<li>
                <a href="'.U('Food/detail?id='.$v['id'].'&model=leader').'"><img src="' . picture($v['icon']) . '" alt=""></a>
               <span>
                   <p><em>' . $v['name'] . '</em><i>';

					$li.='</i></p>
                
                       <p><i>担任职务：</i>' . $v['position'] . '</p>
                       <p><i>所属部门：</i>' . $v['depart'] . '</p>
                  
               </span>
            </li>';
				}

				exit(json_encode(array('code' => 200, 'msg' => $li)));
			} else {
				exit(json_encode(array('code' => 400)));
			}
		} else {
			$this->assign('indexnav', 2);

			$adarr[status] = 1;

			$food = M('leader')->where($adarr)->order('sort asc')->limit(10)->select();
			
			$this->assign('food', $food);
			$this->assign('type','res');

			$this->display();
		}


	}
	public function honor(){
		$where[typeid] = $_GET['navid'];
		$where[status] = 1;


		$lists = M('aboutlist')->where($where)->order('id desc')->limit(10)->select();

		$this->assign('lists',$lists);
        $this->display('aboutlist');
	}
	public function zp(){
		$where[typeid] = $_GET['navid'];
		$where[status] = 1;


		$lists = M('aboutlist')->where($where)->order('id desc')->limit(10)->select();

		$this->assign('lists',$lists);
        $this->display('aboutlist');
	}
	public function thing(){
		$where[typeid] = $_GET['navid'];
		$where[status] = 1;


		$lists = M('aboutlist')->where($where)->order('id desc')->limit(10)->select();

		$this->assign('lists',$lists);
        $this->display('aboutlist');
	}

	

}