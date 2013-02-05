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
			case "getorder":
			getorder();
			break;

		}
	}
	else{
		listorders();
	}
}



function listorders(){
//	global $temp;
$sql = "select * from orders where pizzastatus = 1 group by user_id";
	if($result = mysql_query($sql)){
	$temp = mysql_query($sql);
?>
<table  align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="blaktxt">
<tr bgcolor="#8EBACA">
<th align="left" bgcolor="#8EBACA">ORDER NUMBER</th>
<th>VIEW</th>
<th>&nbsp;</th>
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
echo  $myrow['user_id'] .'</td>';
echo '<td width="70" align=center><a href=orders.php?mode=getorder&id=' .$myrow['user_id'] . ' class="list">View</a></td>';
//echo '<td width="70" align=center><a href=pizza.php?mode=delete&id=' .$myrow['id'] . ' class="list">Delete</a></td>';
echo '</tr>';
$counter = $counter * -1;
		}
?>



<?php

	}
}






function getorder(){
if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$sql = "select orders.*,firstname,lastname,address,name from orders join users on users.id = orders.user_id join pizza on pizza.id = orders.item where orders.user_id = $id and pizzastatus = 1;";
//echo $sql;
	$result = mysql_query($sql);
	$myrow = mysql_fetch_array($result);
	echo '<table width="100%">';
	echo '<tr><td align="center"><font color="red">RECEIPT</font></td></tr>';
	echo '<tr><td align="center">NAMES</td><td>' . $myrow['firstname'] .' ' .$myrow['lastname'] . '</td></tr>';
	echo '<tr><td align="center">ADDRESS</td><td>' . $myrow['address']. '</td></tr>';
	echo '<tr><td colspan="2"><hr></td></tr>';
	echo '<tr><td>YOU ORDERED</td></tr>';
	$sql = "select orders.*,firstname,lastname,address,name from orders join users on users.id = orders.user_id join pizza on pizza.id = orders.item where orders.user_id = $id and pizzastatus = 1;";
	$result = mysql_query($sql);
	while($myrow = mysql_fetch_array($result)){	
	echo '<tr>';
	echo '<td align="center">&nbsp;</td><td>' . $myrow['name']. '</td><td>' .$myrow['price'] .'</td></tr>';

		}
	}
}







?>
