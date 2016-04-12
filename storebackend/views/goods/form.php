<?php
use yii\helpers\Html;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');

if(!empty($model)) {
    $action = 'update';
    $op_text = '更新';
    foreach ($model AS $k => $v)
        ${$k} = $v;
}else{
    $action = 'create';
    $op_text = '创建';
}
$this->params = ['breadcrumb'  => [
                                    ['name' => '商品列表','url' => Url::to(['goods/index']),'current' => 0],
                                    ['name' => $op_text . '商品','url' => '#','current' => 1]
                                  ],
                ];

$goods_size = Yii::$app->params['goods_size'];
unset($goods_size[0]);             

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
				<h5><?= $op_text;?>商品</h5>
			</div>
			<div class="widget-content nopadding">
				<form action="<?= Url::to(['goods/' . $action]) ?>" method="post" class="form-horizontal" enctype="multipart/form-data" />
					<div class="control-group">
						<label class="control-label">商品名称</label>
						<div class="controls">
							<input type="text" placeholder="这里输入商品名称..." name="goods_name" value="<?= $goods_name ?>" />
						</div>
					</div>
					<div class="control-group" id="material-type">
						<label class="control-label">选择分类</label>
						<div class="controls">
							<select name="sort_id" id="material_type_selector">
							   <option value="notype" /> --选择商品分类--
							   <?php foreach ($goods_sort AS $v): ?>
							    <?php 
							        $selected = '';
							        if ($v['id'] == $sort_id) {
							            $selected = "selected";
							        } 
							    ?>
								<option value="<?= $v['id'] ?>"  <?php echo $selected;?> /><?= $v['name'] ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!-- 
					<div class="control-group">
						<label class="control-label">商品图片</label>
						<div class="controls">
							<img src="<?php echo $pic_url;?>" width="160px;" height="120px;" />
						</div>
						<div class="controls">
							<input type="file" name="goods_pic" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">商品简介</label>
						<div class="controls">
							<textarea style="height:100px;" name="brief"><?php echo $brief;?></textarea>
						</div>
					</div>
					 -->
					<?php foreach ($goods_size AS $key => $value):?>
					<div class="control-group">
						<label class="control-label"><?php echo $value;?>价格</label>
						<div class="controls">
							<?php 
							    $_price = 0;
							    if (!empty($goods_price) && !empty($goods_price[$key])) {
							        $_price = $goods_price[$key];
							    }
							?>
							<input type="text" placeholder="" name="goods_price[<?= $key;?>]" value="<?php echo $_price;?>" style="width:100px;"/> 元
						</div>
					</div>
					<?php endforeach;?>
					<div class="form-actions">
						<input type="hidden" name="id" value="<?= $id ?>" />
						<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<button type="submit" class="btn btn-primary"><?= $op_text;?></button>
					</div>
				</form>
			</div>
		</div>						
	</div>
</div>