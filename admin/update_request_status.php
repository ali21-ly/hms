<?php
include("../include/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $action = $_POST['action'];

    // Determine the new status based on the action
    $status = ($action === "approve") ? "Approved" : "Rejected";

    // Update the doctor's status
    $query = "UPDATE doctors SET status='$status' WHERE id='$id'";

    if (mysqli_query($connect, $query)) {
        echo "success"; // Return success if update is successful
    } else {
        echo "Error: " . mysqli_error($connect); // Return error for debugging
    }
}
?>
