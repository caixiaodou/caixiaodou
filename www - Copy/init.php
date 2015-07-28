<?php
define('ROOT', dirname(__FILE__));
header("content-type:text/html;charset=utf-8;");

require_once('config.php');

require_once('model/manager.php');
require_once('model/order.php');
require_once('model/product.php');
require_once('model/productImg.php');
require_once('model/user.php');

require_once('model/userOperation.php');
require_once('model/productOperation.php');
require_once('model/CartTool.php');


global $db;
$db = @mysql_connect($config['hostname'], $config['user'], $config['password']);
if (!$db) {
  echo '数据库连接失败';
  exit;
}
mysql_select_db($config['name']);
mysql_unbuffered_query('SET NAMES "' . $config['charset'] . '"');

require_once 'smarty/Smarty.class.php';

global $smarty;

$smarty = new Smarty();
$smarty->setTemplateDir(ROOT . '/views');
$smarty->setCompileDir('/tmp');

session_start();
