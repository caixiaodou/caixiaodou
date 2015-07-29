<?php

	class DB{
		private $db_UserName;
		private $db_Password;
		private $db_Host;
		private $db_DBName;
		
		function __construct(){
			
			$this->db_UserName='maomao';
			$this->db_Password='maomao';
			$this->db_Host='localhost';
			$this->db_DBName='caixiaodou';

			// $this->db_UserName='maomao_root';
			// $this->db_Password='root';
			// $this->db_Host='localhost';
			// $this->db_DBName='maomao_root';
		}
		
		function __destruct(){
		
		}
		
		function userAdd($Info){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
	
				echo "<script>alert('Can't conect to the database!');</script>";
				exit;
			
			}
				
			$query="insert into users(userTel,userPassword,userName,sex,email,regTime) 
				values('$Info->userTel','$Info->userPassword','$Info->userName','$Info->sex','$Info->email','$Info->regTime')";	
			
			$db->query("SET NAMES UTF8");	
			
			$bool_isSuccess=$result=$db->query($query);
			
			/*echo $db->insert_id;exit;*/
			
				$db->close();
				if($bool_isSuccess)
					return true;
				else
					return false;
		}
		
		function getUser($userId){
		
			//connect the database
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "Can't connect to the database!'";
				return false;	
			}
			
			$query="select * from users where users.userId=$userId";
			$db->query("SET NAMES UTF8");
			
			$result=$db->query($query);
			
			$db->close();
			if($result)
				return $result->fetch_array(MYSQLI_ASSOC);
			else
				return false;
				
		}
		
		function userSearch($userTel){
		
			//connect the database
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "<script> alert('Can't connect to the database!');</script>";
				return false;	
			}
			
			$query="select userId from users where users.userTel=$userTel";
			$db->query("SET NAMES UTF8");
			
			$result=$db->query($query);
			//var_dump($result);exit;
			$db->close();
			if(!isset($result))
				return false;
			
			$result_num=$result->num_rows;
			
			$arr_userId=NULL;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_array(MYSQLI_ASSOC);
					$arr_userId[$i]=stripslashes($row['userId']);	
				}
				
			$arr_user=NULL;
			
			for($i=0;$i<$result_num;$i++){
					$arr_user[$i]=$this->getUser($arr_userId[$i]);	
				}
				
			return $arr_user;	
		}
		
		function userModify($userTel,$Info){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "<script>alert('Can't connect to the database!');</script>";
				return false;
			}
			
			$query="update users set users.userName='$Info->userName',users.sex='$Info->sex',users.email='$Info->email' 
					where users.userTel=$userTel";
					
			$db->query("SET NAMES UTF8");
			
			$result=$db->query($query);
			
			$db->close();
			
			if($result)
				return true;
			else
				return false;
			
		}
		
		function userChangePassword($userTel,$userPassword){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "<script>alert('Can't connect to the database!')</script>";
				return false;
			}
			
			$query="update users set users.userPassword='$userPassword' 
					where users.userTel=$userTel";
			$db->query("SET NAMES UTF8");
			
			
			$result=$db->query($query);
			$db->close();
			
			if($result)
			 	return true;
			else
				return false;
		}
		
		function userMakeOrder($Info){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "'Can't connect to the database!'";
				return false;
			}
			
			$query="insert into orders(orderNumber,userPhone,userName,orderAmount,orderDate,orderTime,orderFlag,orderAddress) 
				values('$Info->orderNumber','$Info->userPhone','$Info->userName','$Info->orderAmount','$Info->orderDate','$Info->orderTime','$Info->orderFlag','$Info->orderAddress')";	
			
			$db->query("SET NAMES UTF8");
			
			$bool_isSuccess=$result=$db->query($query);
			
			
			if($bool_isSuccess){
				
				$orderId=$db->insert_id;
				
				$query="insert into user_order(userTel,orderId) values('$Info->userTel','$orderId')";
				$db->query("SET NAMES UTF8");
				$db->query($query);
				
				for($i=0;$i<count($Info->arr);$i++)
				{
					$productId=$Info->arr[$i]['productId'];
					$quantity=$Info->arr[$i]['productId'];
					$query="insert into order_product(productId,orderId,quantity) 
							values('$productId','$orderId','$quantity')";
					$db->query("SET NAMES UTF8");
					$db->query($query);
				}
				$db->close();
				
				return $orderId;
			}
			else{
				$db->close();
				return false;
			}
			
		}
		
		function getOrder($userTel){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "'Can't connect to the database!'";
				return false;
			}
			
			$query=" select orderId from user_order where user_order.userTel='$userTel'";
			$db->query("SET NAMES UTF8");
	
			$result_orderId=$db->query($query);
			
			if($result_orderId){
			
				$result_num=$result_orderId->num_rows;	
			
				$orderId=NULL;
				for($i=0;$i<$result_num;++$i){
					
					$result=$result_orderId->fetch_array(MYSQLI_ASSOC);
					$orderId[$i]=$result['orderId'];
				}
				
				$order=NULL;
				for($i=0;$i<$result_num;++$i)
				{
					
					$query="select * from orders where orders.orderId='$orderId[$i]'";
					$db->query("SET NAMES UTF8");
				
					$result_order=$db->query($query);
					
					if($result_order){
					
						$result=$result_order->fetch_array(MYSQLI_ASSOC);
						$order[$i]=$result;
					}
					else 
						{echo "Nodb"; exit;}	
				}
				// for($i=0;$i<count($order);++$i){
					
				// 	echo $order[$i]['orderId'];
				// }exit;
				$db->close();
				return $order;		
			}
			else
				{echo "No orderId"; $db->close();exit;}
		}
		
		function userChangeOrder($orderNumber,$orderFlag){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "'Can't connect to the database!'";
				return false;
			}
			
			$query="select orderFlag from orders where orders.orderNumber='$orderNumber' ";
			
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			if($result){
				
				$arrFlag=$result->fetch_array(MYSQLI_ASSOC);
				$dbFlag=$arrFlag['orderFlag'];
			}
			else
				return false;
				
			switch($dbFlag)
			{
			
				case "待付款":
					if($orderFlag=="待取菜"||$orderFlag=="已取消"){
						
						$query="update orders set orders.orderFlag='$orderFlag' where orders.orderNumber='$orderNumber'";
						$db->query("SET NAMES UTF8");
						$bool_isSuccess=$db->query($query);
						$db->close;
						
						if($bool_isSuccess)
							return true;
						else
							return false;
					}
					else{
						$db->close;
						return false;
					}
					break;
				case "待取菜":
					if($orderFlag=="已完成"){
					
						$query="update orders set orders.orderFlag='$orderFlag' where orders.orderNumber='$orderNumber'";
						$db->query("SET NAMES UTF8");
						$bool_isSuccess=$db->query($query);	
						$db->close;
						if($bool_isSuccess)
							return true;
						else
							return false;
					}
					else{
						$db->close;
						return false;
					}
					break;
				case "已取消":
					if($orderFlag=="待取菜"){
					
						$query="update orders set orders.orderFlag='$orderFlag' where orders.orderNumber='$orderNumber'";
						$db->query("SET NAMES UTF8");
						$bool_isSuccess=$db->query($query);	
						$db->close;
						if($bool_isSuccess)
							return true;
						else
							return false;
					}
					else{
						$db->close;
						return false;
					}	
					break;
				default:
					break;
				
			}
			
		}
		
		function getProduct($productId){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "'Can't connect to the database!'";
				return false;
			}
			
			$query="select * from products where products.productId='$productId'";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			if (!isset($result)) 
				return NULL;
			
			$row=$result->fetch_array(MYSQLI_ASSOC);
				
			$db->close();
			return $row;
		}
		
		function getAllProduct(){
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				
				echo "'Can't connect to the database!'";
				return false;
			}
			
			$query="select productId from products";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			if(!isset($result))
				return false;
			
			$result_num=$result->num_rows;
			
			$arr_productId=NULL;
			for($i=0;$i<$result_num;++$i){
				
				$row=$result->fetch_array(MYSQLI_ASSOC);
				$arr_productId[$i]=$row['productId'];
			}
		
			$arr_product=NULL;
			for($i=0;$i<$result_num;++$i){
				
				$arr_product[$i]=$this->getProduct($arr_productId[$i]);	
			}
			$db->close();
			return $arr_product;
		}
		
		
	}