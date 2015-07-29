<?php

	$admin=new Manager();
	
	
	$rows=$admin->getAllProduct();
	//var_dump($rows);exit;

	$smarty->assign('allProduct',$rows);

	$smarty->display('caixiaodou.html');

?>
