<?php

	$userTel=$_SESSION['userTel'];


	$user=new userOperation(NULL);


	$userOrder=$user->userCheckOrder($userTel);

	$userInfo=$user->userSearch($userTel);
	$_SESSION['user']=$userInfo;

	$smarty->assign('userOrder',$userOrder);

	$smarty->assign('userInfo',$userInfo);
	var_dump($userInfo);
 	$smarty->display('member.html');
?>