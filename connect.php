<?php
$localhost = "localhost"; //your host name
$username = "root"; // your database name
$password = ""; // your database password
$dbname = "password_manager";

$con = new mysqli($localhost, $username, $password, $dbname);


if($con->connect_error) {
    die("connection failed : " . $con->connect_error);
}

/* end of file */
?>