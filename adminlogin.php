<?php
session_start();
?>

<?php
include("include/connection.php");

if(isset($_POST['login'])) {

    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if(empty($username)) {
        $error['admin'] = "Enter Username";
    }else if(empty($password)){
        $error['asmin'] = "Enter password";
    }
   
    if (count($error)==0) {
        
        $query = "SELECT * FROM admin WHERE username ='$username' AND password='$password'";

        $result = mysqli_query($connect,$query);

        if (mysqli_num_rows($result) == 1 ) {
            echo "<script>alert('You have Login As an admin')</script>";

            $_SESSION['admin']=$username;

            header ("location:admin/index.php");
            exit();
          } 
          else{
            echo "<script>alert('Invaild Usename or password')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-image: url('img/back.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            backdrop-filter: blur(5px);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9); /* Slight transparency */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        .login-container img {
            border-radius: 50%;
            margin-bottom: 20px;
            height: 100px;
            width: 100px;
        }

        .login-container h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .login-container label {
            font-weight: bold;
            color: #555;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center">
    <div class="login-container text-center">
        <h4>Admin Login</h4>
        <img src="img/admin.jpg" class="img-fluid mx-auto d-block" alt="Admin Image">
        <form method="post" class="my-2" >

        <div>
            <?php 
            
            if(isset($error['admin'])){

                $sh = $error['admin'];

                $show ="<h4 class='alert alert-danger'>$sh</h4>";

            }else{
                $show = "";
            }

            echo $show;
            
            ?>
        </div>

            <div class="form-group mb-3 text-start">
                <label for="uname"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="uname" name="uname" class="form-control"
                       autocomplete="off" placeholder="Enter Username">
            </div>
            <div class="form-group mb-4 text-start">
                <label for="pass"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password">
            </div>
            <div class="text-center">
                <input type="submit" name="login" class="btn btn-custom w-100" value="Login">
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
