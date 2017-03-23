<?php
// E_ERROR(1);
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "isiachiu";
$dbname = "ajax";
	
//Connect to MySQL Server
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (mysqli_connect_errno())
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve data from Query String
if($_GET){
   $firstName  = $_GET['firstName'];
   $lastName   = $_GET['lastName'];
   $gender     = $_GET['gender'];
} else {
   $firstName  = $_POST['firstName'];
   $lastName   = $_POST['lastName'];
   $gender     = $_POST['gender'];
}

	
// Escape User Input to help prevent SQL Injection
$firstName  = mysqli_real_escape_string($con, $firstName);
$lastName   = mysqli_real_escape_string($con, $lastName);
$gender     = mysqli_real_escape_string($con, $gender);
	
//build query
$query = "SELECT * FROM ajax_example WHERE gender = '$gender'";

	
//Execute query
$qry_result = mysqli_query($con, $query) or die(mysqli_error($con));

//Build Result String
// $display_string = "<table>";
// $display_string .= "<tr>";
// $display_string .= "<th>First Name</th>";
// $display_string .= "<th>Last Name</th>";
// $display_string .= "<th>Gender</th>";
// $display_string .= "</tr>";
$display_string = '';
// Insert a new row in the table for each person returned
$arr = array();
while($row = mysqli_fetch_array($qry_result)){
   // $display_string .= "<tr>";
   // $display_string .= "<td>". $row['firstName'] . "</td>";
   // $display_string .= "<td>". $row['lastName'] . "</td>";
   // $display_string .= "<td>". $row['gender'] . "</td>";
   // $display_string .= "</tr>";
   $arr[] = array(
         'firstName' => $row['firstName'],
         'lastName'  => $row['lastName'],
         'gender'    => $row['gender'],
      );
}

//echo "Query: " . $query . "<br />";
//$display_string .= "</table>";
echo json_encode($arr); //Convert array to JSON(Object Notation)
//echo $display_string;
?>