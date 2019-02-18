<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wap\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
		
		$topid = I('request.topid');
		$topvo = M('category')->where('id='.$topid)->find();
		$this->assign('topvo',$topvo);
		$this->assign('topid',$topid);
		$this->assign('cname',CONTROLLER_NAME);
        //$this->head();
		//$this->leftnav();

        $cname=CONTROLLER_NAME;
        if($cname=='About'){
            $icon=M('ad')->where("id=5")->find()['icon'];
        }else if($cname=='News'){
            $icon=M('ad')->where("id=6")->find()['icon'];
        }else if($cname=='Works'){
            $icon=M('ad')->where("id=7")->find()['icon'];
        }else if($cname=='Project'){
            $icon=M('ad')->where("id=9")->find()['icon'];
        }else if($cname=='Culture'){
            $icon=M('ad')->where("id=10")->find()['icon'];
        }else if($cname=='Food'){
            $icon=M('ad')->where("id=11")->find()['icon'];
        }else if($cname=='House'){
            $icon=M('ad')->where("id=12")->find()['icon'];
        }else if($cname=='Transpot'){
            $icon=M('ad')->where("id=13")->find()['icon'];
        }else if($cname=='Scenic'){
            $icon=M('ad')->where("id=14")->find()['icon'];
        }else if($cname=='Shopping'){
            $icon=M('ad')->where("id=15")->find()['icon'];
        }else if($cname=='Funny'){
            $icon=M('ad')->where("id=16")->find()['icon'];
        }
        $this->assign('icon',$icon);

		if(!empty(session('user'))){
			
			$user=M('usermember')->where("id=".session('user'))->find();
			$user['avatar']=picture($user['icon']);
			$user['name']=mb_substr($user['name'],0,12);
			$this->assign('user',$user);

			$this->assign('uid',session('user'));
			$this->assign('shoptype',$user['shoptype']);
			$this->assign('islogin',1);
		}else{
			$this->assign('uid',0);
			$this->assign('shoptype',0);
			$this->assign('islogin',0);
		}

		$xxx[pid] = array('eq',0);
		$xxx[id] = array('lt',6);
		$mynav = M('category')->field('id,title,name,url')->where($xxx)->order('id asc')->select();
		foreach($mynav as $k=>$v){

			$a[pid] = array('eq',$v['id']);
			$a[id] = array('lt',70);
            $a[isnav] = array('eq',1);
			$son=M('category')->field('id,title,name,url')->where($a)->order('sort asc')->select();
			foreach($son as $sk=>$sv){
				if($sv['id'] == 39){
					$son[$sk]['url']=U($sv['url'],array('navid'=>73));
				}else if($sv['id'] == 40){
                    $son[$sk]['url']=U($sv['url'],array('navid'=>51));
                }
                else{
					$son[$sk]['url']=U($sv['url'],array('navid'=>$sv['id']));
				}

			}
			$mynav[$k]['son']=$son;
			$mynav[$k]['url']=U($v['url'],array('navid'=>$v['id']));
		}
		//var_dump($mynav);
		$this->assign('mynav',$mynav);

		$imqq = M('imqq')->where("status=1")->select();
		foreach($imqq as $sk=>$sv){
			//$leftnav[$sk]['url']=U($sv['url'],array('navid'=>$sv['id']));
		}
		$this->assign('imqq',$imqq);
    }

	
	
	//脚步
	public function leftnav(){
		//左边导航
		$top_id = I('request.topid');
		$whee[pid] = $top_id;
		$whee[status] = 1;
        $leftnav = M('category')->where($whee)->order('sort asc')->select();
        //p($leftnav);
		$this->assign('leftnav',$leftnav);
	}
	
	//头部
	public function head(){
		
       //查询顶部网站LOGO
	   $lg['typeid'] = array('eq',13);
	   $lg['status'] = array('eq',1);
	   $logo = M('ad')->where($lg)->order('sort asc')->find();
	  
	   $this -> assign('logo',$logo);
      
	   
	   //查询导航
	   $nav['pid'] = array('eq',0);
	   $nav['isnav'] = array('eq',1);
	   $nav['status'] = array('eq',1);
	   $navList = M('category')->where($nav)->field('url,title,id,pid')->order('sort asc')->limit(6)->select();
	   $this -> assign('navList',$navList);

	   foreach($navList as $kr=>$vr){
		  $navarrs[pid] = $vr[id]; 
		  $navarrs[status] = 1; 
		  $navarrs[isnav]  = 1; 
		  $navbn[$vr[id]] = M('category')->where($navarrs)->field('url,title,id,pid')->order('sort asc')->select();
	   }
	   
	   $this -> assign('navbn',$navbn);
	   //底部导航
	   foreach($navList as $kr=>$vr){
		  $navarr[pid] = $vr[id]; 
		  $navarr[status] = 1; 
		  $ernav[$vr[id]] = M('category')->where($navarr)->field('url,title,id,pid')->order('sort asc')->select();
	   }
	   $this -> assign('ernav',$ernav);
	   
	   
	   //查询网页左边导航
	   $arrte[typeid] = 16;
	   $arrte[status] = 1;
       $leftads = M('ad')->where($arrte)->order('id desc')->find();
	   $this -> assign('leftads',$leftads);	
	}
	
	public function send_post($url, $post_data) {
  
		  $postdata = http_build_query($post_data);
		  $options = array(
			  'http' => array(
			  'method' => 'POST',//or GET
			  'header' => 'Content-type:application/x-www-form-urlencoded',
			  'content' => $postdata,
			  'timeout' => 15 * 60 // 超时时间（单位:s）
		  )
		  );
		  $context = stream_context_create($options);
		  $result = file_get_contents($url, false, $context);
		  return $result;
	}
	public function checklogin(){
		
		/*$uid = $_GET['uid'];
		
		file_put_contents("text.txt","Hello World. Testing!");
		session('[start]');
		session('dr-uid',$uid);
		echo $uid;*/
		
		$memList = str_replace("_","",$_GET['key']);
		
		$memInfo = base64_decode($memList);
		

			
		  $uid = $memInfo;
			  
		  $key = md5('sourceCode=0005wllzztzdr@v_142779052200003');
		  $post_data = array(
			'sourceCode' => 5,
			'key' => $key,
			'uid' => $uid,
		  );
		  
		  $result = $this -> send_post('http://c.tzdr.com:999/tzdr-web/getUserInfo',$post_data);
		  
		  $memResult = json_decode($result,true);
		  
		  if($memResult['success'] == true){
			  
			  
			  //查询当前会员是否在这边注册
		  $memList = $memResult['data'];
		  //var_dump($memList);
		  $user['uid'] = array('eq',$memList['uid']);
		  
		  $userList = M('usermember')->where($user)->find();
		  if(!$userList){
			  
			  
			  //添加会员
			  
			  $data['uid'] = $memList['uid'];
			  $data['mobile'] = $memList['mobile'];
			  $data['username'] = $memList['uname'];
			  $data['email'] = $memList['email'];
			  $data['position'] = getCateId(31,$memList['position']);
			  $data['industry'] = getCateId(16,$memList['industry']);
			  $data['education'] = getCateId(9,$memList['education']);
			  $data['marriage'] = getCateId(27,$memList['marriage']);
			  if(!empty($memList['province'])){
				  
				  $data['nowsprovince'] = $memList['province'];
				  
			  }else{
				  
				  $data['nowsprovince'] = 0;	
				  
			  }
			  
			  if(!empty($memList['city'])){
				  
				  $data['nowscity'] = $memList['city'];
				  
			  }else{
				  
				  $data['nowscity'] = 0;	
				  
			  }
			  $data['nowsaddress'] = $memList['address'];
			  $data['birthday'] = '';
			  $data['leastlogin'] = time();
			  $data['addtime'] = $memList['ctime'];
			  $data['icon'] = 0;
			  $data['point'] = 0;
			  $data['birthaddress'] = 0;
			  
			  if(M('usermember')->add($data)){
				  
				  session('dr-uid',$memList['uid']);
				  $data['mobile'] = $$memList['mobile'];
				  $data['uid'] = $memList['uid'];
				  $data['success'] = true;
				  $data['message'] = '登陆成功！';		
			  }
			  
		  }else{
			  session('dr-uid',$memList['uid']);
			  $data['mobile'] = $$memList['mobile'];
			  $data['uid'] = $memList['uid'];
			  $data['success'] = true;
			  $data['message'] = '登陆成功！';	 
			}
		}else{
			$data['success'] = false;
		     $data['message'] = '用户不存在，非法操作！';	
		}
		 //var_dump($data);
	  echo json_encode($data);
	}
	public function data_post($url, $post_data) {
  
		  $postdata = http_build_query($post_data);
		  $options = array(
			  'http' => array(
			  'method' => 'GET',//or GET
			  'header' => 'Content-type:application/x-www-form-urlencoded',
			  'content' => $postdata,
			  'timeout' => 15 * 60 // 超时时间（单位:s）
		  )
		  );
		  $context = stream_context_create($options);
		  $result = file_get_contents($url, false, $context);
		  return $result;
	}

}
