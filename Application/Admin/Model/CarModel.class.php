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

class CarModel extends Model {
    protected $_validate = array(
		array('title', 'require', '请输入车型名称', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
		array('bid', 'require', '请选择车型品牌', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('cid', 'require', '请选择车型类别', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('jid', 'require', '请选择车型级别', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', 'require', '请选择车型年份', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('icon', 'require', '请上传车型缩略图', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('url', 'require', '请输入车型链接', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );
    protected $_auto = array(
         array('create_time','time',1,'function'),
        array('update_time','time',3,'function')
    );
}
