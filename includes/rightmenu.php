<td bgcolor="#FBB74A" valign="top" width="200">
<table>
<tr>
<td class="ordertable">
<table>
<tr><td>YOUR ORDER</td></tr>
<tr><td><div id="shopping">
<table>
<tr><td><?php 
	echo '<br>';
	
$userid = $_COOKIE['pizza-user'];
//$shopid = $cookie['shopid'];
$qstring = '';

$sql = "select count(item) as no,orders.*, name from orders join pizza on pizza.id = orders.item where user_id = $userid and pizzastatus = 0 group by item";
//echo $sql;
if($result = mysql_query($sql)){
$itemnos = mysql_num_rows($result);
if(mysql_num_rows($result) == 0){
	 echo '&nbsp;&nbsp;Cart is empty';
	 
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
	echo '<td><a href="#" onclick=\'JavaScript:xmlhttpPostCa("removecart.php","'. $myrow['id'] .'")\' class="blue">Remove</a></td></tr>';	
		$price = $myrow['price'] * $myrow['no'];
		$subtotal = $subtotal + $price;
		$counter = $counter * -1;
	}
	echo '<span class="bluetext">&nbsp;&nbsp;Total: $' . number_format($subtotal, 2 , '.', '');
	echo '</span></table>';
	
	
	
	
	
	echo '<table cellspacing="0px" cellpadding="10px">';
	echo '<tr><td colspan=2>';
		echo '<form name=order method=post action="pizza.php?mode=orderform">';
		echo '<input type=submit name=order value="Place Order">';
		echo '</form>';
	echo '</td></tr>';

	echo '</table>';
}
}


?>

</td></tr>
<!--<tr><td>View Order</td></tr>-->
</table>
</div></td></tr>
<tr><td><div id="notwaiting"></div></td></tr>
</table>
</td>
</tr>
<tr>
<td><img src="images/side.jpg" /></td>
</tr>

</table></td>

