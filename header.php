<?php
  include_once("logging.php");
  global $expiry;
  $expiry = 60 * 30; //half hour timeout, ALSO DEFINED IN LOGIN.PHP!!
  global $expired;
  //$expiry = 20; 
  if (isset($_SESSION['username']) && $_SESSION['expires'] < time())
  {
    //echo "EXPIRATION IS " . $_SESSION['expires'] . " BUT TIME IS " . time();
    //session is expired. force reauth
    $expired = true;
    session_unset();
    $pagetitle = "Session Expired";
  }
  else
  {
    $_SESSION['expires'] = time() + $expiry;
    $expired = false;
  }
  $sitetitle = "Chalkdust"; 
  date_default_timezone_set("America/New_York");
  ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="main.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script language="javascript" type="text/javascript" src="scripts.js"></script>
<title><?php if(isset($pagetitle)) { echo $pagetitle . " - " . $sitetitle; } else { echo "Internal Database Access - " . $sitetitle; } ?></title>
</head>
<body>
<div id="headline">
<?php if(isset($pagetitle)) { echo $pagetitle; } else { echo "Internal Database Access"; } ?><br />
</div>
<div id="punchline"></div>
<div id="content">
<?php
  global $expired;
  if ($expired)
  {
    echo "Your session has expired. Please log in again.<br /><br /><a href='index.php'>Re-authenticate</a>";
    echo "</div></body></html>";
    exit();
  }
?>
