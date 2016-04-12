<?php
use yii\helpers\Html;
use yii\helpers\Url;
use storebackend\assets\AppAsset;
AppAsset::addCss($this,'@web/css/select2.css');
AppAsset::addScript($this,'@web/js/jquery.uniform.js');
AppAsset::addScript($this,'@web/js/select2.min.js');
AppAsset::addScript($this,'@web/js/unicorn.js');

$this->params = ['breadcrumb'  => [
                                    ['name' => '订单列表','url' => Url::to(['goods-order/index']),'current' => 0],
                                    ['name' => '订单详情','url' => '#','current' => 1]
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
					<i class="icon-th-list"></i>
				</span>
				<h5>订单详情</h5>
				<!-- 
				<div class="buttons">
					<a title="Icon Title" class="btn btn-mini" href="#"><i class="icon-shopping-cart"></i> Pay Now</a>
					<a title="Icon Title" class="btn btn-mini" href="#"><i class="icon-print"></i> Print</a>
				</div>
				 -->
			</div>
			<div class="widget-content">
				<div class="invoice-content">
					<div class="invoice-head">
						<div class="invoice-meta">
							订单号：<span class="invoice-number"><?php echo $goods_order['order_number'];?> </span><span class="invoice-date">下单时间：<?php echo $goods_order['create_time'];?></span>
						</div>
						<div class="invoice-to">
							<ul>
								<li>
								<span>付款方式：<?php echo $goods_order['pay_type_text'];?></span>
								<span>付款状态：<?php echo $goods_order['pay_status_text'];?></span>
								<span>订单状态：<?php echo $goods_order['status_text'];?></span>
								<span>下单人：<?php if (!empty($goods_order['member_info'])) :?><?=$goods_order['member_info']['username'] ?><?php else: ?>匿名<?php endif;?></span>
								<span>下单人手机号：<?php if (!empty($goods_order['member_info'])) :?><?=$goods_order['member_info']['phone'] ?><?php else: ?>未知<?php endif;?></span>
								</li>
							</ul>
						</div>
					</div>
					<div>
						<table class="table table-bordered">
						<thead>
    						<tr>
    							<th>商品名称</th>
    							<th>商品型号</th>
    							<th>商品单价</th>
    							<th>购买数量</th>
    							<th>商品小计</th>
    						</tr>
						</thead>
						<tbody>
							<?php if (!empty($goods_order['goods_info']) && !empty($goods_order['goods_info']['Items'])) :?>
							<?php foreach ($goods_order['goods_info']['Items'] AS $k => $v):?>
    						<tr>
    							<td><?php echo $v['Name'];?></td>
    							<td><?php echo $v['SizeName'];?></td>
    							<td>￥<?php echo $v['Price'];?>/杯</td>
    							<td><?php echo $v['Count'];?>杯</td>
    							<td>￥<?php echo ($v['Price'] * $v['Count']);?></td>
    						</tr>
    						<?php endforeach;?>
    						<?php endif;?>
						</tbody>
						<tfoot>
						<tr>
							<th class="total-label" colspan="4">优惠：</th>
							<th class="total-amount" style="color:red;">减 ￥<?php echo $goods_order['goods_info']['Discount'];?></th>
						</tr>
						<tr>
							<th class="total-label" colspan="4">总计：</th>
							<th class="total-amount">￥<?php echo $goods_order['goods_info']['Total'];?></th>
						</tr>
						</tfoot>
						
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>