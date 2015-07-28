<?php
	
	$user=new userOperation(NULL);
	
	if(isset($_POST['userTel'])){
		$arr=$_POST;
		$user->userTel=mysql_escape_string($arr['userTel']);
		$user->userName=$arr['userName'];
		$user->userPassword=sha1($arr['userPassword']);
		$user->email=$arr['email']?$arr['email']:'@caixiaodou.com';
		$user->regTime=date("Y-m-d H:i:s");
		$user->sex="保密";
		$bool_isSuccess=$user->userRegister($user);
		if($bool_isSuccess)
			$smarty->display('login.html');
	
		else{
			echo "<script>alert('该用户已注册！请登录！');</script>";
			$smarty->display('login.html');
		}
	
	}else{
		$smarty->display('register.html');
	
	}



