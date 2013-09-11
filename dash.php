<?php
//begin our session again
session_start();

//if not authenticated...
if (isset($_SESSION["authed"]) != true)
{
	//force client to forward to index.php
	header("Location: index.php");
	//terminate script
	exit;
}

//set page title and include the page header
$pagetitle = "Database Dashboard"; include("header.php");
//include database functions
include("database.php");
//connect to database
connectDB();

//echo number of loaded rows
echo "Loaded " . numRows() . " entries.";

// set up query form below!!

?>
<br /><br />
Voter Lookup<br />
<form action="search.php" method="POST">
<table style="display:block; margin-left:auto; margin-right:auto;">
<tr><td><input type="radio" name="field" value="first_name" /></td>
<td><input type="radio" name="field" value="last_name" checked /></td>
<td><input type="radio" name="field" value="address" /></td>
  <td><input type="radio" name="field" value="phone" /></td></tr>
  <tr><td>first name</td><td>last name</td><td>address</td><td>phone</td></tr>
</table>
<table style="display:block; margin-left:auto; margin-right:auto;">
<tr><td><input type="radio" name="operation" value="like" /></td>
<td><input type="radio" name="operation" value="exactly" checked /></td></tr>
<tr><td>contains</td><td>is exactly</td></tr>
</table>
<input type="text" name="entry" /><br />
<br />
Filtering:
<table style="display:block; margin-left:auto; margin-right:auto;">
<tr><td><input type="checkbox" name="affon" /></td>
<td><select name="aff">
<option value="DEM" selected>DEM</option><option value="BLK">BLK</option>
<option value="REP">REP</option><option value="IND">IND</option>
<option value="CON">CON</option>
</select></td></tr>
<tr><td><input type="checkbox" name="voteron" /></td>
<td><select name="voter">
<option value="true" selected>Is Voter</option><option value="false">Not Voter</option>
</select></td></tr>
</table>

<br />
<input type="submit" value="Query" />
</form>

<?php include("footer.php"); ?>
