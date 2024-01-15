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
$LicenseID = $_POST['LicenseID'];
$HospitalID = $_POST['HospitalID'];
$Doctor_Name = $_POST['Doctor_Name'];
$Specialty = $_POST['Specialty'];
$User_Type = $_POST['User_Type'];
$Password = $_POST['Password'];

if ($LicenseID == '' || $HospitalID == ''|| $Specialty == ''|| $User_Type == ''|| $Password == '') {
    echo "<p>You have not entered all the required information. </p>";
    echo "<button class='center' onclick='history.back()'>Go Back</button>";
    exit;
}
else {
    $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');
    mysqli_query( $conn,"UPDATE Doctor SET HospitalID = '$HospitalID', Doctor_Name = '$Doctor_Name', Specialty = '$Specialty', User_Type = '$User_Type', Password = '$Password' WHERE LicenseID = '$LicenseID' ") or die("Could not execute query: " .mysqli_error($conn));
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