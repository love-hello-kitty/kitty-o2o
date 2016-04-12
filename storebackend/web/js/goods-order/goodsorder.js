(function($){
	$(function(){
		$('#confirm-consume-btn').on('click',function(){
			var consume_code = $('#consume-code').val();
			if (!consume_code) {
				$('#consume-code-error').text('消费码不能为空');
				return;
			}
			var url = $('#confirm-consume-url').val();
			var _csrf = $('#_csrf').val();
			$.ajax({
		      	type: "POST",
		         url: url,
		         data:{consume_code:consume_code,_csrf:_csrf},
		         success: function(obj){
		            var obj = eval('(' + obj + ')');
		            if (parseInt(obj.errorCode) == 0) {
		            	//清除消费码输入框
		            	$('#consume-code').val('');
		            	var _html = '<p>订单号：'+obj.data.order_number+'</p>';
		            	_html += '<p>下单人：'+obj.data.member+'</p>';
		            	_html += '<p>手机号：'+obj.data.phone+'</p>';
		            	_html += '<p>消费金额：￥'+obj.data.total_price+'</p>';
		            	_html += '<p>消费时间：'+obj.data.consume_time+'</p>';
		            	$('#AlertConsumeModal .modal-body').html(_html);
		                $('#AlertConsumeModal').modal('show');
		            }else{
		            	$('#consume-code-error').text(obj.errorText);
		            }
		         }
		   	});
		})
	})
})(jQuery);