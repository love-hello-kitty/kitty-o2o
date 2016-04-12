<?php
use yii\helpers\Html;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this, '@web/js/jquery.form.js');
AppAsset::addScript($this, '@web/js/store-account/storeaccount.js');

if(!empty($model)) {
    $action = 'update';
    $op_text = '更新';
    foreach ($model AS $k => $v)
        ${$k} = $v;
}

$this->params = ['breadcrumb'  => [['name' => $op_text . '账号','url' => '#','current' => 1]]];

?>
<script>
$(document).ready(function(){
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
});
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
					<i class="icon-align-justify"></i>								
				</span>
				<h5><?= $op_text;?>账号</h5>
			</div>
			<div class="widget-content nopadding">
				<form action="<?= Url::to(['store-account/modify-password']) ?>" method="post" class="form-horizontal" id="store-account-form" />
					<div class="control-group">
						<label class="control-label">账户名称</label>
						<div class="controls">
							<input type="text" placeholder="这里输入账户名..." readonly value="<?=$account_name ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">原始密码</label>
						<div class="controls">
							<input type="text" placeholder="这里输入原始密码" name="old_password"  />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">新密码</label>
						<div class="controls">
							<input type="text" placeholder="这里输入新密码" name="new_password"  />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">确认密码</label>
						<div class="controls">
							<input type="text" placeholder="这里输入确认密码" name="comfirm_password"  />
						</div>
					</div>
					<div class="form-actions">
						<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<button type="button" class="btn btn-primary" id="save-button"><?= $op_text;?></button>
						<span style="margin-left:20px;color:red;display:none;" id="modify_result"></span>
					</div>
				</form>
			</div>
		</div>						
	</div>
</div>
<div class="modal fade" id="AlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">确认</h4>
      </div>
      <div class="modal-body">
        您确定要修改您的账户密码？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary confirm-modify-password" >确定</button>
      </div>
    </div>
  </div>
</div>
<div class="alert alert-success" id="AlertSuccess" style="display:none;">
	<button class="close" data-dismiss="alert">×</button>
	<strong>修改成功!</strong> 您已经成功修改账号！
</div>