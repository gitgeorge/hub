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
	$sql = "select * from users where username = '$uname' and password = '$pword'";
	if($result = mysql_query($sql)){
		if(mysql_num_rows($result) > 0){
			$_SESSION['errormessage'] = "";
			$myrow = mysql_fetch_array($result);
			$id = $myrow['id'];
			//$cookie = array('username' => $uname, 'logintime' => $logintime);	
			setcookie("pizza-user", $id);
		//	setcookie("pizza-user[logintime]", $logintime);
$sql="insert into tracker (username) values('$uname')";
mysql_query($sql);
			header("Location: pizza.php");	}
			else{
			$_SESSION['errormessage'] = "Either the username or password you entered was incorrect";
			header("Location: index.php");	}
	}
}
?>
