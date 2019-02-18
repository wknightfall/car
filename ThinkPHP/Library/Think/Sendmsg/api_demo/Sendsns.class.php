<?php

namespace Think\Sendmsg\api_demo;
ini_set("display_errors", "on");

require_once dirname(__DIR__) . '/api_sdk/vendor/autoload.php';

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;


// 加载区域结点配置
Config::load();

/**
 * Class SmsDemo
 *
 * @property \Aliyun\Core\DefaultAcsClient acsClient
 */
class Sendsns
{

    public function ddsd($mobile,$smscode,$codes){


        $accessKeyId = "LTAIvCURvFo7JLhT";//参考本文档步骤2
        $accessKeySecret = "O6nigRgqvOIfGEFaqbDbewccUiGRwd";//参考本文档步骤2
		
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);

        $acsClient= new DefaultAcsClient($profile);

        $request = new SendSmsRequest();

        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("贵州杉乡文旅集团");
        //必填-短信模板Code
        $request->setTemplateCode($smscode);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $request->setTemplateParam("{\"code\":\"$codes\",\"product\":\"ytx\"}");
        //选填-发送短信流水号
        $request->setOutId("23");
       // print_r($request);exit;
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
       // print_r($acsResponse);exit;
        return $acsResponse;
    }
	
	public function hotel($mobile,$smscode,$orderno,$name,$date1,$date2,$num,$price,$date3,$addr,$tel,$hotelname){
        $accessKeyId = "LTAIvCURvFo7JLhT";//参考本文档步骤2
        $accessKeySecret = "O6nigRgqvOIfGEFaqbDbewccUiGRwd";//参考本文档步骤2
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);


        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);

        $acsClient= new DefaultAcsClient($profile);

        $request = new SendSmsRequest();

        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("贵州杉乡文旅集团");
        //必填-短信模板Code
        $request->setTemplateCode($smscode);

         //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        //$orderno,$name,$date1,$date2,$num,$price,$date3,$addr,$tel,$hotelname
         $request->setTemplateParam("{\"orderno\":\"$orderno\",\"product\":\"ytx\",\"name\":\"$name\",\"date1\":\"$date1\",
        \"date2\":\"$date2\",\"num\":\"$num\",\"price\":\"$price\",\"date3\":\"$date3\",\"addr\":\"$addr\",\"tel\":\"$tel\",\"hotelname\":\"$hotelname\"}");
        //选填-发送短信流水号
        $request->setOutId("23");
       // print_r($request);exit;
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
       // print_r($acsResponse);exit;
        return $acsResponse;
    }
    public function food($mobile,$smscode,$orderno,$time,$resname,$foodname){
        $accessKeyId = "LTAIvCURvFo7JLhT";//参考本文档步骤2
        $accessKeySecret = "O6nigRgqvOIfGEFaqbDbewccUiGRwd";//参考本文档步骤2
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);


        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);

        $acsClient= new DefaultAcsClient($profile);

        $request = new SendSmsRequest();

        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("贵州杉乡文旅集团");
        //必填-短信模板Code
        $request->setTemplateCode($smscode);

        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        //$orderno,$name,$date1,$date2,$num,$price,$date3,$addr,$tel,$hotelname
        $request->setTemplateParam("{\"orderno\":\"$orderno\",\"product\":\"ytx\",\"time\":\"$time\",\"resname\":\"$resname\",
        \"foodname\":\"$foodname\"}");
        //选填-发送短信流水号
        $request->setOutId("23");
        // print_r($request);exit;
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
        // print_r($acsResponse);exit;
        return $acsResponse;
    }
    public function piao($mobile,$smscode,$orderno,$yzm,$scenicname,$num,$date,$price){
        $accessKeyId = "LTAIvCURvFo7JLhT";//参考本文档步骤2
        $accessKeySecret = "O6nigRgqvOIfGEFaqbDbewccUiGRwd";//参考本文档步骤2
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);


        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);

        $acsClient= new DefaultAcsClient($profile);

        $request = new SendSmsRequest();

        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("贵州杉乡文旅集团");
        //必填-短信模板Code
        $request->setTemplateCode($smscode);

        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        //,$yzm,$scenicname,$num,$date,$price
        $request->setTemplateParam("{\"orderno\":\"$orderno\",\"product\":\"ytx\",\"yzm\":\"$yzm\",\"scenicname\":\"$scenicname\",
        \"num\":\"$num\",\"date\":\"$date\",\"price\":\"$price\"}");
        //选填-发送短信流水号
        $request->setOutId("23");
        // print_r($request);exit;
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
        // print_r($acsResponse);exit;
        return $acsResponse;
    }



}

?>