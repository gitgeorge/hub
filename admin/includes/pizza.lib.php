<script language="Javascript">
function FCKeditor_OnComplete( editorInstance )
{
    if(editorInstance.Name=="fckeditor2")
    {
    editorInstance.Events.AttachEvent( 'OnSelectionChange', DoSomething ) ;
    editorInstance.Events.AttachEvent( 'OnPaste', DoSomething ) ;
    }
}
var counter = 0 ;
var excee = "";
var exvee="";
function DoSomething( editorInstance )
{
    // This is a sample function that shows in the title bar the number of times
    // the "OnSelectionChange" event is called.
    //window.document.title = editorInstance.Name + ' : ' + ( ++counter ) ;
    var cnt=0;
    if(document.all)
    {
    cnt = editorInstance.EditorDocument.body.innerText.length;
    excee = editorInstance.EditorDocument.body.innerHTML;
    }
    else
     {
      cnt = editorInstance.EditorDocument.body.textContent.length;
      excee = editorInstance.EditorDocument.body.innerHTML;
     }
 
  if(cnt > 800)
  {
  editorInstance.EditorDocument.body.innerHTML = exvee;
  return false;
  }
  else
  {
  exvee = excee;
  document.opportunity.tbCnt.value = 800 - cnt;
  return true;
  }

    //alert(editorInstance.EditorDocument.body.innerText);

} 
</script>
<?php
include("fckeditor/fckeditor.php") ;
?>

<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="jscripts/tinyMCEinit.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>


<tr>
    <td>
	<table width="100%" border="0" class="bordertop" cellspacing="0" cellpadding="0" bgcolor="#8EBACA">
      <tr height="30">
        <td width="26%" align="center"><span class="style1">Pizza Management </span></td>
        <td width="74%" align=right><a href=pizza.php?mode=newpizza class="style1">Add New</a></td>
      </tr>
    </table>
</td>
  </tr>

<?php
function choosefunction(){
	if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];
		switch ($mode){
			case "getpizza":
			getpizza();
			break;
			case "update":
			update();
			break;
			case "newpizza":
			newpizza();
			break;
			case "addpizza":
			addpizza();
			break;
			case "delete":
			deletepizza();
			break;

		}
	}
	else{
		listpizza();
	}
}



function listpizza(){
	global $temp;
$sql = "select * from pizza order by id";
	if($result = mysql_query($sql)){
	$temp = mysql_query($sql);
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr bgcolor="#8EBACA">
<th align="left" bgcolor="#8EBACA">PIZZA NAME</th>
<th>EDIT</th>
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
echo  $myrow['id'] . ' ' . strtoupper($myrow['name']) . '</td>';
echo '<td width="70" align=center><a href=pizza.php?mode=getpizza&id=' .$myrow['id'] . ' class="list">Edit</a></td>';
echo '<td width="70" align=center><a href=pizza.php?mode=delete&id=' .$myrow['id'] . ' class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
		}
?>



<?php

	}
}





function deletepizza(){
$id =  $_REQUEST['id'];

$sql = "delete from pizza where id = $id";
if(mysql_query($sql)){
?>
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
	  <!--DWLayoutTable-->
	<tr>
	<td colspan=2 align='left'>
	<div align="center">
    The Pizza has been deleted</div>	</td>
	</tr>
	<?php
	listpizza();
}
else 
{
echo 'The Pizza Was Not Deleted';
}
}




function getpizza(){
if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$sql = "select * from pizza where id = $id";
	if($result = mysql_query($sql)){
		if($myrow = mysql_fetch_array($result)){	
?>
<form name="page" id="page" method="post" action="pizza.php?mode=update&id=<?php echo $id;?>">
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a></td>
</tr>

<tr><td>Name:</td><td><input type="text" name="name" value="<?php echo $myrow['name'];?>"></td></tr>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    
    <td><br />
		<h4>Description:</h4>
    
      <hr align="left" width="200" size="1" noshade="noshade" />    </td>
    </tr>
    <tr>
    <td>
    
    
		<?php
        $oFCKeditor = new FCKeditor('fckeditor1') ;
        $oFCKeditor->BasePath = 'fckeditor/';
        $oFCKeditor->Value = $myrow['descrip'];
        $oFCKeditor->Create() ;
        ?></td>
  </tr>
  <tr><td>Price:</td><td><input type="text" name="price" value="<?php echo $myrow['price'];?>"></td></tr>
 <tr><td>Image:</td><td><input type="file" name="file" value="<?php echo $myrow['image'];?>"></td></tr>
  <tr><td colspan=2 align="center"><input type="submit" name="submit" value="UPDATE"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<hr align="center" width="80%" size="1" noshade="noshade" />
<form>
<br />
 
<br />
<?php
		}
	}
}
	listpizza();
}




function update(){
if(isset($_REQUEST['id'])){
$id = mysql_escape_string($_REQUEST['id']);
$name = mysql_escape_string($_POST['name']);
$price = mysql_escape_string($_POST['price']);
$description = $_POST['fckeditor1'];
$uploaddir = '../pizzas/';
	$uploadfile = $uploaddir . basename($_FILES['file']['name']);
	$filename =  basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
$sql = "update pizza set  name = '$name', descrip = '$description', price = '$price' image ='$filename' where id = $id";
if($result = mysql_query($sql)){
	echo "<div align=center class=blaktxt>The Pizza has been updated</div>";	
	
}
}
listpizza();
}



}



function newpizza(){
?>
<form name="page" id="page" method="post" enctype="multipart/form-data" action="pizza.php?mode=addpizza">
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a>
</td>
</tr>
<tr>
<td colspan=2 align='center'>You are now adding a new type of pizza</td>
</tr>
<tr><td>Name:</td><td><input type="text" name="name" value=""></td></tr>
<tr><td>Description:</td>
<td><textarea cols="80" rows="25"  name="description"></textarea></td></tr>
<tr><td>Price:</td><td><input type="text" name="price" value=""></td></tr>
<tr><td>Image</td>
<td><input type="file" name="file" /></td>
</tr>
<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Add Pizza"></td></tr>
<form>
<table>
<hr align="center" width="80%" noshade="noshade">
<?php
}


function addpizza(){

	$name = mysql_real_escape_string($_POST['name']);
	$description = $_POST['description'];
	$price = $_POST['price'];
	$uploaddir = '../pizzas/';
	$uploadfile = $uploaddir . basename($_FILES['file']['name']);
	$filename =  basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$sql = "insert into pizza (name, descrip, price ,image) values ('$name','$description','$price','$filename')";
	
	if(mysql_query($sql)){
		echo "<div align=center>New pizza has been added</div>";			
	}
	else{
		echo "<div align=center>Operation Failed!!</div>";echo mysql_error();			
	}
	}
	listpizza();	
}



?>
