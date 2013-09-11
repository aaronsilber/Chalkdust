
<?php
  //if authenticated
  if ($_SESSION["authed"] == true)
  {
    //username "admin" then give admin button!
    if ($_SESSION["username"] == "admin")
    {
      //echo admin link
      echo "<a href='admin.php'>Admin Tools</a><br />";
    }
    
    //echo logout link
    echo "<a href='exit.php'>Log Out</a>";
  }
?>
</div>
</body>
</html>

