<?php
if(!defined('LIBRARIES')) die("Error");

/* Root */
define('ROOT',__DIR__);

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình coder */
define('NN_MSHD','2641620w');
define('NN_AUTHOR','nguyentuananh1203.nina@gmail.com');

/* Cấu hình chung */
$config = array(
	'author' => array(
		'email' => 'nguyentuananh1203.nina@gmail.com',
		'timefinish' => '00/2020'
	),
	'arrayDomainSSL' => array(),
	'bonus' => array(
		'responsive'=> true,
		'mobile' 	=> false,
		'cart' 		=> false,
		'user' 		=> false,
	),
	'setting' => array(
		'product_thumb'=> '285x300x1',
		'slide_thumb'=> '1366x485x1',
	),
	'database' => array(
		'server-name' => $_SERVER["SERVER_NAME"],
		'url' => '/phuonguyen_2641620w/',
		'type' => 'mysql',
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'hpde',
		'port' => 3306,
		'prefix' => 'table_',
		'charset' => 'utf8'
	),
	'website' => array(
		'error-reporting' => true,
		'secret' => '$nina@',
		'salt' => 'ntanh1203',
		'debug-developer' => true,
		'debug-css' => true,
		'debug-js' => true,
		'index' => false,
		'upload' => array(
			'max-width' => 1600,
			'max-height' => 1600
		),
		'lang' => array(
			'vi'=>'Tiếng Việt',
			'en'=>'Tiếng Anh'
		),
		'lang-doc' => 'vi|en',
		'slug' => array(
			'vi'=>'Tiếng Việt',
			// 'en'=>'Tiếng Anh'
		),
		'seo' => array(
			'vi'=>'Tiếng Việt',
			'en'=>'Tiếng Anh'
		),
		 // 'comlang' => array(
		 // 	"gioi-thieu" => array("vi"=>"gioi-thieu","en"=>"about-us"),
		 // 	"san-pham" => array("vi"=>"san-pham","en"=>"product"),
		 // 	"tin-tuc" => array("vi"=>"tin-tuc","en"=>"news"),
		 // 	"tuyen-dung" => array("vi"=>"tuyen-dung","en"=>"recruitment"),
		 // 	"thu-vien-anh" => array("vi"=>"thu-vien-anh","en"=>"gallery"),
		 // 	"video" => array("vi"=>"video","en"=>"video"),
		 // 	"lien-he" => array("vi"=>"lien-he","en"=>"contact")
		 // )
	),
	'order' => array(
		'ship' => true
	),
	'login' => array(
		'admin' => 'LoginAdmin'.NN_MSHD,
		'member' => 'LoginMember'.NN_MSHD,
		'attempt' => 5,
		'delay' => 15
	),
	'googleAPI' => array(
		'recaptcha' => array(
			'active' => false,
			'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
			'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
			'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
		)
	),
		// 'oneSignal' => array(
		// 	'active' => false,
		// 	'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
		// 	'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		// ),
		// 'license' => array(
		// 	'version' => "7.0.0",
		// 	'powered' => "@gmail.com"
		// )
);

/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

/* Cấu hình base */
if($config['arrayDomainSSL']) require_once LIBRARIES."checkSSL.php";
$http = 'http';
if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $http .= "s";
$http .= "://";
$config_url = $config['database']['server-name'].$config['database']['url'];
$config_base = $http.$config_url;

/* Cấu hình login */
$login_admin = $config['login']['admin'];
$login_member = $config['login']['member'];

/* Cấu hình upload */
require_once LIBRARIES."constant.php";
?>