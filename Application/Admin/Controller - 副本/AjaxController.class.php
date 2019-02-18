<?php


namespace Admin\Controller;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class AjaxController extends \Think\Controller {
    //ajax取出颜色和尺码
    public function ajaxcolor(){
        //查询颜色
        $whe['pid'] = array('eq',163);
        $whe['status'] = array('eq',1);
        $color = M('category')->where($whe)->select();
        //查询尺码
        $whe['pid'] = array('eq',169);
        $size = M('category')->where($whe)->select();

        foreach($color as $k => $v){

            $col .= "<option  value='".$v['id']."'>{$v['title']}</option>";

        }
        foreach($size as $k => $v){

            $siz .= "<option  value='".$v['id']."'>{$v['title']}</option>";
        }

        $result['color'] = $col;
        $result['size'] = $siz;

        echo json_encode($result);

    }
    //ajax 取出尺码
    public function size(){

        //查询尺码
        $whe['pid'] = array('eq',169);
        $whe['status'] = array('eq',1);
        $size = M('category')->where($whe)->select();

        foreach($size as $k => $v){

            $siz .= "<option  value='".$v['id']."'>{$v['title']}</option>";
        }

        $result['size'] = $siz;

        echo json_encode($result);


    }

    //ajax查询相同款式的商品
    public function getStylelist(){

        $list = $_POST;
        if(!empty($list['brand'])){

            $whe['bid'] = array('eq',$list['brand']);

        }
        if(!empty($list['year'])){

            $whe['year'] = array('eq',$list['year']);

        }
        if(!empty($list['season'])){

            $whe['season'] = array('eq',$list['season']);

        }
        if(!empty($list['pid'])){

            $whe['pid'] = array('eq',$list['pid']);

        }
        if(!empty($list['id'])){

            $whe['id'] = array('neq',$list['id']);

        }

        $vo = D('comstyle')->where($whe)->order('sort asc')->select();
        if($vo){

            foreach($vo as $k =>$v){
                $path = picture($v['icon']);
                $url = "'/Admin/Hyc/edit?cid=".$v['id']."'";
                $ret .='<tr><td>'.$v['id'].'</td><td>'.$v['girard'].'</td><td>'.modelField($v['bid'],'brand','title').'</td><td>'.$v['year'].'</td><td>'.$v['season'].'</td><td>'.modelField(modelField($v['pid'],'producttype','pid'),'producttype','title').'-'.modelField($v['pid'],'producttype','title').'</td><td>'.$v['remark'].'</td><td><a class="zs_tu" href="#"><img class="zs_tu1" style="width:100px;" src="'.$path.'"><br></a><span><img src="'.$path.'" style="width:142px; float:left;"></span></td><td style="width:100px;"><div class="add_cz"><input type="button" value="查看" onclick="window.location.href='.$url.'"></div></td></tr>';

            }

            echo $ret;
        }




    }

    //通过省获取所有的市
    public function getJSONCity(){
        $pid = $_REQUEST['pid'];

        $pid = is_numeric($pid)?$pid:0;

        $_wr['province_id'] = array('eq' , $pid);

        $_wr['status'] = array('eq' , 1);

        $city = M('city')->field('id,addr')->where($_wr)->order('id asc')->select();

        foreach ($city as $key=>$val)
        {
            $ret .= '<option value="' . $city[$key]['id'] .'"'.$this->getCurrent($pid,$city[$key]['id']).'>' . $city[$key]['addr'] . '</option>';

        }
        echo $ret;

    }

    public function getCurrent($id,$curID){

        if($id==$curID){
            return 'selected';
        }else{

            return '';
        }


    }

    public function getCounty(){
        $pid = $_REQUEST['pid'];

        $pid = is_numeric($pid)?$pid:0;

        $_wr['city_id'] = array('eq' , $pid);


        $_wr['status'] = array('eq' , 1);
        $city = M('county')->field('id,addr')->where($_wr)->order('sort desc')->select();
        $curCon = is_numeric($_REQUEST['curCon'])?$_REQUEST['curCon']:0;

        foreach ($city as $key=>$val)
        {
            $ret .= '<option value="' . $city[$key]['id'] .'"'.$this->getCurrent($curCon,$city[$key]['id']).'>' . $city[$key]['addr'] . '</option>';

        }
        echo $ret;


    }

    //Ajax取出省市区下的客户
    public function outboundlist(){

        $list = $_POST;
        if(!empty($list['pro'])){

            $map['province_id'] = array('eq',$list['pro']);
        }
        if(!empty($list['cit'])){

            $map['city_id'] = array('eq',$list['cit']);
        }
        if(!empty($list['cou'])){

            $map['county_id'] = array('eq',$list['cou']);
        }

        $map['status'] = array('eq',1);
       // $map['cid'] = array('eq',is_login());  查询当前业务员的客户

        $cust = D('Customer')->where($map)->select();

        foreach($cust as $k => $v){

            $ret .= '<input type="radio" name="cid" id="s'.($k+1).'" value="'.$v['id'].'" ><label style="width:320px;" for="s'.($k+1).'">&nbsp;'.($k+1).'、'.$v['title'].'</label>';

        }

        echo $ret;

    }

    //添加出库单
    public function outbound_add(){

        $cid = I('post.cid');

        //查询是否有未出库的出库单
        $str['cid'] = array('eq',$cid);
        $str['kid'] = array('eq',0);
        $str['status'] = array('eq',0);

        $cust = D('Outbound')->where($str)->find();

        if($cust){

            exit('500');//已存在出库单
        }

        $data['cid'] = $cid;
        $data['order_number'] = OutBoundSend();
        $data['create_time'] = time();
        $data['end_time'] = time();
        $data['pid'] = is_login();
        $data['kid'] = 0;
        $data['status'] = 0;

        if(D('Outbound')->add($data)){

            exit('200');

        }else{

            exit('501');
        }

    }
    //添加出库单商品
    public function outproduct(){

        $list = $_POST;

        if(!empty($list['barcode'])){

            //查询条码是否存在
            $sto['barcode'] = array('eq',$list['barcode']);

            $stock = D('stock')->where($sto)->find();

            if(!$stock){

                exit('500');//条码不存在

            }
            $out['sid'] = array('eq',$stock['id']);
            $out['oid'] = array('eq',$list['outid']);

            $pro = D('Outproduct')->where($out)->find();

            if($pro){

                exit('501');//当前条码商品已存在当前出库单中

            }

            $data['sid'] = $stock['id'];
            $data['oid'] = $list['outid'];
            $data['number'] = 0;
            $data['status'] = 0;
            $data['create_time'] = time();

            if(D('Outproduct')->add($data)){

                exit('200');

            }else{

                exit('503');
            }
        }

        //品牌添加
        if(!empty($list['out_sid'])){
            $sidlist = explode(',',$list['out_sid']);

            foreach($sidlist as $k => $v){

                $out['sid'] = array('eq',$v);
                $out['oid'] = array('eq',$list['outid']);

                $pro = D('Outproduct')->where($out)->find();

                if(empty($pro)){

                    $data['sid'] = $v;
                    $data['oid'] = $list['outid'];
                    $data['number'] = 0;
                    $data['status'] = 0;
                    $data['create_time'] = time();

                    $res[] = $data;

                }




            }

            if(empty($res)){

                exit('200');

            }

            if(D('Outproduct')->addAll($res)){

                exit('200');

            }else{

                exit('503');
            }

        }




    }

    //新增计划  搜索品牌
    public function out_brand_serah(){

        if(IS_POST){

            $brandname = $_POST['brandname'];

            $arr['status'] = array('eq',1);
            $arr['title'] = array('like','%'.$brandname.'%');
            $brand = M('brand')->where($arr)->select();

            if(empty($brand)){

                exit('500');

            }

            foreach($brand as $k => $v){

                $ret .= '<tr><td class="bt">品牌</td><td class="b_title" id="'.$v['id'].'">'.$v['title'].'</td></tr>';

            }

            echo $ret;

        }

    }

    //新增计划  品牌下款号
    public function out_style_list(){

        if(IS_POST){

            $bid = I('post.bid');

            if(!empty(I('post.girard'))){

                $sty['girard'] = array('like','%'.I('post.girard').'%');

            }

            $sty['status'] = array('eq',1);
            $sty['bid'] = array('eq',$bid);

            $comlist = M('comstyle')->where($sty)->select();

            if(empty($comlist)){

                exit('500');  //当前品牌暂无商品
            }
            foreach($comlist as $k => $v){

                $ret .= '<tr id="'.$v['id'].'"><td class="bt">款号</td><td>'.$v['girard'].'</td><td class="bt">总库存</td><td>'.numstocklist($v['id']).'</td></tr>';

            }

            echo $ret;

        }

    }

    //新增计划  点击款号显示
    public function out_stock_list(){

        if(IS_POST){

            $comid = I('post.comid');

            //查询当前款号信息
            $comstyle = M('comstyle')->find($comid);

            $stock = M('stock')->where('pid='.$comid)->select();

            $result['comstyle'] = '<tbody><tr><td class="bt">款号</td><td>'.$comstyle['girard'].'</td><td class="bt">总库存</td><td>'.numstocklist($comstyle['id']).'</td><td>成本</td><td>'.$comstyle['costprice'].'</td><td>卖价</td><td>'.$comstyle['selprice'].'</td></tr></tbody>';

            $result['brand'] = '<tbody><tr><td class="bt">品牌</td><td>'.modelField($comstyle['bid'],'brand','title').'</td><td>'.$comstyle['year'].'</td><td>'.$comstyle['season'].'</td><td>'.modelField($comstyle['pid'],'producttype','title').'</td><td>'.$comstyle['remark'].'</td></tr></tbody>';

            if(empty($stock)){

                $result['list'] = '<tr><td colspan="4">当前款号暂无库存商品</td></tr>';

            }else{

                foreach($stock as $k =>$v){

                    $ret .= '<tr class="kxz" id="'.$v['id'].'"><td>'.$v['barcode'].'</td><td>'.modelField($v['cid'],'category','title').'</td><td>'.modelField($v['sid'],'category','title').'</td><td>'.$v['stock'].'</td></tr>';

                }

                $result['list'] = '<tr class="bt"><td >条码</td><td>颜色</td><td>码数</td><td>平均库存</td></tr>'.$ret;

            }

            exit(json_encode($result));

        }

    }

    //删除计划单的内容

    public function out_delete(){

        if(IS_POST){

            $o_id = I('post.o_id');

            $result = M('outproduct')->delete($o_id);

            if($result){

                exit('200');

            }


        }

    }

    //出库确认商品
    public function out_status(){

        if(IS_POST){

            $pid = I('post.pid');

            $outpro = M('outproduct')->find($pid);

            $data['status'] = $outpro['status'] == 1?0:1;

            $data['id'] = $outpro['id'];

            if(M('outproduct')->save($data)){

                exit('200');

            }else{

                exit('500');

            }

        }

    }

    //立即发货
    public function delivergoods(){

        if(IS_POST){

            $list = $_POST;

            //查询当前计划单信息

            $outbound = M('outbound')->find($list['outid']);

            if($outbound['status'] != 1){

                exit('500'); // 非法操作

            }

            //添加发货记录

            $data['oid'] = $outbound['id'];
            $data['uid'] = is_login();
            $data['wid'] = $list['kuaid'];
            $data['log_number'] = $list['logistics'];
            $data['create_time'] = time();
            $data['type'] = 1;   //库管员发货

            //修改计划单状态
            $out['id'] = $outbound['id'];
            $out['status'] = 2;   //修改计划单状态
            $out['end_time'] = time();
            $out['kid'] = is_login();

            //记录行为
            action_log('update_planorder', 'outbound', $outbound['id'], is_login());

            $bound = M('outbound');$delivercode = M('delivercode');
            $bound -> startTrans();$delivercode -> startTrans(); //启动事务


            if($bound->save($out) && $delivercode->add($data)){

                $bound->commit();$delivercode->commit(); //提交事务

                exit('200');

            }else{
                $bound -> rollback();$delivercode -> rollback(); //事务回滚
                exit('501');

            }

        }

    }

}
