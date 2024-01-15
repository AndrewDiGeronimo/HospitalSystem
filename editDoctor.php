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
$docid = $_GET['docid'];
$sql = "select * from doctor where LicenseID='$docid'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();
$LicenseID = $row['LicenseID'];
$HospitalID = $row['HospitalID'];
$Doctor_Name = $row['Doctor_Name'];
$Specialty = $row['Specialty'];
$User_Type = $row['User_Type'];
$Password = $row['Password'];


echo "
<body>
    <h2> Edit Existing Doctor </h2>
  <form id='subForm' action='editDoctorScript.php?docid=$docid' method='post' class='center'>
  <table class='center'>
		<tr>
			<td> License ID: <td>
			<td> <input style = 'background-color:#b3c2c9' type = 'text' name ='LicenseID' value = '$LicenseID' readonly> </td>
		</tr>
		<tr>
			<td> Hospital ID: <td>
			<td> <input type = 'text' name ='HospitalID' value = '$HospitalID'> </td>
		</tr>
        <tr>
            <td> Doctor Name: <td>
			<td> <input type = 'text' name ='Doctor_Name' value = '$Doctor_Name'> </td>
		</tr>
		<tr>
			<td> Specialty: <td>
			<td> <input type = 'text' name ='Specialty' value = '$Specialty'> </td>
		</tr>
        <tr>
        <td> User Type: <td>
                <td>
                    <select type='text' name='User_Type'>
                      <option value='doctor'>Doctor</option>
                      <option value='admin'>Admin</option>
                    </select>
                </td>
		</tr>
        <tr>
            <td> Password: <td>
			<td> <input type = 'password' name ='Password'> </td>
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