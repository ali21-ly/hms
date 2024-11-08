<?php
include("include/connection.php");

if (isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
     $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];

    $error = array();

    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    } elseif (empty($surname)) {
        $error['apply'] = "Enter Surname";
    } elseif (empty($username)) {
        $error['apply'] = "Enter Username";
    } elseif (empty($email)) {
        $error['apply'] = "Enter your email";
    } elseif (empty($gender)) {
        $error['apply'] = "Select Your Gender";
    } elseif (empty($phone)) {
        $error['apply'] = "Enter Your Phone Number";
    } elseif (empty($country)) {
        $error['apply'] = "Select Your Country";
    } elseif (empty($password)) {
        $error['apply'] = "Enter Your Password";
    } elseif ($confirm_password !== $password) {
        $error['apply'] = "<span style='color: red;'>Both Passwords do not Match</span>";
    }

    if (count($error) == 0) {
        $query = "INSERT INTO doctors (firstname, surname, username, email, gender, phone, country, password, salary, data_reg, status, profile)
                  VALUES ('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$country', '$password', '0', NOW(), 'Pending', 'doctor.jpg')";

        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "<script>alert('You have Successfully Applied');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'doctorlogin.php'; }, 2000);</script>";
        } else {
            echo "<script>alert('Application Failed');</script>";
        }
    }
}

if (isset($error['apply'])) {
    $s = $error['apply'];
    $show = "<h5 class='text-center alert-danger'>$s</h5>";
} else {
    $show = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Apply Now!!!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body style="background-image: url('img/apply.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

<?php include("include/header.php"); ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6 p-5 rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.85);">
        <h3 class="text-center mb-4">Apply Now!!!</h3>

        <div>
            <?php echo $show; ?>
        </div>

        <form method="post">
            <div class="form-group mb-3">
                <label>Firstname</label>
                <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
            </div>

            <div class="form-group mb-3">
                <label>Surname</label>
                <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname" value="<?php if (isset($_POST['sname'])) echo $_POST['sname']; ?>">
            </div>

            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            </div>
            
            <div class="form-group mb-3">
                <label>Select Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Phone Number</label>
                <input type="tel" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
            </div>

            <div class="form-group mb-3">
                <label>Select Country</label>
                <select name="country" class="form-control">
                    <option value="">Select Country</option>
                    <option value="Libya">Libya</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="Serbia">Serbia</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
            </div>

            <div class="form-group mb-4">
                <label>Confirm Password</label>
                <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
            </div>
            
            <div class="text-center mb-3">
                <input type="submit" name="apply" value="Apply Now" class="btn btn-success w-100">
            </div>
            
            <p class="text-center">Already have an account? <a href="doctorlogin.php" class="text-info text-decoration-none">Click here</a></p>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

