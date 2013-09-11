<?php
session_start();
//print_r($_SESSION);
if (isset($_SESSION["authed"]) != true)
{
header("Location: index.php");
exit;
}
?>

<?php $pagetitle = "Hash Generator"; include("header.php"); ?>
<?php
if ($_SESSION["username"] != "admin")
{
  echo "Sorry. But you're not an admin!<br />";
  exit;
}
  
?>

Enter the string to be hashed (salted Blowfish) below.<br /><br />
  <form action="dohash.php" method="POST">
    <input type="password" name="string" id="input" /><br />
    <input type="button" value="Show Characters" onclick="javascript:document.getElementById('input').type='text';" /><br />
    <input type="submit" value="Generate" />
</form>
<?php include("footer.php"); ?>
