(function($){	$(function(){		var _STORE = {			selectArea:function(url,type,pid,target) {				var _csrf = $('#_csrf').val();				var data = {_csrf:_csrf};				data[type] = pid;				$.ajax({			      	 type: "GET",			         url: url,			         data:data,			         success: function(json) {			        	var obj = JSON.parse(json);			            if (parseInt(obj.errorCode) == 0) {						    var output = ['<option value="0">----请选择----</option>'];						    var firstChildId = 0;						    $.each(obj.data, function(key, value) {							    output.push('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');						    });						    target.html(output.join(''));			            }else{			            	console.log('select data error');			            }			         }			   	});			}		};		//区域选择		$('.area-select')			.on('change','.province-sel',function(){				var provinceId = $(this).val();				_STORE.selectArea(_config.getCityUrl,'province_id',provinceId,$('.city-sel'));			})			.on('change','.city-sel',function(){				var cityId = $(this).val();				_STORE.selectArea(_config.geDistrictUrl,'city_id',cityId,$('.district-sel'));			})	})})(jQuery);