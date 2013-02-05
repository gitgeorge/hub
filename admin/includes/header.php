<?php

if(!isset($_COOKIE['pizza-admin'])){
header("Location: index.php");	
}
header("Expires: Mon, 26 Jul 1922 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
include "includes/dbconnect.php";


$cookie = $_COOKIE['pizza-admin'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Online Pizza - Content Management</title>
<link href="css/cms.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style3 {
	font-size: 14px;
	color: #000000;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
</head>
<body  bgcolor="#FFFFFF">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <td><table width="100%" border="0">
      <tr>
<td align="center" bgcolor="#970F01" height="110" valign="bottom">
<h1><font color="white">Online Pizza - CONTENT MANAGEMENT SYSTEM</font></h1>
</td>
      </tr>
      <tr>
        <td height="31" align="center" class="bordertop">
        <table width="89%" border="0" align="center" class="blaktxt">
          <tr>
            <td width="15%"><strong>User</strong>: <?php echo $cookie['username'];?></td>
            <td width="15%"><strong>Time Logged in:</strong> <?php echo $cookie['logintime'];?></td>
            <td width="15%"><a href="index.php?mode=logout" class='list'><strong>Logout</strong></a></td>
            <td width="15%" align="right"><strong class="blaktxt"><?php echo date('D d F, Y');?></strong></td>
            <td width="15%" align="right"><strong><a href="../index.php" class='list'>View Site</a></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="bordertop">
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FBB74A" >
          <tr height="35">
            <td align="center" ><a href="pages.php" >Pages</a> </td>
            <td align="center" ><a href="pizza.php" >Pizza</a> </td>
            <td align="center" ><a href="orders.php" >Orders</a> </td>
            <td align="center" ><a href="offers.php" >Offers</a> </td>
            <td align="center" ><a href="news.php" >News</a> </td>
            <td align="center" ><a href="banners.php" >Banners</a> </td>
            
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
