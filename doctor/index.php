<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['doctor'])) {
    // Redirect to login page if not logged in
    header("location:../index.php");
    exit;
 }
include("../include/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor's Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Sidebar Styling */
        .sidenav {
            position: fixed;
            top: 2;
            left: -25px;
            height: 100vh;
            width: 200px; /* Adjust width as needed */
            background-color: #17a2b8;
            padding-top: 20px;
            color: white;
        }
        .sidenav a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .sidenav a:hover {
            background-color: #138496;
        }

        /* Content Styling */
        .content {
            margin-left: 220px; /* Adjust this value based on sidebar width */
            padding: 20px;
        }

        /* Dashboard Card Styling */
        .dashboard-card {
            color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 150px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
        }
        .dashboard-card i {
            font-size: 3rem;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
        .profile-card { background-color: #17a2b8; }
        .patient-card { background-color: #ffc107; }
        .appointment-card { background-color: #28a745; }
    </style>
</head>
<body>

<div class="sidenav">
    <?php include("sidenav.php"); ?>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="dashboard-header text-center">
            <h4>Doctor's Dashboard</h4>
        </div>

        <div class="row mt-4">
            <!-- Profile Card -->
            <div class="col-md-3 mb-4">
                <div class="dashboard-card profile-card">
                    <h5>My Profile</h5>
                    <a href="#" class="text-white"><i class="fas fa-user-circle"></i></a>
                </div>
            </div>

            <!-- Total Patients Card -->
            <div class="col-md-3 mb-4">
                <div class="dashboard-card patient-card">
                    <h5>0</h5>
                    <h6>Total Patients</h6>
                    <a href="#" class="text-white"><i class="fas fa-procedures"></i></a>
                </div>
            </div>

            <!-- Total Appointments Card -->
            <div class="col-md-3 mb-4">
                <div class="dashboard-card appointment-card">
                    <h5>0</h5>
                    <h6>Total Appointments</h6>
                    <a href="#" class="text-white"><i class="fas fa-calendar-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and Font Awesome Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
