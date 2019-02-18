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

class ContactModel extends Model {
	
	//protected $trueTableName = 'bhy_article';
	
    protected $_validate = array(
        array('type', 'require', '分类不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),

    );


}
