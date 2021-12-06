<?php
session_start();
$message="";
	
if(count($_POST)>0) {
include 'connect.php';

if (isset($_POST['Submit'])) {
	$Site = $_POST['Site'];
	$Email = $_POST['Email'];
	$Username = $_POST['Username'];
	$Password =($_POST['Password']);
	$message = "";
	$sql = mysqli_query($con, "INSERT INTO accounts (Email, Username , Password , Site) 
	VALUES ('$Email', '$Username' , '$Password' , '$Site')") or die (mysqli_error($con));
	$message = "New record created successfully. Please log in to access the rest of the site";}}
?>

<html>
<head>
<link rel="stylesheet" type = "text/css" href="Style.css">
<title>New Site Page</title>
</head>
<body>
<?php
include 'menu.php';
?>
<h1 style="text-align:center">Signup</h1>

<?php
if($_SESSION["Username"]) {
?>
</body>
<form name="frmsign" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>

<div class="input-group">
<label>Site</label>
<input type="text" name="Site">
<div>
 
<div class="input-group">
<label>Email</label>
<input type="text" name="Email">
<div>

<div class="input-group">
<label>Username</label>
<input type="text" name="Username">
<div>

<div class="input-group">
<label>Password</label>
<input type="text" name="Password">
<div>

<div class="input-group">
<button class="btn" type="submit" name="Submit" >Submit</button>
</div>
</form>

<?php
}
else{
?>
<h2>Please Login</h2>
<?php
}
?>

</html>
</DOCTYPE>
