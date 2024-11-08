<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>

    <!-- Bootstrap and Font Awesome Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        /* Header Styling */
        .navbar {
            background-color: #138496;
            padding: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand h5 {
            color: #ffffff;
            font-weight: bold;
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-size: 1rem;
            margin-left: 15px;
            transition: color 0.3s, transform 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #e0f7fa !important;
            transform: scale(1.05);
        }

        /* Sidebar Styling */
        .sidenav {
            height: 100vh;
            background-color: #17a2b8;
            padding: 20px 10px;
            width: 100%;
        }

        .sidenav a {
            color: white;
            font-size: 18px;
            margin-bottom: 15px;
            padding: 15px;
            text-align: left;
            border-radius: 8px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .sidenav a:hover {
            background-color: #138496;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        /* Main Content Styling */
        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 2.5rem;
            color: #138496;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .card {
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

   <nav class="navbar navbar-expand-lg">
       <div class="container-fluid">
           <a class="navbar-brand" href="#"><h5>Hospital Management System</h5></a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                   <?php
                   if (isset($_SESSION['admin'])) {
                       $user = $_SESSION['admin'];
                       echo '
                       <li class="nav-item"><a href="#" class="nav-link">'.$user.'</a></li>
                       <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
                   } elseif (isset($_SESSION['doctor'])) {
                       $user = $_SESSION['doctor'];
                       echo '
                       <li class="nav-item"><a href="#" class="nav-link">'.$user.'</a></li>
                       <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
                   } else {
                       echo '
                       <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                       <li class="nav-item"><a href="adminlogin.php" class="nav-link">Admin</a></li>
                       <li class="nav-item"><a href="doctorlogin.php" class="nav-link">Doctor</a></li>
                       <li class="nav-item"><a href="#" class="nav-link">Patient</a></li>';
                   }
                   ?>
               </ul>
           </div>
       </div>
   </nav>

</body>
</html>


