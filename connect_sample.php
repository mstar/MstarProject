<?
error_reporting(E_ALL ^ E_NOTICE);
//  error_reporting(0);

//-----------------------------------------------------------------------------------------------------
if ($_SERVER["DOCUMENT_ROOT"]) $_SERVER_NAME=explode($_SERVER["DOCUMENT_ROOT"], str_replace("\\","/",dirname(__FILE__)));
$_SERVER_NAME=$_SERVER['SERVER_NAME'].$_SERVER_NAME[1];
$tmp_server_path=explode(":",dirname(__FILE__));
count($tmp_server_path)==1 ? $_SERVER_PATH=$tmp_server_path[0] : $_SERVER_PATH=str_replace("\\","/",$tmp_server_path[1]);
define(SERVER_NAME,$_SERVER_NAME);
define(SERVER_PATH,$_SERVER_PATH);

if(strpos(get_include_path(),";")=== false){
	set_include_path(SERVER_PATH."/lib/".":".SERVER_PATH."/lib/PHPExcel/".":".get_include_path());
} else {
	set_include_path(SERVER_PATH."/lib/".";".SERVER_PATH."/lib/PHPExcel/".";".get_include_path());
}
//-----------------------------------------------------------------------------------------------------
define(IN_PHPBB,true);
define('PHPBB_ROOT_PATH', '../libp/phpbb/');
$sForumUrl = '/libp/phpBB/';
include_once(SERVER_PATH.$sForumUrl.'config.php');
include_once(SERVER_PATH.$sForumUrl.'includes/constants.php');
//-----------------------------------------------------------------------------------------------------
$DB_CONF = array(
'User' => 'root',
'Password' => 'hastaMysql',
'Database' => 'autozp',
'Host' => '127.0.0.1',
'Port' => '3306',
'Type' => 'mysqlt',
'Charset'=>'cp1251',
'Modules'=> 'transaction : pear'
);
//-----------------------------------------------------------------------------------------------------
$GENERAL_CONF = array(
'MpanelVersion' => '4.2',
'ProjectName' => 'Partmaster',
'Charset' => 'windows-1251',
'AppendPermission' => true,
'ShowCounter' => false,
'IsLive' => false,
'RefererPercentage' => 10,
'PartnerPercentage' => 50,
'FullPaymentDiscount' => 2,
'WebService'=>array(
'Host'=>'emexonline.com:3000',
'Path'=>'/maxima',
'Url'=>'service.asmx',
'UserName'=>'QKIV',
'Password'=>'Sd9w74lp',
'CustomerId'=>'4590',
'MainCustomerId'=>'0',
),
'BaseLocale' => 'ua',
'CookieDomain' => 'partmaster.com.ua',
'RegionDomain' => 'autopartmaster.com',
'LogAdmin' => false,

'ForumUrl'=>$sForumUrl,
'Forum_user_table'=>USERS_TABLE,
'ForumTablePref'=>'phpbb__',
'ForumCookiesPrefName'=>'phpbb3_c34qf',
);
//-----------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//--for backup.sh-return user or passwd
if ($argv[1]=='_for_cron_username') {
	echo $DB_CONF['User'];
} elseif ($argv[1]=='_for_cron_password') {
	echo $DB_CONF['Password'];
}
//-----------------------------------------------------------------------------------------------------

?>