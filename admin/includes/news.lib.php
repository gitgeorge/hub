<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="jscripts/tinyMCEinit.js"></script>

<style type="text/css">
<!--
.style1 {color: #990000}
-->
</style>


<tr>
    <td>
	<table width="100%" border="0" class="bordertop" cellspacing="0" cellpadding="0">
      <tr height="30">
        <td width="26%" align="center" class="whitetext">News Management </td>
    <td width="74%" align="right"><span class="style1"><a href="news.php?mode=addnew">Add New Story&nbsp;&nbsp;&nbsp;&nbsp;</a> </span></td></tr>
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
			case "addnew":
			addnew();
			break;
			case "insert":
			insert();
			break;
			case "delete":
			delete();
			break;
			case "image":
			image();
			break;




		}
	}
	else{
		listnews();
	}
}


function listnews(){
$sql = "select *, date_format(newsdate,'%M %D, %Y') as ndate from news order by ndate asc";
	if($result = mysql_query($sql)){
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr bgcolor="#8EBACA">
<th align="left">TITLE</th>
<th align="left">NEWS DATE</th>
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
echo '<tr bgcolor=' . $bgcolor . '><td>';
echo  $myrow['title'] . '</td>';
echo '<td  align=left>' . $myrow['ndate'] . '</td>';
echo '<td width="70" align=center><a href=news.php?mode=getpage&id=' .$myrow['id'] . ' class="list">Edit</a></td>';
echo '<td width="70" align=center><a href=news.php?mode=delete&id=' .$myrow['id'] . ' onclick="return confirm(\'Are you sure you want to delete?\')" class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
		}
?>
</table>
<?php

	}
}


function getpage(){
if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$sql = "select * from news where id = $id";
	if($result = mysql_query($sql)){
		if($myrow = mysql_fetch_array($result)){	
?>
<form name="page" id="page" method="post"  enctype="multipart/form-data" action="news.php?mode=update&id=<?php echo $id;?>">

<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">GO BACK</a>
</td>
</tr>


<tr>
<td colspan=2 align='center'>
<p style="font-size:14px">You are Editing the '<strong><?php echo stripslashes($myrow['title']);?></strong>' Page</p></td>
</tr>

<tr>
<td>
        <table width="90%" border="0" cellspacing="2" cellpadding="0">
        <tr>
        <td><span class="style1">Title:</span></td>
        <td>
        <input type="text" name="title" value="<?php echo stripslashes($myrow['title']);?>">
        </td>
        </tr> 
        <tr><td> Date:</td><td><input type="text" id="dateinput" name="dateinput" value="Click here to select" editable=false >
                    <!-- Include jQuery -->
                    <script src="admindate/jquery.js" type="text/javascript" charset="utf-8"></script>	
                    
                    <!-- Include Core Datepicker JavaScript -->
                    <script src="admindate/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
                    <script src="admindate/ui.datepicker.css" type="text/javascript" charset="utf-8"></script>	
                    
                    <!-- Attach the datepicker to dateinput after document is ready -->
                    <script type="text/javascript" charset="utf-8">
                        jQuery(function($){
                            $("#dateinput").attachDatepicker();
                        });
                    </script><?php echo $myrow['newsdate'];?></td></tr> 
         <tr><td><span class="style1">Upload picture [size 140 x 120 pixels]:</span></td><td> <input name="uploadedfile" type="file" /><?php echo $myrow['image'];?></td></tr>       
        </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0">
  
<tr>
<td colspan="2"><br />
		<span class="style1">Summary:</span>
        <hr align="left" width="200" size="1" noshade="noshade" />        </td></tr>
<tr>
    <td><textarea cols="100" rows="10"  name="summary"><?php echo stripslashes($myrow['summary']);?></textarea></td>
  </tr>
 
</table>


</td>
</tr>

<tr>
<td>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td><span class="style1">Full Story:</span>
    
      <hr align="left" width="200" size="1" noshade="noshade" />
    </td>
    </tr>
    <tr>
    <td><textarea cols="130" rows="40"  name="content"><?php echo stripslashes($myrow['fullstory']);?></textarea>

</td>
  </tr>
</table>


  <br />
  <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td>
      <hr align="center" width="200" size="1" noshade="noshade" />
    </td>
    </tr>
    <tr>
    <td align="center">
    <input type="submit" name="submit" value="UPDATE">
	</td>
  </tr>
  <tr>
  <td>
  
  <hr align="center" width="30%" size="1" noshade="noshade" />
  
  </td>
  </tr>
</table>



  
  </td></tr>


</form>
</table>
<hr align="center" width="80%" size="1" noshade="noshade" />
<?php
		}
	}
}
	listnews();
}




function update(){
if(isset($_REQUEST['id'])){
$id = mysql_escape_string($_REQUEST['id']);
$title = mysql_escape_string($_POST['title']);
$summary = mysql_escape_string($_POST['summary']);
$fullstory = mysql_escape_string($_POST['content']);
$picture = basename($_FILES['uploadedfile']['name']);


if($dateinput == ""){
$cors= "";
}
else{
$cors= ",  newsdate = '" . $dateinput . "'";
}


//echo $picture;
	$tempfilename = $picture;
	$uploaddir = 'images/newsletter/';
	$counter = 1;
	
	while($counter <=  100){
	$uploadfile = $uploaddir . $picture;
	if(file_exists($uploadfile)){
		$picture = preg_replace('/\./','_' . $counter . '.',$tempfilename);
	}
	else{
		break;
	}
	$counter++;
	}
	
	echo '<pre>';
	if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $uploadfile)) {
		
		
		$sql = "update news set title = '$title', summary = '$summary', fullstory = '$fullstory', image = '$picture' $cors where id = $id";
		
		if(mysql_query($sql)){
			echo 'Newsletter "' . $title . '&nbsp;and&nbsp;' . $picture . '" has been updated';			
		}
		else{
			echo "<div align=center>Sorry Error in Image file upload\n</div>";			
		}

	} else
	
	 {
		   $sql = "update news set title = '$title', summary = '$summary', fullstory = '$fullstory' where id = $id";

		
		if(mysql_query($sql)){
			echo 'Newsletter "' . $title . '" has been updated';			
		}
		else{
			echo "<div align=center>Sorry Error occured while updating NewsStory\n</div>";			
		}
	}
	
listnews();


}



}


function addnew(){
?>
<form name="page" id="page" method="post" enctype="multipart/form-data" action="news.php?mode=insert">

<table width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr>
<td colspan=2 align='left'>
<a href="javascript: history.back();" class='list'><img src="images/back.png" align="top" border="0">GO BACK</a>
</td>
</tr>


<tr>
<td colspan=2 align='center'>You are now adding a new article</td>
</tr>


<tr><td>Title:</td><td><input type="text" name="title" value=""></td></tr>

<tr><td> Date:</td><td><input type="text" id="dateinput" name="dateinput" value="Click here to select" editable=false >
                    <!-- Include jQuery -->
                    <script src="admindate/jquery.js" type="text/javascript" charset="utf-8"></script>	
                    
                    <!-- Include Core Datepicker JavaScript -->
                    <script src="admindate/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
                    
                    <!-- Attach the datepicker to dateinput after document is ready -->
                    <script type="text/javascript" charset="utf-8">
                        jQuery(function($){
                            $("#dateinput").attachDatepicker();
                        });
                    </script></td></tr> 

<tr><td>Upload picture [size 140 x 120 pixels]:</td><td> <input name="uploadedfile" type="file" /></td></tr>

<tr><td>Summary:</td>
     <td><textarea cols="100" rows="10"  name="summary"></textarea></td>
  </tr>

<tr><td>Content:</td>
     <td><textarea cols="100" rows="40"  name="content"><?php echo $myrow['summary'];?></textarea>

</td>
  </tr>
<tr><td colspan=2 align="center">
<input type="submit" name="submit" value="UPDATE"></td></tr>


</table>
</form>
<hr align="center" width="80%" size="1" noshade="noshade" />
<?php

	listnews();
}


function insert(){
$title = mysql_escape_string($_POST['title']);
$picture = basename($_FILES['uploadedfile']['name']);
$summary = mysql_escape_string($_POST['summary']);
$fullstory = mysql_escape_string($_POST['content']);
$dateinput = mysql_escape_string($_POST['dateinput']);

//echo $picture;
	$tempfilename = $picture;
	$uploaddir = 'images/newsletter/';
	$counter = 1;
	
	while($counter <=  100){
	$uploadfile = $uploaddir . $picture;
	if(file_exists($uploadfile)){
		$picture = preg_replace('/\./','_' . $counter . '.',$tempfilename);
	}
	else{
		break;
	}
	$counter++;
	}
	
	echo '<pre>';
	if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $uploadfile)) {
		
		$sql = "insert into news (newsdate,title,summary,fullstory,image) values ('$dateinput','$title','$summary','$fullstory','$picture');";
		
		if(mysql_query($sql)){
			echo 'Newsletter "' . $title . '&nbsp;and&nbsp;' . $picture . '" has been saved';			
		}
		else{
			echo "<div align=center>Sorry Error in Image file upload\n</div>";			
		}

	} else
	
	 {
		   $sql = "insert into news (newsdate,title,summary,fullstory) values ('$dateinput','$title','$summary','$fullstory');";

		
		if(mysql_query($sql)){
			echo 'Newsletter"' . $title . '" has been inserted';			
		}
		else{
			echo "<div align=center>Sorry Error occured while inserting NewsStory\n</div>";			
		}
	}
	

	listnews();

}


function delete(){
$id = $_REQUEST['id'];
$sql = "delete from news where id = $id;";
if(mysql_query($sql)){
	echo '<div align=center>Item has been deleted</div>';
}
else{
	echo '<div align=center>Operation Failed</div>';

}
	listnews();
}




function image(){

}
?>
