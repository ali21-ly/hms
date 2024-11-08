<?php
session_start();
include("../include/connection.php");

// Check if the patient ID is provided in the URL
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Prepare and execute the delete query
    $query = "DELETE FROM patients WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);

    if ($stmt) {
        // Bind the ID parameter and execute the statement
        mysqli_stmt_bind_param($stmt, "i", $patient_id);
        mysqli_stmt_execute($stmt);

        // Check if the record was successfully deleted
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['message'] = "Patient deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete patient.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error preparing the delete statement.";
    }

    // Close the database connection
    mysqli_close($connect);
} else {
    $_SESSION['error'] = "No patient ID provided.";
}

// Redirect back to the main patients page
header("Location: patient.php");
exit();
?>
