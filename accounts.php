<html>
<?php

session_start();
    $message="";
    $Account = "";
    $Username = "";
	$Password = "";
	$Email = "";
	include 'connect.php';
    if (isset($_POST['save'])) 
	{
        $ID = $_SESSION['ID'];
		$Email = $_POST['Email'];
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$Account = $_POST['Account'];

		if(empty($Email) || empty($username) || empty($Password) || empty($Account))
		{
			$message = "Please fill in all fields";
		}
		else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
		{
			$message = "Invalid email";
		}
		else
		{
			$encrypt = openssl_encrypt($Password, "AES-128-CTR", "GeeksforGeeks" , 0, '1234567891011121'); 
            $sql = mysqli_query($con, "INSERT INTO Accounts (UserID, Email , Username , Password , Site) 
			VALUES ('$ID','$Email','$Username','$encrypt','$Account')") or die(mysqli_error($con));
            $message = "Data saved";
            $Account = "";
            $Username = "";
            $Password = "";
            $Email = "";
        }
    }

    if (isset($_POST['update'])) 
	{
		$id = $_SESSION['edit'];
       	$Email = $_POST['Email'];
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$Account = $_POST['Account'];
        
        if (empty($Account) || empty($Username) || empty($Password) || empty($Email)) 
		{
            $message = "Please fill in all of the fields";
        }
		else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
		{
            $message = "Invalid Value for Shoot Length Field";
        }
		 else 
		{
			$encrypt = openssl_encrypt($Password, "AES-128-CTR", "GeeksforGeeks" , 0, '1234567891011121'); 
            mysqli_query($con, "UPDATE accounts SET Site='$Account', Username='$Username', Password='$encrypt', Email='$Email' WHERE AccountID='".$id."'") or die(mysqli_error($con));
            $message = "Data updated!";
            $Account = "";
            $Username = "";
            $Password = "";
            unset($_SESSION['edit']);
            $update = false;
        }
	}

	if (isset($_GET['edit'])) {
		#assigns id from the edit id
		$id = $_GET['edit'];
		#assigns id to be used on update
		$_SESSION['edit'] = $id;
		#collects record from the BookingID at id
		$record = mysqli_query($con, "SELECT * FROM accounts WHERE AccountID='" . $id ."'");
		$n = mysqli_fetch_array($record);

		#assigns data from record
		$Account = $n['Site'];
		$Username = $n["Username"];
		$Password = $decrypt = openssl_decrypt ($n['Password'], "AES-128-CTR", "GeeksforGeeks", 0 , '1234567891011121');
		$Email = $n['Email'];
		$update = true;}		

	if (isset($_GET['del'])) 
	{
		#assigns id from the del id
		$id = $_GET['del'];
		#deletes record in the Booking Table at the corresponding BookingID
		mysqli_query($con, "DELETE FROM accounts WHERE AccountID='" . $id ."'") or (mysqli_error($con));
		$message = "Data deleted";
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
        $query = mysqli_query($con, "SELECT * FROM Accounts WHERE (UserID='".$_SESSION["ID"]."') and 
		(Site LIKE'%".$_POST['search']."%' OR Email LIKE'%".$_POST['search']."%' OR Username LIKE'%".$_POST['search']."%')")
		or die(mysqli_error($con));
	}
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
			<th>Username</th>
			<th>Password</th>
			<th colspan="5">Action</th>
		</tr>
	</thead>
	
	<?php 
	while ($row = mysqli_fetch_array($query)) {
		$decrypt = openssl_decrypt ($row['Password'], "AES-128-CTR", "GeeksforGeeks", 0 , '1234567891011121');
		echo
  		 "<tr>
   		    <td>{$row['Site']}</td>
   		    <td>{$row['Email']}</td>
    		<td>{$row['Username']}</td>
			<td>{$decrypt}</td>
			";
			?>
			<td>
				<a href="accounts.php?edit=<?php echo $row['AccountID']; ?>" class="edit_btn">Edit</a>
			</td>
			<td>
				<a href="accounts.php?del=<?php echo $row['AccountID']; ?>" class="del_btn">Delete</a>
			</td> 
		</tr> <?php } ?>
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

<?php } 
else 
{
	header("location:login.php");
} 
?>
</body>
</html>




