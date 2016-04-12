<?php
use storebackend\widgets\LinkPager;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.dataTables.min.js');
AppAsset::addScript($this,'@web/js/unicorn.tables.js');
AppAsset::addScript($this,'@web/js/common/common.js');
AppAsset::addScript($this,'@web/js/goods-order/goodsorder.js');

$this->params = ['breadcrumb'  => [['name' => '订单列表','url' => '#','current' => 1]]];
?>
<div class="row-fluid">
<div class="span12">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>输入消费码确认消费</h5>
		</div>
		<div class="widget-content nopadding">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>
							<input type="text" placeholder="这里输入消费码" style="float:left;" id="consume-code" />
							<input type="button" class="btn btn-primary" value="确认消费" style="float:left;margin-left:20px;" id="confirm-consume-btn" />
							<span style="float:left;color:red;margin-left:20px;line-height:29px;" id="consume-code-error"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>条件搜索</h5>
		</div>
		<div class="widget-content nopadding">
			<form action="<?php echo Url::to(['goods-order/index']);?>" method="get">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>
							<span>付款方式：</span>
							<select name="pay_type">
								<?php $cur_pay_type = intval(Yii::$app->request->get('pay_type',0));?>
								<?php foreach (Yii::$app->params['pay_type'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_pay_type == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
						<td>
							<span>付款状态：</span>
							<select name="pay_status">
								<?php $cur_pay_status = intval(Yii::$app->request->get('pay_status',0));?>
								<option value="0">所有付款状态</option>
								<?php foreach (Yii::$app->params['order_pay_status'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_pay_status == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<span>订单状态：</span>
							<select name="status">
								<?php $cur_status = intval(Yii::$app->request->get('status',0));?>
								<option value="0">所有订单状态</option>
								<?php foreach (Yii::$app->params['order_status'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_status == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
						<td>
							<span>订单号：</span>
							<input type="text" placeholder="这里输入订单号搜索" name="order_number"  value="<?php echo Yii::$app->request->get('order_number','');?>"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
							<input type="submit" class="btn btn-primary" value="搜索" />
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>订单列表</h5>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped with-check">
				<thead>
					<tr>
						<th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
						<th>订单号</th>
						<th>下单人</th>
						<th>下单人手机号</th>
						<th>付款方式</th>
						<th>付款状态</th>
						<th>订单状态</th>
						<th>优惠</th>
						<th>总价</th>
						<th>下单时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				   <?php if (!empty($models)):?>
				   <?php foreach ($models AS $k => $v): ?>
					<tr id="tr_<?= $v['id'] ?>">
						<td><input type="checkbox" /></td>
						<td><?= $v['order_number'] ?></td>
						<td><?php if (!empty($v['member_info'])) :?><?=$v['member_info']['username'] ?><?php else: ?>匿名<?php endif;?></td>
						<td><?php if (!empty($v['member_info'])) :?><?=$v['member_info']['phone'] ?><?php else: ?>未知<?php endif;?></td>
						<td><span class="label <?php if (intval($v['pay_type']) == 1): ?>label-success<?php else: ?>label-warning<?php endif;?>"><?= $v['pay_type_text'];?></span></td>
						<td><span class="label <?php if (intval($v['pay_status']) == 2): ?>label-success<?php else: ?><?php endif;?>"><?= $v['pay_status_text'];?></span></td>
						<td><span class="label <?php if (intval($v['status']) == 2): ?>label-success<?php else: ?><?php endif;?>"><?= $v['status_text'];?></span></td>						
						<td>￥<?= $v['discount'] ?></td>
						<td>￥<?= $v['total_price'] ?></td>
						<td><?= $v['create_time'] ?></td>
						<td>
						   <a href="<?= Url::to(['goods-order/form','id' => $v['id']]);?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i>订单详情</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
					   <td colspan="11">
   					   <div class="alert alert-info" style="margin-top:22px;">
   							<button class="close" data-dismiss="alert">×</button>
   							<strong>友情提醒！</strong> 目前还没有会员下单！
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
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="AlertConsumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalConsumeLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalConsumeLabel">消费码确认消费</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="confirm-consume-url" value="<?= Url::to(['goods-order/confirm-consume']);?>" />
<input type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>" />