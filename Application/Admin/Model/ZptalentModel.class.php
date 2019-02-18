<?php

namespace Admin\Model;
use Think\Model;
/**
 * 配置模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class ZptalentModel extends Model {
	
	//protected $trueTableName = 'bhy_article'; 
	
    protected $_validate = array(
        array('title', 'require', '标题不能为空!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
       // array('title', '', '新闻标题已经存在！', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
		

    );

   
	
	
	

}
