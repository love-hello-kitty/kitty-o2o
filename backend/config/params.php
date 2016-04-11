<?php
return [
    'admin_session_name' => '__KITTY_O2O_ADMIN',
    //商家状态
    'store_status' => [
            '0' => '全部状态',
            '1' => '待审核',
            '2' => '已审核',
            '3' => '被打回'
     ],
     'member_status' => [
            '0' => '全部状态',
            '1' => '正常',
            '2' => '被封禁'
     ],
     //后台菜单
    'admin_menus' => [
         ['name' => '首页','url'  => ['admin/index'],'mark' => 'admin','icon' => 'icon-home'],
         ['name' => '商家管理','url' => ['store/index'],'mark' => 'store','icon' => 'icon-tags'],
         ['name' => '用户管理','url' => ['members/index'],'mark' => 'members','icon' => 'icon-user'],
         ['name' => '数据统计管理','url' => ['statistics/index'],'mark' => 'statistics','icon' => 'icon-calendar'],
     ],
];
