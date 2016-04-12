(function($){
	$(function(){
		$('.status-show').on('click',function(){
			var url = $('.audit-action').val();
			var id = $(this).attr('_id');
		   	var _csrf = $('#_csrf').val();
		   	var that = this;
		   	$.ajax({
		      	type: "POST",
		         url: url,
		         data:{id:id,_csrf:_csrf},
		         success: function(obj){
		            var obj = eval('(' + obj + ')');
		            if (parseInt(obj.errorCode) == 0) {
		               if (obj.data.status == 2) {
		            	   $(that).find('span').addClass('label-success').text(obj.data.status_text);
		               }else{
		            	   $(that).find('span').removeClass('label-success').text(obj.data.status_text);
		               }
		            }else{
		               alert('状态更新失败');
		            }
		         }
		   	});
		})
	})
})(jQuery);