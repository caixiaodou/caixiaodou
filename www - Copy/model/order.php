<?php

	class Order{
		
		public $orderNumber;
		var $userPhone;
		var $userName;
		var $orderAmount;
		var $orderDate;
		var $orderTime;
		var $orderFlag;
		var $orderAddress;
		var $userId;
		var $arr=array(array());
		
		
		function _construct(){
			
			$this->orderNumber=NULL;
			$this->userPhone=NULL;
			$this->userName=NULL;
			$this->orderAmount=NULL;
			$this->orderDate=NULL;
			$this->orderTime=NULL;
			$this->orderFlag=NULL;
			$this->orderAddress=NULL;
			$this->productId=NULL;
			$this->orderId=NULL;
			$this->quantity=NULL;
		}
		
	}
	

?>