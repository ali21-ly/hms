<?php
session_start();
include("../include/connection.php");

// Check if doctor ID is provided in the URL
if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Fetch doctor details from the database
    $query = "SELECT * FROM doctors WHERE id='$doctor_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $doctor = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Doctor not found.'); window.location.href='doctor.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No doctor selected.'); window.location.href='doctor.php';</script>";
    exit();
}

// Update doctor details if form is submitted
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $salary = $_POST['salary'];

    $update_query = "UPDATE doctors SET 
                        firstname='$firstname', 
                        surname='$surname', 
                        username='$username', 
                        email='$email', 
                        phone='$phone', 
                        country='$country', 
                        salary='$salary' 
                    WHERE id='$doctor_id'";

    if (mysqli_query($connect, $update_query)) {
        echo "<script>alert('Doctor details updated successfully.'); window.location.href='doctor.php';</script>";
    } else {
        echo "<script>alert('Failed to update doctor details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("../include/header.php"); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <div class="col-md-2" style="margin-left: -30px;">
            <?php include("sidenav.php"); ?>
        </div>

        <!-- Main Content Section -->
        <div class="col-md-10">
            <h4 class="text-center my-4">Edit Doctor Details</h4>
            <div class="col-md-8 mx-auto">
                <form method="post">
                    <div class="form-group mb-3">
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $doctor['firstname']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Surname</label>
                        <input type="text" name="surname" class="form-control" value="<?php echo $doctor['surname']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $doctor['username']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $doctor['email']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $doctor['phone']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $doctor['country']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control" value="<?php echo $doctor['salary']; ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-primary w-50">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
