<?php
session_start();
include("../include/connection.php");

// SQL Query to get all pending job requests
$query = "SELECT * FROM doctors WHERE status='Pending' ORDER BY data_reg ASC";
$res = mysqli_query($connect, $query);

$output = "<table class='table table-bordered'>
             <tr>
                 <th>ID</th>
                 <th>Firstname</th>
                 <th>Surname</th>
                 <th>Username</th>
                 <th>Email</th>
                 <th>Phone</th>
                 <th>Country</th>
                 <th>Data Registered</th>
                 <th>Action</th>
             </tr>";

// Populate rows from query result
while ($row = mysqli_fetch_array($res)) {
    $output .= "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['surname']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['country']}</td>
                    <td>{$row['data_reg']}</td>
                    <td>
                        <button class='btn btn-success approve' id='{$row['id']}'>Approve</button>
                        <button class='btn btn-danger reject' id='{$row['id']}'>Reject</button>
                    </td>
                </tr>";
}

// Display if no requests found
if (mysqli_num_rows($res) < 1) {
    $output .= "<tr><td colspan='9' class='text-center'>No Job Requests Yet</td></tr>";
}

$output .= "</table>";
echo $output;
?>

