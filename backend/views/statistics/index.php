<?php
use backend\widgets\LinkPager;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');
AppAsset::addScript($this,'@web/js/jquery.dataTables.min.js');
AppAsset::addScript($this,'@web/js/unicorn.tables.js');
AppAsset::addScript($this,'@web/js/jquery.datetimepicker.js');
AppAsset::addCss($this,'@web/css/jquery.datetimepicker.css');

$this->params = ['breadcrumb'  => [['name' => '统计列表','url' => '#','current' => 1]]];
?>
<script>
$(document).ready(function(){
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('select').select2();
	$('.date-time-picker').datetimepicker({
		lang:"ch", //语言选择中文
	    format:"Y-m-d H:i:s" //格式化日期
	});
	//清除时间拾取器
	$('.clear-date').on('click',function(){
		$(this).prev('input').val('');
	})
});
</script>
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
			<form action="<?php echo Url::to(['statistics/index']);?>" method="get">
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
							<span>所属商家：</span>
							<select name="store_id">
								<?php $cur_store_id = intval(Yii::$app->request->get('store_id',0));?>
								<option value="0">---所有商家---</option>
								<?php if (!empty($store_info)):?>
								<?php foreach ($store_info AS $k => $v):?>
								<option value="<?=$v->id?>" <?php if ($cur_store_id == intval($v->id)) :?>selected<?php endif;?>><?=$v->store_name?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span>下单开始时间：</span>
							<input type="text" class="date-time-picker" placeholder="下单开始时间" name="stime" value="<?=Yii::$app->request->get('stime',''); ?>" style="margin-top:9px;" />
							<input type="button" class="btn btn-primary clear-date" value="清除" style="margin-left:10px;" />
						</td>
						<td colspan="2">
							<span>下单结束时间：</span>
							<input type="text" class="date-time-picker" placeholder="下单结束时间" name="etime" value="<?=Yii::$app->request->get('etime',''); ?>" style="margin-top:9px;" />
							<input type="button" class="btn btn-primary clear-date" value="清除" style="margin-left:10px;" />
						</td>
					</tr>
					<tr>
						<td colspan="4">
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
			<form action="<?php echo Url::to(['statistics/index']);?>" method="get">
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
						<td>用户总数</td>
						<td><?=$member_count?></td>
					</tr>
					<tr>
						<td>商家总数</td>
						<td><?=$store_count?></td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
</div>
</div>