<?php


namespace Home\Controller;
use OT\DataDictionary;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");

class AjaxController extends  \Think\Controller {


    /*
	* 首页搜索
	*/
    public function search(){
        if(IS_POST){
            $list=I('post.');
            $key=$list['key'];
            $col['name']=array('like','%'. $key .'%');

            $find=0;
            if($id=M('news')->where($col)->find()['id']){
                $find=$id;
                $model='news';
            }else if($id=M('media')->where($col)->find()['id']){
                $find=$id;
                $model='media';
            }
            if($find==0){
                exit(json_encode(array('code'=>400,'id'=>$find,'model'=>$model)));
            }else{
                exit(json_encode(array('code'=>200,'id'=>$find,'model'=>$model)));
            }
        }
    }
    /*
	*提交答案
	*/
    public function answer(){
        if(IS_POST){
            $list=I('post.');
            
            $paperno=date('Ymd',time()).rand(1000,9999);

            $add['paperno']=$paperno;
            $add['ip']=getip();
            $add['brandid']=$list['brandid'];
            $add['cartypeid']=$list['cartypeid'];
            $add['create_time']=time();
            $paperid=M('paper')->add($add);

            if($paperid){
                $a=explode('&',$list['data']);
                //exit(json_encode(array('code'=>200,'msg'=>$a)));

                foreach ($a as $k=>$v){
                    $queid=explode('=',$v)[0];
                    $answer=explode('=',$v)[1];

                    $an['paperid']=$paperid;
                    $an['queid']=$queid;
                    $an['answer']=$answer;
                    $an['create_time']=time();
                    M('answer')->add($an);
                }

                exit(json_encode(array('code'=>200,'msg'=>'提交成功!')));

            }else{
                exit(json_encode(array('code'=>400,'msg'=>'提交失败!')));
            }


            
           



        }
    }
    /*
    * 车型
    */
    public function cartype(){
        if(IS_POST){
            $list=I('post.');
            $col['status']=1;
            $col['typeid']=$list['id'];

            $re=M('cartype')->where($col)->select();

            $option='<option value="0" >请选择你驾乘的汽车车型</option>';
            foreach ($re as $v){
                $option.='<option value="'.$v['id'].'">'.$v['name'].'</option>';
            }
          
            exit(json_encode(array('code'=>200,'msg'=>$option)));
           
        }

    }
    /*
    * 切换车图片
    */
    public function carpic(){
        if(IS_POST){
            $list=I('post.');
            $col['status']=1;
            $col['typeid']=$list['id'];
            $re=M('cartype')->where($col)->select();

            $option='';
            foreach ($re as $v){
            
                $option.='<li>
                <div>
                    <img src="'.picture($v[icon]).'">
                    <p>'.$v['name'].'</p>
                </div>
            </li>';
            }

            exit(json_encode(array('code'=>200,'msg'=>$option)));

        }

    }
    /*
    * 编辑评论
    */
    public function editcomment(){
        if(IS_POST){
            $list=I('post.');
            $old=M('comment')->where("id=".$list['id'])->find();
            if(!empty($list['star'])){
                if($old['icon'] == $list['icon'] &&  $old['content'] == $list['content'] &&  $old['star'] == $list['star']){
                    exit(json_encode(array('code'=>400,'msg'=>'请修改评论内容')));
                }
            }else{
                if($old['content'] == $list['content']){
                    exit(json_encode(array('code'=>400,'msg'=>'请修改评论内容')));
                }
            }

            if($old['icon'] != $list['icon']){
                $add['icon']=$list['icon'];
            }
            if($old['content'] != $list['content']){
                $add['content']=$list['content'];
            }
            if($old['star'] != $list['star']){
                $add['star']=$list['star'];
            }
            $re=M('comment')->where("id=".$list['id'])->save($add);
            if($re){
                exit(json_encode(array('code'=>200,'msg'=>'编辑成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'编辑失败')));
            }
        }

    }
    //订单去付款查询信息
    public function hotelinfo(){
        if(IS_POST){
            $list=I('post.');
            $orderno=$list['orderno'];

            $order=M('order')->where("orderno=".$list['orderno'])->find();
            $goodsid=M('orderdetail')->where("orderno=".$list['orderno'])->find()['goodsid'];
            exit(json_encode(array('code'=>200,'id'=>$goodsid, 'num'=>$order['num'],'date1'=>$order['date1'],'date2'=>$order['date2'] )));
        }
    }

    //下订单
    public function order(){
        if(IS_POST){
            $list=I('post.');
            if(empty(session('user'))){
                exit(json_encode(array('code'=>400,'msg'=>'您还未登录,请先登录！')));
            }
            $type=$list['type'];
            $actiontype=$list['actiontype'];

            $orderno=str_shuffle(time());


           if($actiontype == 3){
               //消费
                if($type=='food'){
                    if(empty($_COOKIE['mycart'])){
                        exit(json_encode(array('code'=>201,'msg'=>'您还未选择菜品哦~')));
                    }else{
                        $cart=unserialize($_COOKIE['mycart']);

                        $num=0;
                        $total=0;
                        foreach ($cart as $k=>$v) {

                            $re=M('room')->where("id=".$k)->find();
                            $num++;
                            $money=$v*$re['price'];
                            $total+=$money;

                            $add['orderno']=$orderno;
                            $add['goodsid']=$k;
                            $add['goodsnum']=$v;
                            $add['money']=$money;
                            $add['time']=time();

                            M('orderdetail')->add($add);
                        }
                        $orderadd['orderno']=$orderno;
                        $orderadd['hid']=$list['hid'];
                        $orderadd['uid']=session('user');
                        $orderadd['money']=$total;
                        $orderadd['time']=time();

                        $res=M('order')->add($orderadd);
                        if($res){
                            exit(json_encode(array('code'=>200,'msg'=>$orderno)));
                        }else{
                            exit(json_encode(array('code'=>400,'msg'=>'提交失败')));
                        }
                    }
                }else{
                    $add['orderno']=$orderno;
                    $add['goodsid']=$list['id'];
                    $add['goodsnum']=$list['num'];
                    $add['money']=$list['money'];
                    $add['time']=time();
                    $orderdetail=M('orderdetail')->add($add);

                    $orderadd['orderno']=$orderno;
                    $orderadd['actiontype']=$list['actiontype'];
                    $orderadd['hid']=$list['hid'];
                    $orderadd['uid']=session('user');
                    $orderadd['num']=$list['num'];
                    $orderadd['money']=$list['money'];
                    $orderadd['time']=time();
                    if(!empty($list['date'])){
                        $orderadd['date']=$list['date'];
                    }
                    if(!empty($list['date1'])){
                        $orderadd['date1']=$list['date1'];
                    }
                    if(!empty($list['date2'])){
                        $orderadd['date2']=$list['date2'];
                    }
                    if($list['piao']=='piao'){
                        $orderadd['name']=$list['name'];
                        $orderadd['phone']=$list['phone'];
                        $orderadd['iccard']=$list['iccard'];
                        $orderadd['email']=$list['email'];
                        $orderadd['yzm']=rand(100000,999999);
                    }

                    $re=M('order')->add($orderadd);

                    if($orderdetail && $re ){
                        exit(json_encode(array('code'=>200,'msg'=>$orderno)));
                    }else{
                        exit(json_encode(array('code'=>400,'msg'=>'提交失败')));
                    }
                }
           }else{
               //充值 提现
                   $orderadd['orderno']=$orderno;
                   $orderadd['actiontype']=$list['actiontype'];
                   $orderadd['uid']=session('user');
                   $orderadd['hid']=session('user');
                   $orderadd['money']=$list['money'];
                   $orderadd['time']=time();
                    if(!empty($list['cardno'])){
                        $orderadd['cardno']=$list['cardno'];
                    }
                   $re=M('order')->add($orderadd);

                   if($re){
                       exit(json_encode(array('code'=>200,'msg'=>$orderno)));
                   }else{
                       exit(json_encode(array('code'=>400,'msg'=>'提交失败')));
                   }
           }


        }

    }
    //  订单是否合法,是否已经支付完成
    public function checkorder(){
        if(IS_POST){
            $list=I('post.');
            $orderno=$list['orderno'];
            $order=M('order')->where('orderno='.$orderno)->find();
            if($order){
                if($order['state']==1){
                    exit(json_encode(array('code'=>200)));
                }else{
                    exit(json_encode(array('code'=>201)));
                }
            }else{
                exit(json_encode(array('code'=>400)));
            }

        }

    }
   
    //清空购物车
    public function clearcart(){
        if(setcookie("mycart", null, time() - 3600,'/')){
            exit(json_encode(array('code'=>200,'msg'=>'清空成功')));
        }else{
            exit(json_encode(array('code'=>400,'msg'=>'清空失败')));
        }
    }
    //加入购物车
    public function addtocart(){
        if(IS_POST){
            $list=I('post.');
            $id=$list['id'];
            $type=$list['type'];
            if($type=='jia'){
                $arr=unserialize($_COOKIE['mycart']);
                $arr[$id]=$arr[$id]+1;
                setcookie('mycart',serialize($arr),0,'/');
            }else if($type=='jian'){
                $arr=unserialize($_COOKIE['mycart']);
                $arr[$id]=$arr[$id]-1;
                if($arr[$id] ==0){
                    unset($arr[$id]);
                }
                setcookie('mycart',serialize($arr),0,'/');
            }else{
                if(isset($_COOKIE['mycart'])){
                    $arr=unserialize($_COOKIE['mycart']);
                    if(in_array($id,array_keys($arr))){
                        $arr[$id]=$arr[$id]+1;
                    }else{
                        $arr[$id]=1;
                    }
                    setcookie('mycart',serialize($arr),0,'/');
                }else{
                    $arr=array($id=>1);
                    setcookie('mycart',serialize($arr),0,'/');
                }
            }


            $li='';
            $num=0;
            $total=0;
            foreach ($arr as $k=>$v) {

                $re=M('room')->where("id=".$k)->find();
                $num++;
                $money=$v*$re['price'];
                if(ismobile()){

                    $li.='<li><em>'.$re['name'].'</em><i>￥'.$money.'</i><div class="buy_blus"><div class="shop_num"><p class="jian" data-id="'.$k.'"></p><input type="text" value="'.$v.'"><p class="jia"  data-id="'.$k.'"></p></div></div></li>';
                }else{
                    $li.='<li><i>'.$re['name'].'</i><div class="adds-dis"><p class="jian" data-id="'.$k.'">-</p><input type="text" value="'.$v.'"><p class="jia"  data-id="'.$k.'">+</p></div><em>￥'.$money.'</em></li>';
                }


                $total+=$money;
            }
            exit(json_encode(array('code'=>200,'msg'=>$li,'num'=>$num,'total'=>$total)));
            if($li){
                exit(json_encode(array('code'=>200,'msg'=>$li,'num'=>$num,'total'=>$total)));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'提交失败')));
            }
        }

    }
    // 加载购物车
    public function loadcart(){
        if(IS_POST) {
            $list = I('post.');
            //$type = $list['type'];
            if (isset($_COOKIE['mycart'])) {
                $arr = unserialize($_COOKIE['mycart']);
                $li = '';
                $num = 0;
                $total = 0;
                foreach ($arr as $k => $v) {

                    $re = M('room')->where("id=" . $k)->find();
                    $num++;
                    $money = $v * $re['price'];
                    $li .= '<li><i>' . $re['name'] . '</i><div class="adds-dis"><p class="jian" data-id="'.$k.'">-</p><input type="text" value="' . $v . '"><p class="jia" data-id="'.$k.'">+</p></div><em>￥' . $money . '</em></li>';

                    $total += $money;
                }
                if ($li) {
                    exit(json_encode(array('code' => 200, 'msg' => $li, 'num' => $num, 'total' => $total)));
                } else {
                    exit(json_encode(array('code' => 400, 'msg' => '加载失败')));
                }
            }else{
                    exit(json_encode(array('code' => 201, 'msg' => '购物车为空')));
            }
        }
    }

    /*
    * 发帖
    */
    public function fatie(){
        if(IS_POST){
            $list=I('post.');
            $add['uid']=session('user');
            $add['name']=$list['name'];
            $add['detail']=$list['detail'];

            $add['create_time']=time();

            $re=M('discuz')->add($add);
            if($re){
                exit(json_encode(array('code'=>200,'msg'=>'发布成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'发布失败')));
            }
        }

    }
    /*
   * 开关帖
   */
    public function onoff(){
        if(IS_POST){
            $list=I('post.');
            $kg=$list['onoff'];
            $find=M('discuz')->where("id=".$list['id'])->find()['onoff'];
            
                if($kg==$find){
                    if($kg==1){
                        exit(json_encode(array('code'=>200,'msg'=>'已开启')));
                    }else{
                        exit(json_encode(array('code'=>200,'msg'=>'已关闭')));
                    }
                   
                }
           
            $onoff=M('discuz')->where("id=".$list['id'])->find()['onoff']==1? 0:1;
            $re=M('discuz')->where("id=".$list['id'])->save(array('onoff'=>$onoff));
            if($re){
                exit(json_encode(array('code'=>200,'msg'=>'操作成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'操作失败')));
            }
        }
    }
    /*
  * 删除帖
  */
    public function deltiezi(){
        if(IS_POST){
            $list=I('post.');
            $re=M('discuz')->where("id=".$list['id'])->delete();
            if($re){
                exit(json_encode(array('code'=>200,'msg'=>'删除成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'删除失败')));
            }
        }
    }


    // 收藏
    public function collection(){
        if(IS_POST){
            $list=I('post.');
            if(empty(session('user'))){
                exit(json_encode(array('code'=>400,'msg'=>'请先登录!')));
            }
            
            $where['uid']=array('eq',session('user'));
            $where['tid']=array('eq',$list['id']);
            $where['type']=array('eq',$list['type']);
            $collection=M('collection')->where($where)->find();
            if(!empty($collection)) {
                $whe['id'] = array('eq', $collection['id']);
                $collectiondele = M('collection')->where($whe)->delete();
                if (!empty($collectiondele)) {
                    exit(json_encode(array('code' => 201, 'msg' => '取消成功')));
                } else {
                    exit(json_encode(array('code' => 400, 'msg' => '取消失败')));
                }
            }else{
                $add['tid']=$list['id'];
                $add['type']=$list['type'];
                $add['uid']=session('user');
                $add['time']=time();
                $collectionadd=M('collection')->add($add);
                if($collectionadd){
                    exit(json_encode(array('code'=>200,'msg'=>'收藏成功')));
                }else{
                    exit(json_encode(array('code'=>400,'msg'=>'收藏失败')));
                }
            }
        }

    }
    // 举报
    public function jubao(){
        if(IS_POST){
            $list=I('post.');
            $commentid=intval($list['id']);
            $ip=getip();
            $whe['commentid']=array('eq',$commentid);
            $whe['ip']=array('eq',$ip);
            if(M('jubao')->where($whe)->find()){
                exit(json_encode(array('code' => 201, 'msg' => '已举报 !')));
            }
            $com=M('comment')->where("id=".$commentid)->find();
            $add['ip']=$ip;
            $add['content']=$com['content'];
            $add['commentid']=$commentid;
            $add['comuid']=$com['uid'];
            //$add['comtime']=$com['time'];
            $add['time']=time();

            if(M('jubao')->add($add)) {
                exit(json_encode(array('code' => 200, 'msg' => '举报成功 !')));
            }else{
                exit(json_encode(array('code' => 400, 'msg' => '举报失败 !')));
            }
        }
    }
    /*
   * 建议
   */
    public function advice(){
        if(IS_POST){
            $list=I('post.');

            $add['name']=$list['name'];
            $add['tel']=$list['tel'];
            $add['email']=$list['email'];


            $add['content']=$list['content'];
            $add['create_time']=time();


            $re=M('message')->add($add);
            if($re){
                exit(json_encode(array('code'=>200,'msg'=>'提交成功')));
            }else{
                exit(json_encode(array('code'=>400,'msg'=>'提交失败')));
            }
        }

    }
    public function pictureUploade(){

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf','docx','rar','doc');// 设置附件上传类型
        $upload->rootPath  =     '/Uploads'; // 设置附件上传根目录
        $upload->savePath  =     '/Picture/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        //存入图片
        $picture[path] = '/Uploads'.$info[icon][savepath].$info[icon][savename];
        $picture[md5] = $info[icon][md5];
        $picture[sha1] = $info[icon][sha1];
        $picture[create_time] = time();
//判断是否有图片
        $wherea['md5'] = $info[icon][md5];
        $wherea['sha1'] = $info[icon][sha1];
        $picFind = M('picture')->where($wherea)->find();

        if($picFind){
            $_POST['icon'] = $picFind['id'];

            unlink($picture[path]);
        }else{
            $pic = M('picture')->add($picture);
            $_POST['icon'] = $pic;

        }


        //存入文件
        $file[savename] = $info[files][savename];
        $file[savepath] = $info[files][savepath];
        $file[size] = $info[files][size];
        $file[sha1] = $info[files][sha1];
        $file[sha1] = $info[files][sha1];
        $file[name] = $info[files][name];
        $file[ext] = $info[files][ext];
        $file[md5] = $info[files][md5];
        $file[create_time] = time();
        //判断是否有文件
        $whereb['md5'] = $info[files][md5];
        $whereb['sha1'] = $info[files][sha1];
        $filesFind = M('file')->where($whereb)->find();
        if($filesFind){
            $_POST['files'] = $filesFind['id'];
            $fileurl = 'Uploads/'.$file[savepath].$file[savename];
            unlink($fileurl);
        }else{
            $files = M('file')->add($file);
            $_POST['files'] = $files;
        }



    }

    public function sendLatLog(){

        if(IS_POST){

            $address = I('post.address');
            $address = $this -> trimall($address);
            $result = file_get_contents('http://restapi.amap.com/v3/geocode/geo?key=8bd55b21a9232dc24e65f66c1cde9148&s=rsv3&city=35&address='.$address);

            $res = json_decode($result,true);

            if($res['status'] == 1 && $res['info'] == 'OK' && !empty($res['geocodes'][0]['location'])){

                $jwd = explode(',',$res['geocodes'][0]['location']);

                $code['code'] = 200;
                $code['log'] = $jwd[0]; //经度
                $code['lat'] = $jwd[1];//纬度

                exit(json_encode($code));

            }else{

                $code['code'] = 500;
                $code['content'] = '经纬度解析失败，请手动填写经纬度！';
                exit(json_encode($code));

            }

        }

    }

    public function trimall($str)//删除空格
    {
        $qian=array(" ","　","\t","\n","\r");
        $hou=array("","","","","");
        return str_replace($qian,$hou,$str);
    }
}