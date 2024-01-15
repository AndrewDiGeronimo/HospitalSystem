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
$appid = $_GET['appid'];
$sql = "select * from appointment where AppointmentID='$appid'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();
$AppointmentID = $row['AppointmentID'];
$PatientID = $row['PatientID'];
$LicenseID = $row['LicenseID'];
$Appointment_Date = $row['Appointment_Date'];
$Problem = $row['Problem'];


echo "
<body>
    <h2> Edit Existing Appointment </h2>
  <form id='subForm' action='editAppointmentScript.php?appid=$appid' method='post' class='center'>
  <table class='center'>
		<tr>
			<td> Appointment ID: <td>
			<td> <input style = 'background-color:#b3c2c9' type = 'text' name ='AppointmentID' value = '$AppointmentID' readonly> </td>
		</tr>
		<tr>
			<td> Patient ID: <td>
			<td> <input type = 'text' name ='PatientID' value = '$PatientID'> </td>
		</tr>
        <tr>
            <td> License ID: <td>
			<td> <input type = 'text' name ='LicenseID' value = '$LicenseID'> </td>
		</tr>
		<tr>
			<td> Appointment Date: <td>
			<td> <input type = 'date' name ='Appointment Date' value = '$Appointment_Date'> </td>
		</tr>
        <tr>
        <td> Problem: <td>
        <td> <input type = 'text' name ='Problem' value = '$Problem'> </td>
         </tr>
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