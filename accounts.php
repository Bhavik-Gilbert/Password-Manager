<html>
<?php

session_start();
    $message="";
    $Account = "";
    $Username = "";
	$Password = "";
	$Email = "";
	include 'connect.php';
    if (isset($_POST['save'])) {
        $ID = $_SESSION['ID'];
		$Email = $_POST['Email'];
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$Account = $_POST['Account'];
        $sql = mysqli_query($con, "INSERT INTO Accounts (UserID, Email , Username , Password , Site) 
		VALUES ('$ID','$Email','$Username','$Password','$Account')") or die(mysqli_error($con));
		$message = "Data saved";
		$Account = "";
 	    $Username = "";
		$Password = "";
		$Email = "";
        header('location: accounts.php');
    }

    if (isset($_POST['update'])) {
        $Account = $n['Site'];
        $Username = $n['Usernmae'];
        $Password = $n['Password'];
        
        if (($ShootType == "") and ($Date == "") and ($Address == "") and ($StartTime == "") and ($Length == "")) {
            $message = "Please fill in all of the fields";
        } elseif (!is_numeric($Length)) {
            $message = "Invalid Value for Shoot Length Field";
        } else {
            mysqli_query($con, "UPDATE Accounts SET ShootType='$ShootType', PackageID='$PackageType', Date='$Date', Address='$Address', StartTime='$StartTime', Length='$Length', Price='$Price',Status='$Status', WHERE BookingID='2'") or die(mysqli_error($con));
            $message = "Data updated!";
        }
        $Account = "";
        $Username = "";
        $Password = "";
        header('location: accounts.php');
	}
?>

<head>
<meta charset="utf-8">
<title>Accounts Page</title>
<link rel="stylesheet" type = "text/css" href="Style.css">
</head>

<body>
<?php
include 'menu.php';
if (isset($_SESSION["ID"])) {
?>
<h1 style="text-align:center">Accounts</h1>
<?php
include 'connect.php';

if (isset($_POST['submit'])) {
        $query = mysqli_query($con, "SELECT * FROM Accounts WHERE (UserID='".$_SESSION["ID"]."' and 
		Site LIKE'%".$_POST['search']."%')")
		or die(mysqli_error($con));}
else{
    $query = mysqli_query($con, "SELECT * FROM Accounts WHERE UserID='". $_SESSION["ID"]."'")
   or die(mysqli_error($con));} ?>

<form action="" method="post" align="center" style="background-color:transparent;
	border: 2px solid transparent";>
<div class="input-group">
<input name="search" type="text" placeholder="Type here" style="height: 30px;
    width: 100%; font-size: 16px;">
</div>
<br>
<div class="input-group">
<button class="btn" type="submit" name="submit" style="display: block; margin-left: auto;
    margin-right: auto; width: 8em">Search</button>
</div>
</form>

<table>
	<thead>
		<tr>
			<th>Account</th>
			<th>Email</th>
			<th>Usernmae</th>
			<th>Password</th>
		</tr>
	</thead>
	
	<?php 
	while ($row = mysqli_fetch_array($query)) {
		echo
  		 "<tr>
   		    <td>{$row['Site']}</td>
   		    <td>{$row['Email']}</td>
    		<td>{$row['Username']}</td>
			<td>{$row['Password']}</td>
		<tr>"; } ?>
</table>

<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Accounts</h3>

<div class="input-group">
Website
<input type="text" name="Account" value="<?php echo $Account;?>">
<div>

<div class="input-group">
<label>Username</label>
<input type="text" name="Username" value="<?php echo $Username;?>">
<div>

<div class="input-group">
<label>Password</label>
<input type="text" name="Password" value="<?php echo $Password;?>">
<div>

<div class="input-group">
Email
<input type="text" name="Email" value="<?php echo $Email;?>">
<div>

<div class="input-group">
			<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
			<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>
		</div>
</form>

<?php } else {echo "Please login first";} ?>
</body>
</html>




