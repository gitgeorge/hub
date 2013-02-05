<?php
include "includes/dbconnect.php";

function choose(){
if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];	
		switch($mode){
			case "getarticles":
			getarticles();
			break;
			case "1":
			listnews();
			break;
			case "logout":
			logout();
			break;


		}
	}

}

function listnews(){

//echo "News:";
	$sql = "select *, date_format(newsdate, '%D %M, %Y') as mydate from news order by mydate limit 1";
//echo $sql;
	$result = mysql_query($sql);
//echo mysql_error();	
if(mysql_num_rows($result) == 0){
echo "&nbsp;There is no news to display";
}
else {	
echo '<table align="center">';
while($myrow = mysql_fetch_array($result)){
echo '<tr><td><img src="admin/images/newsletter/' . $myrow['image'] . '" align="left" vspace=3 hspace=3 class="blackbox" width="280" height="200"/> &nbsp;&nbsp;</td></tr>';
echo '<tr><td align="center">'.stripslashes($myrow['title']) . '&nbsp;</span></td></tr>';
echo '<tr><td>' .$myrow['fullstory'] .'</td></tr>' ;    
      
}
echo '</table>';
}
}

function getarticles(){

	if(isset($_REQUEST['id'])){
		$id =  mysql_escape_string($_REQUEST['id']);
		$sql = "select * from news where id = $id";
		
		$result = mysql_query($sql);
		$myrow = mysql_fetch_array($result);
		
		 ?>
      <div align="right"><a href="javascript: history.back();" class="blue"><img src="admin/images/back.png" align="top" border="0"><strong> Back &nbsp;&nbsp;&nbsp;</strong></a></div>
     <?php

	 	  
	  echo '<div class=bluetext>' .  stripslashes($myrow['title']) . '</div>';
	  
	  echo ' <div class="content" valign="top">';
	  if ($myrow['image'] != "")
	  {
	  echo '<img src="admin/images/newsletter/' . $myrow['image'] . '" align="left" vspace=3 hspace=3 class="blackbox"/> &nbsp;&nbsp;';
	  }
	  echo  stripslashes($myrow['fullstory']) . '</div>';


	}

}



function logout(){

setcookie("pizza-user","",time() -3600);
header("Location: index.php");
}
?>
