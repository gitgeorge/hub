<?php
function choosefunction(){
	if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];
		switch ($mode){
			case "new":
			newuser();
			break;
			case "adduser":
			adduser();
			break;
			case "delete":
			deleteuser();
			break;

		}
	}
	else{
		listusers();
	}
}



function listusers(){
$sql = "select * from users";
	if($result = mysql_query($sql)){
	$temp = mysql_query($sql);
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr bgcolor="#8EBACA">
<th align="left" bgcolor="#8EBACA">NAME</th>
<th>&nbsp;</th>
<th>DELETE</th>
</tr>

<?php
$counter = 1;
		while($myrow = mysql_fetch_array($result)){
if($counter < 1){
$bgcolor = "#8EBACA";
}
else{
$bgcolor = "#8EBACA";
}

echo '<tr bgcolor=#A9D3D3><td></td><td></td><td></td></tr>';
echo '<tr bgcolor=#A9D3D3><td></td><td></td><td></td></tr>';
echo '<tr bgcolor=' . $bgcolor . '><td>';
echo  $myrow['id'] . ' ' . strtoupper($myrow['firstname']) .' '.strtoupper($myrow['lastname']).'</td>';
echo '<td width="70" align=center>&nbsp;</td>';
echo '<td width="70" align=center><a href=main.php?mode=delete&id=' .$myrow['id'] . ' class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
		}
?>



<?php

	}
}


function newuser(){
?>
<form name="page" id="page" method="post" action="main.php?mode=adduser">
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a>
</td>
</tr>
<tr>
<td colspan=2 align='center'>You are now adding a new user</td>
</tr>
<tr><td>Username:</td><td><input type="text" name="username" value=""></td></tr>
<tr><td>Password:</td><td><input type="text" name="password" value=""></td></tr>
<tr><td>Firstname:</td><td><input type="text" name="firstname" value=""></td></tr>
<tr><td>Lastname:</td><td><input type="text" name="lastname" value=""></td></tr>
<tr><td>Address:</td>
<td><textarea cols="80" rows="25"  name="address"></textarea></td></tr>
<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Add User"></td></tr>
<form>
<?php
}



function adduser(){
	$username = mysql_escape_string($_POST['username']);
	$password = mysql_escape_string($_POST['password']);
	$firstname = mysql_escape_string($_POST['firstname']);
	$lastname = mysql_escape_string($_POST['lastname']);
	$address = $_POST['address'];
	$sql = "insert into users (username,password,firstname,lastname,address) values ('$username','$password','$firstname','$lastname','$address')";
	
	if(mysql_query($sql)){
		echo "<div align=center>New user has been added</div>";			
	}
	else{
		echo "<div align=center>Operation Failed!!</div>";			
	}
	listusers();	
}


function deleteuser(){
$id =  $_REQUEST['id'];

$sql = "delete from users where id = $id";
if(mysql_query($sql)){
?>
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
	  <!--DWLayoutTable-->
	<tr>
	<td colspan=2 align='left'>
	<div align="center">
    The User has been deleted</div>	</td>
	</tr>
	<?php
	listusers();
}
else 
{
echo 'The User Was Not Deleted';
}
}




?>
