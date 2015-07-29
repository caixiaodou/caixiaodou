<?php

	class User {
		
		public $userTel;
		var $userPassword;
		var $userName;
		var $sex;
		var $email;
		var $regTime;

	function __construct(){
		
		//$this->userTel=$userTel;
		$this->userTel=NULL;
		$this->userPassword=NULL;
		$this->userName=NULL;
		$this->sex=NULL;
		$this->email=NULL;
		$this->regTime=NULL;
	}
	
	/*function getUserTel(){
		
		return $this->userTel;	
	}*/

}

?>
