<?php
session_start();
$message=false;
	
if (!empty($_POST)){
    require 'connect.php';

    if (isset($_POST['Submit'])) {
        $Name = $_POST['Name'];
        $Username = $_POST['Username'];
        $Password =($_POST['Password']);
        $message = false;

		$name_err=$pass_err=$user_err=$field_err="";

        $Username_Get = mysqli_query($con, "SELECT * FROM user WHERE Username='".$Username."'") or die(mysqli_error($con));
        $UserCheck  = mysqli_fetch_array($Username_Get);
    

        #creates conditions for strong password
        $uppercase = preg_match('@[A-Z]@', $Password);
        $lowercase = preg_match('@[a-z]@', $Password);
        $number    = preg_match('@[0-9]@', $Password);
        $specialChars = preg_match('@[^\w]@', $Password);

        if (empty($Name) || empty($Username) || empty($Password)) 
		{
			$field_err = "Please fill in all the fields";
            $message = true;
        }

        if (is_numeric($Name)) 
		{
			$name_err  = "Name must not be numeric";
            $message = true;
        }

        if (is_array($UserCheck)) 
		{
			$user_err = "Username already registered in system";
			$message = true;
        }

		if (strlen($_POST['Password'])<8)
		{
			$pass_err = "Password must be at least 8 characters long";
			$message = true;
		}
		else if(!$uppercase || !$lowercase || !$number || !$specialChars)
		{
			$pass_err = "Password must contain at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character";
			$message = true;
		}
    
        if (!$message) {
            #hashes password
            $Format = "$2y$10$";
            $HashLength = 55;
            $Unique = md5(uniqid(mt_rand(), true));
            $Base64  = base64_encode($Unique);
            $Modified = str_replace('+', '.', $Base64);
            $Generate = substr($Modified, 0, $HashLength);
            $Formatting = $Format.$Generate;
            $Hash = crypt($Password, $Formatting);

            $sql = mysqli_query($con, "INSERT INTO User (Username, Password , User) 
			VALUES ('$Username', '$Hash' , '$Name')") or die(mysqli_error($con));
			$message = true;
            $pass_err = "New record created successfully. Please log in to access the rest of the site";
        }
    }
}
?>

<html>
<head>
<link rel="stylesheet" type = "text/css" href="CSS/Style.css">
<title>Signup Page</title>
</head>
<body>
<?php
include 'menu.php';
?>
<h1 style="text-align:center">Signup</h1>

<?php
if($_SESSION["Username"])
{
	header("location:accounts.php");

}
else{
?>
</body>
<form name="frmUser" method="post" action="" align="center">
<?php if($message) { ?>
<div class="message">
    <?php
        if (!empty($field_err)) 
		{
            echo $field_err;
            echo "<br>";
        }
        if (!empty($name_err)) 
		{
            echo $name_err;
            echo "<br>";
        }
        if (!empty($user_err)) 
		{
            echo $user_err;
            echo "<br>";
        }
        if (!empty($pass_err)) 
		{
            echo $pass_err;
        } ?>
</div>
<?php } ?>
<h3 align="center">Accounts</h3>

<div class="input-group">
<label>Name</label>
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
