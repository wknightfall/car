<?php

/**
 * 系统配文件
 * 所有系统级别的配置
 */
return array(

    




    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common', 'User'),
    //'MODULE_ALLOW_LIST'  => array('Home','Admin'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'Ge41o:3>liWXx}<?.0=rRwJp{HzI|Q7(vFfuPcSU', //默认数据加密KEY

    /* 调试配置 */
    'SHOW_PAGE_TRACE' => true,

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 3, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'test', // 数据库名
    'DB_USER'   => 'root', // 用户名
    //'DB_PWD'    => '123456',  // 密码
    'DB_PWD'    => 'root3306',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'bhy_', // 数据库表前缀

    /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',

        '__HYCCSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/Hyc/css',
        '__HYCIMAGES__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/Hyc/images',
        '__HYCJS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/Hyc/js',
    ),
    'WEIXINPAY_CONFIG'       => array(
        'APPID'              => 'wx5e3800f385f36cfa', // 微信支付APPID
        'MCHID'              => '1510738971', // 微信支付MCHID 商户收款账号
        'KEY'                => '416fda2fd9a44f060a37dea77b189fc8', // 微信支付KEY
        'APPSECRET'          => '2b67ebf4033940bf8af68c14a43abbf7', // 公众帐号secert (公众号支付专用)
        'NOTIFY_URL'         => 'http://www.gzsxwljt.com/Home/Weixinpay/notify', // 接收支付状态的连接
    ),
);
