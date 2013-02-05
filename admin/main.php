<?php
include "includes/header.php";
include "includes/users.lib.php";
?>
  <tr>
    <td>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#970F01" class="bordertop">
      <tr height="30">
        <td width="26%" align="center" class="whitebold" >User Management </td>
        <td width="74%" align=right><a href='main.php?mode=new'>Add User</a></td>
      </tr>
    </table>
</td>
  </tr>
  <tr >
  <td valign="top">
  <?php
choosefunction();
?>
</td>
</body>
</html>
