<?php
  
  //include("header.php");
  session_start();
  
  if ($_SESSION["authed"] == true)
  {
    session_unset();
    session_destroy();
  }
  
  header("Location:index.php");
  exit;
?>