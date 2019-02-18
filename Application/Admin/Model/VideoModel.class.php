<?php

namespace Admin\Model;
use Think\Model;
/**
 * 配置模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class VideoModel extends Model {

    protected $_validate = array(
        array('title', 'require', '请输入标题!', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '', '视频标题已经存在！', self::VALUE_VALIDATE,'unique',self::MODEL_BOTH),
		array('typeid', 'require', '请选择视频类别！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('icon', 'require', '请选择缩略图！', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        //array('file', 'require', '请选择视频！', self::EXISTS_VALIDATE, 'regex', self::MODEL_INSERT),
    );

    protected $_auto = array (
        array('create_time','time',1,'function') ,
        array('update_time','time',3,'function'),
        array('mid','getUid',3,'callback'),
    );

    public function getUid(){

        return UID;

    }

}
