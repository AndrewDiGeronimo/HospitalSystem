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
<body>

<?php $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');
session_start();
$ID= $_SESSION["ID"];
$pass=$_SESSION["password"]; 
$type=$_SESSION["type"]; 
?>

  <h2> Create Appointment </h2>
  <form id="subForm" action="addAppointmentScript.php" method="post" class="center">
  <table class="center">
		<tr>
			<td> Patient Name: </td>
            <td>
            <select type='text' name='PatientID'>
                    <?php
                        if ($type == "Admin") {
                            $sql = "SELECT PatientID FROM Patient order by PatientID";
                            $result = $conn->query($sql);
                            while($info = mysqli_fetch_array( $result ))
                            {
                                echo '<option value="'.htmlspecialchars($info['PatientID']).'">'.htmlspecialchars($info['PatientID']).'</option>';
                            }
                        }
                        else {
                            echo "<option hidden=".$ID.">".$ID."</option>";
                        }
                        ?>
            </select>
                    </td>
		</tr>
		<tr>
			<td> Doctor Name: </td>
                <td>
                <select type='text' name='LicenseID'>
                    <?php
                        $sql = "SELECT * FROM Doctor order by LicenseID";
                        $result = $conn->query($sql);
                        while($info = mysqli_fetch_array( $result ))
                        {
                            echo '<option value="'.htmlspecialchars($info['LicenseID']).'" name="'.htmlspecialchars($info['Doctor_Name']).'">'.htmlspecialchars($info['Doctor_Name']).'</option>';
                        }
                    ?>
                </select>
            </td>
		</tr>
        <tr>
            <td> Appointment Date: </td>
			<td> <input type = "date" name ="Examination_Date"> </td>
		</tr>
		<tr>
			<td> Problem: </td>
			<td> <input type = "text" name ="Problem"> </td>
		</tr>
        <tr>
        </table>
    <br>
<input id="button" type="submit" value="submit" />
</form>