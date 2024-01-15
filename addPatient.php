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
  <h2> Add Patient Confirmation </h2>
  <?php
$Patient_Name = $_POST['Patient_Name'];
$Patient_Address = $_POST['Patient_Address'];
$Diagnosis = $_POST['Diagnosis'];

if ($Patient_Name == '' || $Patient_Address == ''|| $Diagnosis == '') {
    echo "<p>You have not entered all the required information. </p>";
    echo "<button class='center' onclick='history.back()'>Go Back</button>";
    exit;
}
else {
    $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');
    mysqli_query( $conn,"INSERT INTO Patient (Patient_Name, Patient_Address, Diagnosis) 
                        VALUES ('$Patient_Name', '$Patient_Address', '$Diagnosis')") or die("Could not execute query: " .mysqli_error($conn));
}

?>
<form id="subForm" action="usertable.php" method="post">
  <?php
session_start();
$ID= $_SESSION["ID"];
$pass=$_SESSION["password"]; 
$type=$_SESSION["type"]; 
echo "<input type='hidden' name='ID' value='$ID'>";
echo "<input type='hidden' name='password' value='$pass'>";
echo "<input type='hidden' name='type' value='$type'>";
?>
<input id="button" type="submit" value="   Click to go to User Table   " />
</form>
</body>
<footer>
  <small>© 2022 Advanced Database Andrew DiGeronimo <br>
</small>
</footer>
</html>