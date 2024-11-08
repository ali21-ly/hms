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
          /* Style the dropdown container to be hidden by default */
        .dropdown-container {
            display: none;
        }
        .dropdown-container a {
            color: white;
            font-size: 18px;
            padding: 15px;
            display: block;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
        }

    /* Add styles to the dropdown button */
        .dropdown-btn {
            background-color: #17a2b8;
            color: white;
            text-align: left;
            border: none;
            cursor: pointer;
            outline: none;
            width: 100%;  
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px; 
        }
        .dropdown-btn a i {
            margin-right: 10px;
        }
        .dropdown-btn a:hover {
            background-color: #138496;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<div class="sidenav">
    <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="admin.php"><i class="fas fa-user-shield"></i> Administrators</a>
    <!-- Doctors section with dropdown -->
    <button class="dropdown-btn">
        <a href="#"><i class="fas fa-user-md"></i> Doctors <i class="fas fa-caret-down"></i></a>
    </button>
    <div class="dropdown-container">
        <a href="add_doctor.php">Add New Doctor</a>
        <a href="doctor.php">Show All Doctors</a>
    </div>
    <!-- Doctors section with dropdown -->
    <button class="dropdown-btn">
        <a href="#"><i class="fas fa-users"></i> Patients <i class="fas fa-caret-down"></i></a>
    </button>
    <div class="dropdown-container">
        <a href="add_patient.php">Add New Patient</a>
        <a href="patient.php">Show All Patients</a>
    </div>
    <!-- Surgeries section with dropdown -->
    <button class="dropdown-btn">
        <a href="#"><i class="fas fa-users"></i> Surgeries <i class="fas fa-caret-down"></i></a>
    </button>
    <div class="dropdown-container">
        <a href="add_surgery.php">Add New Surgerie</a>
        <a href="view_surgeries.php">Show All Surgeries</a>
    </div>
</div>
<!-- Add JavaScript for dropdown functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdowns = document.querySelectorAll('.dropdown-btn');
        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('click', function () {
                this.classList.toggle('active');
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        });
    });
</script>
</body>
</html>
