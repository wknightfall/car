$(function(){
	$.ajaxSetup({async : false});
	var curPro = $('#now_pro').val();
	var curCit = $('#now_cit').val();
	var curCon = $('#now_con').val();
	//alert(curPro);
	$.get("/Admin/public/getPronvince",{curpro:curPro} ,function(result){
																  
		$('.province').html('<select name="nowprovince" class="select" id="nowprovince" style="width:90px;"><option value="" >请选择省</option>' + result + '</select>')
  		if(curPro!=null){

			selectCity(curCit,curCon);
		}
		
	});
	$('#nowprovince').change(function(){

				selectCity(curCit,curCon);
				$('#county_id').val();
				$('#county_id').hide();
									  
	});		
	
	function selectCity(curCit,curCon){
			
			var pid = $('#nowprovince').val();
		
			$.get("/Admin/public/getCity",{ pid:pid}, function(result){
				//$("div").html(result);
				$('.city').html('<select name="nowcity" class="select" id="nowcity" style="width:90px;"><option value="" >请选择市</option>' + result + '</select>')
				
				$('#nowcity').val(curCit);
				
				if(curCon!=null){
					//alert(curCon)
					selectContry(curCon);
				}
				//alert(result);
				$('#nowcity').change(function(){
					//执行显示区县
					selectContry(curCon);
					
				});
			});
	}

	function selectContry(curCon){
	
			var pid=$('#nowcity').val();
					//alert(pid);
			$.get("/Admin/public/getCounty",{ pid:pid}, function(result){
				//$("div").html(result);
				$('.county').html('<select name="nowcounty" class="select" id="nowcounty" style="width:90px;" ><option value="" >请选择区</option>' + result + '</select>')
				
				$('#nowcounty').val(curCon);
				//alert(result);
			});
	
	}
	
	
});