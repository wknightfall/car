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

class LinksModel extends Model {
    protected $_validate = array(
		array('name', 'require', '请输入链接名称', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('url', 'require', '请输入链接地址', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('url', 'require', '链接格式不正确', self::EXISTS_VALIDATE, 'url', self::MODEL_BOTH),
    );

}
