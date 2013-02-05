<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>

<title>Online Pizza › Login</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/mimi.css" rel="stylesheet" type="text/css">
<script type="text/javascript">

		function focusit() {

			document.getElementById('user_login').focus();
		}

		window.onload = focusit;

	</script>
</head>

<body>
<script language="JavaScript" type="text/JavaScript">
function checkform(form){
	if (form["username"].value==""){
		alert("Please enter your username"); 
		return false;
	}
	if (form["password"].value==""){
		alert("Please enter your password"); 
		return false;
	}
	return true;
}
</script>


<p>&nbsp;</p>
<div align="center">
<font color="red">
<?php
if(isset($_SESSION['errormessage'])){
	echo $_SESSION['errormessage'];
}
?>
</font>
</div>
<div id="login">

  <h1><a href="http://Pizza.org" title="Company Name">Company Name</a></h1>
<form action="login.php" method="post" name="login" id="loginform" onsubmit = "return checkform(this)">
<p>

      <label>Username:<br />

      <input name="username" id="user_login" class="input" value="" size="20" tabindex="10" type="text" />

      </label>

    </p>

    <p>

      <label>Password:<br />

      <input name="password" id="password" class="input" value="" size="20" tabindex="20" type="password" />

      </label>

    </p>

    <p class="submit">

      <input name="wp-submit" id="wp-submit" value="Login »" tabindex="100" type="submit" />

      <input name="redirect_to" value="#" type="hidden" />

    </p>
</form>
</div>
</body>
</html>
