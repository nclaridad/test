<?php

$dbhost = "localhost";
$dbuser = "nclaridad";
$dbpass = "root";
$dbname = "ajax";
	
//Connect to MySQL Server
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (mysqli_connect_errno())
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve data from Query String
$firstName  = $_GET['firstName'];
$lastName   = $_GET['lastName'];
$gender     = $_GET['gender'];
	
// Escape User Input to help prevent SQL Injection
$firstName  = mysqli_real_escape_string($con, $firstName);
$lastName   = mysqli_real_escape_string($con, $lastName);
$gender     = mysqli_real_escape_string($con, $gender);
	
//build query
$query = "SELECT * FROM ajax_example WHERE gender = '$gender'";

	
//Execute query
$qry_result = mysqli_query($con, $query) or die(mysqli_error($con));

//Build Result String
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>First Name</th>";
$display_string .= "<th>Last Name</th>";
$display_string .= "<th>Gender</th>";
$display_string .= "</tr>";

// Insert a new row in the table for each person returned
while($row = mysqli_fetch_array($qry_result)){
   $display_string .= "<tr>";
   $display_string .= "<td>". $row['firstName'] . "</td>";
   $display_string .= "<td>". $row['lastName'] . "</td>";
   $display_string .= "<td>". $row['gender'] . "</td>";
   $display_string .= "</tr>";
}

echo "Query: " . $query . "<br />";
$display_string .= "</table>";

echo $display_string;
?>