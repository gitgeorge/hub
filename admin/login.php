<?php 
session_start();
include "includes/dbconnect.php";
if(isset($_POST['username'])){
	login();
}

function login(){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	$logintime = date('g:i a');
	$sql = "select * from admin where username = '$uname' and pword = sha1('$pword')";
	if($result = mysql_query($sql)){
		if(mysql_num_rows($result) > 0){
			$_SESSION['errormessage'] = "";
			$cookie = array('username' => $uname, 'logintime' => $logintime);	
			setcookie("pizza-admin[username]", $uname);
			setcookie("pizza-admin[logintime]", $logintime);
$sql="insert into tracker (username) values('$uname')";
mysql_query($sql);
			header("Location: main.php");	}
			else{
			$_SESSION['errormessage'] = "Either the username or password you entered was incorrect";
			header("Location: index.php");	}
	}
}
?>
