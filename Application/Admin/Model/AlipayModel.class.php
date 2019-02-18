<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
/**
 * 配置模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class AlipayModel extends Model {
	
    protected $_validate = array(
        array('name', 'require', '名称不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '名称已经存在！', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
		array('partner_id', 'require', '商户ID不能为空！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('key', 'require', '安全校检码不能为空！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('title', 'require', '标题不能为空！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('description', 'require', '描述不能为空！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('seller_email', 'require', '商家支付宝不能为空！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),

    );

    protected $_auto = array(
		array('create_time','time',1,'function'),
        array('update_time','time',3,'function'),
    );
	

}
