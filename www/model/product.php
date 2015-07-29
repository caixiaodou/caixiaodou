<?php

	class Product{
		
		public $productNumber;
		var $productName;
		var $productCharacter;
		var $productInfo;
		var $productWeigth;
		var $productOrigin;
		var $productPrice;
		var $productTime;
		var $productQuantity;
		var $productLove;
		var $productKind;
		var $productToday;
		var $productFlag;
		
		function _construct(){
			
			$this->productNumber=NULL;
			$this->productName=NULL;
			$this->productCharacter=NULL;
			$this->productInfo=NULL;
			$this->productWeigth=NULL;
			$this->productOrigin=NULL;
			$this->productPrice=NULL;
			$this->productTime=NULL;
			$this->productQuantity=NULL;
			$this->productLove=NULL;
			$this->productKind=NULL;
			$this->productToday=NULL;
			$this->productFlag=NULL;
		}
		
		function getProductNumber(){
			
			return $this->productNumber;	
		}
	}