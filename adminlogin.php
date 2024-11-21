<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $error = array();

    if (empty($username)) {
        $error['admin'] = "Enter Username";
    } else if (empty($password)) {
        $error['admin'] = "Enter password";
    }

    if (count($error) == 0) {
        $query = "SELECT * FROM admin WHERE username ='$username' AND password='$password'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['admin'] = $username;
            header("location:admin/index.php");
            exit();
        } else {
            $error['admin'] = "Invalid Username or Password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Zliten Medical Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(120deg, #5d99c6, #283a47);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .company-banner {
            font-size: 32px;
            font-weight: 700;
            color: #5d99c6;
            background: linear-gradient(to right, #5d99c6, #283a47);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .center-title {
            font-size: 20px;
            font-weight: bold;
            color: #666;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-container img {
            border: 3px solid #5d99c6;
            border-radius: 50%;
            margin-bottom: 15px;
            height: 100px;
            width: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #5d99c6;
            box-shadow: 0 0 0 0.2rem rgba(93, 153, 198, 0.25);
        }

        .btn-custom {
            background-color: #5d99c6;
            color: #fff;
            font-weight: 600;
            transition: background-color 0.3s;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #3f7a9d;
        }

        .alert-danger {
            display: block;
            font-size: 14px;
            margin-top: 15px;
            color: #d9534f;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center">
    <div class="login-container">
        <div class="company-banner">Inno Code</div>
        <div class="center-title">Zliten Medical Center</div>

        <h4>Admin Login</h4>
        <img src="img/mm.jpg" class="img-fluid" alt="Admin Image">
        
        <form method="post">
            <?php if (isset($error['admin'])) : ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error['admin']; ?>
                </div>
            <?php endif; ?>

            <div class="form-group mb-3 text-start">
                <label for="uname"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter Username" autocomplete="off">
            </div>
            <div class="form-group mb-4 text-start">
                <label for="pass"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password">
            </div>
            <button type="submit" name="login" class="btn btn-custom">Login</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
