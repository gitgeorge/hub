<?php 
include "includes/dbconnect.php";
?>
<td bgcolor="#FBB74A" width="200" valign="top" align="left">
<table align="center">
<tr>
<td>
<?php
if(isset($_COOKIE['pizza-user'])){
echo 'Welcome';
echo '<a href="news.php?mode=logout">logout</a>';
}
else{
?> 
<form name="login" id="login" method="post" action="login.php">
<table bgcolor="#970F01" align="center">
<tr><td><font color="#FFFFFF">Customer Login</font></td></tr>
<tr><td><input type="text" name="username" id="username" value="username" /></td></tr>
<tr><td><input type="text" name="password" id="password" value="password" /></td></tr>
<tr><td><input type="submit" name="button" value="Login" /></td></tr>
<tr><td>&nbsp;</td></tr>
</table>
</form>
<?php
}
?>
</td>
</tr>
<tr><td><img src="images/offer.jpg" height="210px"/></td></tr>
<!--<tr><td align="center"><a href="#">View all Offers</a></td></tr>-->
</table>
</td>

