<?php
function Check($password,$old_Hash){
	$Hash = crypt($password, $old_Hash);
	if ($hash = $old_Hash){
	return true;}
	else {
	return false;}}



session_start();
$message="";
if (isset($_POST['Submit'])) {
	
include 'connect.php';
 
$result = mysqli_query($con,"SELECT * FROM User WHERE Username='" . $_POST["Username"] ."'");
$row  = mysqli_fetch_array($result);

if(is_array($row)){ 
		$_SESSION["ID"] = $row['UserID'];
		$_SESSION["Username"] = $row['Username'];}
else {
$message = "Invalid Username or Password!";}}
?>

<html>
<head>
<link rel="stylesheet" type = "text/css" href="Style.css">
<title>User Login</title>
</head>
<body>
<?php
include 'menu.php';
?>

<h1 style="text-align:center">Login</h1>

<?php
if($_SESSION["Username"]) {
?>
Welcome <?php echo $_SESSION["Username"]; ?>. 
You have already logged in.
Click here to create a new booking <a href="newaccount.php" tite="Logout">
	<br></br>
Click here to <a href="logout.php" tite="Logout">Logout
<?php
}else{
?>
<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Enter Login Details</h3>

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


</body>
</html>

