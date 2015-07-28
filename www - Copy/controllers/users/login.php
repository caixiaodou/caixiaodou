<?php

	$user=new userOperation(NULL);
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		$arr=$_POST;
		$user->userTel=mysql_escape_string($arr['userTel']); //转义一个字符串用于mysql_query,防sql注入
		
		$user->userPassword=sha1($arr['userPassword']);
		
		$row=$user->userLogin($user->userTel);
		/*echo $user->userTel;
		exit;*/
	
		if($row){
			if($row[0]['userPassword']==$user->userPassword){
				$_SESSION['loginFlag']=true;
				$_SESSION['userName']=$row[0]['userName'];
				$_SESSION['userTel']=$row[0]['userTel'];
				$_SESSION['sex']=$row[0]['sex'];
				$_SESSION['email']=$row[0]['email'];
				//$smarty->assign('user',$row);
				/*$smarty->display('caixiaodou.html');*/
				if($_SESSION['login']=="member"){
					//header('Location: index.php');
					$smarty->display('member.html');
					$_SESSION['login']="";
				}
				else
					header('Location: index.php');
			}
			else{
				echo "<script>alert('密码不正确！请重新登录！');</script>";	
				$smarty->display('login.html');
			}
		}
		else{
			echo "<script>alert('该账号不存在！请注册！');</script>";	
			$smarty->display('register.html');	
		}
	
	}else{
		$smarty->display('login.html');
	
	}
?>