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
  <h2> Edit Doctor Confirmation</h2>


  <?php
$RecordID = $_POST['RecordID'];
$PatientID = $_POST['PatientID'];
$LicenseID = $_POST['LicenseID'];
$Examination_Date = $_POST['Examination_Date'];
$Problem = $_POST['Problem'];


if ($RecordID == '' || $PatientID == ''|| $LicenseID == ''|| $Examination_Date == ''|| $Problem == '') {
    echo "<p>You have not entered all the required information. </p>";
    echo "<button class='center' onclick='history.back()'>Go Back</button>";
    exit;
}
else {
    $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');
    mysqli_query( $conn,"UPDATE medical_record SET PatientID = '$PatientID', LicenseID = '$LicenseID', Examination_Date = '$Examination_Date', Problem = '$Problem' WHERE RecordID = '$RecordID' ") or die("Could not execute query: " .mysqli_error($conn));
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