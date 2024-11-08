<?php
session_start();
include("../include/connection.php");

// Check if patient ID is provided in the URL
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Fetch patient details from the database
    $query = "SELECT * FROM patients WHERE id='$patient_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $patient = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Patient not found.'); window.location.href='patients.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No patient selected.'); window.location.href='patients.php';</script>";
    exit();
}

// Update patient details if form is submitted
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $bloodtype = $_POST['bloodtype'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $update_query = "UPDATE patients SET 
                        firstname='$firstname', 
                        surname='$surname', 
                        bloodtype='$bloodtype', 
                        email='$email', 
                        phone='$phone', 
                        country='$country', 
                        dob='$dob', 
                        address='$address' 
                    WHERE id='$patient_id'";

    if (mysqli_query($connect, $update_query)) {
        echo "<script>alert('Patient details updated successfully.'); window.location.href='patients.php';</script>";
    } else {
        echo "<script>alert('Failed to update patient details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Patient</title>
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
            <h4 class="text-center my-4">Edit Patient Details</h4>
            <div class="col-md-8 mx-auto">
                <form method="post">
                    <div class="form-group mb-3">
                        <label>Firstname</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $patient['firstname']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Surname</label>
                        <input type="text" name="surname" class="form-control" value="<?php echo $patient['surname']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Blood Type</label>
                        <input type="text" name="bloodtype" class="form-control" value="<?php echo $patient['bloodtype']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $patient['email']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $patient['phone']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $patient['country']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?php echo $patient['dob']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3" required><?php echo $patient['address']; ?></textarea>
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
