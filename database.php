<?php
/* File: database.php
 * Author: Aaron Silber
 * Description: Provide database functions and helper tools.
 * 				Database login hardcoded here. From scratch.
 */


/*
 * Function: connectDB()
 * Description: connect to the database, initialize the global
 * 				mysql handle. exits on fatal error
 */
function connectDB()
{
	//define database connection settings
  	$DB_NAME = 'db_name';
 	$DB_HOST = 'localhost';
  	$DB_USER = 'username';
 	$DB_PASS = 'password';
  
 	//let's reference the global handle, not the local one
  	global $handle;
 	try
 	{
 		//perform the connection
  		$handle = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 	}
 	catch (Exception $e)
  	{
 	 	echo "Sorry... there was an issue connecting to the database. Please refresh this page in a few seconds.<br />" .
	    	"If this issue does not self-resolve soon, something is wrong internally.";
 	 	exit; //fatal connection errors should exit
 	}
  
  	if (mysqli_connect_errno())
  	{
    	echo "FATAL ERROR: Connection failure. Please refresh. <br />";
    	echo "details: " . mysqli_connect_error();  
  		exit; //same as catch, fatal errors should exit
  	}
}

/*
 * Function: numRows()
 * Description: returns the number of rows in table voter_data
 */
function numRows()
{
	//use global handle variable
	global $handle;
	
	//query to count all the rows in voter_data
    $query = "SELECT COUNT(row_id) FROM voter_data;";
    //perform the query on the database
    $result = $handle->query($query) or die($handle->error.__LINE__);

    
    if($result->num_rows > 0)
    {
    	//get one (the only) row of results
    	$row = $result->fetch_assoc();
    	//get this row as an array
        $vals = array_values($row);
        //return our count 
        return $vals[0];  
	}
    else
    {
    	return 0; //for whatever reason, didn't find ANY rows
    }       
}

/* Function: queryDB($query)
 * Description: simple - perform the query, and return the results.
 */
function queryDB($query)
{
	//use global handle
  	global $handle;
  	
  	//get result or exit with error
  	$result = $handle->query($query) or die($handle->error.__LINE__ .  "\r\n;" . $query);
  	//return resultant data
 	return $result;
}

/* Function: getErrors()
 * Description: return the current error tied to the mysql handle
 */
function getErrors()
{
	return $handle->error;
}
  
/* Function: sanitize($data)
 * Description: utilize mysqli's string escaping safety function
 */
function sanitize($data)
{
	//use global handle
    global $handle;

    //check if $handle has been set
    if (isset($handle) == false)
    {
    	//oops! connect to the database.
      	connectDB();
  	}
    
  	//return the "sanitized" escaped string
  	return $handle->real_escape_string($data);
}
?>
