<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.datetimepicker.js');
AppAsset::addCss($this,'@web/css/jquery.datetimepicker.css');


if(!empty($model)) {
	$action = 'update';
	$op_text = '更新';
    foreach ($model AS $k => $v) {
        ${$k} = $v;
    }
} else {
	$action = 'create';
	$op_text = '创建';
}
$this->params = ['breadcrumb'  => [
                                    ['name' => '商家管理','url' => Url::to(['store/index']),'current' => 0],
                                    ['name' => $op_text . '商家','url' => '#','current' => 1]
                                  ],
                ];
$longitude = !empty($longitude) ? $longitude : 0;
$latitude = !empty($latitude) ? $latitude : 0;
?>
<script>
$(document).ready(function(){
// 	$('input[type=radio],input[type=file]').uniform();
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
// 	$('select').select2();
	//返回
	$('.go-back').on('click',function() {
		var url = "<?php echo Url::to(['store/index']);?>";
		window.location.href = url;
	})
	//省市区变化
	$('#province_select').change(function(){
		var province_id = $('#province_select').val();
		$.ajax({
			type: "POST",
			   url: '<?php echo Url::to(['store/getcitys']);?>',
			   data: {province_id:province_id},
			   success: function(msg) {
				   var obj = eval('('+msg+')');	
				   if (obj.errorCode == 0 ) {
					   $("#city_select").empty();
					   var output = [];
					   var city_id;
					   $.each(obj.data, function(key, value) {
						   if(key == 0) { 
							   city_id = value['id'];
							   output.push('<option selected=selected value="'+ value['id'] +'">'+ value['name'] +'</option>');
						   } else {
							   output.push('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');
						   }
					   });
					   $('#city_select').html(output.join(''));
					   city_change(city_id);
				   }
			   }
		});
	})
	
	var city_change = function (id) {
		var city_id = id;
		$.ajax({
			type: "POST",
			   url: '<?php echo Url::to(['store/getdistricts']);?>',
			   data: {city_id:city_id},
			   success: function(msg) {
				   var obj = eval('('+msg+')');	
				   if (obj.errorCode == 0 ) {
					   $("#district_select").empty();
					   var output = [];
					   $.each(obj.data, function(key, value) {
						   if(key == 0) { 
							   output.push('<option selected=selected value="'+ value['id'] +'">'+ value['name'] +'</option>');
						   } else {
							   output.push('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');
						   }
					   });
					   $('#district_select').html(output.join(''));
				   }
			   }
		});
	}
	$('#city_select').change(function(){
		var city_id = $('#city_select').val();
		city_change(city_id);
	})
	$('#datetimepicker1,#datetimepicker2').datetimepicker({
		datepicker:false,
		format:'H:i:00',
		step:30
	});
});
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
					<i class="icon-align-justify"></i>								
				</span>
				<h5>商家详情</h5>
			</div>
			<div class="widget-content nopadding">
				<form action="<?= Url::to(['store/' . $action]) ?>" method="post" class="form-horizontal" enctype="multipart/form-data"/>
					<div class="control-group">
						<label class="control-label">商家名称</label>
						<div class="controls">
							<input type="text" id='store_area'  name="store_name" value="<?= $store_name; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">门店LOGO</label>
						<div class="controls">
							<img src="<?php echo $logo_pic_url;?>" width="160px;" height="120px;" />
						</div>
						<div class="controls">
							<input type="file" name="logo_pic" />
						</div>
					</div>
					<!-- 
					<div class="control-group">
						<label class="control-label">商家简介</label>
						<div class="controls">
							<textarea name="brief"><?= $brief; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">门店面积</label>
						<div class="controls">
							<input type="text" name="store_area"  value="<?= $store_area; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">营业时间</label>
						<div class="controls">
							<input id = 'datetimepicker1' style='width:15%' type="text" name='open_stime' value="<?= $open_stime; ?>" />~
							<input id = 'datetimepicker2' style='width:15%' type="text" name="open_etime"  value="<?= $open_etime; ?>" />
						</div>
					</div>
					 -->
					<div class="control-group">
						<label class="control-label">所属地区</label>
						<div class="controls" style= 'line-height:30px'>
							省：	<select name='province_id' style='width:15%' id='province_select'>
									<?php if (!empty($area['provinces'])):?>
									<?php foreach ($area['provinces'] as $k => $v):?>
										<option value='<?=$v['id'];?>' <?php if ($province_id == $v->id):?>selected = "selected"><?= $province_name; ?><?php else: ?>><?=$v->name ?><?php endif; ?></option>
									<?php endforeach;?>
									<?php endif;?>
								</select>
							市：<select name='city_id' style='width:15%' id='city_select'>
									<?php if (!empty($area['citys'])):?>
									<?php foreach ($area['citys'] as $k => $v):?>
										<option value='<?=$v['id'];?>' <?php if ($city_id == $v->id):?>selected = "selected"><?= $city_name; ?><?php else: ?>><?=$v->name ?><?php endif; ?></option>
									<?php endforeach;?>
									<?php endif;?>
								</select>
							区：<select name='district_id' style='width:15%' id='district_select'>
									<?php if (!empty($area['districts'])):?>
									<?php foreach ($area['districts'] as $k => $v):?>
										<option value='<?=$v['id'];?>' <?php if ($district_id == $v->id):?>selected = "selected"><?= $district_name; ?><?php else: ?>><?=$v->name ?><?php endif; ?></option>
									<?php endforeach;?>
									<?php endif;?>
								</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">详细地址</label>
						<div class="controls">
							<input type="text" name='address'  value="<?= $address; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">联系人</label>
						<div class="controls">
							<input type="text" name='linkman'  value="<?= $linkman; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">手机号</label>
						<div class="controls">
							<input type="text" name='phone'  value="<?= $phone; ?>" />
						</div>
					</div>
					<!-- 
					<div class="control-group" style='display:none'>
						<label class="control-label">门脸图</label>
						<div class="controls">
							<img src="<?php echo $front_pic_url;?>" width="160px;" height="120px;" />
						</div>
						<div class="controls">
							<input type="file" name="front_pic" />
						</div>
					</div>
					<div class="control-group" style='display:none'>
						<label class="control-label">店内环境图</label>
						<div class="controls">
							<img src="<?php echo $store_env_pic_url;?>" width="160px;" height="120px;" />
						</div>
						<div class="controls">
							<input type="file" name="store_env_pic" />
						</div>
					</div>
					-->
					<div class="control-group">
						<label class="control-label">坐标（经度）</label>
						<div class="controls">
							<input id='longitude' type="text" name='longitude' readonly  value="<?= $longitude; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">坐标（纬度）</label>
						<div class="controls">
							<input id='latitude' type="text" name='latitude' readonly  value="<?= $latitude; ?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">地图</label>
						<div class="controls">
							<div id='map' style='width:80%;height:500px;'></div>
						</div>
					</div>
					<div class="form-actions">
						<input type="hidden" name="id" value="<?= $id ?>" />
						<input type="hidden" name="poi_id" value="<?= $poi_id ?>" />
						<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<button type="submit" class="btn btn-primary"><?= $op_text;?></button>
					</div>
				</form>
			</div>
		</div>						
	</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?=Yii::$app->params['lbsApi']['ak']?>"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
<script type="text/javascript">
var map = new BMap.Map("map"); // 创建地图实例
var form_type = '<?=$action;?>';
if (form_type == 'create') {
   map.centerAndZoom("无锡", 11); // 初始化地图，设置中心点坐标和地图级别(改为以城市为中心)
} else if (form_type == 'update') {
   var point = new BMap.Point(<?=$longitude?>,<?=$latitude?>); // 创建点坐标
   map.centerAndZoom(point, 15); // 初始化地图，设置中心点坐标和地图级别
   var marker = new BMap.Marker(point);        // 创建标注
   map.addOverlay(marker);                     // 将标注添加到地图中
}
map.enableScrollWheelZoom();//缩放
map.addControl(new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_RIGHT})); //添加默认缩放平移控件

map.addEventListener("click",function(e){
   //先删除覆盖物
   map.clearOverlays();
   var point = new BMap.Point(e.point.lng, e.point.lat);  
   var marker = new BMap.Marker(point);        // 创建标注
//    var opts = {    
// 		   width : 250,     // 信息窗口宽度    
// 		   height: 100,     // 信息窗口高度    
// 		   title : "Hello"  // 信息窗口标题   
// 		  }    
//    var infoWindow = new BMap.InfoWindow("World", opts);  // 创建信息窗口对象    
//    map.openInfoWindow(infoWindow, map.getCenter());      // 打开信息窗口
   map.addOverlay(marker);                     // 将标注添加到地图中
   //将值改变
   $('#longitude').val(e.point.lng);
   $('#latitude').val(e.point.lat);
});
</script>
	
</div>