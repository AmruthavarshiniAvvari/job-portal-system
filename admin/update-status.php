<?php

session_start();

include '../config/db.php';

// Admin Protection
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
}

$application_id = $_POST['application_id'];

$status = $_POST['status'];

$sql = "UPDATE applications
        SET status='$status'
        WHERE id='$application_id'";

mysqli_query($conn, $sql);

header("Location: applicants.php");

?>