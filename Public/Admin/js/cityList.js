$(function(){
	$.ajaxSetup({async : false});
	var curPro = $('#cur_pro').val();
	var curCit = $('#cur_cit').val();
	//alert(curPro);
	$.get("/Admin/public/getPronvince",{curpro:curPro} ,function(result){
																  
		$('.sheng').html('<select name="nowsprovince" class="select" id="nowsprovince" style="width:90px;"><option value="" >请选择省</option>' + result + '</select>')
  		if(curPro!=null){

			selectCity(curCit);
		}
		
	});
	$('#nowsprovince').change(function(){
			$('#county_id').val();
			$('#county_id').hide();
			selectCity(curCit);
									  
	});		
	
	function selectCity(curCit){
			var pid = $('#nowsprovince').val();

			$.get("/Admin/public/getCity",{ pid:pid}, function(result){
				
				//$("div").html(result);
				$('.shi').html('<select name="nowscity" id="nowscity" class="select" style="width:90px;"><option value="" >请选择市</option>' + result + '</select>')
				
				$('#nowscity').val(curCit);
				
				
			});
	}

	
	
	
});