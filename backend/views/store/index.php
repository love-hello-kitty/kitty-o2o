<?php
use backend\widgets\LinkPager;
use backend\widgets\Delete;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.dataTables.min.js');
AppAsset::addScript($this,'@web/js/unicorn.tables.js');
AppAsset::addScript($this,'@web/js/common/common.js');
AppAsset::addScript($this,'@web/js/store/store.js');

$this->params = ['breadcrumb'  => [['name' => '商家管理','url' => '#','current' => 1]]];
?>
<div class="row-fluid">
<div class="span12">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>商家列表</h5>
			<a class="btn btn-info label" href="<?= Url::to(['store/form']);?>">创建</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped with-check">
				<thead>
					<tr>
						<th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
						<th>商家名称</th>
						<th>所属省份</th>
						<th>所属城市</th>
						<th>所属区县</th>
						<th>地址</th>
						<th>联系人</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				   <?php if (!empty($models)):?>
				   <?php foreach ($models AS $k => $v): ?>
					<tr id="tr_<?= $v['id'] ?>">
						<td><input type="checkbox" /></td>
						<td><?= $v['name'] ?></td>
						<td><?= $v['province_name'] ?></td>
						<td><?= $v['city_name'] ?></td>
						<td><?= $v['district_name'] ?></td>
						<td><?= $v['address'] ?></td>
						<td><?= $v['linkman'] ?></td>
						<td class="status-show" _id="<?php echo $v['id'];?>" style="cursor:pointer;"><span class="label <?php if (intval($v['status']) == 2): ?>label-success<?php else: ?><?php endif;?>"><?= $v['status_text'];?></span></td>
						<td>
						   <a href="<?= Url::to(['store/form','id' => $v['id']]);?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>商家编辑</a>
						   <a href="javascript:void(0);" _id=<?= $v['id'] ?> class="btn btn-danger remove-row"><i class="icon-remove icon-white"></i>删除</a>
						   <!-- 
						   <a href="<?= Url::to(['admin-store/index','store_id' => $v['id']]);?>" class="btn btn-success"><i class="icon-briefcase icon-white"></i>管理商家</a>
						   -->
						   <?php if (!empty($v['has_account'])) :?>
						   <a href="javascript:void(0);" _id=<?= $v['id'] ?> class="btn btn-info account-info"><i class="icon-briefcase icon-white"></i>账号信息</a>
						   <?php else:?>
						   <a href="javascript:void(0);" _id=<?= $v['id'] ?> class="btn btn-warning fenpei-account"><i class="icon-briefcase icon-white"></i>分配账号</a>
						   <?php endif;?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
					   <td colspan="9">
   					   <div class="alert alert-info" style="margin-top:22px;">
   							<button class="close" data-dismiss="alert">×</button>
   							<strong>友情提醒！</strong> 目前还没有商家入驻
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
			<input type="hidden" class="delete-action" value="<?= Url::to(['store/delete']);?>" />
			<input type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
			<input type="hidden" class="audit-action" value="<?= Url::to(['store/audit']);?>" />
			<input type="hidden" class="fenpei-account-url" value="<?= Url::to(['store/allocate']);?>" />
			<input type="hidden" class="account-info-url" value="<?= Url::to(['store/get-account-info']);?>" />
		</div>
	</div>
</div>
</div>
<?php echo Delete::widget();?>
<!-- Modal -->
<div class="modal fade" id="AlertModalFenPei" tabindex="-1" role="dialog" aria-labelledby="myModalLabelFenPei">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelFenPei">账号分配成功</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="AlertModalAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAccount">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelAccount">账号信息</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>