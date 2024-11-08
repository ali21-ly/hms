<?php
session_start();

if (isset($_SESSION['admin'])) {
    // Unset specific session variables if needed
    unset($_SESSION['admin']);

    // Destroy the entire session
    session_destroy();

    // Redirect to the login or home page
    header("location:../index.php");
    exit;
} else {
    // In case someone tries to access logout directly without an active session
    header("location:../index.php");
    exit;
}
?>
