<?php
session_start();
$message="";
	
if(count($_POST)>0) {
include 'connect.php';

if (isset($_POST['Submit'])) {
	$Name = $_POST['Name'];
	$Username = $_POST['Username'];
	$Password =($_POST['Password']);
	$message = "";
	
	$sql = mysqli_query($con, "INSERT INTO User (Username, Password , User) 
	VALUES ('$Username', '$Password' , '$Name')") or die (mysqli_error($con));
	$message = "New record created successfully. Please log in to access the rest of the site";}}
?>

<html>
<head>
<link rel="stylesheet" type = "text/css" href="Style.css">
<title>Signup Page</title>
</head>
<body>
<?php
include 'menu.php';
?>
<h1 style="text-align:center">Signup</h1>

<?php
if($_SESSION["Username"]) {
?>
Welcome <?php echo $_SESSION["Username"]; ?>. 
You have already logged in.
Click here to <a href="logout.php" tite="Logout">Logout
<?php
}
else{
?>
</body>
<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Accounts</h3>

<div class="input-group">
Name
<input type="text" name="Name">
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
<div>
</form>

<?php
}
?>

</html>
</DOCTYPE>
