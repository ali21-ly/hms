<?php
session_start();
include("../include/connection.php");

$error = array();

if (isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    // Validation
    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    }
    if (empty($surname)) {
        $error['apply'] = "Enter Surname";
    }
    if (empty($username)) {
        $error['apply'] = "Enter Username";
    }
    if (empty($email)) {
        $error['apply'] = "Enter your email";
    }
    if (empty($gender)) {
        $error['apply'] = "Select Your Gender";
    }
    if (empty($phone)) {
        $error['apply'] = "Enter Your Phone Number";
    }
    if (empty($country)) {
        $error['apply'] = "Select Your Country";
    }


  // Check if the email already exists in the database
  $email_check_query = "SELECT * FROM doctors WHERE email = ?";
  $stmt = mysqli_prepare($connect, $email_check_query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
      $error['apply'] = "Email already exists. Please use a different email.";
  }

  mysqli_stmt_close($stmt);

  



    // If no errors, insert into the database
    if (empty($error)) {
        $query = "INSERT INTO doctors (firstname, surname, username, email, gender, phone, country, salary, data_reg, status, profile) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW(), 'Pending', 'doctor.jpg')";

        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 'sssssss', $firstname, $surname, $username, $email, $gender, $phone, $country);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('You have successfully added a new doctor');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
        } else {
            echo "<script>alert('Failed to add doctor');</script>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($connect);
}

// Display error messages
if (!empty($error)) {
    foreach ($error as $msg) {
        echo "<h5 class='text-center alert-danger'>$msg</h5>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body style="background-image: url('img/apply.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

<?php include("../include/header.php"); ?>

<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-2" style="margin-left:-30px">
            <?php include("sidenav.php"); ?>
        </div>
        
        <div class="col-md-10 p-5 rounded shadow-lg" style="background-color: rgba(255, 255, 255, 0.85);">
            <h3 class="text-center mb-4">Add a new Doctor</h3>

            <form method="post">
                <div class="form-group mb-3">
                    <label>Firstname</label>
                    <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Surname</label>
                    <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname" value="<?php echo isset($_POST['sname']) ? htmlspecialchars($_POST['sname']) : ''; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Username</label>
                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php echo isset($_POST['uname']) ? htmlspecialchars($_POST['uname']) : ''; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group mb-3">
                    <label>Select Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Select Country</label>
                    <select name="country" class="form-control">
                        <option value="">Select Country</option>
                        <option value="Libya" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Libya') ? 'selected' : ''; ?>>Libya</option>
                        <option value="Ukraine" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Ukraine') ? 'selected' : ''; ?>>Ukraine</option>
                        <option value="Serbia" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Serbia') ? 'selected' : ''; ?>>Serbia</option>
                    </select>
                </div>
                
                <div class="text-center mb-3">
                    <input type="submit" name="apply" value="Add new doctor" class="btn btn-success w-100">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
