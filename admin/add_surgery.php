<?php
session_start();
include("../include/connection.php");

// Initialize an empty error array
$error = array();

if (isset($_POST['add_surgery'])) {
    $patient_firstname = $_POST['patient_firstname'];
    $patient_surname = $_POST['patient_surname'];
    $doctor_firstname = $_POST['doctor_firstname'];
    $doctor_surname = $_POST['doctor_surname'];
    $surgery_type = $_POST['surgery_type'];
    $surgery_date = $_POST['surgery_date'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    // Validation
    if (empty($patient_firstname) || empty($patient_surname)) {
        $error['surgery'] = "Enter the patient's full name";
    }
    if (empty($doctor_firstname) || empty($doctor_surname)) {
        $error['surgery'] = "Enter the doctor's full name";
    }
    if (empty($surgery_type)) {
        $error['surgery'] = "Enter surgery type";
    }
    if (empty($surgery_date)) {
        $error['surgery'] = "Select surgery date";
    }

    // Insert surgery if no errors
    if (empty($error)) {
        $query = "INSERT INTO surgeries (patient_firstname, patient_surname, doctor_firstname, doctor_surname, surgery_type, surgery_date, duration, status, notes) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 'sssssssss', $patient_firstname, $patient_surname, $doctor_firstname, $doctor_surname, $surgery_type, $surgery_date, $duration, $status, $notes);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Surgery added successfully'); window.location.href='view_surgeries.php';</script>";
        } else {
            echo "<script>alert('Failed to add surgery');</script>";
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($connect);
}

// Display error messages
if (isset($error['surgery'])) {
    echo "<h5 class='text-center alert-danger'>{$error['surgery']}</h5>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Surgery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("../include/header.php"); ?>

<div class="container mt-5">
    <h3 class="text-center">Add New Surgery</h3>
    <form method="post">
        <div class="mb-3">
            <label>Patient Firstname</label>
            <input type="text" name="patient_firstname" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Patient Surname</label>
            <input type="text" name="patient_surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Doctor Firstname</label>
            <input type="text" name="doctor_firstname" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Doctor Surname</label>
            <input type="text" name="doctor_surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Surgery Type</label>
            <input type="text" name="surgery_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Surgery Date</label>
            <input type="date" name="surgery_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Duration (HH:MM)</label>
            <input type="time" name="duration" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <div class="text-center">
            <button type="submit" name="add_surgery" class="btn btn-primary">Add Surgery</button>
        </div>
    </form>
</div>

</body>
</html>
