<?php
function Check($password, $old_Hash)
{
    $hash = crypt($password, $old_Hash);
    return $hash == $old_Hash;
}



session_start();
$message="";
if (isset($_POST['Submit'])) 
	{
		
	include 'connect.php';
	
	$result = mysqli_query($con,"SELECT * FROM User WHERE Username='" . $_POST["Username"] ."'");
	$row  = mysqli_fetch_array($result);

	if(is_array($row))
	{ 
        if (Check($_POST["Password"],$row["Password"]) == $row["Password"]) {
			$login = true;
        }
		else
		{
			$login = false;
		}
	}
	
	if($login)
	{
		$_SESSION["ID"] = $row['UserID'];
        $_SESSION["Username"] = $row['Username'];
	}
	else
	{
		$message = "Invalid Username or Password!";
	}
}


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
<?php
if($_SESSION["Username"]) {
	header("location:accounts.php");
}

else{

?>
	
<h1 style="text-align:center">Login</h1>

<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Enter Login Details</h3>

<div class="input-group">
<label>Username</label>
<input type="text" name="Username">
<div>

<div class="input-group">
<label>Password</label>
<input type="password" name="Password">
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