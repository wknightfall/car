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

class TouristModel extends Model {
    protected $_validate = array(
		array('name', 'require', '请输入导游名称', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

	protected $_auto = array(
		array('create_time','time',1,'function'),
		array('update_time','time',3,'function'),
	);

}
