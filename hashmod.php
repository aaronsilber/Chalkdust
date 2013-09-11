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

<?php
  include("database.php");
  connectDB();
  
  $hash = $_POST["hash"];
  $salt = $_POST["salt"];
  $user = $_POST["username"];

  //disclaimer: we do not santize authenticated admin commands to the SQL server. watch out.
  
  //$query = "UPDATE  `campaign_demo`.`auth` SET  `password` =  'insertblowfishcrypt2' WHERE  `auth`.`user_id` =1;";
          
  //$query = "INSERT INTO `campaign_demo`.`auth` (`user_id`, `username`, `password`, `salt`) VALUES (NULL, 'testing', 'insertblowfishcrypt', 'saltysalt');";
  
  $query = "SELECT user_id FROM auth WHERE username='" . $user . "';";
  $result = queryDB($query);
  $numusers = count($result->fetch_array());
  
  if ($numusers != 0)
  {
    //update the field
    $query = "UPDATE campaign_demo.auth SET password = '" . $hash . "', salt = '" . $salt . "' WHERE username='" . $user . "';";
    echo "Updating existing user record...<br />";
  }
  else
  {
    //create new user
    $query = "INSERT INTO campaign_demo.auth (user_id,username,password,salt) VALUES (NULL,'" . $user . "','" . $hash . "','" . $salt . "');";
    //echo "This is our query: " . $query . "<br />";
    echo "User not found in database. Created new row.<br />";
  }
  queryDB($query);
  
  echo "Successfully augmented authentication table!<br /><br />";
  ?>

<?php include("footer.php"); ?>
