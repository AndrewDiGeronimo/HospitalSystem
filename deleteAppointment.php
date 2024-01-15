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
  <h2> Appointment Removal Confirmaton </h2>


  <?php
  $appid = $_GET['appid'];
  $conn = mysqli_connect('localhost', 'root', '', 'fduhospital');
  $sql = "Delete FROM Appointment WHERE AppointmentID = $appid";

  if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
} else {
    echo "Error deleting Appointment";
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
<input id="button" type="submit" value="Go Back" />
</form>
</body>
<footer>
  <small>© 2022 Advanced Database Andrew DiGeronimo <br>
</small>
</footer>
</html>