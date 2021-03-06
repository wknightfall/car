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

class AboutlistModel extends Model {
	
	protected $trueTableName = 'bhy_aboutlist';
	
    protected $_validate = array(
        array('name', 'require', '标题不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
       // array('title', '', '新闻标题已经存在！', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
		array('typeid', 'require', '类别必须选择！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),

    );

    protected $_auto = array(
		/* array('create_time','time',1,'function'), */
        array('update_time','time',3,'function'),
		array('flag','listflag','3','callback'),
    );
	
	
	protected function listflag(){

		if(!empty($_POST['flag'])){
			$flags = $_POST['flag'];
			$flag = implode( "," , $flags) ;
			return $flag;
		}else{
			return '';
		}
	
	}

}
