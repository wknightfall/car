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

class AdModel extends Model {
    protected $_validate = array(
		array('name', 'require', '请输入广告名称', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('typeid', 'require', '请选择广告类别', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		//array('url', 'require', '请输入广告链接', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		//array('url', 'require', '链接格式不正确', self::EXISTS_VALIDATE, 'url', self::MODEL_BOTH),
		//array('icon', 'require', '请选择广告图片', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),

    );

}
