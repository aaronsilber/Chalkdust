<?php
  function newpage($authcheck)
  {
    session_start();
    if (authcheck && isset($_SESSION["authed"]) != true)
    {
      header("Location: index.php");
      exit;
    }
  }
?>