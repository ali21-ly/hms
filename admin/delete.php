<?php
session_start();
include("../include/connection.php"); // Ensure this path is correct

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Create a prepared statement to delete the doctor record
    $query = "DELETE FROM doctors WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);

    if ($stmt) {
        // Bind the ID parameter to the statement and execute
        mysqli_stmt_bind_param($stmt, "i", $doctor_id);
        mysqli_stmt_execute($stmt);

        // Check if the record was deleted
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['message'] = "Doctor deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete the doctor.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error preparing the delete statement.";
    }

    // Close the database connection
    mysqli_close($connect);
} else {
    $_SESSION['error'] = "No doctor ID provided.";
}

// Redirect back to the main doctors page
header("Location: doctor.php");
exit();
?>
