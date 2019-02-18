<?php

namespace Admin\Controller;


class ProvinceController extends AdminController{
	public function _initialize(){

		$this->assign("pro_type",$this->getvo ("category","pid=49","id asc","id,title"));//城市类别
		parent::_initialize();
	}
	
	
	public function _filter(&$where){
		
		if(!empty($_GET['addr'])){
			$where['addr'] = array('like','%' . $_GET['addr'] . '%');
			
		}
		
		return $where;
		
		
	}
	
	
	

	
}

?>