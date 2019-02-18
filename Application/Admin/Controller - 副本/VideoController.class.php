<?php
namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台视频控制器
 */
class VideoController extends AdminController {
	
	public function _initialize(){

		//查询视频分类
		$type['status'] = array('eq',1);

		//$this -> assign('mid',is_login());  //当前登陆用户IDs
        $category = M('category')->where($type)->order('sort asc')->select();

        $category = $this->unlimitforlevel($category,'|--',23);
        $this->assign('category',$category);

		parent::_initialize();
	}
	public function index(){

		$where['status'] = array('gt',-1);

		$listsCount = M('video')->where($where)->count();
		$Page       = new \Think\Page($listsCount,20);// 实例化分页类
		$show       = $Page->show();// 分页显示输出

		$list = M('video')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);
		$this->assign('_page',$show);
		$this->display();

	}
	public function add(){
		if(IS_POST){

			$post = $_POST;
			if(trim($post['title'])==''){
				$this->error('请填写标题！');
			}
			if(trim($post['egtitle'])==''){
				$this->error('请填写英文标题！');
			}
			if(empty($post['icon'])){
				$this->error('请上传视频缩略图！');
			}
			if(empty($post['file'])){
			//	$this->error('请上传视频文件！');
			}

			$post['create_time'] = time();
			$res = M('video')->add($post);
			if($res){
				$this->success('添加成功',U('index'));
			}else{
				$this->error('添加失败！');
			}


		}else{


			$this->display();
		}

	}

	public function edit(){
		if(IS_POST){

			$post = $_POST;
			if(trim($post['title'])==''){
				$this->error('请填写标题！');
			}
			if(trim($post['egtitle'])==''){
				$this->error('请填写英文标题！');
			}
			if(empty($post['icon'])){
				$this->error('请上传视频缩略图！');
			}
			if(empty($post['file'])){
				$this->error('请上传视频文件！');
			}

			$post['update_time'] = time();
			$res = M('video')->save($post);
			if($res){
				$this->success('编辑成功',U('index'));
			}else{
				$this->error('编辑失败！');
			}


		}else{
			$get = $_GET;
			if($get['id']>0){
				$vo = M('video')->find($get['id']);
				$this->assign('vo',$vo);
			}

			$this->display();
		}

	}

	//更换状态
	public function changeStatus(){

		$post = $_REQUEST;
		$res = M('video')->where('id='.$post['id'])->save(array('status'=>-1));
		if($res){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}

	}
	public function _filter(&$sqlWhere){

        $get = I('get.');

        if(!empty($get['title'])){

            $sqlWhere['title'] = array('like','%'.$get['title'].'%');

        }

        return $sqlWhere;
    }

//	public function recommend(){
//		$id=$_GET['id'];
//		$recommend = M('video')->where("id=".$id)->find()['recommend'];
//		$tj=$recommend==1?0:1;
//		$re=M('video')->where("id=".$id)->save(array('recommend'=>$tj));
//		if($re){
//
//			$this->success('修改成功','/Admin/Video/index.html');
//		}else{
//			$this->error('修改失败');
//		}
//	}

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

    public function _before_add(){
        $_POST['mid']=UID;
        $_POST['create_time']=strtotime($_POST['create_time']);

    }
    public function _before_edit(){
        $_POST['update_time']=strtotime($_POST['update_time']);

        $_POST['mid']=$_POST['mid'];


    }
}
