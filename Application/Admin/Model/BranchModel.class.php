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

class BranchModel extends Model {
	
	
    protected $_validate = array(
        array('name', 'require', '名称不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '名称已经存在！', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('tell', 'require', '联系电话不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('qq', 'require', '联系qq不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('en_address', 'require', '报名地址不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('line', 'require', '乘车路线不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
		array('addtime','time',1,'function'),
        array('updatetime','time',3,'function'),
    );

}
