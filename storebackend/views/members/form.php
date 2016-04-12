<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');

if(!empty($model)) {
    foreach ($model AS $k => $v) {
        ${$k} = $v;
    }
}
$this->params = ['breadcrumb'  => [
                                    ['name' => '用户管理','url' => Url::to(['members/index']),'current' => 0],
                                    ['name' => '用户详情','url' => '#','current' => 1]
                                  ],
                ];
?>
<script>
$(document).ready(function() {
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
	//返回
	$('.go-back').on('click',function() {
		var url = "<?php echo Url::to(['members/index']);?>";
		window.location.href = url;
	})
});
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
					<i class="icon-align-justify"></i>								
				</span>
				<h5>用户详情</h5>
			</div>
			<div class="widget-content nopadding">
				<form action="###" method="post" class="form-horizontal" />
					<div class="control-group">
						<label class="control-label">用户名称</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $username; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">性别</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $sex_text; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">邮箱</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $email; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">手机号</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $phone; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">账户金额</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $balance; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">积分</label>
						<div class="controls">
							<input type="text" readonly  value="<?= $points; ?>" />
						</div>
					</div>
					<div class="form-actions">
						<button type="button" class="btn btn-primary go-back">返回</button>
					</div>
				</form>
			</div>
		</div>						
	</div>
</div>