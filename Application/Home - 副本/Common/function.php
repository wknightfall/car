<?php



/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */
function getip(){
	global  $_SERVER;
	if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$ip  =  $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(isset($_SERVER["HTTP_CLIENT_IP"])){
		$ip  = $_SERVER["HTTP_CLIENT_IP"];
	}
	else{
		$ip  =  $_SERVER["REMOTE_ADDR"];
	}
	return $ip;
}
function geticon($id){
	$v=M('usermember')->Field('icon')->find($id);
	$icon=$v['icon'];
	$picture=M('picture')->Field('path')->find($icon);
	if($picture){
		return $picture['path'];
	}
	return '/Public/Home/images/def.jpg';
}
/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 获取列表总行数
 * @param  string  $category 分类ID
 * @param  integer $status   数据状态
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_list_count($category, $status = 1){
    static $count;
    if(!isset($count[$category])){
        $count[$category] = D('Document')->listCount($category, $status);
    }
    return $count[$category];
}




/**
 * 获取段落总数
 * @param  string $id 文档ID
 * @return integer    段落总数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_part_count($id){
    static $count;
    if(!isset($count[$id])){
        $count[$id] = D('Document')->partCount($id);
    }
    return $count[$id];
}
//生成验证码
function generate_code($length = 4) {
	
	
	return rand(pow(10,($length-1)), pow(10,$length)-1);

	
}



//会员密码加密
//密码加密
function mymd5($password){

	$jmpassword = md5(md5($password));
	return $jmpassword;
}

/**
 * 获取导航URL
 * @param  string $url 导航URL
 * @return string      解析或的url
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_nav_url($url){
    switch ($url) {
        case 'http://' === substr($url, 0, 7):
        case '#' === substr($url, 0, 1):
            break;        
        default:
            $url = U($url);
            break;
    }
    return $url;
}









function inmatchTit($id,$field){
	
	$match = M('matchmaker')->where('u_m_id='.$id)->find();
	
	return $match[$field];
	
}





function getCompanyNum($num){
	$length =strlen($num);
	if($length==1){
		return '0'.$num;
	}else if($length>1){
		return $num;
	}
	
}

//判断是否是手机登录
function ismobile(){

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");

    $is_mobile = false;

    foreach ($mobile_agents as $device) {

        if (stristr($user_agent, $device)) {

            $is_mobile = true;

            break;

        }

    }

    return $is_mobile;

}



function getTwoNavStatus($topid){

	 if($topid==1){
	 	return 100;
	 }else{
	 	 $where[status] = 1;
	     $where[pid]    = $topid;
	     $resu = M('category')->where($where)->select();
	     if(empty($resu)){
	     	return 200;
	     }else{
	     	return 100;
	     }

	 }

    


}










