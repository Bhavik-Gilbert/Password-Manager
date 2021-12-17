<?php
    session_start();
?>

<head>
<title>navbar</title>
<link rel="stylesheet" type = "text/css" href="CSS/menu.css">
</head>

<body>

<div class="topnav">
	<a href="accounts.php">Account</a>
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

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
            }
        });
    });
</script>

