<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace English\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class ContactController extends HomeController {

    public function index(){

        $vo = M('contact')->where('type=2 and status=1')->order('id desc')->find();
        $this->assign('vo',$vo);
        $this->display();
    }


    //提交信息
    public function addmsg(){
        if(IS_POST){
            $post = $_POST;
            if(trim($post['name'])==''){
                $this->ajaxReturn(array('code'=>201,'msg'=>'姓名不能为空！','egmsg'=>'Name cannot be empty !'));
            }
            if(!isMobileCode($post['tel'])){
                $this->ajaxReturn(array('code'=>201,'msg'=>'请输入正确的手机号！','egmsg'=>'Please enter a valid phone number !'));
            }
            if(!isEmail($post['email'])){
                $this->ajaxReturn(array('code'=>201,'msg'=>'请输入正确的邮箱！','egmsg'=>'Please enter your vaild email !'));
            }
            if(trim($post['content'])==''){
                $this->ajaxReturn(array('code'=>201,'msg'=>'请输入内容！','egmsg'=>'Please enter content !'));
            }
            $post['create_time'] = time();
            $res = M('message')->add($post);
            if($res){
                $this->ajaxReturn(array('code'=>200,'msg'=>'提交成功！','egmsg'=>'Submitted successfully !'));
            }else{
                $this->ajaxReturn(array('code'=>201,'msg'=>'提交失败！','egmsg'=>'Submission Failed !'));
            }
        }
    }




}