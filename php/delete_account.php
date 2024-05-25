<?php
session_start();
include ("config.php");

if (!isset($_SESSION['valid'])) {
     header("Location: ../login.php");
     exit;
}

$id = $_SESSION['id'];

// Delete user data from database
$query = "DELETE FROM users WHERE Id=$id";
$result = mysqli_query($con, $query);

if ($result) {
     // Destroy the session and redirect to login page
     session_destroy();
     header("Location: ../login.php");
     exit;
} else {
     echo "Error deleting record: " . mysqli_error($con);
}
?>