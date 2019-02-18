<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
use OT\DataDictionary;
use Think\AjaxUpload;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class PublicController extends Controller {
	/*protected function _initialize(){
// 		读取站点配置
		$config = api('Config/lists');
		C($config); //添加配置
	
		if(!C('WEB_SITE_CLOSE')){
			$this->error('站点已经关闭，请稍后访问~');
		}
	}*/

	/*注册*/
	public function register(){
		if(IS_POST){
			$list=I('post.');
			$fidn['phone']=array('eq',$list['phone']);
			$user = M('usermember')->where($fidn)->find();
			if($user){
				exit(json_encode(array('code'=>402,'msg'=>'手机号存在!')));
			}
            if(session($list['phone'])!=$list['regphonecode']){
                exit(json_encode(array('code'=>403,'msg'=>'验证码错误!')));
            }
			$add['name']=$list['phone'];
            $add['phone']    = $list['phone'];
			$add['password']=$list['password'];
            //$add['password']=md5(md5($list['password']));
			$add['reg_time']=time();

			$useradd= M('usermember')->add($add);
			if($useradd){
                session('user',$useradd);
                session('user_info',M('usermember')->where("id=".$useradd)->find());
				exit(json_encode(array('code'=>200,'msg'=>'注册成功')));
			}else{
				exit(json_encode(array('code'=>400,'msg'=>'注册失败')));
			}

		}else{
			$this->display();
		}
	}
    public function checklogin(){
        if(IS_POST){ 

            $list=I('post.');
			$whe['phone']=$list['username'];
            $whe['password']=$list['password'];
            $re=M('usermember')->where($whe)->find();
            if($re){

				if($re['state']==0){
					exit(json_encode(array('code'=>400,'msg'=>'您已被禁用，请联系系统管理员')));
				}
                session('user',$re['id']);
                session('user_info',$re);
                exit(json_encode(array('code'=>200,'msg'=>'登陆成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'用户名或密码错误')));
            }
        }
    }
	/*退出*/
	public function logout(){
		session('user',null);
		session('user_info',null);
		$this->redirect('/Home/Index/index');
	}
	public function verify(){
		$verify = new \Think\Verify();
		$verify->length   = 3;
		$verify->entry(1);
	}
   
    //获取注册短信验证码  注册模板号 SMS_137895102  修改密码 SMS_137895101 
    public function sms(){
        if(empty($_POST['phone'])){
            exit(json_encode(array('code'=>400,'msg'=>'手机号码不能为空')));
        }
        $pt=$_POST;
        $phone=$_POST['phone'];
         //type发送类型  1:注册  2短信登录 3修改密码  4修改支付密码  5修改手机号
        if($pt['type'] == 1){
            //判断该手机号是否已经注册过
            if(M('usermember')->where("phone=".$phone)->find()){
                exit(json_encode(array('code'=>400,'msg'=>'该手机号已被注册！')));
            }
            $sms = "SMS_137895102 ";
            $verify_type = 'verify';
        }elseif ($pt['type'] == 2 ){
            $sms = "";
        }elseif ($pt['type'] == 3 ){
            
            $sms = "SMS_137895101";
           
        }elseif ($pt['type'] == 4 ){
            $sms = "";
        }elseif ($pt['type'] == 5 ){
            if(M('usermember')->where("phone=".$phone)->find()){
                exit(json_encode(array('code'=>400,'msg'=>'该手机号已被注册！')));
            }
            $sms = "SMS_137895102";
        }
        $codes = rand(1000,9999);
        $run = AliyunSendMsg($phone,$sms,$codes);
        if($run[Code]=='OK'){
            session($phone,$codes);
            exit(json_encode(array('code'=>200,'msg'=>'短信已发送至'.substr($_POST['phone'],-4))));
        }else{
            exit(json_encode(array('code'=>400,'msg'=>$run['Message'])));
        }
    }
	public function forget(){
		if (IS_POST) {
			$list = I('post.');


			$re = M('usermember')->where("phone=" . $list['phone'])->find();
			if (!$re) {
				exit(json_encode(array('code' => 400, 'msg' => '用户不存在')));
			}
			if (session($re['phone']) != $list['code']) {
				exit(json_encode(array('code' => 402, 'msg' => '验证码错误')));
			}
			$save=M('usermember')->where("phone=".$re['phone'])->save(array('password'=>$list['newpass']));
            

			if ($save) {
				exit(json_encode(array('code' => 200,'msg'=>'修改成功' )));
			} else {
				exit(json_encode(array('code' => 400, 'msg'=>'修改失败')));
			}
		}else{
            $this->display();
        }
	}

	//微信登录
	public function wx_login(){
		//$AppID     = C('WX_LOGIN_APPID');
		//$AppSecret = C('WX_LOGIN_APPSECRET');
        $AppID     = 'wxad41fc80c23c0208';
        $AppSecret = '9d8f71069e5fcabe8f4cf7b34f3cc68d';

		$callback  =  'http://www.gzsxwljt.com/Home/public/callback'; //回调地址

		//-------生成唯一随机串防CSRF攻击
		$state  = md5(uniqid(rand(), TRUE));
		session('wx_state',$state);//存到SESSION
		$callback = urlencode($callback);

		$wxurl = "https://open.weixin.qq.com/connect/qrconnect?appid=".$AppID."&redirect_uri=".$callback."&response_type=code&scope=snsapi_login&state=".$state."#wechat_redirect";
		header("Location: $wxurl");


	}

	//微信回调地址
	public function callback(){
        $AppID     = 'wxad41fc80c23c0208';
        $AppSecret = '9d8f71069e5fcabe8f4cf7b34f3cc68d';

		$info = D('Login')->wx_login($AppID,$AppSecret,$_GET['state'],$_GET['code']); //获取用户信息，参数必传


		$where['openid'] = array('eq',$info['openid']);
		//$where['status'] = array('eq',1);
		$res = M('usermember')->where($where)->find();
		if(!empty($res)){
            session('user',$res['id']);
			session('sdw_users_id',$res['id']); //登录成功
			if(ismobile()){
				$this->redirect('/Wap/Index/index');
			}else{
				$this->redirect('/Home/Index/index');
			}
		}else{
            $data['openid']=$info['openid'];
            $data['name']=$info['nickname'];
			$data['reg_time']=time();
            $add = M('usermember')->add($data);
            if($add){
                session('user',$add);
                session('three_login_type','weixin');//向前台传递三方登录类型
                $this->redirect('Index/index');
            }
			// //绑定账号*/
		}

	}

	//QQ登录入口
	public function qq_login(){
		$app_id = C('QQ_LOGIN_APPID');
		$app_id =101502450;
		$scope = 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol';
		$callback = 'http://www.gzsxwljt.com/home/public/qqlogin';

		$sns = new \Common\Api\QQConnect;
		$sns->login($app_id, $callback, $scope);
	}
	//qq登录回调地址
	public function qqlogin(){
		$callback = 'http://www.gzsxwljt.com/home/public/qqlogin';
		$appid=101502450;
		$appkey='a0acd40215e7d06e6e380cfe0ba637cf';

		$info = D('Login')->qq_userinfo($_REQUEST['code'],$_REQUEST['state'],$appid,$appkey,$callback);

		$where['qq_openid'] = array('eq',$info['openid']);
		//$where['status'] = array('eq',1);
		$res = M('usermember')->where($where)->find();
		if(!empty($res)){
			session('user',$res['id']);
			session('sdw_users_id',$res['id']); //登录成功

		}else{
			$data['qq_openid']=$info['openid'];
			$data['name']=$info['nickname'];
			$data['reg_time']=time();
			$add = M('usermember')->add($data);
			if($add){
				session('user',$add);
				session('three_login_type','weixin');//向前台传递三方登录类型

			}
			// //绑定账号*/
		}
		if(ismobile()){
			$this->redirect('/Wap/Index/index');
		}else{
			$this->redirect('/Home/Index/index');
		}

	}

	//没有绑定第三方唯一标识 跳转绑定页面
	public function bang(){
		if(IS_POST){
			$post = $_POST;

			$where['mobile'] = array('eq',$post['mobile1']);
			$vo = M('usermember')->where($where)->find();

			if(empty($vo) || $vo['status']!=1){
				$this->ajaxReturn(array('code'=>201,'msg'=>'账号不存在或被禁用！'));exit;
			}else{
				if($vo['password']!=mymd5($post['password'])){
					$this->ajaxReturn(array('code'=>201,'msg'=>'密码错误！'));exit;
				}
			}
			$thrinfo = session('wxdj_three_info');
			if(empty($thrinfo)){
				$this->ajaxReturn(array('code'=>201,'msg'=>'获取第三方信息失败！'));exit;
			}
			$data['id'] = $vo['id'];
			if($post['type']=='weixin'){
				//微信
				if($vo['openid']!=''){
					$this->ajaxReturn(array('code'=>201,'msg'=>'该账号已被绑定！'));exit;
				}

				$data['openid']     = $thrinfo['openid'];
				$data['wx_headimg'] = $thrinfo['headimgurl'];
			}else if($post['type']=='qq'){
				//qq
				$data['qq_openid']  = $thrinfo['openid'];
				$data['qq_headimg'] = $thrinfo['figureurl'];
			}

			$res = M('usermember')->save($data);
			if($res){
				session('sdw_users_id',$vo['id']); //登录成功
				$this->ajaxReturn(array('code'=>200,'msg'=>'登录成功！'));
			}else{
				$this->ajaxReturn(array('code'=>201,'msg'=>'登录失败！'));
			}


		}else{

			$this->assign('type',session('three_login_type'));

			$this->display();
		}

	}

	//获取注册短信验证码  注册模板号 SMS_105215235  修改密码 SMS_105215234 登录确认 SMS_105215237  签名号 115901164
    public function mobileVerify(){

        if(IS_POST){
            $randnum =  session('dx_rand_num');
            $pt = $_POST;
            //验证是否正规操作
            if($pt['rand_num']!=$randnum){
                $msg[status] = 2;
                $msg[msg]    =  '非法操作！';
                $this->ajaxReturn($msg);exit;
            }
            $mobile = $pt[mobile];
            $map['mobile'] = array('eq',$mobile);
            $telResu = M('usermember')->where($map)->find();
            //type发送类型  1:注册  2短信登录 3修改密码  4修改支付密码  5修改手机号
            if($pt['type'] == 1){
                //判断该手机号是否已经注册过
                if(!empty($telResu)){
                    $msg[status] = 2;
                    $msg[msg]    =  '该手机号已被注册！';
                    $this->ajaxReturn($msg);exit;
                }
                $sms = "SMS_105215235";
                $verify_type = 'verify';
            }elseif ($pt['type'] == 2 ){
                //判断用户是否存在
                if(empty($telResu)){
                    $msg[status] = 2;
                    $msg[msg]    =  '该手机号不存在！';
                    $this->ajaxReturn($msg);exit;
                }
                $sms = "SMS_105215237";
                $verify_type = 'verify';
            }elseif ($pt['type'] == 3 ){
                //判断用户是否存在
                if(empty($telResu)){
                    $msg[status] = 2;
                    $msg[msg]    =  '该手机号不存在！';
                    $this->ajaxReturn($msg);exit;
                }
                $sms = "SMS_105215234";
                $verify_type = 'verify';
            }elseif ($pt['type'] == 4 ){
                //判断用户是否存在
                if(empty($telResu)){
                    $msg[status] = 2;
                    $msg[msg]    =  '该手机号不存在！';
                    $this->ajaxReturn($msg);exit;
                }
                $sms = "SMS_105215234";
                $verify_type = 'paypass';
            }elseif ($pt['type'] == 5 ){
                //判断用户是否存在
                if(!empty($telResu)){
                    $msg[status] = 2;
                    $msg[msg]    =  '该手机号已存在！';
                    $this->ajaxReturn($msg);exit;
                }
                $sms = "SMS_105215234";
                $verify_type = 'updateMobile';
            }

            $yzm = rand(100000,999999);

            //阿里云短信接口
            $rt = AliyunSendMsg($pt['mobile'],$sms,$yzm);

            if($rt[Code]=='OK'){
                session($pt[mobile].$verify_type,$yzm);//将短信验证码存入session中
                session('dx_rand_num',null);//清除session
                $msg[status] = 1;
                $msg[msg]    =  '短信发送成功，请注意查收！';
            }else{
                $msg[status] = 2;
                $msg[msg]    =  '短信发送失败！';
            }
            $this->ajaxReturn($msg);exit;
        }else{
            $this->error('非法操作');
        }

    }
	/*手机验证码重置密码*/
	public function phoneresetpassword(){
		if(IS_POST){
			$list=I('post.');
			if(session($list['forgetuname'])!=$list['forgecode']){
				exit(json_encode(array('code'=>402,'msg'=>'验证码错误!')));
			}
			$fidn['uname']=array('eq',$list['forgetuname']);
			$user = M('system_users','jieqi_','DB_CONFIG1')->where($fidn)->find();
			if(empty($user)){
				exit(json_encode(array('code'=>401,'msg'=>'账号不存在!')));
			}else{
				exit(json_encode(array('code'=>200,'msg'=>'验证成功!')));
			}

		}
	}
	/*重置密码*/
	public function resetpassword(){
		if(IS_POST){
			$list=I('post.');

			$fidn['uname']=array('eq',$list['forgetuname']);
			$user = M('system_users','jieqi_','DB_CONFIG1')->where($fidn)->find();
			if($user){
				exit(json_encode(array('code'=>400,'msg'=>'非法操作!')));
			}
			if($user['pass']==md5(md5($list['forgepass']))){
				exit(json_encode(array('code'=>200,'msg'=>'修改成功!')));
			}
			$save['pass']=md5(md5($list['forgepass']));
			$saveuser = M('system_users','jieqi_','DB_CONFIG1')->where('uid='.$user['uid'])->save($save);
			if($saveuser){
				exit(json_encode(array('code'=>200,'msg'=>'修改成功!')));
			}else{
				exit(json_encode(array('code'=>400,'msg'=>'修改失败!')));
			}
		}
	}

	//上传图片
	public function upload333(){

		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     'Picture/'; // 设置附件上传（子）目录
		// 上传文件
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$arr = array('code'=>201,'msg'=>$upload->getError());
			$this->ajaxReturn($arr);
		}else{// 上传成功
			$path = "/Uploads/".$info['file']['savepath'].$info['file']['savename'];
			$file = file_get_contents('.'.$path);
			$where['sha1'] = array('eq',sha1($file));
			$where['md5'] = array('eq',md5($file));
			$vo = M('picture')->where($where)->find();
			if(!empty($vo)){
				@unlink('.'.$path); //删除图片路径
				$arr = array('code'=>200,'path'=>$vo['path'],'icon'=>$vo['id']);
			}else{
				$data['sha1'] = $info['file']['sha1'];
				$data['md5']  = $info['file']['md5'];
				$data['create_time'] = time();
				$data['path'] = $path;
				$res = M('picture')->add($data);
				if($res){
					$arr = array('code'=>200,'path'=>$path,'icon'=>$res);
				}
			}
			$this->ajaxReturn($arr);
		}
	}
	/*用户头像*/
	public function uploadicon(){
		$id=session('user');

		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   = 3145728 ;// 设置附件上传大小
		$upload->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  = 'https://move20170828.oss-cn-shanghai.aliyuncs.com/files/system/avatar/';// 设置附件上传根目录
		if(strlen($id)>3){
			$upload->savePath  = substr($id,0,3);
		}else{
			$upload->savePath  = $id;
		}
		$upload->saveName = $id;/*上传文件的名称*/
		// 上传文件
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$arr = array('code'=>201,'msg'=>$upload->getError());
			$this->ajaxReturn($arr);
		}else{// 上传成功

			$arr = array('code'=>200,'path'=>"");
			$this->ajaxReturn($arr);
		}
	}

	public function test(){
		if (!is_dir("./Uploads/Picture/".date('Y-m-d'))){
			mkdir("./Uploads/Picture/".date('Y-m-d'), 0777);
		}

		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     "Picture/"; // 设置附件上传（子）目录
		// 上传文件
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$arr = array('code'=>201,'msg'=>$upload->getError());
			$this->ajaxReturn($arr);
		}else{// 上传成功
			$icon='';
			foreach ($info as $k=>$v) {
				$path = "/Uploads/".$v['savepath'].$v['savename'];
				//$file = file_get_contents('.'.$path);
				$where['sha1'] = array('eq',$v['sha1']);
				$where['md5'] = array('eq',$v['sha1']);
				$vo = M('picture')->where($where)->find();
				if(!empty($vo)){
					@unlink('.'.$path); 
					//$arr = array('code'=>200,'path'=>$vo['path'],'icon'=>$vo['id']);
				}else{
					$data['sha1'] = $v['sha1'];
					$data['md5']  = $v['md5'];
					$data['create_time'] = time();
					$data['path'] = $path;
					$res = M('picture')->add($data);
					if($res){
						//$arr = array('code'=>200,'path'=>$path,'icon'=>$res);
						$icon .= ','.$res;
					}

				}
			}
			
			//$arr = array('code'=>200,'path'=>$path,'icon'=>trim($icon,','));
			$icon=trim($icon,',');
			$re=M('usermember')->where('id='.session('user'))->save(array('icon'=>$icon));
			if($re){
				$this->redirect('mer/shangjia',array('icon'=>$icon));
			}
			//$this->ajaxReturn($arr);
		}
	}
	//上传图片
	public function upload(){
		if ($_POST) {
			$form_name = $_GET['form_name'];
			$file_size = intval($_GET['file_size']);
			$upload = new AjaxUpload($form_name, $file_size);
			$result = $upload->upload();
			if($result['ok'] == 'ok'){
				$data['path'] = "/Uploads/Picture/".date('Y-m-d').'/'.$result['filename'];
				$data['url'] = '';
				$file = file_get_contents('.'.$data['path']);
				$data['md5'] = md5($file);
				$data['sha1'] = sha1($file);
				$data['status'] = 1;
				$data['create_time'] = time();
				$pic['md5'] = array('eq',$data['md5']);
				$pic['sha1'] = array('eq',$data['sha1']);
				$picture = M('picture')->where($pic)->find();
				if($picture){
					@unlink('.'.$data['path']);
					$arr = array('ok'=>"ok",'filename'=>$picture['path'],'id'=>$picture['id']);
					exit(json_encode($arr));
				}else{
					$result = M('picture')->add($data);
					if($result){
						$arr = array('ok'=>"ok",'filename'=>$data['path'],'id'=>$result);
						exit(json_encode($arr));
					}
				}
			}
		}
	}
	/*用户更改头像*/
	public function uploads(){
		if ($_POST) {
			$form_name = $_GET['form_name'];
			$file_size = intval($_GET['file_size']);
			$upload = new AjaxUpload($form_name, $file_size);
			$result = $upload->upload();
			if($result['ok'] == 'ok'){
				$data['path'] = "/Uploads/Picture/".date('Y-m-d').'/'.$result['filename'];
				$data['url'] = '';
				$file = file_get_contents('.'.$data['path']);
				$data['md5'] = md5($file);
				$data['sha1'] = sha1($file);
				$data['status'] = 1;
				$data['create_time'] = time();
				$pic['md5'] = array('eq',$data['md5']);
				$pic['sha1'] = array('eq',$data['sha1']);
				$picture = M('picture')->where($pic)->find();
				if($picture){
					@unlink('.'.$data['path']);
					$id['id']=array('eq',session('user'));
					$save['icon']=$picture['id'];
					M('user')->where($id)->save($save);
					$arr = array('ok'=>"ok",'filename'=>$picture['path'],'id'=>$picture['id']);
					exit(json_encode($arr));
				}else{
					$result = M('picture')->add($data);
					if($result){
						$id['id']=array('eq',session('user'));
						$save['icon']=$result;
						M('user')->where($id)->save($save);
						$arr = array('ok'=>"ok",'filename'=>$data['path'],'id'=>$result);
						exit(json_encode($arr));
					}
				}
			}
		}
	}


	/*微信登陆已经判断*/
	public function calljs(){
		if(IS_POST){
			$list=I('post.');
			if($list['type']==1){
				$wher['weiappid']=array('eq',$list['msg']['openid']);
				$user=M('user')->where($wher)->find();
				if($user){
					session('user',$user['id']);
					exit('200');
				}else{
					session('weix',$list['msg']);
					exit('400');
				}
			}else{
				/*绑定微信*/
				$wher['weiappid']=array('eq',$list['msg']['openid']);
				$user=M('user')->where($wher)->find();
				if($user){
					exit(json_encode(array('code'=>'400','msg'=>'当前微信已绑定过了,请更换微信!')));
				}
				$id['id']=array('eq',session('user'));
				$save['weititle']=$list['msg']['name'];
				$save['weiappid']=$list['msg']['openid'];
				$user=M('user')->where($id)->save($save);
				if($user){
					exit(json_encode(array('code'=>'200','msg'=>'绑定成功')));
				}else{
					exit(json_encode(array('code'=>'400','msg'=>'绑定失败')));
				}
			}
		}
	}
	
	//登陆接口
	
	public function sessionLogin(){
		
		$href = $_POST['href'];
		$data['sourceCode'] = 5;
		$data['backData'] = base64_encode($href);
		$data['key'] = md5('sourceCode=000'.$data['sourceCode'].'&backData='.$href.'wllzztzdr@v_142779052200001');
		
		$arr = json_encode($data);
		
		echo $arr;
		
	}
	
	//注册接口
	
	public function sessionRegister(){
		
		$href = $_POST['href'];
		$data['sourceCode'] = 5;
		$data['backData'] = base64_encode($href);
		$data['key'] = md5('sourceCode=000'.$data['sourceCode'].'&backData='.$href.'wllzztzdr@v_142779052200002');
		
		$arr = json_encode($data);
		
		echo $arr;
		
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
  
  //弹窗是否登陆
  
  public function loginCheck(){
	  
	$this -> display();  
	  
  }
  
  //退出会员中心
  
  public function signout(){
	  	
		session('dr-uid',null);  
		
		$href = $_POST['url'];
		$data['sourceCode'] = 5;
		$data['backData'] = base64_encode($href);
		$data['key'] = md5('sourceCode=000'.$data['sourceCode'].'&backData='.$href.'wllzztzdr@v_142779052200001');
		
		
		echo '200-'.$data['sourceCode'].'-'.$data['backData'].'-'.$data['key'];
		
		//exit('200');
		/*$url = $_POST['url'];
		
		$this -> redirect('http://c.tzdr.com:999/tzdr-web/logout?sourceCode=5&backData='.base64_encode($url).'&key='.md5('sourceCode=0005&backData='.$url.'wllzztzdr@v_142779052200001'));
		
		$uid = session('dr-uid');
	  	$key = md5('sourceCode=0005wllzztzdr@v_142779052200005');
		$post_data = array(
		  'sourceCode' => 5,
		  'key' => $key,
		  'uid' => $uid,
		);
	  	$result = $this -> send_post('http://c.tzdr.com:999/tzdr-web/singleLogout',$post_data);
		
		$memResult = json_decode($result,true);
		
		//exit(var_dump($memResult));
		
		if($memResult['success'] == true){
			
				
			
		}else{
			
			exit('500');
			
		}*/
	  
		
	 
  }
  
  //查询@好友列表
  public function memlist(){
	  
	  	$useration = $this -> getMemberation();
		
		//查询自己的所有好友
		$data['_string'] = ' uid = '.$useration.' OR friendid = '.$useration;
		$fir['status'] = array('eq',1);
		
		//查询最新的所有问题
	   
		$data = M("friend");
		$count = $data->where($fir)->count();

		$Page = new \Think\Pagelist($count,12); // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show(); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$friList = $data->where($fir)->limit($Page->firstRow.",".$Page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		
		$this -> assign('friList',$friList);
		$this -> assign('useration',$useration);
		$this -> display();  
		
  }
  
  //存在登陆session
  public function loginSession(){
	  
		session('loginSession','loginSession');
		
		exit('200');  
	  
  }
  
  //存储注册session
  public function registerSession(){
	  
		session('loginSession','registerSession');
		
		exit('200');  
	  
  }
  
  //获取登陆注册session
  public function layerSession(){
	  
	  $loginSession = session('loginSession');
	  
	  if($loginSession == 'loginSession'){
		  
		  session('loginSession',null);
		  exit('200');
		  
	  }elseif($loginSession == 'registerSession'){
		  session('loginSession',null);
		  exit('201');
		  
	  }else{
		  session('loginSession',null);
		  exit('500'); 
		  
	  }
	  
	  
  }

    public function loginout(){
        if(IS_POST){
            if(session('user',null) && session('user_info',null)){
                exit(json_encode(array('code'=>200,'msg'=>'')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'')));
            }
        }
    }
  public function checklogin1(){
		
		$memList = str_replace("_","",$_GET['key']);
		
		$memInfo = json_decode($memList,true);
		
		$backData = base64_decode($memInfo['backData']);
		
		$kevVal = md5('sourceCode=000'.$memInfo['sourceCode'].'&backData='.$backData.'7kcb@19910503');
		
		if($memInfo['key'] == $kevVal && $memInfo['sourceCode'] == 5){
			
			
			$uid = $memInfo['uid'];
				
			$key = md5('sourceCode=0005wllzztzdr@v_142779052200003');
			$post_data = array(
			  'sourceCode' => 5,
			  'key' => $key,
			  'uid' => $uid,
			);
			
			$result = $this -> send_post('http://c.tzdr.com:999/tzdr-web/getUserInfo',$post_data);
			
			$memResult = json_decode($result,true);
			
			
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
					
					Header("Location: $backData"); 
				}
				
			}else{
				
				
				
				session('dr-uid',$memList['uid']);
				
				Header("Location: $backData"); 
				
				
			}
			
			
		}else{
			
			$data['success'] = false;
			$data['message'] = '密钥或渠道来源不匹配！';		
			
		}
		
		var_dump($data);
	}
  
  //同步登陆
  
  public function login(){
	  
	  $this->display();
  }
	
}
