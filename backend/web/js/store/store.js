(function($){	$(function(){		var _STORE = {			selectArea:function(url,type,pid,target) {				var _csrf = $('#_csrf').val();				var data = {_csrf:_csrf};				data[type] = pid;				$.ajax({			      	 type: "GET",			         url: url,			         data:data,			         success: function(json) {			        	var obj = JSON.parse(json);			            if (parseInt(obj.errorCode) == 0) {						    var output = ['<option value="0">----请选择----</option>'];						    var firstChildId = 0;						    $.each(obj.data, function(key, value) {							    output.push('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');						    });						    target.html(output.join(''));			            }else{			            	console.log('select data error');			            }			         }			   	});			}		};		//区域选择		$('.area-select')		.on('change','.province-sel',function(){			var provinceId = $(this).val();			_STORE.selectArea(_config.getCityUrl,'province_id',provinceId,$('.city-sel'));		})		.on('change','.city-sel',function(){			var cityId = $(this).val();			_STORE.selectArea(_config.geDistrictUrl,'city_id',cityId,$('.district-sel'));		})		//账号分配		$('.row-fluid')	   .on('click','.fenpei-account',function() {		   var url = $('.fenpei-account-url').val();		   var id = $(this).attr('_id');		   var _csrf = $('#_csrf').val();		   var that = this;		   $.ajax({		      	type: "POST",		        url: url,		        data:{store_id:id,_csrf:_csrf},		        success: function(obj) {		            var obj = eval('(' + obj + ')');		            if (parseInt(obj.errorCode) == 0) {		               $(that).removeClass('btn-warning fenpei-account').addClass('btn-info account-info').html('<i class="icon-briefcase icon-white"><\/i>账号信息');		               $('#myModalLabelFenPei').text('账号分配成功！');		               $('#AlertModalFenPei .modal-body').html('<p>账号名称：'+obj.data.account_name+'<p/><p>账号密码：'+obj.data.password+'<p/>');		               $('#AlertModalFenPei').modal('show');		            }else{		               $('#myModalLabelFenPei').text('账号分配失败！');		               $('#AlertModalFenPei .modal-body').text(obj.errorText);		               $('#AlertModalFenPei').modal('show');		            }		        }		   	});	   })	   .on('click','.account-info',function() {		   var url = $('.account-info-url').val();		   var id = $(this).attr('_id');		   var _csrf = $('#_csrf').val();		   var that = this;		   $.ajax({		      	type: "POST",		        url: url,		        data:{store_id:id,_csrf:_csrf},		        success: function(obj) {		            var obj = eval('(' + obj + ')');		            if (parseInt(obj.errorCode) == 0) {		               $('#myModalLabelAccount').text('账号信息！');		               $('#AlertModalAccount .modal-body').html('<p>账号名称：'+obj.data.account_name+'<p/><p>创建时间：'+obj.data.create_time+'<p/>');		               $('#AlertModalAccount').modal('show');		            }else{		               $('#myModalLabelAccount').text('账号信息获取失败！');		               $('#AlertModalAccount .modal-body').text(obj.errorText);		               $('#AlertModalAccount').modal('show');		            }		        }		   	});	   })	})})(jQuery);