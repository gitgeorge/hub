<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="jscripts/tinyMCEinit.js"></script>
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>
<tr>
    <td>
	<table width="100%" border="0" bgcolor="#8EBACA" class="bordertop" cellspacing="0" cellpadding="5">
      <tr height="30">
        <td width="26%" align="center"><span class="style3">Banner Management</span> </td>
        <td width="74%" align=right><a href="banners.php?mode=newbanner">New Banner</a></td>
      </tr>
    </table>
</td>
  </tr>

<?php
function choosefunction(){
	if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];
		switch ($mode){
			case "getimages":
			getimages();
			break;
			case "delete":
			delbanner();
			break;
			case "newbanner":
			newform();
			break;
			case "viewbanner":
			viewbanner();
			break;
			case "addbanner":
			addbanner();
			break;
			case "updatebanner":
			updatebanner();
			break;

		}
	}
	else{
		listbanners();
	}
}



function listbanners(){
$sql = "select * from banners;";
	if($result = mysql_query($sql)){
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">

<tr>
<td colspan=3>List of Banners</td>
</tr>

<tr bgcolor="#8EBACA">
<th align="left">Banner</th>
<th align="left">url</th>
<th>View</th>
<th>Delete</th>
</tr>



<?php
$counter = 1;
while($myrow = mysql_fetch_array($result)){
if($counter < 1){
$bgcolor = "#dcdcdc";
}
else{
$bgcolor = "#ffffff";
}
echo '<tr bgcolor=' . $bgcolor . '><td>';
echo  $myrow['image'] . '</td>';
echo '<td>' . $myrow['url'] . '</td>';
echo '<td width="70" align=center><a href=banners.php?mode=viewbanner&id=' . $myrow['id'] . ' class="list">View</a></td>';
echo '<td width="70" align=center><a href=banners.php?mode=delete&id=' . $myrow['id'] . ' class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
}
?>
</table>
<?php

	}
}

function delbanner(){
$id = mysql_escape_string($_REQUEST['id']);
$sql = "delete from banners where id = $id";
if(mysql_query($sql)){
	echo "<div align=center>Banner has been removed<div>";
}
listbanners();
}

function newform(){
?>
<form id="banner" name="banner" enctype="multipart/form-data" method="post" action="banners.php?mode=addbanner">
<table width="80%" cellpadding="5" cellspacing="0" border="0">


<tr>
<td colspan="2">
Banner dimensions: Height:260px Width:228px


</td>
</tr>



<tr>
<td>Image:</td>
<td><input type="file" name="file"></td> 
</tr>

<tr>
<td>URL:</td>
<td><input type="text" name="url"></td>
</tr>


<tr>
<td colspan=2 align=center><input type="submit" name="submit" value="Add Banner"></td>
</tr>
</table>

</form>

<?php
listbanners();
}


function addbanner(){
$url = mysql_escape_string($_POST['url']);
$uploaddir = '../images/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
$filename =  basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
$sql = "insert into banners (image,url) values ('$filename','$url');";
	
if(mysql_query($sql)){
echo '<div align=center>New banner has been entered into the system</div>';
}

} else {
	echo '<div align=center>Operation Failed!!!!</div>';
}
listbanners();
}


function updatebanner(){
$id = $_REQUEST['id'];
$url = mysql_escape_string($_POST['url']);

$uploaddir = '../images/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
$filename =  basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
$sql = "update banners set image='$filename',url='$url' where id=$id;";
if(mysql_query($sql)){
echo '<div align=center>The banner has been updated</div>';
}

} else {
	echo '<div align=center>Operation Failed!!!!</div>';
}
listbanners();
}

function viewbanner(){
$id = mysql_escape_string($_REQUEST['id']);
$sql = "select * from banners where id = $id";
if($result = mysql_query($sql)){
while($myrow = mysql_fetch_array($result)){
?>
<form id="banner" name="banner" enctype="multipart/form-data" method="post" action="banners.php?mode=updatebanner&id=<?php echo $id;?>">

<table width="80%" cellpadding="5" cellspacing="0" border="0">

<tr>
<td width="1%"></td>
<td width="98%" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Image is " <?php echo $myrow['image']; ?> " <br />
<img src="../images/banners/<?php echo $myrow['image']; ?>" alt="" />
</td>
</tr>
</table>

<table width="80%" cellpadding="5" cellspacing="0" border="0">

<tr>
<td>Image:</td>
<td><input type="file" name="file" value="<?php echo $myrow['image'];?>"></td>

</tr>

<tr>
<td>URL:</td>
<td><input type="text" name="url" value="<?php echo  $myrow['url']; ?>"></td>
</tr>


<tr>
<td colspan=2 align=center><input type="submit" name="submit" value="Update Banner"></td>
</tr>


</table>

</form>

<?php
}
}
listbanners();
}


?> 
