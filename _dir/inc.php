<?php
//error_reporting(0);
define("DIR_INIT", true);
define("SYSTEM_ROOT", dirname(__FILE__).'/');
define("ROOT", dirname(SYSTEM_ROOT).'/');
define("PAGE_ROOT", SYSTEM_ROOT.'page/');

date_default_timezone_set("PRC");

require SYSTEM_ROOT.'functions.php';
require SYSTEM_ROOT.'Cache.class.php';
require SYSTEM_ROOT.'DirList.class.php';

$CACHE = new Cache();
$conf = $CACHE->get('config');
if(!$conf){
	if(!$CACHE->set('config', ['admin_username'=>'admin','admin_password'=>md5('123456'),'title'=>'本地 | 免费开源的网盘程序', 'keywords'=>'开源,网盘,本地网盘,直链,本地网盘直链,本地网盘目录树,文件列表,文件搜索,文件下载','description'=>'一款开源的本地网盘开发者接口程序，解锁更多炫酷的技能。','announce'=>'','footer'=>'', 'name_encode'=>'utf8', 'file_hash'=>'1', 'cache_indexes'=>'0', 'readme_md'=>'1', 'auth'=>'0', 'nav'=>'智云源码*http://bbs.zyzyw.cc'])){
		sysmsg('配置项初始化失败，可能无文件写入权限');
	}
	$conf = $CACHE->get('config');
}

$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = (is_https() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';

if(isset($_COOKIE["admin_session"]))
{
	if($conf['admin_session']===$_COOKIE["admin_session"]) {
		$islogin=1;
	}
}
