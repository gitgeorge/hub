<?php
include "includes/dbconnect.php";

function addtoc(){
if(isset($_COOKIE['pizza-user'])){
$userid = $_COOKIE['pizza-user'];
}
	$id = $_REQUEST['w'];
	$sql ="select * from pizza where id =$id";
	$result = mysql_query($sql); 
	$myrow = mysql_fetch_array($result);
	$name = $myrow['name'];
	$price = $myrow['price'];
//	echo $name;
	$id = mysql_real_escape_string($_REQUEST['w']);
	$sql = "insert into orders (item,user_id,price,pizzastatus) values('$id','$userid','$price',0)";
//echo $sql;	
	mysql_query($sql);

}



function getcart(){
	echo '<br>';
	
$userid = $_COOKIE['pizza-user'];
//$shopid = $cookie['shopid'];
$qstring = '';

$sql = "select count(item) as no,orders.*, name from orders join pizza on pizza.id = orders.item where user_id = $userid and pizzastatus = 0 group by item";
//echo $sql;
if($result = mysql_query($sql)){
$itemnos = mysql_num_rows($result);
if(mysql_num_rows($result) == 0){
	 echo '&nbsp;&nbsp;No order has been made';
	 
}
else{
	
	$subtotal = 0;
	$bgcolor = array(1 => "#dcdcdc", -1 => "#ffffff");
	$counter = -1;
	$itemno = 0;
	
	echo '<table cellspacing="0px" cellpadding="10px" align="center" width="90%"><div id="notwaiting"> </div>';
	while($myrow = mysql_fetch_array($result)){
	
	//$qstring = $qstring . '=' . $myrow['coid'] . 's' . $quantity . '=' . $myrow['no'];

	$itemno = $itemno + 1;
	
	
	echo '<tr bgcolor=' . $bgcolor[$counter] . '><td class="blue">&nbsp;&nbsp;' . $myrow['name'] . '(' . $myrow['no'] . ') </td>';
	echo '<td><a href="#" onclick=\'JavaScript:xmlhttpPostCa("editcart.php","'. $myrow['id'] .'")\' class="blue">Edit</a></td></tr>';	
		$price = $myrow['price'] * $myrow['no'];
		$subtotal = $subtotal + $price;
		$counter = $counter * -1;
	}
	echo '<span class="bluetext">&nbsp;&nbsp;Total: $' . number_format($subtotal, 2 , '.', '');
	echo '</span></table>';
	
	
	
	
	
	echo '<table cellspacing="0px" cellpadding="10px">';
	echo '<tr><td colspan=2>';
		echo '<form name=order id=order method=post action="pizza.php?mode=orderform">';
		echo '<input type=submit name=order value="&nbsp;&nbsp;Place Order">';
		echo '</form>';
	echo '</td></tr>';

	echo '</table>';
}
}
}



addtoc();
getcart();
?>
