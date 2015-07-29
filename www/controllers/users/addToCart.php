<?php

	/*******************************************************************
	
	addToCart.php用来接收前台ajax对后台数据库的请求和操作
	主要任务：完成用户的购物下订单流程
	具体功能如下：
	1、用户添加商品到购物车
	2、用户修改购物车
	3、用户提交结算
	4、用户填写订单信息
	5、用户提交订单、付款完成整个购物流程

	日期：2015/07/27

	程序猿：黄树茂

	*******************************************************************/
	
	//打开session
	session_start();


	//获取用户操作指令
	$action=isset($_GET['action'])?$_GET['action']:"";
	
	//获取用户提交的商品id、商品名称和商品单价
	$id=isset($_GET["id"])?$_GET['id']:"";
	$name=isset($_GET['name'])?$_GET['name']:"";
	$price=isset($_GET['price'])?$_GET['price']:"";
	$num=isset($_GET['num'])?$_GET['num']:"";

	//声明调用购物车类单例
	$cart=CartTool::getCart();
	
	switch($action){

		case "buy":
			$cart->addItem($id,$name,$price,1);
			break;
		case "add":
			$cart->incNum($id);
			break;
		case "reduce":
			$cart->indNum($id);
			break;
		case "modify":
			$cart->modNum($id,$num);
			break;
		case "delete" :
			$cart->dellItem($id);
			break;
		case "deleteAll" :
			$cart->dellAllItem();
			break;
		default:
			echo "No action!";
			break;
	}

	$arr=$cart->all();

	$smarty->assign('myarr',$arr);

	// $arr=$cart->all();
	// var_dump($arr);

	// $i=0;
	// foreach($arr as $item){
	// 	//echo $item['productId'];
	// 	$myCart[$i]['productId']=$item['productId'];
	// 	$myCart[$i]['productName']=$item['productName'];
	// 	$myCart[$i]['productPrice']=$item['productPrice'];
	// 	$myCart[$i]['productNum']=$item['productNum'];
	// 	$myCart[$i]['priceTotal']=$item['productPrice']*$item['productNum'];
	// 	$i++;
	// }
	// var_dump($myCart);



	//$_SESSION=array($page,$pId,$pNum);
	//var_dump($_SESSION);
?>