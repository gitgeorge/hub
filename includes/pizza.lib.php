 <script language="Javascript">
function xmlhttpPostCa(strURL,formid) {
   var notwaiting = "<img align=center src=images/spinner.gif><font color = red>Please Wait...</font>";
    document.getElementById("notwaiting").innerHTML = notwaiting; 

    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepageCa(self.xmlHttpReq.responseText);
			
        }
		
    }
    self.xmlHttpReq.send(getquerystringCa(formid));
	
}

function getquerystringCa(formid) {
    var form     = document.forms[formid];
    qstr = 'mode=del&w=' + formid;  // NOTE: no '?' before querystring
    return qstr;
}

function updatepageCa(str){
   document.getElementById("notwaiting").innerHTML = '';
	document.getElementById("shopping").innerHTML = str;
	 
}

</script>


<?php
function choosefunction(){
	if(isset($_REQUEST['mode'])){
		$mode = $_REQUEST['mode'];
		switch ($mode){
			case "orderform":
			orderform();
			break;

		}
	}
	else{
		listpizza();
	}
}


function listpizza(){

$sql = "select * from pizza";
$result = mysql_query($sql);
echo '<table>';
while($myrow = mysql_fetch_array($result)){
echo '<tr>';
echo '<td><img src="pizzas/' . $myrow['image'] . '"></td><td>' . $myrow['descrip'] . '</td></tr>';
echo '<tr><td>' . $myrow['name'] . '</td></tr>';
echo '<tr><td><a href="#" onclick=\'JavaScript:xmlhttpPostCa("addcart.php","'. $myrow['id'] .'")\' class="blue">Order This</a></td></tr>';

}
echo '</table>';

}


function getbanner(){
$sql = "select * from banners order by rand() limit 1;";
$result = mysql_query($sql);
$myrow = mysql_fetch_array($result);
$banner = $myrow['image'];
return $banner;


}

function orderform(){
$id = $_COOKIE['pizza-user'];
$sql = "update orders set pizzastatus = 1 where user_id = $id";
if(mysql_query($sql)){
echo 'Your order has been received.Delivery will be done within the next 30min.';

}
else{
mysql_error();
}

}

//choosefunction();
?>
