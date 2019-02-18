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

class EmailModel extends Model {
    protected $_validate = array(
		array('configtype', 'require', '请选择配置类型', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('charset', 'require', '请输入编码方式', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('debugoutput', 'require', '请输入支持输出格式', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('host', 'require', '请输入邮件服务器名称', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('port', 'require', '请输入端口号', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('username', 'require', '请输入用户名', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('password', 'require', '请输入密码', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('mailfrom', 'require', '请输入发件人地址', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('mailfromname', 'require', '请输入发件人名称', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('sendtitle', 'require', '请输入发送标题', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
		array('sendcontent', 'require', '请输入发送内容', self::EXISTS_VALIDATE, 'regx', self::MODEL_BOTH),
    );

}
