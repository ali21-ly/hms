<?php
session_start();
include("../include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Surgeries</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("../include/header.php"); ?>

<div class="container mt-5">
    <h3 class="text-center">All Surgeries</h3>
    <?php
    // Fetch all surgeries directly
    $query = "SELECT * FROM surgeries ORDER BY surgery_date DESC";
    $res = mysqli_query($connect, $query);

    // Start the output table
    echo "<table class='table table-bordered'>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Surgery Type</th>
                <th>Surgery Date</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>";

    // Check if any surgeries exist
    if (mysqli_num_rows($res) < 1) {
        echo "<tr><td colspan='9' class='text-center'>No surgeries found</td></tr>";
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['patient_firstname']} {$row['patient_surname']}</td>
                    <td>{$row['doctor_firstname']} {$row['doctor_surname']}</td>
                    <td>{$row['surgery_type']}</td>
                    <td>{$row['surgery_date']}</td>
                    <td>{$row['duration']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['notes']}</td>
                    <td>
                        <a href='edit_surgery.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                        <a href='delete_surgery.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this surgery?\");' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
        }
    }

    echo "</table>";
    ?>
</div>

</body>
</html>
