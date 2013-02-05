<?php
function getinfo(){
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$sql = "select * from content where id = $id";
		$result = mysql_query($sql);
		$myrow = mysql_fetch_array($result);
		echo $myrow['content'];
	}

}


function getbanner(){
$sql = "select * from banners order by rand() limit 1;";
$result = mysql_query($sql);
$myrow = mysql_fetch_array($result);
$banner = $myrow['image'];
return $banner;
}





function contactform(){
if(isset($_REQUEST['id'])){
$id = $_REQUEST['id'];
if($id == 3){
showform();
}
}

}










function showform(){
?>
	<script language="JavaScript" type="text/JavaScript">
	function checkform(form){
	if (form["name"].value==""){
		alert("Please enter your name"); 
		return false;
	}

	if (form["email"].value==""){
		alert("Please enter your email address") 
			return false;
	}
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value) == false){
		alert("The email address you have entered is not valid. Please re-enter.")
		return (false);
	}

	if (form["company"].value==""){
		alert("Please enter your company name"); 
		return false;
	}


	if (form["enquiry"].value==""){
	alert("Please enter your enquiry") 
	return false;
	}
	return true;
}
</script>
<form name="booking" id="booking" method="post" action="contacts.php?mode=sendform"  onsubmit = "return checkform(this)">
<table>
<tr><td>Name:</td><td><input type="text" name="name" size="40"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" size="40"></td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone" size="40"></td></tr>
<tr><td>Subject:</td><td><input type="text" name="subject" size="40"></td></tr>

<tr><td>Enquiry:</td><td></td></tr>
<tr><td colspan="2"><textarea name="enquiry" cols="40"></textarea></td></tr>
<tr><td><input type="submit" name="submit" value="SEND ENQUIRY"></td><td></td></tr>
</table>
</form>
<?php
}

?>
