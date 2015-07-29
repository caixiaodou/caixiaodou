<?php
		
	$user_order=new Order();
	
	$user=new userOperation(NULL);
	
	$user_order->orderNumber="990";
	$user_order->userName="maomao";
	$user_order->userPhone="22";
	$user_order->orderAmount="21";
	$user_order->orderDate=date("Y-m-d H:i:s");
	$user_order->orderTime="16:30";
	$user_order->orderFlag="待付款";
	$user_order->orderAddress="广州大学城华南理工大学C10——247房";
	
	$user_order->userTel='1';
	
	$user_order->arr=array(array("productId"=>'1',"quantity"=>'1'),
						   array("productId"=>'2',"quantity"=>'2'),
						   array("productId"=>'3',"quantity"=>'3'));
						   
	/*var_dump($user_order->arr);echo "->";echo count($user_order->arr);exit;*/
	
	/*for($i=0;$i<count($user_order->arr);++$i)
		echo $user_order->arr[$i]['productId'];
	exit;*/
	
	$orderId=$user->userMakeOrder($user_order);
	
	if($orderId)
		echo "Yes";
	else 
		echo "No";


