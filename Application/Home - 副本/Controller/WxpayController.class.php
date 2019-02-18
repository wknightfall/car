<?php

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class WxpayController extends HomeController {

    //微信支付
	public function testpay(){
        $get = $_REQUEST;
        if($get['orderno']==''){
            $this->error('非法操作！');
        }
        $where['orderno'] = array('eq',$get['orderno']);
        
        $vo = M('order')->where($where)->find();
        if(empty($vo)){
            $this->error('非法操作！');
        }
        $time=time();
        $order=array(
            'body'=> '杉乡旅游-下单',
            //'total_fee'=>$vo['total_price']*100, //单位分
            'total_fee'=>1, //单位分
            'out_trade_no'=>$vo['orderno'],
            'product_id'=>$vo['id'],
            'notify_url'=>'http://www.gzsxwljt.com/Home/Pay/wxnotify'
        );
        $url = weixinpay($order);
        //$url = 'http://www.baidu.com';
        $path    = 'Uploads/Picture/Qrcode/'.date('Ymd').'/';
        $imgname = date('YmdHis').rand(1000,9999);
        wxpay_qrcode($url,$path,$imgname,'L',10);
        $imgurl = '/'.$path.$imgname.'.png';
        $this->assign('url',$imgurl);
        $this->assign('orderno',$vo['orderno']);
        $this->display();

	}

	public function notify(){

        $postdata = file_get_contents("php://input");
        $postObj = simplexml_load_string( $postdata, 'SimpleXMLElement', LIBXML_NOCDATA );
        file_put_contents('1232.txt',$postObj->result_code);

    }


    //定时查询该订单是否支付成功
    public function select_order(){
        if(IS_POST){
            $post = $_POST;
         
            $where['orderno'] = array('eq',$post['orderno']);
            $vo = M('order')->where($where)->find();
            
            $time = $vo['time']+60;
            if($vo['state']==1){
                $msg = array('code'=>200,'msg'=>'支付成功！');
            }else if($vo['state']==2){
                $msg = array('code'=>202,'msg'=>'支付失败！');
            }else{
                if($time<time()){
                    $msg = array('code'=>201,'msg'=>'支付已超时！');
                }
            }
            $this->ajaxReturn($msg);
        }
    }
    



    //微信pc充值
    public function wx_add_price(){
        $get = $_REQUEST;
        if($get['order_num']==''){
            $this->error('非法操作！');
        }
        $where['pay_num'] = array('eq',$get['order_num']);
        $vo = M('payup')->where($where)->find();
        if(empty($vo)){
            $this->error('非法操作！');
        }
        $time=time();
        $order=array(
            'body'=> '唯心代练-账户充值',
            //'total_fee'=>$vo['total_price']*100, //单位分
            'total_fee'=>pay_total_money($vo['price']), //单位分
            'out_trade_no'=>$vo['pay_num'],
            'product_id'=>$vo['id'],
            'notify_url'=>'http://www.wxpeiwan.com/Home/Pay/wx_add_notify'
        );
        $url = weixinpay($order);
        //$url = 'http://www.baidu.com';
        $path    = 'Uploads/Picture/Qrcode/'.date('Ymd').'/';
        $imgname = date('YmdHis').rand(1000,9999);
        wxpay_qrcode($url,$path,$imgname,'L',10);
        $imgurl = '/'.$path.$imgname.'.png';
        $this->assign('url',$imgurl);
        $this->assign('order_number',$vo['pay_num']);
        $this->display();
    }




    //手机微信支付页面
    public function tel_wx_pay(){
        $post = $_REQUEST;
        $where['status'] = array('eq',1);
        $where['pay_status'] = array('eq',0);
        if($post['type']==1){
            //微信手机下单
            $where['order_number'] = array('eq',$post['order_number']);
            $order = M('order')->where($where)->find();
            if(empty($order)){
                $this->error('非法操作！');
            }
            //$total_price  = $order['total_price']*100; //支付金额-单位分
            $total_price  = pay_total_money($order['total_price']); //支付金额-单位分
            $descriptions = '唯心代练-下单';
            $order_number = $order['order_number'];
        }else if($post['type']==2){
            //手机微信充值
            $where['pay_num'] = array('eq',$post['order_number']);
            $order = M('payup')->where($where)->find();
            if(empty($order)){
                $this->error('非法操作！');
            }
            $total_price  = pay_total_money($order['price']); //支付金额-单位分
            $descriptions = '唯心代练-账户充值';
            $order_number = $order['pay_num'];
        }

        //获取openid
        if(strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')!== false){
            $return_url = 'http://www.wxpeiwan.com/Home/Wxpay/tel_wx_pay?order_number='.$post['order_number'].'&type='.$post['type'];
            $return_url =urlencode($return_url);
            $wx_peizhi = C('WEIXINPAY_CONFIG');
            if(!isset($_GET['code'])){
                $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$wx_peizhi['APPID'].'&redirect_uri='.$return_url.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
                header("Location:".$url);
            }else{
                $code = $_GET['code'];
                //根据code获取用户openid
                $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$wx_peizhi['APPID']."&secret=".$wx_peizhi['APPSECRET']."&code=".$code."&grant_type=authorization_code";
                $abs = file_get_contents($url);
                $obj=json_decode($abs,true);
                $openid = $obj['openid'];
                if($openid==''){
                    $url = 'http://www.wxpeiwan.com/Home/Wxpay/tel_wx_pay?order_number='.$post['order_number'];
                    header("Location:".$url);
                }
                if($post['type']==1){
                    M('order')->where('id='.$order['id'])->save(array('wx_openid'=>$openid)); //更新微信支付openid
                }
            }
        }

        Vendor('Weixinpay.WxPayPubHelper.WxPayPubHelper');
        $jsApi = new \JsApi_pub();
        $unifiedOrder = new \UnifiedOrder_pub();
        $unifiedOrder->setParameter('openid',$openid);//$userinfo['wxpay_openid']
        //echo $openid;
        $unifiedOrder->setParameter('body', $descriptions);
        $timeStamp = time();
        $out_trade_no = \WxPayConf_pub::APPID . "$timeStamp";
        $unifiedOrder->setParameter('out_trade_no', "$out_trade_no");
        //echo ($entry_fel);exit;
        $unifiedOrder->setParameter('total_fee', "'" + $total_price + "'");

        $unifiedOrder->setParameter('notify_url',\WxPayConf_pub::NOTIFY_URL);// \WxPayConf_pub::NOTIFY_URL

        $unifiedOrder->setParameter('trade_type', "JSAPI");

        $prepay_id = $unifiedOrder->getPrepayId();

        $jsApi->setPrepayId($prepay_id);
        $param['out_trade_no'] = $out_trade_no;
        $param['skf_name']  = '';
        $param['order_number'] = $order_number;
        $param['type'] = $post['type'];

        $jsApiparamter = $jsApi->getParameters();

        $this->assign('total_price', $total_price);

       // var_dump($jsApiparamter);

        $this->assign('jsApiparamter', $jsApiparamter);

        $this->assign('param', $param);

        $this->display();
    }

    public function test(){
        $postdata = file_get_contents("php://input");
        $postObj = simplexml_load_string( $postdata, 'SimpleXMLElement', LIBXML_NOCDATA );
        file_put_contents('12326.txt',$postObj);
        file_put_contents('126.txt','我的测试');
    }


}