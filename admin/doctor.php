<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Total Doctors</title>
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
            <h4 class="my-4">Total Doctors</h4>
            <?php
            // Query to fetch approved doctors
            $query = "SELECT * FROM doctors  ORDER BY data_reg ASC";
            $res = mysqli_query($connect, $query);

            // Start the output table
            $output = "
                <table class='table table-bordered'>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Surname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Salary</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>";
            
            // Check if there are any approved doctors
            if (mysqli_num_rows($res) < 1) {
                $output .= "<tr><td colspan='10' class='text-center'>No approved doctors yet</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    $output .= "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['surname']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['country']}</td>
                            <td>{$row['salary']}</td>
                            <td>{$row['data_reg']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}'>
                                    <button class='btn btn-info'>Edit</button>
                                </a>                          
                                <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this patient?\");'>
                                    <button class='btn btn-danger'>Delete</button>
                                </a>
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
