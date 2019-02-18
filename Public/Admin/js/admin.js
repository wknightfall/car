$(function(){
	if($('#linktype').val()=='文字链接'){
		$('#logo').fadeOut();
	}else{
		$('#logo').fadeIn();
	}
	$('#linktype').change(function(){
		if($(this).val()=='文字链接'){
			$('#logo').fadeOut();
		}else{
			$('#logo').fadeIn();
		}
	});
	
	
	function getstatus(status){
		if(status==1){
			return '正常';
		}else{
			return '禁用';
		}
	}
	function timeformat(timestamp){
		return new Date(parseInt(timestamp) * 1000).toLocaleString();
	}
	function _int2iP(num)
	{
	    var str;
	    var tt = new Array();
	    tt[0] = (num >>> 24) >>> 0;
	    tt[1] = ((num << 8) >>> 24) >>> 0;
	    tt[2] = (num << 16) >>> 24;
	    tt[3] = (num << 24) >>> 24;
	    str = String(tt[0]) + "." + String(tt[1]) + "." + String(tt[2]) + "." + String(tt[3]);
	    return str;
	} 
	$('#matchuname').change(function(){
		
		//得到当前选择的红娘的id
		var matchid=$(this).val();
		if(!matchid){
			
			$.each($('input[type=text]'),function(){
				
				$(this).val('');
				
			});
			
			$('input[name=u_c_id]').val('');
			
		}else{
			
				$('input[name=u_m_id]').val(matchid);
				
				//得到这个红娘的信息
				$.post('/index.php?s=/Admin/Matchmaker/getucmember',{matchid:matchid},function(data){
					
					var jsonData=eval("("+data+")");//转换为json对象 
					
					$.each(jsonData, function(index, objVal) {
						
						if(index=='status'){
							
							$('input[name='+index+']').val(getstatus(objVal));
							
						}else if(index=='reg_time' || index=='last_login_time' || index=='update_time'){
							
							$('input[name='+index+']').val(timeformat(objVal));
							
						}else if(index=='reg_ip' || index=='last_login_ip'){

							$('input[name='+index+']').val(_int2iP(objVal));
							
						}else{
							
							$('input[name='+index+']').val(objVal);
							
						}
					});  
					
				});
				
		}
	});
});