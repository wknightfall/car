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

class OrderModel extends Model {
    protected $_validate = array(
		array('name', 'require', '请输入名称', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

	/*protected $_auto = array(
		array('create_time','time',1,'function'),
		array('update_time','time',3,'function'),
	);*/
	public function _filter(&$sqlWhere){

		if(!empty($_GET['name'])){

			$sqlWhere['name'] = array('like','%' . $_GET['name'] . '%');
		}
		if(!empty($_GET['date1'])){
			$date1=strtotime($_GET['date1']);
			$sqlWhere['time'] = array('gt',$date1);
		}
		if(!empty($_GET['date2'])){
			$date2=strtotime($_GET['date2']);
			$sqlWhere['time'] = array('lt',$date2);
		}
		return $sqlWhere;

	}

}
