<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "";
$db = "webdailyjournal";

$conn = mysqli_connect($servername, $username, $password, $db);

if($conn->connect_error){
    die("connect failed : ". $conn->connect_error);
}

//echo "Connected successfully";
?>