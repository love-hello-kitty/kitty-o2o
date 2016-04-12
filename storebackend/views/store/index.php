<?php
use yii\helpers\Html;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.datetimepicker.js');
AppAsset::addCss($this,'@web/css/jquery.datetimepicker.css');

if(!empty($store_info)) {
    foreach ($store_info AS $k => $v)
        ${$k} = $v;
}

$this->params = ['breadcrumb'  => [['name' => '门店设置','url' => '#','current' => 1]]];           

?>
<script>
$(document).ready(function(){
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
	$('#open_time,#open_etime').datetimepicker({
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
				<h5><?= $op_text;?>商品</h5>
			</div>
			<div class="widget-content nopadding">
				<form action="<?= Url::to(['store/update']) ?>" method="post" class="form-horizontal" enctype="multipart/form-data" />
					<div class="control-group">
						<label class="control-label">店名</label>
						<div class="controls">
							<input type="text" readonly value="<?=$store_name ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">营业开始时间</label>
						<div class="controls">
							<input type="text" id="open_time" placeholder="营业开始时间" name="open_stime" value="<?= $open_stime ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">营业结束时间</label>
						<div class="controls">
							<input type="text" id="open_etime" placeholder="营业结束时间" name="open_etime" value="<?= $open_etime ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">门店面积</label>
						<div class="controls">
							<input type="text" placeholder="门店面积" name="store_area" value="<?= $store_area ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">门店服务</label>
						<div class="controls">
							<?php foreach (Yii::$app->params['store_service'] AS $key => $value):?>
							<?php 
							    $checked = '';
							    if (in_array($key, $store_service)) {
							        $checked = " checked ";
							    }
							?>
							<label><input type="checkbox" name="store_service[]" value="<?=$key?>" <?php echo $checked;?>/><?=$value?></label>
							<?php endforeach;?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">咖啡机</label>
						<div class="controls">
							<input type="text" placeholder="咖啡机" name="coffeemaker" value="<?= $coffeemaker ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">咖啡豆</label>
						<div class="controls">
							<input type="text" placeholder="咖啡豆" name="coffee_beans" value="<?= $coffee_beans ?>" />
						</div>
					</div>
					<div class="form-actions">
						<input type="hidden" name="id" value="<?= $id ?>" />
						<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<button type="submit" class="btn btn-primary">保存</button>
					</div>
				</form>
			</div>
		</div>						
	</div>
</div>