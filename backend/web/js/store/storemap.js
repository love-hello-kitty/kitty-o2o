(function ($) {	$(function(){		var map = new BMap.Map("map"); // 创建地图实例		if (_config.action == 'create') {		   map.centerAndZoom("南京", 11); // 初始化地图，设置中心点坐标和地图级别(改为以城市为中心)		} else if (_config.action == 'update') {		   var point = new BMap.Point(_config.longitude,_config.latitude); // 创建点坐标		   map.centerAndZoom(point, 15); // 初始化地图，设置中心点坐标和地图级别		   var marker = new BMap.Marker(point);// 创建标注		   map.addOverlay(marker);// 将标注添加到地图中		}		map.enableScrollWheelZoom();//缩放		map.addControl(new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_RIGHT})); //添加默认缩放平移控件		var geoc = new BMap.Geocoder();		map.addEventListener("click",function(e) {		   //先删除覆盖物		   map.clearOverlays();		   var point = new BMap.Point(e.point.lng, e.point.lat);		   var marker = new BMap.Marker(point);// 创建标注		   map.addOverlay(marker);//将标注添加到地图中		   geoc.getLocation(e.point, function(rs){				var addComp = rs.addressComponents;				var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;				$('input[name="address"]').val(address);			});		   //将值改变		   $('#longitude').val(e.point.lng);		   $('#latitude').val(e.point.lat);		});	})})(jQuery);