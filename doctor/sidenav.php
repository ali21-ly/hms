<!DOCTYPE html>
<html lang="en">
<head>
    <title>Side Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .sidenav {
            height: 100vh;
            width: 250px;
            background-color: #17a2b8;
            padding-top: 20px;
            position: fixed;
            transition: all 0.3s ease;
        }

        .sidenav a {
            color: white;
            font-size: 18px;
            padding: 15px;
            display: block;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidenav a:hover {
            background-color: #138496;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .sidenav a i {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="sidenav">
    <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="admin.php"><i class="fas fa-user-shield"></i> patient</a>
    <a href="doctor.php"><i class="fas fa-user-md"></i> Appointment</a>
    <a href="patients.php"><i class="fas fa-users"></i> Report</a>
</div>

</body>
</html>
