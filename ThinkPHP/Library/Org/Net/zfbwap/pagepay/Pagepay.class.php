<?php
/* *
 * 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
 */
namespace Org\Net\zfbwap\pagepay;


class Pagepay{

    public function alipay($data,$site = array()){

        require_once dirname ( __FILE__ ).'/service/AlipayTradeService.php';

        require_once dirname ( __FILE__ ).'/buildermodel/AlipayTradeWapPayContentBuilder.php';

        require_once dirname(dirname(__FILE__)).'/config.php';

        if (!empty($data['WIDout_trade_no'])&& trim($data['WIDout_trade_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $data['WIDout_trade_no'];

            //订单名称，必填
            $subject = $data['WIDsubject'];

            //付款金额，必填
            $total_amount = $data['WIDtotal_amount'];

            //商品描述，可空
            $body = $data['WIDbody'];

            if(!empty($site['notify_url'])){

                $config['notify_url'] = $site['notify_url'];

            }
            if(!empty($site['return_url'])){

                $config['return_url'] = $site['return_url'];

            }

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();

            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return $result;
        }
    }
}


?>

</html>