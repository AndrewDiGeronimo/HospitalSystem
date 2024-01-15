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
$patid = $_GET['patid'];
$sql = "select * from patient where PatientID='$patid'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();
$PatientID = $row['PatientID'];
$Patient_Name = $row['Patient_Name'];
$Patient_Address = $row['Patient_Address'];
$Diagnosis = $row['Diagnosis'];


echo "
<body>
    <h2> Edit Existing Patient </h2>
  <form id='subForm' action='editPatientScript.php?patid=$patid' method='post' class='center'>
  <table class='center'>
		<tr>
			<td> Patient ID: <td>
			<td> <input style = 'background-color:#b3c2c9' type = 'text' name ='PatientID' value = '$PatientID' readonly> </td>
		</tr>
        <tr>
            <td> Patient Name: <td>
			<td> <input type = 'text' name ='Patient_Name' value = '$Patient_Name'> </td>
		</tr>
		<tr>
			<td> Patient Address: <td>
			<td> <input type = 'text' name ='Patient_Address' value = '$Patient_Address'> </td>
		</tr>
        <tr>
            <td> Diagnosis: <td>
			<td> <input type = 'text' name ='Diagnosis' value = '$Diagnosis'> </td>
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