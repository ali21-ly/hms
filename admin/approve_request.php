<?php
include("../include/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] === "approve") {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $query = "UPDATE doctors SET status='Approved' WHERE id='$id'";

    if (mysqli_query($connect, $query)) {
        echo "success"; // Success message returned to AJAX
    } else {
        echo "Error: " . mysqli_error($connect); // Error message for debugging
    }
}
?>
