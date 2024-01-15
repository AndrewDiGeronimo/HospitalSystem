<!DOCTYPE html>
<html>
<head>
<link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
<li class="active"><a href="login.html">Sign in</a></li>
</ul>
</nav>
<body>

    <?php
	session_start();
@$dbConnect = new mysqli('localhost', 'root', '', 'fduhospital');
if (mysqli_connect_errno()) {
	echo ("<p>Error: Unable to connect to database.</p>" .
			"<p>Error code $dbConnect->connect_errno: $dbConnect->connect_error. </p>");
	exit;
	}
 
// get data from the input boxes 
$licenseID = $_POST['ID'];
$password = $_POST['password'];
//$type = $_POST['type'];

if ($licenseID == '' || $password == '') {
    echo "<p>You have not entered all the required information. </p>";
    exit;
}

else {
	$user=$_POST['ID']; 
	$pass=$_POST['password']; 
	//$type=$_POST['type']; 

	$ret=mysqli_query( $dbConnect, "SELECT * FROM doctor WHERE LicenseID='$user' AND Password='$pass'") or die("Could not execute query: " .mysqli_error($conn)); 
	$row = mysqli_fetch_assoc($ret); 
	if(!$row) { 
		$ret2=mysqli_query( $dbConnect, "SELECT * FROM patient WHERE Username='$user' AND Password='$pass'") or die("Could not execute query: " .mysqli_error($conn));
		$row2 = mysqli_fetch_assoc($ret2);
		if(!$row2){
			echo "<p>Incorrect Password </p>";
			header("Location: login.html");
		}
		else {
			$_SESSION["ID"] = $user;
			$_SESSION["password"] = $pass;
			$_SESSION["PatientID"] = $row2['PatientID'];
			$_SESSION["type"] = $row2['User_Type'];
			$_SESSION["name"] = $row2['Patient_Name'];
		}
	}
	else {
		$_SESSION["ID"] = $user;
		$_SESSION["password"] = $pass;
		$_SESSION["type"] = $row['User_Type'];
		$_SESSION["name"] = $row['Doctor_Name'];
		if ($_SESSION['type'] == 'Admin') {
			echo "<p> You have admin privileges! </p>";
		}
	}
} 
?>

<div id=header>
	<h1>Hello  <?php echo $_SESSION['name'] ?></h1>

	<?php

 $data = mysqli_query(@$dbConnect, "SELECT * FROM patient order by PatientID") 
 or die("Unable to select data"); 
 if ($_SESSION['type'] == 'Doctor' || $_SESSION['type'] == 'Admin'){
	echo '<h2>Patient Table</h2>';
	echo'</div>';
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Name</th>";
	echo "<th>Address</th>";
	echo "<th>Diagnosis</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['PatientID'] . "</td>";
 echo "<td>".$info['Patient_Name'] . " </td>";
 echo "<td>".$info['Patient_Address']. " </td>";
 echo "<td>" .$info['Diagnosis']. " </td>";
 echo "<td> <a href='editPatient.php?patid=".$info['PatientID']."'>edit</a> </td>";
 echo "<td> <a href='deletePatient.php?patid=".$info['PatientID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addPatient.html' method='post'>";
 echo"<input id='button' type='submit' value='Add Patient' />";
 echo "</form>";
}
 ?>
<br>


<?php
//display medical records (user specific)
if ($_SESSION['type'] == 'Patient') {
$PatientID = $_SESSION['PatientID'];
$data = mysqli_query(@$dbConnect, "SELECT * FROM Medical_Record WHERE PatientID = '$PatientID' order by RecordID") 
or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Your Medical Records</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Record ID</th>";
	echo "<th>Examination Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['RecordID'] . "</td>";
 echo "<td>".$info['Examination_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "</tr>";
 }
 echo "</table>";
}
 ?>


<?php
//display medical records (doctor specific)
if ($_SESSION['type'] == 'Doctor') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Medical_Record WHERE LicenseID='$user' order by RecordID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Your Patients' Medical Records</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Record ID</th>";
	echo "<th>Patient ID</th>";
	echo "<th>Examination Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['RecordID'] . "</td>";
 echo "<td>".$info['PatientID'] . " </td>";
 echo "<td>".$info['Examination_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "</tr>";
 }
 echo "</table>";
}
 ?>


<?php
//display All Patient Medical Records (admin only)
if ($_SESSION['type'] == 'Admin') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Medical_Record order by RecordID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>All Patient Medical Records</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Record ID</th>";
	echo "<th>Patient ID</th>";
	echo "<th>LicenseID</th>";
	echo "<th>Examination Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['RecordID'] . "</td>";
 echo "<td>".$info['PatientID'] . " </td>";
 echo "<td>".$info['LicenseID'] . " </td>";
 echo "<td>".$info['Examination_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "<td> <a href='editRecord.php?recid=".$info['RecordID']."'>edit</a> </td>";
 echo "<td> <a href='deleteRecord.php?recid=".$info['RecordID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
}
if ($_SESSION['type'] == 'Doctor' || $_SESSION['type'] == 'Admin'){
echo"<form class = 'center' id='subForm' action='addRecord.php' method='post'>";
echo"<input id='button' type='submit' value='Add Record' />";
echo "</form>";
}
 ?>

<?php
//display Appointments (user specific)
if ($_SESSION['type'] == 'Patient') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Appointment WHERE PatientID='$PatientID' order by AppointmentID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Your Booked Appointments</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Appointment ID</th>";
	echo "<th>Appointment Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['AppointmentID'] . "</td>";
 echo "<td>".$info['Appointment_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "<td> <a href='deleteAppointment.php?appid=".$info['AppointmentID']."'>Cancel</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addAppointment.php' method='post'>";
echo"<input id='button' type='submit' value='Add Appointment' />";
echo "</form>";
}
 ?>

<?php
//display Appointments (doctor specific)
if ($_SESSION['type'] == 'Doctor') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Appointment WHERE LicenseID='$user' order by AppointmentID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Your Upcoming Appointments</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Appointment ID</th>";
	echo "<th>Patient ID</th>";
	echo "<th>Appointment Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['AppointmentID'] . "</td>";
 echo "<td>".$info['PatientID'] . " </td>";
 echo "<td>".$info['Appointment_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "<td> <a href='editAppointment.php?appid=".$info['AppointmentID']."'>edit</a> </td>";
 echo "<td> <a href='deleteAppointment.php?appid=".$info['AppointmentID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addAppointment.php' method='post'>";
echo"<input id='button' type='submit' value='Add Appointment' />";
echo "</form>";
}
 ?>

<?php
//display Appointments (admin only)
if ($_SESSION['type'] == 'Admin') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Appointment order by AppointmentID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>All Upcoming Appointments</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Appointment ID</th>";
	echo "<th>Patient ID</th>";
	echo "<th>Appointment Date</th>";
	echo "<th>Problem</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['AppointmentID'] . "</td>";
 echo "<td>".$info['PatientID'] . " </td>";
 echo "<td>".$info['Appointment_Date']. " </td>";
 echo "<td>" .$info['Problem']. " </td>";
 echo "<td> <a href='editAppointment.php?appid=".$info['AppointmentID']."'>edit</a> </td>";
 echo "<td> <a href='deleteAppointment.php?appid=".$info['AppointmentID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addAppointment.php' method='post'>";
echo"<input id='button' type='submit' value='Add Appointment' />";
echo "</form>";
}
 ?>

<?php
//display doctor table (admin only)
if ($_SESSION['type'] == 'Admin') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Doctor order by LicenseID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Doctor Table</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>License ID</th>";
	echo "<th>Hospital ID</th>";
	echo "<th>Name</th>";
	echo "<th>Specialty</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['LicenseID'] . "</td>";
 echo "<td>".$info['HospitalID'] . " </td>";
 echo "<td>".$info['Doctor_Name']. " </td>";
 echo "<td>" .$info['Specialty']. " </td>";
 echo "<td> <a href='editDoctor.php?docid=".$info['LicenseID']."'>edit</a> </td>";
 echo "<td> <a href='deleteDoctor.php?docid=".$info['LicenseID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addDoctor.html' method='post'>";
 echo"<input id='button' type='submit' value='Add Doctor' />";
 echo "</form>";
}
 ?>


<?php
//display hospital table (admin only)
if ($_SESSION['type'] == 'Admin') {
 $data = mysqli_query(@$dbConnect, "SELECT * FROM Hospital order by HospitalID") 
 or die("Unable to select data"); 
 echo "<br>";
 echo "<h2>Hospital Table</h2>";
 echo '<table class="center">';
    echo "<tr>";
	echo "<th>Hospital ID</th>";
	echo "<th>Hospital Name</th>";
	echo "<th>Address</th>";
	echo "<th>City</th>";
	echo "</tr>";
 while($info = mysqli_fetch_array( $data )) 
 {
 echo "<tr>";  
 echo "<td>" .$info['HospitalID'] . "</td>";
 echo "<td>".$info['Hospital_Name'] . " </td>";
 echo "<td>".$info['Hospital_Address']. " </td>";
 echo "<td>" .$info['Hospital_City']. " </td>";
 echo "<td> <a href='editHospital.php?hosid=".$info['HospitalID']."'>edit</a> </td>";
 echo "<td> <a href='deleteHospital.php?hosid=".$info['HospitalID']."'>remove</a> </td>";
 echo "</tr>";
 }
 echo "</table>";
 echo"<form class = 'center' id='subForm' action='addHospital.html' method='post'>";
 echo"<input id='button' type='submit' value='Add Hospital' />";
 echo "</form>";
}
 ?>