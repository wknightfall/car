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
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class RegController extends AdminController {
	
	public function _initialize(){
		//查询新闻分类

		$type['status'] = array('eq',1);

		$this->assign("lists",M('regular')->where($type)->order('sort asc')->select());//公司类型
		
		$this -> assign('mid',is_login());  //当前登陆用户ID
		
		$list = M('category')->where('pid=2')->order('sort asc')->select();

		
		parent::_initialize();
	}

    public function index(){
	    $where['status'] = 1;
		$typeid = I('request.typeid');
		$title = I('request.title');
		if($typeid>0){
			$where['typeid'] = array(array('eq',$typeid),array('like','%'.$typeid.',%'), 'or');
		}
		if($title!=''){
			$where['title'] = array('like','%'.$title.'%');
		}

		$lists = M('reg')->where($where)->order('id desc')->select();
		$this->assign('list',$lists);
		$this->display();
    }
	//新增
	public function add(){
		if(IS_POST){
			$news = D('Reg');
			if($news->create()){
				$_POST[flag] = implode(',',$_POST[flag]);
				$_POST[create_time] = time();
				$resu = M('reg')->add($_POST);
				if($resu){
					$this->success('新增成功！',U('Reg/index'));
					//$this->success('新增成功！',U('Reg/index',array('typeid'=>$_POST[typeid])));
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
	//编辑
	public function edit(){
		$id = I('request.id');
		if(IS_POST){
			$news = D('Reg');
		    if($news->create()){
				$_POST[flag] = implode(',',$_POST[flag]);
				$_POST[create_time] = time();
				$resu = M('reg')->save($_POST);
				if($resu){
					$this->success('修改成功！',U('Reg/index'));
					//$this->success('修改成功！',U('Reg/index',array('typeid'=>$_POST[typeid])));
				}else{
					$this->error('修改失败！');
				}
			}else{
				
				$this->error($news->getError());
			}	
			
			
		}else{
			$vo = M('reg')->find($id);
			$this->assign('vo',$vo);
			$this->display();
		}
		
	}
	

	
	

     //删除
	public function del(){
		$id = I('request.id');

		if($id>0){
		  $lists = M('reg')->where('id='.$id)->save(array('status'=>-1));
		  if($lists){
			  $this->success('删除成功');
		  }
		}else{

				$this->error('参数错误');


		}

		$this->display();

	}


	public function _filter(&$sqlWhere){
		
		if(!empty($_GET['mid'])){
			//查找改用户对应的id
			$tempwhr['nickname']=array('like','%'.$_GET['mid'].'%');
			$member=M('member')->where($tempwhr)->select();
			$temp='';
			foreach ($member as $k=>$v ){
				if($k==0){
					
					$temp=$v['uid'];
					
				}else{
					
					$temp.=','.$v['uid'];
					
				}
			}
			
			$sqlWhere['mid'] = array('in',$temp);
			
		}	
		if(!empty($_GET['title'])){
			
			$sqlWhere['title'] = array('like','%' . $_GET['title'] . '%');
		}

		if(!empty($_GET['typeid'])){

			$sqlWhere['typeid'] = array(array('eq',$_GET['typeid']),array('like','%'.$_GET['typeid'].',%'), 'or');

		}
		
		return $sqlWhere;
		
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
	
	public function _before_add(){
		$_POST['mid']=UID;
		$_POST['create_time']=strtotime($_POST['create_time']);
		
	}
	public function _before_edit(){
		$_POST['create_time']=strtotime($_POST['create_time']);
		
		$_POST['mid']=$_POST['mid'];
		
		
	}

}
