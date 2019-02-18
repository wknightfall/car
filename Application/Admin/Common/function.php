<?php
function getip(){
    global  $_SERVER;
    if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $ip  =  $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(isset($_SERVER["HTTP_CLIENT_IP"])){
        $ip  = $_SERVER["HTTP_CLIENT_IP"];
    }
    else{
        $ip  =  $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}
/*批量删除
     *  @param $saveWhere ：想要更新主键ID数组
     *  @param $saveData    ：想要更新的ID数组所对应的数据
     *  @param $tableName  : 想要更新的表明
     *  @param $saveWhere  : 返回更新成功后的主键ID数组
     * */
function saveAll($saveWhere,&$saveData,$tableName){
    if($saveWhere==null||$tableName==null)
        return false;
    //获取更新的主键id名称
    $key = array_keys($saveWhere)[0];
    //获取更新列表的长度
    $len = count($saveWhere[$key]);
    $flag=true;
    $model = isset($model)?$model:M($tableName);
    //开启事务处理机制
    $model->startTrans();
    //记录更新失败ID
    $error=[];
    for($i=0;$i<$len;$i++){
        //预处理sql语句
        $isRight=$model->where($key.'='.$saveWhere[$key][$i])->save($saveData[$i]);
        if($isRight==0){
            //将更新失败的记录下来
            $error[]=$i;
            $flag=false;
        }
        //$flag=$flag&&$isRight;
    }
    if($flag ){
        //如果都成立就提交
        $model->commit();
        return $saveWhere;
    }elseif(count($error)>0&count($error)<$len){
        //先将原先的预处理进行回滚
        $model->rollback();
        for($i=0;$i<count($error);$i++){
            //删除更新失败的ID和Data
            unset($saveWhere[$key][$error[$i]]);
            unset($saveData[$error[$i]]);
        }
        //重新将数组下标进行排序
        $saveWhere[$key]=array_merge($saveWhere[$key]);
        $saveData=array_merge($saveData);
        //进行第二次递归更新
        saveAll($saveWhere,$saveData,$tableName);
        return $saveWhere;
    }
    else{
        //如果都更新就回滚
        $model->rollback();
        return false;
    }
}

function getUnqiechar($tit){

    $name = getAllChar($tit);

    //查询数据库中是否存在

    $whe['name'] = array('eq',$name);

    $list = D('brand')->where($whe)->find();

    if(!$list){

        return $name;

    }else{

        return $name.create_code(4);

    }

}
//取出二维数组中某个字段不重复的值
function gettwocodeone($arr,$field){

    $arrlist = array();
    foreach($arr as $k => $v){

        if(!in_array($v[$field],$arrlist)){

            $arrlist[] = $v[$field];

        }

    }

    return $arrlist;

}

//生产唯一的出库单号
function OutBoundSend(){

    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

}

//生成唯一的商品款号
function pro_girard_send($brand,$year,$season){

    //查询相同品牌相同年份相同季节的款式有几件

    $whe['bid'] = array('eq',$brand);
    $whe['year'] = array('eq',$year);
    $whe['season'] = array('eq',$season);
    $numlist = M('comstyle')->where($whe)->count();

    $numlist = $numlist == 0?1:$numlist+1;

    $bname = M('brand')->field('id,title,name')->find($brand);

    return $bname['name'].substr($year,-2).getAllChar($season).sprintf("%04d", $numlist);

}



/**
 * @param string $str
 * @param bool $allow   默认转换所有字符
 * @return Ambigous <unknown, string, string>
 */
function getAllChar($str, $allow = TRUE)
{
    if($allow){
        $length = mb_strlen($str, 'utf-8');
        $result = '';
        for($i=0; $i<$length; $i++){
            $subStr = cutOutString($str, $i, 1);
            $result .= getLetter($subStr);
        }
        return $result;
    }else{
        $subStr = cutOutString($str, 0, 1);
        return getLetter($subStr);
    }
}

/**
 * 截取字符串第一个字符
 * @param string $string    需要被截取的字符串
 * @param int   $start      开始位置
 * @param int $length       截取长度
 * @param string $postfix   字符串截取后的后缀
 * @return string
 */
function cutOutString($string, $start, $length, $postfix='')
{
    $result = (mb_strlen($string, 'utf-8') <= $length) ? $string : mb_substr($string, $start, $length, 'utf-8');
    return $result.$postfix;
}

/**
 * 获取字符串中文拼音首字母
 * @param string $str   需要转换的字符串
 * @return unknown|string
 */
function getLetter($str)
{
    $firest_ord = ord($str);
    if($firest_ord >= 48 && $firest_ord <= 57){
        return $str;    //数字
    }elseif($firest_ord >= 65 && $firest_ord <= 90){
        return $str;    //大写字母
    }elseif($firest_ord >=97 && $firest_ord <= 122){
        return $str;    //小写字母
    }

    //中文
    $s=iconv("UTF-8","gb2312//IGNORE", $str);
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319 and $asc<=-20284)return "A";
    if($asc>=-20283 and $asc<=-19776)return "B";
    if($asc>=-19775 and $asc<=-19219)return "C";
    if($asc>=-19218 and $asc<=-18711)return "D";
    if($asc>=-18710 and $asc<=-18527)return "E";
    if($asc>=-18526 and $asc<=-18240)return "F";
    if($asc>=-18239 and $asc<=-17923)return "G";
    if($asc>=-17922 and $asc<=-17418)return "H";
    if($asc>=-17417 and $asc<=-16475)return "J";
    if($asc>=-16474 and $asc<=-16213)return "K";
    if($asc>=-16212 and $asc<=-15641)return "L";
    if($asc>=-15640 and $asc<=-15166)return "M";
    if($asc>=-15165 and $asc<=-14923)return "N";
    if($asc>=-14922 and $asc<=-14915)return "O";
    if($asc>=-14914 and $asc<=-14631)return "P";
    if($asc>=-14630 and $asc<=-14150)return "Q";
    if($asc>=-14149 and $asc<=-14091)return "R";
    if($asc>=-14090 and $asc<=-13319)return "S";
    if($asc>=-13318 and $asc<=-12839)return "T";
    if($asc>=-12838 and $asc<=-12557)return "W";
    if($asc>=-12556 and $asc<=-11848)return "X";
    if($asc>=-11847 and $asc<=-11056)return "Y";
    if($asc>=-11055 and $asc<=-10247)return "Z";
    return $str;
}


//取出最近的年份

function yearlist($num){
    $year = date('Y',time());
    for($i=$year;$i>$year-$num;$i--){

        $arr[] = $i;

    }

    return $arr;

}

//判断是否是超级管理员
function issupermanager($uid){
	if(UID==1 || $uid==UID){
		return true;
	}else{
		return false;
	}
}





//会员密码加密
//密码加密
function mymd5($password){

	$jmpassword = md5(md5($password));
	return $jmpassword;
}


/**
 * 后台公共文件
 * 主要定义后台公共函数库
 */

/* 解析列表定义规则*/

function get_list_field($data, $grid,$model){

	// 获取当前字段数据
    foreach($grid['field'] as $field){
        $array  =   explode('|',$field);
        $temp  =	$data[$array[0]];
        // 函数支持
        if(isset($array[1])){
            $temp = call_user_func($array[1], $temp);
        }
        $data2[$array[0]]    =   $temp;
    }
    if(!empty($grid['format'])){
        $value  =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data2){return $data2[$match[1]];}, $grid['format']);
    }else{
        $value  =   implode(' ',$data2);
    }

	// 链接支持
	if(!empty($grid['href'])){
		$links  =   explode(',',$grid['href']);
        foreach($links as $link){
            $array  =   explode('|',$link);
            $href   =   $array[0];
            if(preg_match('/^\[([a-z_]+)\]$/',$href,$matches)){
                $val[]  =   $data2[$matches[1]];
            }else{
                $show   =   isset($array[1])?$array[1]:$value;
                // 替换系统特殊字符串
                $href	=	str_replace(
                    array('[DELETE]','[EDIT]','[MODEL]'),
                    array('del?ids=[id]&model=[MODEL]','edit?id=[id]&model=[MODEL]',$model['id']),
                    $href);

                // 替换数据变量
                $href	=	preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data){return $data[$match[1]];}, $href);

                $val[]	=	'<a href="'.U($href).'">'.$show.'</a>';
            }
        }
        $value  =   implode(' ',$val);
	}
    return $value;
}

// 获取模型名称
function get_model_by_id($id){
    return $model = M('Model')->getFieldById($id,'title');
}

// 获取属性类型信息
function get_attribute_type($type=''){
    // TODO 可以加入系统配置
    static $_type = array(
        'num'       =>  array('数字','int(10) UNSIGNED NOT NULL'),
        'string'    =>  array('字符串','varchar(255) NOT NULL'),
        'textarea'  =>  array('文本框','text NOT NULL'),
        'datetime'  =>  array('时间','int(10) NOT NULL'),
        'bool'      =>  array('布尔','tinyint(2) NOT NULL'),
        'select'    =>  array('枚举','char(50) NOT NULL'),
    	'radio'		=>	array('单选','char(10) NOT NULL'),
    	'checkbox'	=>	array('多选','varchar(100) NOT NULL'),
    	'editor'    =>  array('编辑器','text NOT NULL'),
    	'picture'   =>  array('上传图片','int(10) UNSIGNED NOT NULL'),
    	'file'    	=>  array('上传附件','int(10) UNSIGNED NOT NULL'),
    );
    return $type?$_type[$type][0]:$_type;
}

/**
 * 获取对应状态的文字信息
 * @param int $status
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_status_title($status = null){
    if(!isset($status)){
        return false;
    }
    switch ($status){
        case -1 : return    '已删除';   break;
        case 0  : return    '禁用';     break;
        case 1  : return    '正常';     break;
        case 2  : return    '待审核';   break;
        default : return    false;      break;
    }
}
// 获取数据的状态操作
function show_status_op($status) {
    switch ($status){
        case 0  : return    '启用';     break;
        case 1  : return    '禁用';     break;
        case 2  : return    '审核';		break;
        default : return    false;      break;
    }
}

/**
 * 获取文档的类型文字
 * @param string $type
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_document_type($type = null){
    if(!isset($type)){
        return false;
    }
    switch ($type){
        case 1  : return    '目录'; break;
        case 2  : return    '主题'; break;
        case 3  : return    '段落'; break;
        default : return    false;  break;
    }
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type=0){
    $list = C('CONFIG_TYPE_LIST');
    return $list[$type];
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group=0){
    $list = C('CONFIG_GROUP_LIST');
    return $group?$list[$group]:'';
}

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col.'_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 动态扩展左侧菜单,base.html里用到
 * @author 朱亚杰 <zhuyajie@topthink.net>
 */
function extra_menu($extra_menu,&$base_menu){
    foreach ($extra_menu as $key=>$group){
        if( isset($base_menu['child'][$key]) ){
            $base_menu['child'][$key] = array_merge( $base_menu['child'][$key], $group);
        }else{
            $base_menu['child'][$key] = $group;
        }
    }
}

/**
 * 获取参数的所有父级分类
 * @param int $cid 分类id
 * @return array 参数分类和父类的信息集合
 * @author huajie <banhuajie@163.com>
 */
function get_parent_category($cid){
    if(empty($cid)){
        return false;
    }
    $cates  =   M('Category')->where(array('status'=>1))->field('id,title,pid')->order('sort')->select();
    $child  =   get_category($cid);	//获取参数分类的信息
    $pid    =   $child['pid'];
    $temp   =   array();
    $res[]  =   $child;
    while(true){
        foreach ($cates as $key=>$cate){
            if($cate['id'] == $pid){
                $pid = $cate['pid'];
                array_unshift($res, $cate);	//将父分类插入到数组第一个元素前
            }
        }
        if($pid == 0){
            break;
        }
    }
    return $res;
}

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 获取当前分类的文档类型
 * @param int $id
 * @return array 文档类型数组
 * @author huajie <banhuajie@163.com>
 */
function get_type_bycate($id = null){
    if(empty($id)){
        return false;
    }
    $type_list  =   C('DOCUMENT_MODEL_TYPE');
    $model_type =   M('Category')->getFieldById($id, 'type');
    $model_type =   explode(',', $model_type);
    foreach ($type_list as $key=>$value){
        if(!in_array($key, $model_type)){
            unset($type_list[$key]);
        }
    }
    return $type_list;
}

/**
 * 获取当前文档的分类
 * @param int $id
 * @return array 文档类型数组
 * @author huajie <banhuajie@163.com>
 */
/* function get_cate($cate_id = null){
	if(empty($cate_id)){
		return false;
	}
	$cate   =   M('Category')->where('id='.$cate_id)->getField('title');
	return $cate;
} *///此处的函数搬到公共函数里面去了

 // 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

// 获取子文档数目
function get_subdocument_count($id=0){
    return  M('Document')->where('pid='.$id)->count();
}



 // 分析枚举类型字段值 格式 a:名称1,b:名称2
 // 暂时和 parse_config_attr功能相同
 // 但请不要互相使用，后期会调整
function parse_field_attr($string) {
    if(0 === strpos($string,':')){
        // 采用函数定义
        return   eval(substr($string,1).';');
    }
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

/**
 * 获取行为数据
 * @param string $id 行为id
 * @param string $field 需要获取的字段
 * @author huajie <banhuajie@163.com>
 */
function get_action($id = null, $field = null){
	if(empty($id) && !is_numeric($id)){
		return false;
	}
	$list = S('action_list');
	if(empty($list[$id])){
		$map = array('status'=>array('gt', -1), 'id'=>$id);
		$list[$id] = M('Action')->where($map)->field(true)->find();
	}
	return empty($field) ? $list[$id] : $list[$id][$field];
}

/**
 * 根据条件字段获取数据
 * @param mixed $value 条件，可用常量或者数组
 * @param string $condition 条件字段
 * @param string $field 需要返回的字段，不传则返回整个数据
 * @author huajie <banhuajie@163.com>
 */
function get_document_field($value = null, $condition = 'id', $field = null){
	if(empty($value)){
		return false;
	}

	//拼接参数
	$map[$condition] = $value;
	$info = M('Model')->where($map);
	if(empty($field)){
		$info = $info->field(true)->find();
	}else{
		$info = $info->getField($field);
	}
	return $info;
}

/**
 * 获取行为类型
 * @param intger $type 类型
 * @param bool $all 是否返回全部类型
 * @author huajie <banhuajie@163.com>
 */
function get_action_type($type, $all = false){
	$list = array(
		1=>'系统',
		2=>'用户',
	);
	if($all){
		return $list;
	}
	return $list[$type];
}

function user_group($group_id){
    if(empty($group_id)){
        $this->error('参数错误');
    }

    $AuthGroupModel = D('AuthGroup');

    $auth_group = M('AuthGroup')->where( array('status'=>array('egt','0'),'module'=>'admin','type'=>$AuthGroupModel->TYPE_ADMIN) )
        ->getfield('id,title,rules');
    $prefix   = C('DB_PREFIX');
    $l_table  = $prefix.($AuthGroupModel->MEMBER);
    $r_table  = $prefix.($AuthGroupModel->AUTH_GROUP_ACCESS);
    $model    = M()->table( $l_table.' m' )->join ( $r_table.' a ON m.uid=a.uid' );
    $_REQUEST = array();
    $list = lists($model,array('a.group_id'=>$group_id,'m.status'=>array('egt',0)),'m.uid asc',null,'m.uid,m.nickname,m.last_login_time,m.last_login_ip,m.status');

    int_to_string($list);
    return $list;
}


//删除图片
function dellpics($file){
	if(unlink($_SERVER["DOCUMENT_ROOT"].$file)){return true;}else{return false;}
}
