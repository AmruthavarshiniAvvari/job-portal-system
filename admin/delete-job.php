<?php

session_start();

include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM jobs WHERE id=$id");

header("Location: jobs.php");

?>