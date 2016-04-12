<?php
use storebackend\widgets\LinkPager;
use storebackend\widgets\Delete;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.dataTables.min.js');
AppAsset::addScript($this,'@web/js/unicorn.tables.js');
AppAsset::addScript($this,'@web/js/common/common.js');

$this->params = ['breadcrumb'  => [['name' => '商品列表','url' => '#','current' => 1]]];
?>
<div class="row-fluid">
<div class="span12">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>商品列表</h5>
			<a class="btn btn-info label" href="<?= Url::to(['goods/form']);?>">创建</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped with-check">
				<thead>
					<tr>
						<th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
						<th>商品名称</th>
						<th>所属分类</th>
						<th>状态</th>
						<th>创建时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				   <?php if (!empty($models)):?>
				   <?php foreach ($models AS $k => $v): ?>
					<tr id="tr_<?= $v['id'] ?>">
						<td><input type="checkbox" /></td>
						<td><?= $v['goods_name'] ?></td>
						<td><?= $v['sort_name'] ?></td>
						<td class="status-show" _id="<?php echo $v['id'];?>" style="cursor:pointer;"><span class="label <?php if (intval($v['status']) == 2): ?>label-success<?php else: ?><?php endif;?>"><?= $v['status_text'];?></span></td>
						<td><?= $v['create_time'] ?></td>
						<td>
						   <a href="<?= Url::to(['goods/form','id' => $v['id']]);?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>编辑商品</a>
						   <a href="javascript:void(0);" _id=<?= $v['id'] ?> class="btn btn-danger remove-row"><i class="icon-remove icon-white"></i>删除</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
					   <td colspan="6">
   					   <div class="alert alert-info" style="margin-top:22px;">
   							<button class="close" data-dismiss="alert">×</button>
   							<strong>友情提醒！</strong> 该商家目前还没有商品
   						</div>
					   </td>
			      </tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">
			      <!--
   			   <div class="dataTables_filter" style="margin-top:-4px;margin-left: 14px;">
      			   <label>搜索: <input type="text"></label>
      			</div>
      			-->
      			<div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers">
         			<div class="pagination alternate">
						<?php echo LinkPager::widget(['pagination' => $pages]);?>
						</div>
      			</div>
			</div>
			<input type="hidden" class="delete-action" value="<?= Url::to(['goods/delete']);?>" />
			<input type="hidden" class="audit-action" value="<?= Url::to(['goods/audit']);?>" />
			<input type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
		</div>
	</div>
</div>
</div>
<?php echo Delete::widget();?>