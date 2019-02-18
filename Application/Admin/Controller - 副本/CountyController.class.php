<?php

namespace Admin\Controller;

class CountyController extends AdminController {
	public function _initialize() {
// 		$this->assign ( "pro_type", M ( 'province' )->where ( 'status=1' )->order ( 'id' )->Field ( 'id,addr' )->select () ); // 城市类别
		parent::_initialize ();
	}
	public function _filter(&$where) {
		if (! empty ( $_GET ['addr'] )) {
			$where ['addr'] = array (
					'like',
					'%' . $_GET ['addr'] . '%' 
			);
		}
		if(!empty($_REQUEST['cityid'])){
			$where ['city_id'] = array ('eq',$_REQUEST['cityid']);
		}
		
		return $where;
	}
	public function _before_edit() {
		if (IS_POST) {
			
			$_POST ['last_id'] = is_login ();
			
			$_POST ['last_time'] = date ( 'Y-m-d H:i:s', time () );
			
			$_POST ['contry_id'] = 1;
			
			$_POST ['province_id'] = $_POST ['cardprovince'];
			
			$_POST ['addr_one'] = getprovince ( $_POST ['cardprovince'] );
			
			$_POST ['city_id'] = $_POST ['cardcity'];
			
			$_POST ['addr_two'] = getcity ( $_POST ['cardcity'] );
			
		} else {

		}
	}
	public function _before_add() {
		if (IS_POST) {
			
			$_POST ['add_id'] = is_login ();
			
			$_POST ['add_time'] = date ( 'Y-m-d H:i:s', time () );
			
			$_POST ['contry_id'] = 1;
			
			$_POST ['province_id'] = $_POST ['cardprovince'];
			
			$_POST ['addr_one'] = getprovince ( $_POST ['cardprovince'] );
			
			$_POST ['city_id'] = $_POST ['cardcity'];
			
			$_POST ['addr_two'] = getcity ( $_POST ['cardcity'] );
			
		} else {
		}
	}
	public function citylist() {
		
		$province_id=$_REQUEST['province_id'];
		
		$prowhr['province_id']=array('eq',$province_id);
		
		$prowhr['status']=array('eq',1);
		
		$citys=M('city')->where($prowhr)->select();
		
		exit(json_encode($citys));
	}
}

?>