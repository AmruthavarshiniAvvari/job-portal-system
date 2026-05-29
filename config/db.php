<?php

$servername = "sql300.infinityfree.com";
$username   = "ifo_42032923";
$password   = "3805avt.";
$database   = "ifo_42032923_jobportal";

$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
);

if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>