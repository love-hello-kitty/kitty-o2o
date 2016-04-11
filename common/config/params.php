<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'upload_url' => 'http://localhost/coffee/data/upload/',//上传目录对应的基准URL
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
];
