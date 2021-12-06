<?php
    session_start();
?>

<head>
<title>navbar</title>
<link rel="stylesheet" type = "text/css" href="CSS/menu.css">
</head>

<body>

<div class="topnav">
	<a class="active" href="accounts.php">Account</a>
    <?php
    if($_SESSION['Username'])
    {
    ?>
    <a href="logout.php">Logout</a>
    <?php
    }
    else 
    {
    ?>
    <a href="login.php">Login</a>
    <a href="signup.php">Signup</a>
    <?php
    }
    ?>
</div>

</body>

