/**********************************************************/
//弹出层调用
/**********************************************************/

window.onload = function(){

    if($(window).width() > 1280) {
        layer.ready(function () {
            layer.photos({
                photos: '#photos'
            });

        });
    };
}
if($(window).width() > 1280){
    layer.ready(function(){
        layer.photos({
            photos: '#photos'
        });
		alert($('#photos').attr('class'));
    });

    //弹出登录框
    function showLoginDiv(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['600px', '453px'],
            content: 'login.html',
            shift:2,
            skin: 'skin01'
        })
    }
    //弹出注册框
    function showRegDiv(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['578px', '280px'],
            content: 'reg.html',
            shift:2,
            skin: 'skin01'
        })
    }
    //弹出找回密码框
    function showFindDiv(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['600px', '310px'],
            content: 'find.html',
            shift:2,
            skin: 'skin01'
        })
    }
    //调用父页面,关闭登录框,打开注册框的方法
    function regClick(){window.parent.showRegDiv();}
    //调用父页面,关闭注册框,打开登录框的方法
    function loginClick(){window.parent.showLoginDiv();}
    //打开找回密码的方法
    function findClick(){window.parent.showFindDiv();}
    $(function(){
        //点击弹框内的注册按钮，打开注册框
        $(".RegLink").on("click",function(){regClick();});
        //打开找回密码框
        $(".FindLink").on("click",function(){findClick();});
        //点击注册按钮，打开注册框
        $(".RegBtn").on("click",function(){regClick();});
        //点击登录按钮，打开注册框
        $(".LogBtn").on("click",function(){loginClick();});
    });

    function popup_doctor(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['600px', '400px'],
            content: 'doctor-2.html',
            shift:2,
            skin: 'skin02'
        })
    }
    $(function(){
        //健康咨询
        $(".jkzx").on("click",function(){popup_doctor();});
    });

    //医生会员
    /*function popup_patient(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['785px', '661px'],
            content: 'popup-2.html',
            skin:'skin02'
        })
    }*/
    function popup_feedback(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['632px', '246px'],
            content: 'popup-1.html',
            shift:2,
            skin:'skin02'
        })
    }
    function popup_comments(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['785px', '480px'],
            content: 'article-1.html',
            shift:2,
            skin:'skin02'
        })
    }
    function popup_commentsm(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['785px', '480px'],
            content: 'article-2.html',
            shift:2,
            skin:'skin02'
        })
    }
    $(function(){
        //患者信息、开始诊断、回复患者
        /*$(".hzxx,.hfhz").on("click",function(){popup_patient();});*/
        //请求反馈信息
        $(".qqfk").on("click",function(){popup_feedback();});
        //查看评论
        $(".ckpl").on("click",function(){popup_comments();});
        //查看评论 个人会员
        $(".mckpl").on("click",function(){popup_commentsm();});

        /*$(".kszd").on("click",function(){
            layer.open({
                type: 2,
                title: false,
                shadeClose: true,
                closeBtn: false,
                area: ['785px', '661px'],
                content: 'popup-kszd.html',
                skin:'skin02'
            })
        });*/
        
        $(".kszd").on("click",function () {
            layer.open({
                type: 2,
                title: false,
                shadeClose: true,
                closeBtn: false,
                area: ['785px', '661px'],
                content: 'tab3.html',
                shift:2,
                skin:'skin02'
            })
        });
        $(".hdl2 .tab-issue a").on("click",function () {
            layer.open({
                type: 2,
                title: false,
                shadeClose: true,
                closeBtn: false,
                area: ['785px', '661px'],
                content: 'tab2.html',
                shift:2,
                skin:'skin02'
            })
        });
        $(".hdl1 p").on("click",function () {
            layer.open({
                type: 2,
                title: false,
                shadeClose: true,
                closeBtn: false,
                area: ['785px', '661px'],
                content: 'tab1.html',
                shift:2,
                skin:'skin02'
            })
        });
    });


    //个人会员
    function showfeedbackDiv(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['640px', '320px'],
            content: ['p-feedback.html', 'no'],
            shift:2,
            skin:'skin02'
        })
    }
    $(function(){
        //反馈信息
        $(".fkxx").on("click",function(){showfeedbackDiv();})
    });
    function showbookDiv(){
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['785px', '655px'],
            content: ['popup-3.html', 'no'],
            shift:2,
            skin:'skin02'
        })
    }
    $(function(){
        //预约详情
        $(".yyxq").on("click",function(){showbookDiv();})
    });


    //诊所管理&&总后台管理
    //添加医生
    function add_doctor(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['330px', '378px'],
            content: 'add_doctor.html',
            shift:2,
            skin:'skin02'
        })
    }
    //问题列表 编辑
    function editor(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['360px', '190px'],
            content: 'editor.html',
            shift:2,
            skin:'skin02'
        })
    }
    //后台管理 登录
    function register(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['320px', '220px'],
            content: 'Background_register.html',
            shift:2,
            skin:'skin02'
        })
    }
    //编辑服务项目
    function editor_project(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['280px', '310px'],
            content: 'editor_project.html',
            shift:2,
            skin:'skin02'
        })
    }
    //添加服务项目
    function add_Service_project(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['280px', '310px'],
            content: 'add_project.html',
            shift:2,
            skin:'skin02'
        })
    }
    //删除
    function project_remove(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['280px', '150px'],
            content: 'project_remove.html',
            shift:2,
            skin:'skin02'
        })
    }
    //医生列表——编辑
    function doctor_editor(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['360px', '190px'],
            content: 'doctor_list.html',
            shift:2,
            skin:'skin02'
        })
    }
    //医生列表——删除
    function doctor_remove(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn: false,
            area: ['280px', '156px'],
            content: 'doctor_remove.html',
            shift:2,
            skin:'skin02'
        })
    }
    // 弹出添加服务列表
    function AddServiceList(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['620px', '310px'],
            content: 'Background-addservice.html',
            shift:2,
            skin:'skin02'
        })
    }
    // 弹出编辑服务列表
    function EditServiceList(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['600px', '310px'],
            content: 'Background-editservice.html',
            shift:2,
            skin:'skin02'
        })
    }

    // 弹出添加服务列表
    function showAddServiceList(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['620px', '310px'],
            content: 'allM-addservice.html',
            shift:2,
            skin:'skin02'
        })
    }
    // 弹出编辑服务列表
    function showEditServiceList(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['600px', '310px'],
            content: 'allM-editservice.html',
            shift:2,
            skin:'skin02'
        })
    }
    // 弹出删除服务列表
    function showdelteServiceList(obj1){
        var othis=$(obj1).get(0);
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            btn: ['确认删除', '关闭'],
            yes: function(index, layero){
                $(othis).parents('tr').fadeOut();
                layer.closeAll();
            },
            area: ['280px', '150px'],
            skin:"btn-class",
            content: 'allM-deleteservie.html',
            shift:2
        })
    }
    // 弹出添加诊所
    function showaddClinic(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['400px', '280px'],
            skin:"btn-class",
            content: 'allM-addclinic.html',
            shift:2
        })
    }
    // 弹出编辑邮件
    function showeditemail(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['330px', '220px'],
            skin:"btn-class",
            content: 'allM-editemail.html',
            shift:2
        })
    }
    // 弹出编辑医生特长
    function showeditedocspecial(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '220px'],
            skin:"btn-class",
            content: 'allM-editdocspecial.html',
            shift:2
        })
    }
    // 弹出添加医生特长
    function showaddedocspecial(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '220px'],
            skin:"btn-class",
            content: 'allM-adddoctorspecial.html',
            shift:2
        })
    }
    // 弹出添加文章分类标签
    function showaddarticletag(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-addarticletag.html',
            shift:2
        })
    }
    // 弹出编辑文章分类标签
    function showeidtarticletag(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-editarticletag.html',
            shift:2
        })
    }
    // 弹出编辑自定义标签
    function showeidtTostag(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-edittostag.html',
            shift:2
        })
    }
    // 弹出编辑自定义标签
    function showaddTostag(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-addtaglib.html',
            shift:2
        })
    }
    // 弹出添加服务类型标签
    function showaddTostag(){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-addtostag.html',
            shift:2
        })
    }
    // 弹出编辑服务类型标签
    function showeditTostag(a,b){
        var enName = a;
        var cnName = b;
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: true,
            closeBtn:false,
            area: ['360px', '240px'],
            skin:"btn-class",
            content: 'allM-editstostag.html?chineeseName='+enName+'&englishname='+cnName+'"',
            shift:2
        })
    }
    //打开添加服务列表
    function addServiceClick(){window.parent.showAddServiceList();}
    //打开编辑服务列表
    function editServiceClick(){window.parent.showEditServiceList();}
    //打开删除服务列表
    function deleteServiceClick(obj){
        var s = $(obj);
        window.parent.showdelteServiceList(s);
    }
    //打开编辑服务列表
    function editServiceClick(){window.parent.showEditServiceList();}
    //打开添加诊所
    function addClinicClick(){window.parent.showaddClinic();}
    //打开编辑邮件
    function editmailClick(){window.parent.showeditemail();}
    //打开编辑医生特长
    function editdocspecialClick(){window.parent.showeditedocspecial();}
    //打开添加医生特长
    function adddocspecialClick(){window.parent.showaddedocspecial();}
    //打开添加文章分类标签
    function addArticleTagClick(){window.parent.showaddarticletag();}
    //打开编辑文章分类标签
    function editArticleTagClick(){window.parent.showeidtarticletag();}
    function addArticleTagClick(){window.parent.showaddarticletag();}
    //打开编辑自定义标签
    function editTosTagClick(){window.parent.showeidtTostag();}
    //打开添加自定义标签
    function addTaglibClick(){window.parent.showaddTostag();}
    //打开添加服务类型标签
    function addTaglibClick(){window.parent.showaddTostag();}
    //打开编辑服务类型标签
    function editTaglibClick(a,b){
        var En = a;
        var cn = b;
        window.parent.showeditTostag(a,b);
    }
    function showadduppicClick(a,b){
        layer.closeAll();
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            closeBtn:false,
            area: ['1200px', '700px'],
            skin:"btn-class",
            content: ['uppic.html',"no"],
            shift:2
        })
    }
    function adduppicClick(){window.parent.showadduppicClick();}
    $(function() {
        // 点击添加服务列表按钮
        $(".btnaddservice").on("click", function () {
            addServiceClick();
        });
        // 点击编辑服务列表按钮
        $(".editservice").on("click", function () {
            editServiceClick();
        });
        // 点击删除服务列表按钮
        $(".deleteservice").on("click", function () {
            deleteServiceClick($(this));
        });
        $(".log-tit1 .fa").on("click", function (event) {
            layer.closeAll();
        });
        // 点击添加诊所按钮
        $(".btnaddclinic").on("click", function () {
            addClinicClick();
        });
        // 点击编辑邮件按钮
        $(".editemail").on("click", function () {
            editmailClick();
        });
        // 点击编辑医生特长
        $(".editdocspeci").on("click", function () {
            editdocspecialClick();
        });
        // 点击添加医生特长
        $(".btnadddocspecial").on("click", function () {
            adddocspecialClick();
        });
        // 点击添加文章分类标签
        $(".btnadddarticletag").on("click", function () {
            addArticleTagClick();
        });
        // 点击编辑文章分类标签
        $(".editarticletag").on("click", function () {
            editArticleTagClick();
        });
        // 点击编辑自定义标签
        $(".editaglib").on("click", function () {
            editTosTagClick();
        });
        // 点击添加自定义标签
        $(".btnadddtaglib").on("click", function () {
            addTaglibClick();
        });
        // 点击添加服务类型标签
        $(".btnaddtosstag").on("click", function () {
            addTaglibClick();
        });
        // 点击编辑服务类型标签
        $(".editosstag").on("click", function () {
            var oEnName = $(this).parents("tr").find("td:nth-child(2)").text();
            var oCnName = $(this).parents("tr").find("td:nth-child(3)").text();
            editTaglibClick(oEnName, oCnName);
        });
        //
        $(".up").on("click", function () {
            layer.closeAll();
            layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            closeBtn:false,
            area: ['1200px', '700px'],
            skin:"btn-class",
            content: ['uppic.html',"no"],
            shift:2
        })
        });

    })
}

