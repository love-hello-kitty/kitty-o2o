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

$this->params = ['breadcrumb'  => [['name' => '统计列表','url' => '#','current' => 1]]];
?>
<div class="row-fluid">
<div class="span12">
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-th"></i>
			</span>
			<h5>订单统计筛选</h5>
		</div>
		<div class="widget-content nopadding">
			<form action="<?php echo Url::to(['statistics/index']);?>" method="post">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>
							<span>付款方式：</span>
							<select name="pay_type">
								<?php $cur_pay_type = intval(Yii::$app->request->post('pay_type',0));?>
								<?php foreach (Yii::$app->params['pay_type'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_pay_type == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
						<td>
							<span>付款状态：</span>
							<select name="pay_status">
								<?php $cur_pay_status = intval(Yii::$app->request->post('pay_status',0));?>
								<option value="0">所有付款状态</option>
								<?php foreach (Yii::$app->params['order_pay_status'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_pay_status == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
						<td>
							<span>订单状态：</span>
							<select name="status">
								<?php $cur_status = intval(Yii::$app->request->post('status',0));?>
								<option value="0">所有订单状态</option>
								<?php foreach (Yii::$app->params['order_status'] AS $k => $v):?>
								<option value="<?=$k?>" <?php if ($cur_status == intval($k)) :?>selected<?php endif;?>><?=$v?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
							<input type="submit" class="btn btn-primary" value="筛选" />
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
			<h5>统计结果</h5>
		</div>
		<div class="widget-content nopadding">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td style="width:150px;">订单总数</td>
						<td><?=$order_count?></td>
					</tr>
					<tr>
						<td>已付款总额</td>
						<td>￥<?=$pay_count?></td>
					</tr>
					<tr>
						<td>已折扣总额</td>
						<td>￥<?=$discount_count?></td>
					</tr>
					<tr>
						<td>会员总数</td>
						<td><?=$member_count?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>