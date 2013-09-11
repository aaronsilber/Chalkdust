<?php include("func.php"); newpage(true); ?>
<?php $pagetitle = "Admin Panel"; include("header.php"); ?>
You are currently logged in as the <b>super admin</b>. Be careful!<br /><br />

<a href="hasher.php">Generate Hashes</a><br />
Generate SHA-1 hashes from small strings. Password internals.<br /><br />

<a href="querious.php">SQL Input</a><br />
Send direct MySQL commands to the database. Dangerous!!<br /><br />

<a href="logs.php">Review Logs</a><br />
Access access, user, and query logs.<br /><br />

<a href="dash.php">Dashboard</a><br />
Return to the normal dashboard.<br /><br />
<?php include("footer.php"); ?>
