<?php
session_start();

if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Total Patients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");
?>


<div class="container-fluid"> 
    <div class="row">
        <!-- Sidebar Section -->
        <div class="col-md-2" style="margin-left: -30px;">
            <?php include("sidenav.php"); ?>
        </div>

        <!-- Main Content Section -->
        <div class="col-md-10">
            <h4 class="my-4">Total Patients</h4>
            <?php
            // Query to fetch patients
            $query = "SELECT * FROM patients ORDER BY reg_date ASC";
            $res = mysqli_query($connect, $query);

            // Start the output table
            $output = "
                <table class='table table-bordered'>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Surname</th>
                        <th>Blood Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>";
            
            // Check if there are any patients
            if (mysqli_num_rows($res) < 1) {
                $output .= "<tr><td colspan='11' class='text-center'>No patients found</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    $output .= "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['surname']}</td>
                            <td>{$row['bloodtype']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['country']}</td>
                            <td>{$row['dob']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['reg_date']}</td>
                            <td>
                                <a href='edit_patient.php?id={$row['id']}'>
                                    <button class='btn btn-info'>Edit</button>
                                </a>                          
                                <a href='delete_patient.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this patient?\");'>
                                    <button class='btn btn-danger'>Delete</button>
                                </a>
                            </td>
                        </tr>";
                }
            }
            
            // End the table and display it
            $output .= "</table>";
            echo $output;
            ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
