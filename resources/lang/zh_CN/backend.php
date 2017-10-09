<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 11:04
 */

return [

    'global'    =>  [

        'title' =>  config('app_name','TDBlog')
    ],

    'header'    =>  [

        'set'   => '设置',
        'logout'=>  '登出'
    ],

    'menu'  =>  [

        'online'    =>  '在线',
        'menu'      =>  '菜单'
    ],

    'index' =>  [

        'title' =>  '后台首页'
    ],

    'configs'   =>  [

        'title' =>  '配置',
        'description'   =>  '',
        'add'   =>  '新增',
        'edit'  =>  '更新',

        'key'   =>  '键',
        'value' =>  '值',
        'created_at'    =>  '创建时间',
        'updated_at'    =>  '更新时间',

    ],

    'files'     =>  [

        'title' =>  '文件',
        'description'   =>  '',

        'path'  =>  '路径',
        'name'  =>  '文件名',
        'size'  =>  '大小',
        'format'=>  '文件类型',
        'md5'   =>  'MD5值',
        'download_num'  =>  '下载量',
        'created_at'    =>  '创建时间',
        'updated_at'    =>  '更新时间',

    ],

    'emoticon_group'    =>  [

        'title' =>  '表情包组',
        'description'   =>  '',

        'name'  =>  '分组名',
        'owner_id'  =>  '拥有者ID',
        'created_at'    =>  '创建时间',
        'updated_at'    =>  '更新时间',

    ]
];