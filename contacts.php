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
include "includes/header.php";
include "includes/contacts.lib.php";
?>
<tr>
<?php include "includes/leftmenu.php";?>
<td bgcolor="#FBB74A" valign="top" width="380">
<?php


choosefunction();


 ?>
</td>

<?php include "includes/rightmenu.php";?>
</tr>

<?php include "includes/footer.php";?>

