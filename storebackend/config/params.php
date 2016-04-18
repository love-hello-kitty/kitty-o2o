<?php
use yii\helpers\Url;
return [
    'admin_menus' => [
         ['name' => '首页','url'  => ['admin/index'],'mark' => 'admin','icon' => 'icon-home'],
         ['name' => '门店管理','url'  => '#','mark' => 'store','icon' => 'icon-tags','submenus' => [
               ['name' => '基本信息管理','url' => ['store/index'],'mark' => 'store']
         ]],
         ['name' => '商品管理','url'  => '#','mark' => 'goods','icon' => 'icon-gift','submenus' => [
               ['name' => '商品列表','url' => ['goods/index'],'mark' => 'goods'],
               ['name' => '商品分类','url' => ['goods-sort/index'],'mark' => 'goods-sort'],
         ]],
         ['name' => '订单管理','url'  => ['goods-order/index'],'mark' => 'goods-order','icon' => 'icon-shopping-cart'],
         ['name' => '会员管理','url'  => ['members/index'],'mark' => 'members','icon' => 'icon-user'],
         ['name' => '统计管理','url'  => ['statistics/index'],'mark' => 'statistics','icon' => 'icon-calendar'],
         ['name' => '账户设置','url'  => ['store-account/index'],'mark' => 'store-account','icon' => 'icon-cog'],
     ]
];
