<?php

namespace Home\Model;
use Think\Model;

/**
 * 分类模型
 */
class LoginModel extends Model{
	
	
    //微信登录 
	public function wx_login($AppID,$AppSecret,$state,$code){
		
		if($state!=session('wx_state')){
			  exit("5001");
		}
		$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$code.'&grant_type=authorization_code';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$json =  curl_exec($ch);
		curl_close($ch);
		$arr=json_decode($json,1);
		//得到 access_token 与 openid
		
		$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$json =  curl_exec($ch);
		curl_close($ch);
		$arr=json_decode($json,1);
		
		return $arr;
		
	}
	
	
	//qq获取用户信息
	public function qq_userinfo($code,$state,$appid,$appkey,$callback){
		
		$code = isset($code)? $code : '';
        $state = isset($state)? $state : '';  
		$url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=".$appid."&client_secret=".$appkey."&code=".$code."&redirect_uri=".urlencode($callback);
		
		//返回token
		$mm = file_get_contents($url);
		parse_str($mm,$arr);
		$acc_token = $arr[access_token];
		
		//获取client_id 和 openid
		$urler = 'https://graph.qq.com/oauth2.0/me?access_token='.$acc_token;
		$iders = file_get_contents($urler);
		
		$client_open = $this->change_callback($iders);
		$client_id = $client_open[client_id];
		$openid = $client_open[openid];
		
		//获取用户信息
		$urlty = 'https://graph.qq.com/user/get_user_info?oauth_consumer_key='.$client_id.'&access_token='.$acc_token.'&openid='.$openid.'&format=json';
		$userinfo = file_get_contents($urlty);
		$userinfoarr           = json_decode($userinfo,true);
		$userinfoarr['openid'] = $openid;
		return $userinfoarr;
	}

	protected function change_callback($str){
        if (strpos($str, "callback") !== false){
            //将字符串修改为可以json解码的格式
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $json  = substr($str, $lpos + 1, $rpos - $lpos -1);
            //转化json
            $result = json_decode($json,true);
            $this->client_id = $result['client_id'];
            $this->openid = $result['openid'];
            return $result;
        }else{
            return false;
        }
    }


}
