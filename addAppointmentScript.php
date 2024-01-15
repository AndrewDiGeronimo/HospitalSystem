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
  <h2> Appointment Creation Confirmation </h2>
  <?php
  session_start();
  $ID= $_SESSION["ID"];
  $pass=$_SESSION["password"]; 
  $type=$_SESSION["type"]; 

$PatientID = $_POST['PatientID'];
$LicenseID = $_POST['LicenseID'];
$Examination_date = $_POST['Examination_Date'];
$Problem = $_POST['Problem'];
$UserID = '';

if ($LicenseID == '' || $PatientID == ''|| $Examination_date == ''|| $Problem == '') {
    echo "<p>You have not entered all the required information. </p>";
    echo "<button class='center' onclick='history.back()'>Go Back</button>";
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'fduhospital');

if ($_SESSION['type'] == "Patient"){
    $sql = "SELECT PatientID FROM Patient WHERE Username = '$PatientID'";
    $result = mysqli_query($conn, $sql);
    while($info = mysqli_fetch_array( $result )) {
        $UserID = $info['PatientID'];
        mysqli_query( $conn,"INSERT INTO appointment (PatientID, LicenseID, Appointment_Date, Problem) 
        VALUES ('$UserID', '$LicenseID', '$Examination_date', '$Problem')") or die("Could not execute query: " .mysqli_error($conn));
        break;
    }
}
else {
    mysqli_query( $conn,"INSERT INTO appointment (PatientID, LicenseID, Appointment_Date, Problem) 
        VALUES ('$PatientID', '$LicenseID', '$Examination_date', '$Problem')") or die("Could not execute query: " .mysqli_error($conn));
}

?>
<form id="subForm" action="usertable.php" method="post">
  <?php
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