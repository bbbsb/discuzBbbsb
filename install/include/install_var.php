<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install_var.php 33326 2013-05-28 08:52:45Z kamichen $
 */

if(!defined('IN_COMSENZ')) {
	exit('Access Denied');
}

define('SOFT_NAME', 'Discuz!');

define('INSTALL_LANG', 'SC_UTF8');

define('CONFIG', './config/config_global.php');
define('CONFIG_UC', './config/config_ucenter.php');

$sqlfile = ROOT_PATH.((file_exists(ROOT_PATH.'./install/data/install_dev.sql')) ? './install/data/install_dev.sql' : './install/data/install.sql');
$lockfile = ROOT_PATH.'./data/install.lock';

@include ROOT_PATH.CONFIG;

define('CHARSET', 'utf-8');
define('DBCHARSET', 'utf8');

define('ORIG_TABLEPRE', 'pre_');

define('METHOD_UNDEFINED', 255);
define('ENV_CHECK_RIGHT', 0);
define('ERROR_CONFIG_VARS', 1);
define('SHORT_OPEN_TAG_INVALID', 2);
define('INSTALL_LOCKED', 3);
define('DATABASE_NONEXISTENCE', 4);
define('PHP_VERSION_TOO_LOW', 5);
define('MYSQL_VERSION_TOO_LOW', 6);
define('UC_URL_INVALID', 7);
define('UC_DNS_ERROR', 8);
define('UC_URL_UNREACHABLE', 9);
define('UC_VERSION_INCORRECT', 10);
define('UC_DBCHARSET_INCORRECT', 11);
define('UC_API_ADD_APP_ERROR', 12);
define('UC_ADMIN_INVALID', 13);
define('UC_DATA_INVALID', 14);
define('DBNAME_INVALID', 15);
define('DATABASE_ERRNO_2003', 16);
define('DATABASE_ERRNO_1044', 17);
define('DATABASE_ERRNO_1045', 18);
define('DATABASE_CONNECT_ERROR', 19);
define('TABLEPRE_INVALID', 20);
define('CONFIG_UNWRITEABLE', 21);
define('ADMIN_USERNAME_INVALID', 22);
define('ADMIN_EMAIL_INVALID', 25);
define('ADMIN_EXIST_PASSWORD_ERROR', 26);
define('ADMININFO_INVALID', 27);
define('LOCKFILE_NO_EXISTS', 28);
define('TABLEPRE_EXISTS', 29);
define('ERROR_UNKNOW_TYPE', 30);
define('ENV_CHECK_ERROR', 31);
define('UNDEFINE_FUNC', 32);
define('MISSING_PARAMETER', 33);
define('LOCK_FILE_NOT_TOUCH', 34);

$func_items = [
	function_exists('mysqli_connect') ? 'mysqli_connect' : 'mysql_connect',
	'gethostbyname',
	'file_get_contents',
	'xml_parser_create'
];

$filesock_items = [
	'fsockopen',
	'pfsockopen',
	'stream_socket_client',
	'curl_init'
];

$env_items = [
	'os' => ['c' => 'PHP_OS', 'r' => 'notset', 'b' => 'unix'],
	'php' => ['c' => 'PHP_VERSION', 'r' => '5.1', 'b' => '5.3'],
	'attachmentupload' => ['r' => 'notset', 'b' => '2M'],
	'gdversion' => ['r' => '1.0', 'b' => '2.0'],
	'diskspace' => ['r' => '10M', 'b' => 'notset'],
];

$dirfile_items = [
	'config' => ['type' => 'file', 'path' => CONFIG],
	'ucenter config' => ['type' => 'file', 'path' => CONFIG_UC],
	'config_dir' => ['type' => 'dir', 'path' => './config'],
	'data' => ['type' => 'dir', 'path' => './data'],
	'cache' => ['type' => 'dir', 'path' => './data/cache'],
	'avatar' => ['type' => 'dir', 'path' => './data/avatar'],
	'plugindata' => ['type' => 'dir', 'path' => './data/plugindata'],
	'plugindownload' => ['type' => 'dir', 'path' => './data/download'],
	'addonmd5' => ['type' => 'dir', 'path' => './data/addonmd5'],
	'ftemplates' => ['type' => 'dir', 'path' => './data/template'],
	'threadcache' => ['type' => 'dir', 'path' => './data/threadcache'],
	'attach' => ['type' => 'dir', 'path' => './data/attachment'],
	'attach_album' => ['type' => 'dir', 'path' => './data/attachment/album'],
	'attach_forum' => ['type' => 'dir', 'path' => './data/attachment/forum'],
	'attach_group' => ['type' => 'dir', 'path' => './data/attachment/group'],

	'logs' => ['type' => 'dir', 'path' => './data/log'],
	'uccache' => ['type' => 'dir', 'path' => './uc_client/data/cache'],

	'uc_server_data' => ['type' => 'dir', 'path' => './uc_server/data/'],
	'uc_server_data_cache' => ['type' => 'dir', 'path' => './uc_server/data/cache'],
	'uc_server_data_avatar' => ['type' => 'dir', 'path' => './uc_server/data/avatar'],
	'uc_server_data_backup' => ['type' => 'dir', 'path' => './uc_server/data/backup'],
	'uc_server_data_logs' => ['type' => 'dir', 'path' => './uc_server/data/logs'],
	'uc_server_data_tmp' => ['type' => 'dir', 'path' => './uc_server/data/tmp'],
	'uc_server_data_view' => ['type' => 'dir', 'path' => './uc_server/data/view'],
];


$form_app_reg_items = [
	'ucenter' => [
		'ucurl' => ['type' => 'text', 'required' => 1, 'reg' => '/^https?:\/\//', 'value' => ['type' => 'var', 'var' => 'ucapi']],
		'ucip' => ['type' => 'text', 'required' => 0, 'reg' => '/^\d+\.\d+\.\d+\.\d+$/'],
		'ucpw' => ['type' => 'password', 'required' => 1, 'reg' => '/^.*$/']
	],
	'siteinfo' => [
		'sitename' => ['type' => 'text', 'required' => 1, 'reg' => '/^.*$/', 'value' => ['type' => 'constant', 'var' => 'SOFT_NAME']],
		'siteurl' => ['type' => 'text', 'required' => 1, 'reg' => '/^https?:\/\//', 'value' => ['type' => 'var', 'var' => 'default_appurl']]
	]
];

$form_db_init_items = [
	'dbinfo' => [
		'dbhost' => ['type' => 'text', 'required' => 1, 'reg' => '/^.+$/', 'value' => ['type' => 'var', 'var' => 'dbhost']],
		'dbname' => ['type' => 'text', 'required' => 1, 'reg' => '/^.+$/', 'value' => ['type' => 'var', 'var' => 'dbname']],
		'dbuser' => ['type' => 'text', 'required' => 0, 'reg' => '/^.*$/', 'value' => ['type' => 'var', 'var' => 'dbuser']],
		'dbpw' => ['type' => 'text', 'required' => 0, 'reg' => '/^.*$/', 'value' => ['type' => 'var', 'var' => 'dbpw']],
		'tablepre' => ['type' => 'text', 'required' => 0, 'reg' => '/^.*+/', 'value' => ['type' => 'var', 'var' => 'tablepre']],
		'adminemail' => ['type' => 'text', 'required' => 1, 'reg' => '/@/', 'value' => ['type' => 'var', 'var' => 'adminemail']],
	],
	'admininfo' => [
		'username' => ['type' => 'text', 'required' => 1, 'reg' => '/^.*$/', 'value' => ['type' => 'constant', 'var' => 'admin']],
		'password' => ['type' => 'password', 'required' => 1, 'reg' => '/^.*$/'],
		'password2' => ['type' => 'password', 'required' => 1, 'reg' => '/^.*$/'],
		'email' => ['type' => 'text', 'required' => 1, 'reg' => '/@/', 'value' => ['type' => 'var', 'var' => 'adminemail']],
	]
];

$serialize_sql_setting = [
  'extcredits' =>[
    1 => [
      'img' => '',
      'title' => '威望',
      'unit' => '',
      'ratio' => 0,
      'available' => '1',
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    2 => [
      'img' => '',
      'title' => '金钱',
      'unit' => '',
      'ratio' => 0,
      'available' => '1',
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    3 => [
      'img' => '',
      'title' => '贡献',
      'unit' => '',
      'ratio' => 0,
      'available' => '1',
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    4 => [
      'img' => '',
      'title' => '',
      'unit' => '',
      'ratio' => 0,
      'available' => NULL,
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    5 => [
      'img' => '',
      'title' => '',
      'unit' => '',
      'ratio' => 0,
      'available' => NULL,
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    6 => [
      'img' => '',
      'title' => '',
      'unit' => '',
      'ratio' => 0,
      'available' => NULL,
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    7 => [
      'img' => '',
      'title' => '',
      'unit' => '',
      'ratio' => 0,
      'available' => NULL,
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
    8 => [
      'img' => '',
      'title' => '',
      'unit' => '',
      'ratio' => 0,
      'available' => NULL,
      'showinthread' => NULL,
      'allowexchangein' => NULL,
      'allowexchangeout' => NULL,
    ],
  ],
  'postnocustom' => [
    0 => '楼主',
    1 => '沙发',
    2 => '板凳',
    3 => '地板',
  ],
  'recommendthread' => [
    'status' => '0',
    'addtext' => '支持',
    'subtracttext' => '反对',
    'defaultshow' => '1',
    'daycount' => '0',
    'ownthread' => '0',
    'iconlevels' => '50,100,200',
  ],
  'seotitle' => [
    'portal' => '门户',
    'forum' => '论坛',
    'group' => '群组',
    'home' => '家园',
    'userapp' => '应用',
  ],
  'activityfield' => [
    'realname' => '真实姓名',
    'mobile' => '手机',
    'qq' => 'QQ号',
  ],
  'article_tags' => [
    1 => '原创',
    2 => '热点',
    3 => '组图',
    4 => '爆料',
    5 => '头条',
    6 => '幻灯',
    7 => '滚动',
    8 => '推荐',
  ],
  'verify' => [
    6 => [
      'title' => '实名认证',
      'available' => '0',
      'showicon' => '0',
      'viewrealname' => '0',
      'field' => [
        'realname' => 'realname',
      ],
      'icon' => false,
    ],
    'enabled' => false,
    1 => [
      'icon' => '',
    ],
    2 => [
      'icon' => '',
    ],
    3 => [
      'icon' => '',
    ],
    4 => [
      'icon' => '',
    ],
    5 => [
      'icon' => '',
    ],
    7 => [
      'title' => '视频认证',
      'available' => '0',
      'showicon' => '0',
      'viewvideophoto' => '0',
      'icon' => '',
    ],
  ],
  'focus' => [
    'title' => '站长推荐',
    'data' => [],
    'cookie' => '1',
  ],
  'profilegroup' => [
    'base' => [
      'available' => 1,
      'displayorder' => 0,
      'title' => '基本资料',
      'field' => [
        'realname' => 'realname',
        'gender' => 'gender',
        'birthday' => 'birthday',
        'birthcity' => 'birthcity',
        'residecity' => 'residecity',
        'residedist' => 'residedist',
        'affectivestatus' => 'affectivestatus',
        'lookingfor' => 'lookingfor',
        'bloodtype' => 'bloodtype',
        'field1' => 'field1',
        'field2' => 'field2',
        'field3' => 'field3',
        'field4' => 'field4',
        'field5' => 'field5',
        'field6' => 'field6',
        'field7' => 'field7',
        'field8' => 'field8',
      ],
    ],
    'contact' => [
      'title' => '联系方式',
      'available' => '1',
      'displayorder' => '1',
      'field' => [
        'telephone' => 'telephone',
        'mobile' => 'mobile',
        'icq' => 'icq',
        'qq' => 'qq',
        'yahoo' => 'yahoo',
        'msn' => 'msn',
        'taobao' => 'taobao',
      ],
    ],
    'edu' => [
      'available' => 1,
      'displayorder' => 2,
      'title' => '教育情况',
      'field' => [
        'graduateschool' => 'graduateschool',
        'education' => 'education',
      ],
    ],
    'work' => [
      'available' => 1,
      'displayorder' => 3,
      'title' => '工作情况',
      'field' => [
        'occupation' => 'occupation',
        'company' => 'company',
        'position' => 'position',
        'revenue' => 'revenue',
      ],
    ],
    'info' => [
      'title' => '个人信息',
      'available' => '1',
      'displayorder' => '4',
      'field' => [
        'idcardtype' => 'idcardtype',
        'idcard' => 'idcard',
        'address' => 'address',
        'zipcode' => 'zipcode',
        'site' => 'site',
        'bio' => 'bio',
        'interest' => 'interest',
        'sightml' => 'sightml',
        'customstatus' => 'customstatus',
        'timeoffset' => 'timeoffset',
      ],
    ],
  ],
];

?>