<?php

namespace Home\Controller;
use OT\DataDictionary;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class PayController extends \Think\Controller {


    public function add_price(){
		if(IS_POST){
            $uid = memberId();
            $post = $_POST;
            
            if($uid==0){
                $this->ajaxReturn(errorCode(201,'请先登录！'));exit;
            }
            if(floatval($post['add_price'])<=0){
                $this->ajaxReturn(errorCode(201,'充值金额必须大于0！')); exit;
            }
            if($post['pay_type']<=0){
                $this->ajaxReturn(errorCode(201,'请选择支付方式！')); exit;
            }
			
			$user = M('usermember')->where('id='.$uid)->field('type')->find();
			
			//创建待支付订单
			
			$order = array(
				'pay_num' => payOrderNums(),
				'uid' => $uid,
				'type' => $user['type'],
				'price' => $post['add_price'],
				'cztype' => $post['pay_type'],
				'create_time' => time(),
				'remark' =>'唯心电竞-账户充值'
			);
			
			$site_url = C('WEB_SITE_URL');
			
			if(empty($site_url)){
				
				$this->ajaxReturn(errorCode(201,'充值失败,请稍后再试！')); exit;
				
			}
			
			if(M('payup')->add($order)){
				
				if($post['pay_type'] == 1){ //支付宝充值
					$pagepay = new \Org\Net\Alipay\pagepay\Pagepay();
					$param = array(
						'WIDout_trade_no'=> $order['pay_num'],
						'WIDsubject' => '唯心电竞充值订单',
						'WIDtotal_amount' => 0.01,
						'WIDbody' => $order['remark']
					);
					$config = array(
						//异步通知地址
						'notify_url' => $site_url."/home/pay/payup_notify_url",
						//同步跳转
						'return_url' => $site_url."/home/pay/payup_return_url",
					);
					$results = $pagepay->alipay($param,$config);
					exit($results);
				}else if($post['pay_type'] == 2){
                    $result['order_number'] = $order['pay_num'];
                    $result['pay_type']     = $post['pay_type'];
                    $this->ajaxReturn(errorCode(200,'成功！',$result));
                }
			}else{
				
				$this->ajaxReturn(errorCode(201,'充值失败,请稍后再试！')); exit;
			}

			/* if($this->pay($post['add_price'],$post['pay_type'])==1){
                $this->ajaxReturn(errorCode(200,'充值成功！')); 
            }else{
                $this->ajaxReturn(errorCode(201,'充值失败！')); exit;
            }*/
        }
    }
	//微信充值异步通知
    public function wx_add_notify(){
        $postdata = file_get_contents("php://input");
        $postObj = simplexml_load_string( $postdata, 'SimpleXMLElement', LIBXML_NOCDATA );
        $order_number = $postObj->out_trade_no; //订单号
        if($postObj->result_code=='SUCCESS'){
            $where['pay_num'] = array('eq',$order_number);
            $order = M('payup')->where($where)->find(); //修改openid
            if(!empty($order)){
                $resu = $this->pay($order);
                if($resu==1){
                    //添加系统消息
                    add_system_msg($order['uid'],1,'充值提醒','您的余额充值成功！');
                    echo "success";
                }else{
                    echo "failure";
                }
            }else{
                echo "failure";
            }
        }
    }


	//支付宝充值异步通知
	public function payup_notify_url(){

		$post = $_POST;

		if($post['auth_app_id'] == '2018060460279709' && $post['trade_status'] == 'TRADE_SUCCESS'){
			
			$map['pay_num'] = array('eq',$post['out_trade_no']);
			$map['pay_status'] = array('neq',1);
			
			$order = M('payup')->where($map)->find();

			if(!empty($order)){
				
				
				$resu = $this->pay($order);
				
				if($resu==1){
				    //添加系统消息
                    add_system_msg($order['uid'],1,'充值提醒','您的余额充值成功！');
				   echo "success";
			   }else{
				   echo "failure";
			   }
				
			}
			
		}
		
	}
	
	public function payup_return_url(){
		
		$this->redirect('/home/user/geren');
		
	}

    //封装充值
    public function pay1($order){
           $uid = $order['uid'];
           $userinfo = member_info($uid);

           $usermember = M('usermember');
           $flowwater  = M('flowwater');
		   $payup = M('payup');

           $usermember->startTrans();$flowwater->startTrans();$payup->startTrans(); //开启事物

           //改变余额
           $data1['balance']      = $userinfo['balance']+$order['price'];
           $data1['update_time']  = time();
           $data1['id']           = $uid;
           $res1 = $usermember->save($data1);
		   //改变订单状态
		   
		   $res3 = $payup->where('id='.$order['id'])->save(array('pay_status'=>1));
		   
           //添加流水表
           $data2['uid']          = $uid;
           $data2['c_type']       = 1;
           $data2['type']         = 2;
           $data2['user_type']    = $userinfo['type'];
           $data2['pay_type']     = $order['cztype'];
           $data2['pre_price']    = $order['price'];
           $data2['total_price']  = $order['price'];
           $data2['balance']      = $data1['balance'];
           $data2['remark']       = $order['remark'];
           $data2['create_time']  = time();
           $res2 = $flowwater->add($data2);
           if($res1 && $res2 && $res3){
             $usermember->commit();$flowwater->commit(); $payup->commit(); //开启事物
             return 1;
           }else{
             $usermember->rollback();$flowwater->rollback();$payup->rollback(); //开启事物
             return 0;
           }

    }
	
	public function testpay(){
        $orderno=$_GET['orderno'];
        $order=M('order')->where('orderno='.$orderno)->find();
        $money=$order['money'];

        if(ismobile()){
            $pagepay = new \Org\Net\zfbwap\pagepay\Pagepay();
        }else{
            $pagepay = new \Org\Net\Alipay\pagepay\Pagepay();
        }
        $param = array(
            'WIDout_trade_no'=> $orderno,
            'WIDsubject' => '旅游订单',
            'WIDtotal_amount' => 0.01,
            'WIDbody' => '暂无描述'

        );

        $results = $pagepay->alipay($param);

        exit(var_dump($results));

    }

    //支付宝同步跳转
    public function alipay_return_url(){
        $orderno=$_GET['out_trade_no'];

        $this->payed($orderno,2);
    }
    //支付宝异步通知
    public function alipay_notify_url(){

        $post = $_POST;

        if($post['auth_app_id'] == '2018072460818266' && $post['trade_status'] == 'TRADE_SUCCESS'){
            $orderno=$post['out_trade_no'];

            $this->payed($orderno,2);
        }
    }
    // 余额支付
    public function pay(){
        if(IS_POST){
            $list=I('post.');
            //$type=$list['type'];
            $orderno=$list['orderno'];
            $order=M('order')->where('orderno='.$orderno)->find();

            $money=$order['money'];
            $balance=M('usermember')->where('id='.session('user'))->find()['balance'];

            if($money>$balance){
                exit(json_encode(array('code'=>400,'msg'=>'余额不足')));
            }else{
                $usermember=M('usermember');$usermember->startTrans();
                $jian=$usermember->where('id='.session('user'))->setDec('balance',$money);

                $save['state']=1;
                $save['type']=1;
                $order=M('order');$order->startTrans();
                $changeorder=$order->where('orderno='.$orderno)->save($save);

                $w['uid']=session('user');
                $w['type']=3;//消费
                $w['payment']=1; //余额
                $w['income']=2;//支出
                $w['money']=$money;
                $w['time']=time();
                $water=M('water');$water->startTrans();
                $addwater=$water->add($w);
                if($jian && $changeorder && $addwater){
                    $usermember->commit();$order->commit();$water->commit();

                    //增加商家余额
                    $order=M('order')->where('orderno='.$orderno)->find();
                    M('usermember')->where('id='.$order['hid'])->setInc('balance',$order['money']);

                    //发短信
                    if(modelField($order['uid'],'usermember','phone') != ''){
                        $this->payedMsg($orderno);
                    }

                    exit(json_encode(array('code'=>200,'msg'=>'余额支付成功')));
                }else{
                    $usermember->rollback();$order->rollback();$water->rollback();
                    exit(json_encode(array('code'=>400,'msg'=>'余额支付失败')));
                }
            }

        }

    }
    //付款成功改状态，加流水
    public function payed($orderno,$type){
        $order=M('order')->where('orderno='.$orderno)->find();
        $money=$order['money'];
        $actiontype=$order['actiontype'];

        $shoptype=M('usermember')->where('id='.$order['uid'])->find()['shoptype'];

        if(M('order')->where('orderno='.$orderno)->find()['state'] == 1){
            if(ismobile()){
                if($shoptype==0){
                    $this->redirect('/Wap/user/rest');
                }else{
                    $this->redirect('/Wap/mer/caiwu');
                }
            }else{
                if($shoptype==0){
                    $this->redirect('/Home/user/rest');
                }else{
                    $this->redirect('/Home/mer/caiwu');
                }
            }
        }else{
            $save['state']=1;
            $save['type']=$type;//2支付宝3微信
            $changeorder=M('order')->where('orderno='.$orderno)->save($save);

            $w['orderno']=$orderno;
            $w['uid']=$order['uid'];
            $w['type']=$actiontype;
            $w['payment']=$type;
            $w['income']= $actiontype==1 ? 1 : 2;
            $w['money']=$money;
            $w['time']=time();
            $addwater=M('water')->add($w);

            if($addwater){

                //增加商家余额
                M('usermember')->where('id='.$order['hid'])->setInc('balance',$money);

                //发短信
                if(modelField($order['uid'],'usermember','phone') != ''){
                    $this->payedMsg($orderno);
                }

                if(ismobile()){
                    if($shoptype==0){
                        $this->redirect('/Wap/user/rest');
                    }else{
                        $this->redirect('/Wap/mer/caiwu');
                    }
                }else{
                    if($shoptype==0){
                        $this->redirect('/Home/user/rest');
                    }else{
                        $this->redirect('/Home/mer/caiwu');
                    }
                }

            }
        }


    }
    //付款成功发短信
    public function payedMsg($orderno){
        $order=M('order')->where('orderno='.$orderno)->find();

        $shoptype=modelField($order['hid'],'usermember','shoptype');

       
        $user=M('usermember')->where('id='.$order['uid'])->find();
        $shop=M('usermember')->where('id='.$order['hid'])->find();
        if($shoptype == 1){
            $date1=date('Y-m-d',strtotime($order['date1']));
            $date2=date('Y-m-d',strtotime($order['date2']));
            $goodsid=M('orderdetail')->where('orderno='.$orderno)->find()['goodsid'];
            $price=M('room')->where('id='.$goodsid)->find()['price'];

            AliyunHotel($user['phone'],'SMS_143861177',$orderno,$user['name'],$date1,$date2,$order['num'],$price,$date1,$shop['addr'],$shop['tel'],$shop['name']);

        }elseif($shoptype == 2){
            $time=date('Y-m-d',$order['time']);
            $goodsid=M('orderdetail')->where('orderno='.$orderno)->find()['goodsid'];
            $foodname=M('room')->where('id='.$goodsid)->find()['name'];

            AliyunFood($user['phone'],'SMS_143862502',$orderno,$time,$shop['name'],$foodname);

        }else if($shoptype == 3){
            $goodsid=M('orderdetail')->where('orderno='.$orderno)->find()['goodsid'];
            $room=M('room')->where('id='.$goodsid)->find();
            $scenicname=$room['name'];
            $price=$room['price'];
            $date=date('Y-m-d',strtotime($order['date']));

            AliyunPiao($user['phone'],'SMS_143866147',$orderno,$order['yzm'],$scenicname,$order['num'],$date,$price);

        }
    }
	//待付款去支付
	public function topayorder(){
		
		if(IS_POST){
			
			$order_id = I('post.orderid');
			
			$order = M('order')->where('id='.$order_id.' and pay_status=0')->find();
			
			if(empty($order)){
				
				$this->ajaxReturn(errorCode(201,'非法操作！'));
				
			}
			
			$pagepay = new \Org\Net\Alipay\pagepay\Pagepay();
					
			$param = array(
			
				'WIDout_trade_no'=> $order['order_number'],
				'WIDsubject' => '唯心电竞订单',
				//'WIDtotal_amount' => $total_price,
				'WIDtotal_amount' => 0.01,
				'WIDbody' => empty($order['remark'])?'暂无描述':$order['remark']
			);
			
			$results = $pagepay->alipay($param);
			exit(var_dump($results));
			
			
		}
		
	}
	
	//取消订单
	public function closeorder(){
		
		if(IS_POST){
			
			$order_id = I('post.orderid');
			
			$order = M('order')->where('id='.$order_id.' and pay_status=0')->find();
			
			if(empty($order)){
				$this->ajaxReturn(errorCode(201,'非法操作！'));
			}
			
			if(M('order')->delete($order['id'])){
                //添加系统消息
                add_system_msg(memberId(),1,'订单取消提醒','单号为 '.$order['order_number'].' 的订单，您已经取消成功！');

				$this->ajaxReturn(errorCode(200,'取消订单成功！'));
				
			}else{
				
				$this->ajaxReturn(errorCode(201,'取消订单失败，请稍后再试！'));
				
			}
			
		}
		
	}
	
	//前台提交订单
    public function add_order(){
        if(IS_POST){
            $uid = memberId();
            $myinfo = member_info($uid);
            if($uid<=0){
                $this->ajaxReturn(errorCode(201,'非法操作！'));
            }
            $post = $_POST;
            if($post['is_black']!=1){
				if($post['start_time']==''){
					$this->ajaxReturn(errorCode(201,'开始时间必须填写！'));
				}
		    }
            if(trim($post['qq'])==''||trim($post['mobile'])==''){
                $this->ajaxReturn(errorCode(201,'QQ号和手机号必须填写！'));
            }

            if($post['pay_type']!=1 && $post['pay_type']!=2 && $post['pay_type']!=3){
                $post['pay_type'] = 3; //余额支付
            }
			//exit(var_dump($post));
				
			$oneprice = get_one_price($post['pwperson_id'],$post['game_id']); //pw_list表
			if($post['is_black']!=1){
				$post['total_num'] = $post['total_num']>0?$post['total_num']:1; //购买数量必须大于等于1
				if($oneprice['one_price']==0){
					$this->ajaxReturn(errorCode(201,'非法操作！'));
				}else{
					$one_price = round(floatval(modelField($oneprice['one_price'],'category','title')),2);//单价
				}
				$data1['one_price']    = $one_price; //单价
				$data1['pre_price']    = $post['total_num']*$one_price; //原价
			}else{
				//开黑
				$sort1 = modelField($post['this_duanwei'],'duanwei_jineng','sort');//当前段位
				$sort2 = modelField($post['order_duanwei'],'duanwei_jineng','sort'); //目标段位
				if($sort2<=$sort1){
					$this->ajaxReturn(errorCode(201,'目标段位必须大于当前段位！'));exit;
				}
				$total_price = get_duanwei_price($post['this_duanwei'],$post['order_duanwei']); //开黑金额
				
				$data1['pre_price']    = $total_price; //原价
				$data1['one_price']    = 0; //单价
				$data1['this_duanwei']  = $post['this_duanwei'];
				$data1['order_duanwei'] = $post['order_duanwei'];
				$data1['order_type']    = 2; //开黑上分
			}
			
			if($post['coupon']>0){
				$coupon = M('coupon_code')->find($post['coupon']);
				$total_price = $data1['pre_price']-$coupon['price'];
			}else{
				$total_price = $data1['pre_price'];
			}
			if($post['is_black']!=1) {
			    if($post['tel']=='tel'){
			        //手机端传过来的值
                    $yytime = strtotime($post['start_time']); //陪玩开始时间
                }else{
                    $yytime = $post['start_time']; //陪玩开始时间
                }

				$endtime = $post['total_num'] * 3600 + $yytime; //陪玩结束时间
				$vott = is_buyed_time($yytime, $post['pwperson_id'], $endtime);
				if (!empty($vott)) {
					$this->ajaxReturn(errorCode(201, '该时间段已经有人购买！'));
					exit;
				}
				$data1['start_time']   = $yytime;
				$data1['end_time']     = $endtime;
				$data1['hour_num']     = $post['total_num'];
			}
			if($post['pay_type']==3){
				if($total_price>$myinfo['balance']){
					$this->ajaxReturn(errorCode(201,'您的余额不足！'));
				}
			}
            $godset['u.id'] = array('eq',$post['pwperson_id']);
			$pwinfos = M('godset')->join('bhy_usermember as u on u.ds_level = bhy_godset.id')->where($godset)->field('bhy_godset.*')->find();

			//添加订单
			$data1['order_number'] = payOrderNums('order');
			$data1['pwlist_id']    = $oneprice['id'];
			$data1['uid']          = $uid;
			$data1['pwperson_id']  = $post['pwperson_id'];
			$data1['game_id']      = $post['game_id'];
			$data1['pt_scale']     = $pwinfos['pt_scale']>0 && $pwinfos['pt_scale']<1 ? $pwinfos['pt_scale']:0; //平台提成比例
            $data1['pt_price']     = $total_price*$data1['pt_scale']; //平台提成金额
			$data1['total_price']  = $total_price; //用户实际支付金额
			$data1['dsget_price']  = $data1['total_price'] - $data1['pt_price']; //大神实际得到金额
			$data1['type']         = $post['pay_type'];
			$data1['remark']       = $post['remark'];
			$data1['mobile']       = $post['mobile'];
			$data1['qq']           = $post['qq'];
			$data1['recoupon_id']  = $post['coupon']>0?$post['coupon']:0;
			$data1['create_time']  = time();
			$res = M('order')->add($data1);
				
			
			if($post['pay_type'] == 1){ //支付宝
				
				if($res){
					if(ismobile()){
                        $pagepay = new \Org\Net\zfbwap\pagepay\Pagepay();
                    }else{
                        $pagepay = new \Org\Net\Alipay\pagepay\Pagepay();
                    }
					$param = array(
					
						'WIDout_trade_no'=> $data1['order_number'],
						'WIDsubject' => '唯心电竞订单',
						//'WIDtotal_amount' => $total_price,
						'WIDtotal_amount' => 0.01,
						'WIDbody' => empty($data1['remark'])?'暂无描述':$data1['remark']
					
					);
					
					$results = $pagepay->alipay($param);
					exit(var_dump($results));
					//$result['pay_type']     = $post['pay_type'];
					//$result['alipay_result'] = $results;
					//$this->ajaxReturn(errorCode(200,'订单创建成功，正在跳转支付宝！',$result));
					
				}
				
			}elseif($post['pay_type'] == 2){
			    //微信支付
                if($res){
                        $result['order_number'] = $data1['order_number'];
                        $result['pay_type']     = $post['pay_type'];
                        $this->ajaxReturn(errorCode(200,'添加订单成功！',$result));
                }else{
                    $this->ajaxReturn(errorCode(200,'添加订单失败！'));
                }


			}elseif($post['pay_type'] == 3){//余额
				
				if($res){
					$result['order_number'] = $data1['order_number'];
					$result['pay_type']     = $post['pay_type'];
					$this->ajaxReturn(errorCode(200,'添加订单成功！',$result));
				}else{
					$this->ajaxReturn(errorCode(201,'添加订单失败！'));
				}
				
			}else{
				
				$this->ajaxReturn(errorCode(201,'非法支付方式'));
				
			}
        }
    }

   //输入余额支付密码
    public function yepage(){
       if(IS_POST){
           $uid = memberId();
           $myinfo = member_info($uid);
           $post = $_POST;
           if(trim($post['paypassword'])==''){
               $this->ajaxReturn(errorCode(201,'支付密码不能为空！'));
           }
           if($myinfo['pay_password']!=mymd5($post['paypassword'])){
               $this->ajaxReturn(errorCode(201,'支付密码错误！'));
           }
           $orderinfo = get_order($post['ordernumber']);
           if(empty($orderinfo)){
               $this->ajaxReturn(errorCode(201,'订单不存在！'));
           }
           if($myinfo['balance']<$orderinfo['total_price']){
               $this->ajaxReturn(errorCode(201,'余额不足！'));
           }
           $resu = $this->commorder($orderinfo,$myinfo);
           $gamename = modelField($orderinfo['game_id'],'games','title');
           if($resu==1){
               //系统消息
    
               add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单已下单成功！');
               add_system_msg($orderinfo['pwperson_id'],1,'下单通知','手机号为'.$orderinfo['mobile'].'的用户已向你下单，请注意查看！');
               $this->ajaxReturn(errorCode(200,'支付成功！'));
           }else{
               add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单下单失败！');
               $this->ajaxReturn(errorCode(201,'支付失败！'));
           }
       }
    }
    


    //微信pc端异步通知
    public function wxnotify(){

        $postdata = file_get_contents("php://input");
        $postObj = simplexml_load_string( $postdata, 'SimpleXMLElement', LIBXML_NOCDATA );
        //file_put_contents('12326.txt',$postObj->openid);
        $orderno = $postObj->out_trade_no; //订单号
        if($postObj->result_code=='SUCCESS'){
            $this->payed($orderno,3);

        }else{
            //$data['wx_openid']  = $postObj->openid;
            $where['orderno'] = array('eq',$orderno);
            $data['state'] = 2;
            //$res = M('order')->where($where)->save($data);
        }
    }
    public function wxnotify2(){

        $postdata = file_get_contents("php://input");
        $postObj = simplexml_load_string( $postdata, 'SimpleXMLElement', LIBXML_NOCDATA );
        //file_put_contents('12326.txt',$postObj->openid);
        $order_number = $postObj->out_trade_no; //订单号
        if($postObj->result_code=='SUCCESS'){
              $where['order_number'] = array('eq',$order_number);
               M('order')->where($where)->save(array('wx_openid'=>$postObj->openid)); //修改openid

              $orderinfo = get_order($order_number);
              $myinfo = member_info($orderinfo['uid']);
              if(empty($orderinfo)){
                  echo "failure";
              }
              $resu = $this->commorder($orderinfo,$myinfo);
              $gamename = modelField($orderinfo['game_id'],'games','title');
              if($resu==1){
                add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单已下单成功！');
                add_system_msg($orderinfo['pwperson_id'],1,'下单通知','手机号为'.$orderinfo['mobile'].'的用户已向你下单，请注意查看！');
              }else{
                add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单下单失败！');
             }

        }else{
            $where['order_number'] = array('eq',$order_number);
            $data['wx_openid']  = $postObj->openid;
            $data['pay_status'] = 2;
            $res = M('order')->where($where)->save($data);
        }
    }
    //手机下单微信支付回调
    public function wxpay_callurl(){
        if(IS_POST){
            $post = $_POST;
            if($post['type']==1){
                //微信下单
                $orderinfo = get_order($post['order_number']);
                $myinfo = member_info($orderinfo['uid']);
                if(empty($orderinfo)){
                    $this->ajaxReturn(array('code'=>201,'msg'=>'订单不存在！'));
                }
                $resu = $this->commorder($orderinfo,$myinfo);
                $gamename = modelField($orderinfo['game_id'],'games','title');
                if($resu==1){
                    add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单已下单成功！');
                    add_system_msg($orderinfo['pwperson_id'],1,'下单通知','手机号为'.$orderinfo['mobile'].'的用户已向你下单，请注意查看！');
                    $this->ajaxReturn(array('code'=>200,'msg'=>'支付成功！'));
                }else{
                    add_system_msg(memberId(),1,'购买通知','您购买《'.$gamename.'》的陪玩订单下单失败！');
                    $this->ajaxReturn(array('code'=>201,'msg'=>'支付成功，订单状态更新失败！'));
                }

            }else if($post['type']==2){
                //微信手机充值回调
                $where['pay_num'] = array('eq',$post['order_number']);
                $order = M('payup')->where($where)->find(); //修改openid
                if(!empty($order)){
                    $resu = $this->pay($order);
                    if($resu==1){
                        //添加系统消息
                        add_system_msg($order['uid'],1,'充值提醒','您的余额充值成功！');
                        $this->ajaxReturn(array('code'=>200,'msg'=>'充值成功！'));
                    }else{
                        $this->ajaxReturn(array('code'=>201,'msg'=>'充值失败！'));
                    }
                }else{
                    $this->ajaxReturn(array('code'=>201,'msg'=>'订单不存在！'));
                }
            }
        }
    }


//封装公共
public function commorder($orderinfo,$myinfo){
    $order      = M('order');
    $usermember = M('usermember');
    $flowwater  = M('flowwater');
    $order->startTrans(); $usermember->startTrans();$flowwater->startTrans();
    //订单表
    $dataa['pay_status'] = 1;
    $dataa['id']         = $orderinfo['id'];
    $res1 = $order->save($dataa);
    //增加陪玩人余额
    $pwinfo = member_info($orderinfo['pwperson_id']);
    $data2['sum_num']    = $pwinfo['sum_num']+1;
    $data2['balance']    = $pwinfo['balance']+$orderinfo['dsget_price'];
    $data2['total_sale'] = $pwinfo['total_sale']+$orderinfo['pre_price']; //总销售额
    $data2['ds_level']   = sale_sum_price($data2['total_sale']);
    $data2['id']         = $orderinfo['pwperson_id'];
    $res2 = $usermember->save($data2);
    $ii=0;
    if($orderinfo['type']==3){
        //减少购买人余额
        $data['balance']   = $myinfo['balance']-$orderinfo['total_price'];
        $data['total_pay'] = $myinfo['total_pay']+$orderinfo['total_price']; //总消费
        $data['id']        = $myinfo['id'];
        $res1 = $usermember->save($data);
        //增加购买人流水
        $dtaer[$ii]['uid']         = $myinfo['id'];
        $dtaer[$ii]['c_type']      = 2;
        $dtaer[$ii]['type']        = 1;
        $dtaer[$ii]['user_type']   = $myinfo['type'];
        $dtaer[$ii]['pay_type']    = 3;
        $dtaer[$ii]['pre_price']   = $orderinfo['pre_price'];
        $dtaer[$ii]['total_price'] = $orderinfo['total_price'];
        $dtaer[$ii]['balance']     = $data['balance'];
        $dtaer[$ii]['create_time'] = time();
        $dtaer[$ii]['return_id']   = $orderinfo['id'];
        $dtaer[$ii]['remark']      = '购买下单';
        $ii++;
    }
    //增加陪玩人流水
    $dtaer[$ii]['uid']         = $orderinfo['pwperson_id'];
    $dtaer[$ii]['c_type']      = 1;
    $dtaer[$ii]['type']        = 1;
    $dtaer[$ii]['user_type']   = 2;
    $dtaer[$ii]['pay_type']    = 3;
    $dtaer[$ii]['pre_price']   = $orderinfo['pre_price'];
    $dtaer[$ii]['total_price'] = $orderinfo['dsget_price'];
    $dtaer[$ii]['balance']     = $data2['balance'];
    $dtaer[$ii]['create_time'] = time();
    $dtaer[$ii]['return_id']   = $orderinfo['id'];
    $dtaer[$ii]['remark']      = '购买下单';
    $ii++;

    //增加平台抽成流水
    $dtaer[$ii]['uid']         = 0;
    $dtaer[$ii]['c_type']      = 1;
    $dtaer[$ii]['type']        = 9;
    $dtaer[$ii]['user_type']   = 0;
    $dtaer[$ii]['pay_type']    = 0;
    $dtaer[$ii]['pre_price']   = $orderinfo['total_price'];
    $dtaer[$ii]['total_price'] = $orderinfo['pt_price'];
    $dtaer[$ii]['balance']     = 0; //平台余额默认为填写0
    $dtaer[$ii]['create_time'] = time();
    $dtaer[$ii]['return_id']   = $orderinfo['id'];
    $dtaer[$ii]['remark']      = '平台抽成';
    $ii++;


    $res3 = $flowwater->addAll($dtaer);
    if($res1&&$res2&&$res3){
        if($orderinfo['recoupon_id']>0){
            $yhjdata['is_use'] = 1;
            $yhjdata['id']     = $orderinfo['recoupon_id'];
            M('coupon_code')->save($yhjdata); //将优惠券修改为已使用
        }
        $mobile = modelField($orderinfo['pwperson_id'],'usermember','mobile');
        $rt = AliyunSendMsg($mobile,'SMS_126462631'); //短信通知大神
        //分销
        $this->three_sale($myinfo,$orderinfo);
        $order->commit(); $usermember->commit();$flowwater->commit();
        return 1; //成功
    }else{
        $order->rollback();$usermember->rollback();$flowwater->rollback();
        return 2; //失败
    }




}
//分销报酬
public function three_sale($myinfo,$orderinfo){
       if(!empty(trim($myinfo['sale1']))||!empty(trim($myinfo['sale2']))!=''||!empty(trim($myinfo['sale3']))!=''){
           $retya = array(); $saleid = array();
           $where['status']      = array('eq',1);

           if(!empty($myinfo['sale1'])){
               $where['user_number'] = array('eq',trim($myinfo['sale1']));
               $sale1 = M('usermember')->where($where)->find();
               if(!empty($sale1)){
                   $salepri = get_sale_scale(1,$orderinfo['total_price']);
                   $yepri = $sale1['balance']+$salepri;
                   $retya[]['balance'] = $yepri;
                   $saleid[]      = $sale1['id'];
                   $rrt[] = sale_flowater($sale1,$yepri,$salepri,$orderinfo['id']);
               }
           }
           if(!empty($myinfo['sale2'])){
               $where['user_number'] = array('eq',trim($myinfo['sale2']));
               $sale2 = M('usermember')->where($where)->find();
               if(!empty($sale2)){
                   $salepri = get_sale_scale(2,$orderinfo['total_price']);
                   $yepri = $sale2['balance']+$salepri;
                   $retya[]['balance'] = $yepri;
                   $saleid[]      = $sale2['id'];
                   $rrt[] = sale_flowater($sale2,$yepri,$salepri,$orderinfo['id']);
               }
           }
           if(!empty($myinfo['sale3'])){
               $where['user_number'] = array('eq',trim($myinfo['sale3']));
               $sale3 = M('usermember')->where($where)->find();
               if(!empty($sale3)){
                   $salepri = get_sale_scale(3,$orderinfo['total_price']);
                   $yepri = $sale3['balance']+$salepri;
                   $retya[]['balance'] = $yepri;
                   $saleid[]      = $sale3['id'];
                   $rrt[] = sale_flowater($sale3,$yepri,$salepri,$orderinfo['id']);
               }
           }
           $wherty['ID'] = $saleid;
           saveAll($wherty,$retya,'usermember');
           //添加流水
           $restt = M('flowwater')->addAll($rrt);
           if($restt){
               return 1;
           }else{
               return 2;
           }
       }else{
           return 2; //没有推荐人
       }
}






	

}