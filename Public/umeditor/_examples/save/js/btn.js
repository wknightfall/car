/**
 * 创建按钮
 */

UM.registerUI('save', function( name ){

    //该方法里的this指向编辑器实例

    var me = this,

        //实例化一个UMEDITOR提供的按钮对象
        $button = $.eduibutton({
            //按钮icon的名字， 在这里会生成一个“edui-icon-save”的className的icon box，
            //用户可以重写该className的background样式来更改icon的图标
            //覆盖示例见btn.css
            'icon': 'save',
            'title': me.options.lang === "zh-cn" ? "@好友" : "save",
            'click': function(){
                //在这里处理按钮的点击事件
                //点击之后执行save命令
                //me.execCommand( name );
				//me.execCommand('insertHtml', '<a href="" style="color:#3eb0f5">@周建波</a>')
				
				$.post('/Home/stockgold/friends',function(result){
					
					if(result == '500'){
						
						layer.msg('您还没有登陆！',2,3);
						return false;
						
					}else{
						
						var index = $.layer({
									type : 2,
									fix : true,
									shade : [0.5 , '#000' , true],
									shadeClose : true,
									closeBtn: false,
									title: [
										'您的好友列表',
										//自定义标题风格，如果不需要，直接title: '标题' 即可
										'border:none; background:#3eb0f5; color:#fff;' 
									],
									border : [!0],
									
									//offset : ['25px',''],
									area : ['700px', '500px'],
									end: function(){
										
										var friend = $('#friend').val();
										
										if(friend != ''){
											
											me.execCommand('insertHtml', friend);
											
										}
	
									},
									iframe : {src : '/Home/public/memList.html'}
								});
						
					}
					
				});
            }
        });

    //在这里处理保存按钮的状态反射
    me.addListener( "selectionchange", function () {

        //检查当前的编辑器状态是否可以使用save命令
        var state = this.queryCommandState( name );

        //如果状态表示是不可用的( queryCommandState()的返回值为-1 )， 则要禁用该按钮
        $button.edui().disabled( state == -1 ).active( state == 1 );

    } );

    //返回该按钮对象后， 该按钮将会被附加到工具栏上
    return $button;

});