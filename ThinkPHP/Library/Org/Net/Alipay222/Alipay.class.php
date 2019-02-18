<?php
namespace Org\Net\Alipay;
/* *
 * 配置文件
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
	
 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
	
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

class Alipay {//类定义开始
	
	//支付类型
	private $payment_type = "1";
	
	//必填，不能修改
	//服务器异步通知页面路径
	public $notify_url = "http://www.xxx.com/create_direct_pay_by_user-PHP-UTF-8/notify_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数
	
	//页面跳转同步通知页面路径
	public $return_url = "http://www.xxx.com/create_direct_pay_by_user-PHP-UTF-8/return_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
	
	//卖家支付宝帐户
	private $seller_email = '1045834146@qq.com';
	
	//必填
	
	//商户订单号
	public $out_trade_no;
	//商户网站订单系统中唯一订单号，必填
	
	//订单名称
	public $subject;
	//必填
	
	//付款金额
	public $total_fee;
	//必填
	//订单描述
	public $body;
	//商品展示地址
	public $show_url;
	//需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
	
	//防钓鱼时间戳
	public $anti_phishing_key = "";
	//若要使用请调用类文件submit中的query_timestamp函数
	
	//客户端的IP地址
	public $exter_invoke_ip;
	//非局域网的外网IP地址，如：221.0.0.1
	//合作身份者id，以2088开头的16位纯数字
	//public $alipay_config["partner"] = '2088411964121133';
	public $alipay_partner_id = '2088811106570186';
	
	//安全检验码，以数字和字母组成的32位字符
	//$alipay_config['key']			= 'v6b6q4yacuvtc8ofy1y1atjh0hwoomfm';
	public $alipay_key	= 'wevir5gosuohq6fdbkwfpy1o9q3oeqtd';
	
	private  $input_charset;
	
	private $alipay_config=array();
	
	//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

	public function submit(){
		header("Content-Type:text/html;Charset=utf-8");
		$alipay_config = $this->getalipay_Config();
		
		$parameter = array(
				"service" => "create_direct_pay_by_user",
				//"partner" => trim($this->alipay_config['partner']),
				"partner" => trim($this->alipay_partner_id),
				
				"payment_type"	=> $this->payment_type,
				"notify_url"	=> $this->notify_url,
				"return_url"	=> $this->return_url,
				"seller_email"	=> $this->seller_email,
				"out_trade_no"	=> $this->out_trade_no,
				"subject"	=> $this->subject,
				"total_fee"	=> $this->total_fee,
				"body"	=> $this->body,
				"show_url"	=> $this->show_url,
				"anti_phishing_key"	=> $this->anti_phishing_key,
				"exter_invoke_ip"	=> $this->exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($this->input_charset))
		);

		$alipaySubmit = new AlipaySubmit($alipay_config);
		
		
		
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		
		//var_dump($html_text);die();
		echo $html_text;
		
	}
	
	
	public function getalipay_Config(){
		header("Content-Type:text/html;Charset=utf-8");
		$alipay_config['partner'] = $this->alipay_partner_id;
		
		$alipay_config['key'] = $this->alipay_key;
		
		//签名方式 不需修改
		$alipay_config['sign_type']    = strtoupper('MD5');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$this->input_charset = $alipay_config['input_charset'];
		
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';
		
		return $alipay_config;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}