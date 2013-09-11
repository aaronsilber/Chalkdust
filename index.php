<?php 
/* File: index.php
 * Author: Aaron Silber
 * Description: Display the login page. Only "unprotected" page on site. (besides auth)
 */

//define title of the page
$pagetitle = "Welcome!";
//include document header
include("header.php");
?>
<form action="login.php" method="POST">
<span class="label">username</span><br /><input type="text" name="username" size="20"/><br />
<span class="label">password</span><br /><input type="password" name="password" size="20"/><br />
<input type="submit" value="Log In" /><br />
</form>
<?php include("footer.php"); //include footer ?>
