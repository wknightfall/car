<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台用户控制器
 */
class NewsController extends AdminController {
	
	public function _initialize(){

        $this -> assign('controller_name',strtolower(CONTROLLER_NAME));  //当前登陆用户ID
		
		$this -> assign('mid',is_login());  //当前登陆用户ID
        $where['status'] = array('eq',1);
        $where['id'] = array('neq',12);

		$list = M('category')->where($where)->order('sort asc')->select();
		$list = $this->unlimitforlevel($list,'|--');

		$this->assign('lists',$list);
		
		parent::_initialize();
	}



    public function index(){

		$typeid = I('request.typeid');
		$title = I('request.title');
		if($typeid>0){
			$where['typeid'] = array(array('eq',$typeid),array('like','%'.$typeid.',%'), 'or');
		}
		if($title!=''){
			$where['title'] = array('like','%'.$title.'%');
		}
        $where['status'] = array('gt',-1);
        $where['pid'] = array('eq',0);
		//分页
        $listsCount = M('article')->where($where)->count();
        $Page       = new \Think\Page($listsCount,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

	    $lists = M('article')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$lists);
        $this->assign('_page',$show);
		
		$this->assign('get',$_GET);
		$this->display();
    }
	
	//编辑
	public function edit(){
		$id = I('request.id');
		if(IS_POST){
			$news = D('News');
		    if($news->create()){
				$_POST[flag] = implode(',',$_POST[flag]);
                $_POST['update_time'] = time();
				$resu = M('article')->save($_POST);
				if($resu){
					$this->success('修改成功！',U('News/index',array('typeid'=>$_POST[typeid])));
				}else{
					$this->error('修改失败！');
				}
			}else{
				
				$this->error($news->getError());
			}	
			
			
		}else{
			$vo = M('article')->find($id);
			$this->assign('vo',$vo);
			$this->display();
		}
		
	}
	
	//新增
	public function add(){
		if(IS_POST){
			$news = D('News');
		    if($news->create()){
				$_POST[flag] = implode(',',$_POST[flag]);
                $_POST['create_time'] = time();
				$resu = M('article')->add($_POST);
				if($resu){
					$this->success('新增成功！',U('News/index',array('typeid'=>$_POST[typeid])));
				}else{
					$this->error('新增失败！');
				}
			}else{
				
				$this->error($news->getError());
			}	
			
			
		}else{
			
			$this->display();
		}
		
	}
	
	

     //删除
	public function del(){
		$id = I('request.id');

		if($id>0){
		  $lists = M('article')->where('id='.$id)->delete();
		  if($lists){
			  $this->success('删除成功');
		  }
		}else{
				$this->error('参数错误');
		}
		$this->display();
	}

	//删除所有
    public function forverdel(){
	    $pt = $_REQUEST;
	    if($pt['method']=='deleteUser'){
            $where['id'] = array('in',implode(',',$pt['id']));

            $res = M('article')->where($where)->delete();
            if($res){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }


    }







	public function unlimitforlevel($cate,$html='------',$pid=0,$level=0,$topid=0){
		//$cate  查询出来的数据
		//$html   标识符
		//$pid    上级ID
		//$level   层级
		$arr = array();  //定义返回的数组
		foreach($cate as $v){
			if($v['pid'] == $pid){  //等于顶级分离
				$v['topid'] = 0;
				if($level == 0){
					$topid = $v['id'];
				}
				if($level != 0){
					$v['topid'] = $topid;
				}
	
				$v['level'] = $level + 1;     //层级加1
				if($level > 1){
					$html = str_replace('|' , '' , $html);
				}
	
				$v['html'] = str_repeat($html,$level);   //str_repeat  字符串重复次数
				//var_dump($v['id']);
				$lis = M('column')->where('pid=' . $v['id'])->select();
				if($lis){
					$v['num'] = 1;
				}else{
					$v['num'] = 0;
				}
				$arr[]=$v;
				//array_merge  把多个数组合并为一个数组
				$arr = array_merge($arr,$this->unlimitforlevel($cate,$html,$v['id'],$level+1,$topid));
	
			}
		}
		return $arr;
	
	}
	//新闻回收站
	
	public function recycle(){
		
		$map['status']  =   -1;
		
		$list = $this->lists(M('article'),$map,'update_time desc');	
		
		$this -> assign('list',$list);
		$this -> display();
		
	}
	
	

}
