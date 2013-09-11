<?php
   include_once("logging.php");
/* File: login.php
 * Author: Aaron Silber
 * Description: Heavy lifting of user authentication. Take in usernames and passwords,
 *         and perform a query for the username. If it exists, does the Blowfish
 *         hash of the password match? If not, offer to try again.
 */

//include database functions
include("database.php");

//connect to the database!
connectDB();

  global $expiry;
  $expiry = 60 * 30; //half hour expiration
//if not accessed through the index.php "login"...
if (isset($_POST["username"]) == false)
{
  //force client back to login
  header("Location: index.php");
  
  //exit script
  exit;
}

//get raw username from POST variables
$username = $_POST["username"];
  
  
//build a query to return passwords and salt for applicable usernames
//note this does use a sanitized username! BE CAREFUL HERE!
$query = "SELECT password,salt FROM auth WHERE username='" . sanitize($username) . "';";
//perform query
$result = queryDB($query);

if ($result->num_rows < 1)
{
  dolog("notice","security","IP " . $_SERVER['REMOTE_ADDR'] . " attempted to login with nonexistant username '" . $username . "'");
  $find = false; //username does not exist
}
else
{
  //get array of query results
  $returned = $result->fetch_array();
  
     //variables from database
    $salt = $returned[1];
    $rightpass = $returned[0];
    
    //password as submitted by user
    $inpass = $_POST["password"];
    
    //compute a salted hash with: submitted password and valid salt
    $genhash = crypt($inpass, $salt);
    
    //is the computed hash equal to the known one?
    if (strcmp($genhash,$rightpass) == 0)
    {
      $find = true; //authentication passes
    }
    else
    {
        $find = false; //authentication fails
    }
}

if (($find === FALSE) != true)
{
  if ($find === true)
  {
    //initializing the session can be a tad tricky
    //and finicky sometimes.
    
    //start that session!
    $started = session_start();
    //unset any previously defined variables
      session_unset();
      //note in session that user is authenticated
    $_SESSION["authed"] = true;
    //note in session the logged in username
    $_SESSION["username"] = $username;
    
    $_SESSION["expires"] = time() + $expiry;//session expiration timestamp
    
    //flush the cache, etc. etc. may not be necessary
    session_write_close();
    
    //tell the client to refresh in 2 sec to dash.php
    header("Refresh: 2; url=dash.php\r\n");
  }
  else
  {
     $_SESSION["authed"] = false; //record session as failed auth
  }
}
else
{
  $_SESSION["authed"] = false; //authentication fail (no username found)
}

//END HEAVY LIFTNG AREA

//set page title and include page header
$pagetitle = "Authentication"; include("header.php");

//if authentication has been successful...
if ($_SESSION["authed"] == true)
{
  //echo welcome message
   echo "Welcome, " . $username . "! Redirecting you...<br />";
}
else
{
  //provide link to re-try authentication
  echo "Sorry, but the credentials provided were invalid.<br /><a href='index.php'>Try Again</a>";
}

//include page footer
include("footer.php");

?>
