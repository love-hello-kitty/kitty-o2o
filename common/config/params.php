<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'upload_url' => 'http://localhost/kitty-o2o/data/upload/',//上传目录对应的基准URL
    'upload_path' => 'kitty/data/upload/',//图片上传之后保存目录(这个是以web根目录的为基准的)
    'lbsyun' => [
        'web_map_api' => 'http://api.map.baidu.com/api?v=2.0&ak=7QueCRjcCpxZEqhNdTHr9oD1A6G0rlD4',//web端的地图API
    ],    
    //订单状态
    'order_status' => [
        '1' => '待消费',
        '2' => '已消费',
        '3' => '已取消'
    ],
    'order_pay_status' => [
        '1' => '待付款',
        '2' => '已付款'
    ],
    //支付方式
    'pay_type' => [
            '0' => '所有方式',
            '1' => '到店支付',
            '2' => '在线支付'
     ],
     //用户状态
     'member_status' => [
            '0' => '全部状态',
            '1' => '正常',
            '2' => '被封禁'
     ],
     //商家状态
    'store_status' => [
            '0' => '全部状态',
            '1' => '待审核',
            '2' => '已审核',
            '3' => '被打回'
     ],
     //商品状态
     'goods_status' => [
            '0' => '全部状态',
            '1' => '待上架',
            '2' => '已上架',
            '3' => '已下架'
     ],
];
