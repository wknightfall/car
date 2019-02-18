<?php

namespace Admin\Controller;

class CityController extends AdminController {
	public function _initialize() {
		$this->assign ( "pro_type", M ( 'province' )->where ( 'status=1' )->order ( 'id' )->Field ( 'id,addr' )->select () ); // 城市类别
		parent::_initialize ();
	}
	public function _filter(&$where) {
		if (! empty ( $_GET ['addr'] )) {
			$where ['addr'] = array (
					'like',
					'%' . $_GET ['addr'] . '%' 
			);
		}
		if(!empty($_REQUEST['provinceid'])){
			$where ['province_id'] = array ('eq',$_REQUEST['provinceid']);
		}
		
		return $where;
	}
	public function _before_edit() {
		if (IS_POST) {
			$_POST ['last_id'] = is_login ();
			$_POST ['last_time'] = date ( 'Y-m-d H:i:s', time () );
			$_POST ['contry_id'] = 1;
			$_POST ['addr_one'] = getprovince ( $_POST ['province_id'] );
		} else {
		}
	}
	public function _before_add() {
		if (IS_POST) {
			$_POST ['add_id'] = is_login ();
			$_POST ['add_time'] = date ( 'Y-m-d H:i:s', time () );
			$_POST ['contry_id'] = 1;
			$_POST ['addr_one'] = getprovince ( $_POST ['province_id'] );
		} else {
		}
	}
}

?>