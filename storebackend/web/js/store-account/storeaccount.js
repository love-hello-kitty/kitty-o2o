(function($){
	$(function(){
		//修改账号
		$('#store-account-form').on('click','#save-button',function() {
			$('#AlertModal').modal('show');
		})

		//确定修改
		$('.confirm-modify-password').on('click',function(){
			$('#store-account-form').ajaxSubmit({  
	            type:"POST", 
	            success:function(obj){
	            	var obj = eval('(' + obj + ')');
		            if (parseInt(obj.errorCode) == 0) {
		            	$('#AlertSuccess').fadeIn('fast',function(){
		                    $(this).fadeOut(2000,function(){
		                    	window.location.reload();
		                    });
		                 });
		            }else{
		            	$('#modify_result').css({color:'red'}).text(obj.errorText).show();
		            }
	            },
	            complete:function() {
	                $('#AlertModal').modal('hide');
	            }
	        });
		})
	})
})(jQuery);