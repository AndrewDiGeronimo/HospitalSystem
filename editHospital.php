<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css" type="text/css">
<title>FDU Hospital Home</title>
</head>
<header>
  <h1> <a href="index.html"><img src="FDUHospitalLogo.png"/></a></h1>
</header>
<nav class="navbar">
  <ul>
<li><a href="index.html">Home</a></li>
<li><a href="about.html">About Us</a></li>
<li><a href="location.html">Location</a></li>
<li><a href="login.html">Sign in</a></li>
</ul>
</nav>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');

if($conn->connect_error){
	die("Connection failed ".$conn->connect_error);
}
$hosid = $_GET['hosid'];
$sql = "select * from Hospital where HospitalID='$hosid'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();
$HospitalID = $row['HospitalID'];
$Hospital_Name = $row['Hospital_Name'];
$Hospital_Address = $row['Hospital_Address'];
$Hospital_City = $row['Hospital_City'];


echo "
<body>
    <h2> Edit Existing Hospital </h2>
  <form id='subForm' action='editHospitalScript.php?docid=$hosid' method='post' class='center'>
  <table class='center'>
		<tr>
			<td> Hospital ID: <td>
			<td> <input style = 'background-color:#b3c2c9' type = 'text' name ='HospitalID' value = '$HospitalID' readonly> </td>
		</tr>
		<tr>
			<td> Hospital Name: <td>
			<td> <input type = 'text' name ='Hospital_Name' value = '$Hospital_Name'> </td>
		</tr>
        <tr>
            <td> Hospital Address: <td>
			<td> <input type = 'text' name ='Hospital_Address' value = '$Hospital_Address'> </td>
		</tr>
		<tr>
			<td> Hospital City: <td>
			<td> <input type = 'text' name ='Hospital_City' value = '$Hospital_City'> </td>
		</tr>
        <tr>
        </table>
    <br>
<input id='button' type='submit' value='submit' />
</form>
";
} else {
	echo "Not Found";
}
$conn->close();
?>