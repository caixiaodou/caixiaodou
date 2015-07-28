<?php
include 'init.php';

$op = isset($_GET['op']) ? $_GET['op'] : 'caixiaodou';


$isLogin = isset($_SESSION['loginFlag']) && $_SESSION['loginFlag'] == true;

switch ($op){
	case 'caixiaodou':
	
			include 'controllers/users/caixiaodou.php';
    	break;
	case 'register':
    	
    	include 'controllers/users/register.php';
    	break;
		
	case 'login':
   		// if ($isLogin) {
     //  		header('Location: index.php');
    	// }
      $_SESSION['login']="";
    	include 'controllers/users/login.php';
    	break;
    case 'loginout':
      $_SESSION['loginFlag'] = false;
	  $_SESSION['userTel']=NULL;
      include 'controllers/users/login.php';
      break;
  	case 'member':
    	if (!$isLogin) {
          $_SESSION['login']=$op;
      		header('Location: index.php?op=login');
    	}
    	include 'controllers/users/member.php';
    	break;
  	case 'help':
 
    	include 'controllers/users/help.php';
    	break;
  	case 'caidou':
    	
    	include 'controllers/users/caidou.php';
    	break;
		
	case 'userModify':
    
    	include 'controllers/users/userModify.php';
    	break;
		
	case 'userSearch':
    
    	include 'controllers/users/userSearch.php';
    	break;
	case 'userChangePassword':
   
    	include 'controllers/users/userChangePassword.php';
    	break;
		
	case 'userMakeOrder':
   
    	include 'controllers/users/userMakeOrder.php';
    	break;
	case 'userCheckOrder':
   
    	include 'controllers/users/userCheckOrder.php';
    	break;
		
	case 'userChangeOrder':
   
    	include 'controllers/users/userChangeOrder.php';
    	break;
		
	case 'getProduct':
   
    	include 'controllers/admin/getProduct.php';
    	break;
	case 'addToCart':
   
    	include 'controllers/users/addToCart.php';
    	break;
  default:
    echo '无效操作';
    exit;
}
