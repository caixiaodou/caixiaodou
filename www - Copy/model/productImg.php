<?php

	class ProductImg{
		
		public $imgName;
		var $imgRoot;
		var $imgFlag;
		
		function _construct($imgName){
		
			$this->imgName=$imgName;
		}
			
		
		function getImgName(){
			
			return $this->imgName;	
		}
		
	}
	

?>