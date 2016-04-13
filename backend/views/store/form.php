<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addCss($this,'@web/css/jquery.datetimepicker.css');
AppAsset::addCss($this,'http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.datetimepicker.js');
AppAsset::addScript($this,'http://api.map.baidu.com/api?v=2.0&ak=7QueCRjcCpxZEqhNdTHr9oD1A6G0rlD4',3);
AppAsset::addScript($this,'http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js',3);
AppAsset::addScript($this,'@web/js/store/storemap.js',3);

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

					<div class="control-group">
						<label class="control-label">商家简介</label>
						<div class="controls">
							<textarea name="brief"><?= $brief; ?></textarea>
						</div>
					</div>
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
</div>