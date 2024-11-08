<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];
    $error = array();

    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } elseif (empty($password)) {
        $error['login'] = "Enter Your Password";
    } else {
        // Fetch doctor details and check status
        $query = "SELECT * FROM doctors WHERE username= '$uname' AND password= '$password'";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            if ($row['status'] == "Pending") {
                $error['login'] = "Please Wait For the admin to confirm";
            } elseif ($row['status'] == "Rejected") {
                $error['login'] = "Your application was rejected. Try again later.";
            } else {
                // Valid user with approved status
                echo "<script>alert('Login Successful');</script>";
                $_SESSION['doctor'] = $uname;
                header("Location: doctor/index.php"); // redirect to doctor dashboard
                exit();
            }
        } else {
            $error['login'] = "Invalid Username or Password";
        }
    }
}

$show = isset($error['login']) ? "<h5 class='text-center alert alert-danger'>{$error['login']}</h5>" : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Login Page</title>
    <!-- Add Bootstrap & FontAwesome for styling -->
</head>
<body style="background-image: url('img/455899.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

<?php include("include/header.php"); ?>

<div class="container-fluid">
    <div class="col-md-12 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4 p-4 shadow-lg rounded" style="background-color: rgba(255, 255, 255, 0.85);">
            <h3 class="text-center mb-4">Doctor Login</h3>
            <?php echo $show; ?>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="uname" class="form-label">Username</label>
                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                </div>
                <div class="form-group mb-4">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                </div>
                <div class="text-center">
                    <input type="submit" name="login" class="btn btn-success w-100" value="Login">
                    <p class="text-center mt-3">I don’t have an account? <a href="Apply.php" class="text-decoration-none text-info">Apply Now!</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
