<?php
session_start();
?>
<html>
<head>
<title>User Login</title>
</head>
<body>

<?php
if($_SESSION["Username"]) {
?>
Welcome <?php echo $_SESSION["Username"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.
<?php
}else
{
    header("location:login.php");
}
?>
</body>
</html>