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
        <td width="26%" align="center"><span class="style1">Page Management </span></td>
        <td width="74%" align=right><a href=pages.php?mode=newpage class="style1">Add New</a></td>
      </tr>
    </table>
</td>
  </tr>

<?php
function choosefunction(){
	if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];
		switch ($mode){
			case "getpage":
			getpage();
			break;
			case "update":
			update();
			break;
			case "newpage":
			newpage();
			break;
			case "addpage":
			addpage();
			break;
			case "delete":
			deletepage();
			break;

		}
	}
	else{
		listpages();
	}
}



function listpages(){
	global $temp;
$sql = "select id,title, cdate from content where id  > 0 order by id";
	if($result = mysql_query($sql)){
	$temp = mysql_query($sql);
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr bgcolor="#8EBACA">
<th align="left" bgcolor="#8EBACA">TITLE</th>
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
echo  $myrow['id'] . ' ' . strtoupper($myrow['title']) . '</td>';
echo '<td width="70" align=center><a href=pages.php?mode=getpage&id=' .$myrow['id'] . ' class="list">Edit</a></td>';
echo '<td width="70" align=center><a href=pages.php?mode=delete&id=' .$myrow['id'] . ' class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
		}
?>



<?php

	}
}





function deletepage(){
$id =  $_REQUEST['id'];

$sql = "delete from content where id = $id";
if(mysql_query($sql)){
?>
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
	  <!--DWLayoutTable-->
	<tr>
	<td colspan=2 align='left'>
	<div align="center">
    The Page has been deleted</div>	</td>
	</tr>
	<?php
	listpages();
}
else 
{
echo 'The Page Was Not Deleted';
}
}




function getpage(){
if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$sql = "select *, date_format(cdate,'%D %M, %Y') as mycdate from content where id = $id";
	if($result = mysql_query($sql)){
		if($myrow = mysql_fetch_array($result)){	
?>
<form name="page" id="page" method="post" action="pages.php?mode=update&id=<?php echo $id;?>">
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a></td>
</tr>


<tr>
<td colspan=2 align='center'>You are now editing the '<strong><?php echo $myrow['title'];?></strong>' page</td>
</tr>


<tr>
<td colspan=2 align='center'>This page was last edited on <strong><?php echo $myrow['mycdate'];?></strong><hr></td>
</tr>

<tr><td>Title:</td><td><input type="text" name="title" value="<?php echo $myrow['title'];?>"></td></tr>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    
    <td><br />
		<h4>Content:</h4>
    
      <hr align="left" width="200" size="1" noshade="noshade" />    </td>
    </tr>
    <tr>
    <td>
    
    
		<?php
        $oFCKeditor = new FCKeditor('fckeditor1') ;
        $oFCKeditor->BasePath = 'fckeditor/';
        $oFCKeditor->Value = $myrow['content'];
        $oFCKeditor->Create() ;
        ?></td>
  </tr>
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
	listpages();
}




function update(){
if(isset($_REQUEST['id'])){
$id = mysql_escape_string($_REQUEST['id']);
$title = mysql_escape_string($_POST['title']);
$content = $_POST['fckeditor1'];
$sql = "update content set  title = '$title', content = '$content', cdate = current_timestamp() where id = $id";
if($result = mysql_query($sql)){
	echo "<div align=center class=blaktxt>The $title page has been updated</div>";	
	listpages();
}
}



}

function getImage1($image){
	if(isset($_REQUEST['id'])){
		if($image == "getImage"){
			$colname = "image";
		}
		if($image == "getImage2"){
			$colname = "image2";
		}

		$id = $_REQUEST['id'];
		$sql = "select title, cdate, $colname from content where id = $id";
	       $result = mysql_query($sql);	
		$myrow = mysql_fetch_array($result);
?>
<tr>
<td>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a></td>
</tr>

<tr>
<td align="center">
You are now editing the main image for the <b><?php echo $myrow['title'];?></b> page<br>
This page was last edited on <b><?php echo $myrow['cdate'];?></b> <br>
Current image is <b><?php echo $myrow['image'];?></b></td>
</tr>

<tr>
<td>
<img src="../images/<?php echo $myrow['image'];?>"></td>
</tr>
<tr>
<td align="center">
<hr>
Upload new image here!
<form name="upload1" method="post" enctype="multipart/form-data" action="pages.php?mode=uimage">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="title" value="<?php echo $myrow['title']; ?>">
<input type="file" id="file1" name="file1">
<input type="submit" name="update" value="update">
</form>
<hr>
</td>
</tr>
</table>



<?php
	
	
	}
}

function uImage1($image){
	$uploaddir = '../rightimage/';
	$uploadfile = $uploaddir . basename($_FILES['file1']['name']);
	if(($_FILES['file1']['type'] == "image/gif")||($_FILES['file1']['type'] == "image/jpeg")){
		if (move_uploaded_file($_FILES['file1']['tmp_name'], $uploadfile)) {
			if(isset($_REQUEST['id'])){
				$id = $_POST['id'];
				$title = $_POST['title'];
				$filename = $_FILES['file1']['name']; 
				$sql = 'update content set '. $image  . ' = \'' . $filename .'\' where id = ' . $id;
				$result = mysql_query($sql);
			}

?>
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td align="center">
Image file for the <?php echo $title; ?> page was successfully uploaded
<img src="../images/<?php echo $_FILES['file1']['name'] ?>"><br>
</td>
</tr>
</table>
<?php
		listpages();

		} else {
		    echo "An error occured while uploading, please try again";
		}
	}
	else{
		echo "The file type you have entered is not valid";	
	}
}



function newpage(){
?>
<form name="page" id="page" method="post" action="pages.php?mode=addpage">
<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">Go Back</a>
</td>
</tr>
<tr>
<td colspan=2 align='center'>You are now adding a new page</td>
</tr>
<tr><td>Title:</td><td><input type="text" name="title" value=""></td></tr>
<tr><td>Content:</td>
<td><textarea cols="80" rows="25"  name="content"></textarea></td></tr>
<tr><td colspan=2 align="center"><input type="submit" name="submit" value="Add Page"></td></tr>
<form>
<table>
<hr align="center" width="80%" noshade="noshade">
<?php
}


function addpage(){
	$title = mysql_escape_string($_POST['title']);
	$content = $_POST['content'];
	$sql = "insert into content (title, content) values ('$title','$content')";
	
	if(mysql_query($sql)){
		echo "<div align=center>New page has been added</div>";			
	}
	else{
		echo "<div align=center>Operation Failed!!</div>";			
	}
	listpages();	
}




function getlinkto($id){
	$sql = "select * from content order by id";
	$result = mysql_query($sql);
		while($myrow = mysql_fetch_array($result)){
			echo '<option value=' . $myrow['id'];
				if($id == $myrow['id']){
					echo ' selected';	
					echo '>' . $myrow['title'] . '  (SELF)</option>';	
				}
				else{
					echo '>' . $myrow['title'] . '</option>';	
				}
		}
}

?>
