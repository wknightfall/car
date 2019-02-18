<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

include_once "../lib/WxPay.Api.php";
include_once "WxPay.NativePay.php";
include_once 'log.php';
//echo __FILE__.'/ThinkPHP/Library/Vendor/Wxpay/example';exit;
/*require_once "../libe/WxPay.Api.php";
echo 2345;exit;*/
/*require_once('WxPay.NativePay.php');
include_once('../lib/WxPay.Data.php');
require_once('log.php');*/


//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
 
class Native{
	public function native($body,$attach,$total_fee,$product_id){

        $notify = new NativePay();
		$input = new WxPayUnifiedOrder();
		$input->SetBody($body);
		$input->SetAttach($attach);
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($total_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		//$input->SetGoods_tag("test");
		$input->SetNotify_url(WxPayConfig::NOTIFY_URL);
		$input->SetTrade_type("NATIVE");
		$input->SetProduct_id($product_id);
		$result = $notify->GetPayUrl($input);
		return $result;
	}
} 



?>
