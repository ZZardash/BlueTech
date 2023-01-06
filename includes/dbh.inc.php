<?php

define('EMAIL','Your Email');
define('PASSWORD','Your email password');

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
else {
    mysqli_select_db($conn, $dBName);
}
?>
