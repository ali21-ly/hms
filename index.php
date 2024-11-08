<!DOCTYPE html>
<html lang="en">
<head>
    <!-- This line declares that the document is written in HTML5 -->
    <meta charset="UTF-8">
    <!-- Specifies the character encoding as UTF-8, which ensures proper display of different language characters -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ensures that the website is responsive, allowing it to adjust to different screen sizes.
         The width=device-width makes the page's width match the device's width, and initial-scale=1.0 sets the default zoom level to 1:1 (no zoom) -->

    <title>HMS Home Page</title>
    <!-- Sets the title of the web page, which is displayed on the browser tab -->
</head>

<body>

<?php
include("include/header.php");
?>
<!-- PHP code to include the 'header.php' file. This is useful for reusing common components like navigation bars across multiple pages.
     The header.php file is expected to be in the 'include' directory. Make sure this path is correct, or it may give a 'file not found' error. -->

<div style="margin-top: 50px;"></div>
<!-- This div adds a 50px margin at the top to provide spacing between the header and the rest of the content -->

<div class="container">
    <!-- Bootstrap class 'container' is used to align the content properly and add padding around it. It makes the content responsive and aligned within the page layout. -->
    <div class="container">
    <div class="row text-center">
        <!-- أول عمود -->
        <div class="col-md-3 mx-1 shadow p-3">
            <img src="img/info.jpeg" style="width: 100%; height: 190px; object-fit: cover;" alt="Information Image">
            <h5 class="text-center">Click on the button for more information.</h5>
            <a href="#">
                <button class="btn btn-success my-3">More Information</button>
            </a>
        </div>

        <!-- ثاني عمود -->
        <div class="col-md-4 mx-1 shadow p-3">
            <img src="img/patient.jpg" style="width: 100%; height: 190px; object-fit: cover;" alt="Patient Image">
            <h5 class="text-center">Create Account so that we can take good care of you.</h5>
            <a href="#">
                <button class="btn btn-success my-3">Create Account!!!</button>
            </a>
        </div>

        <!-- ثالث عمود -->
        <div class="col-md-4 mx-1 shadow p-3">
            <img src="img/doctor.jpeg" style="width: 100%; height: 190px; object-fit: cover;" alt="Doctor Image">
            <h5 class="text-center">We are employing for doctors</h5>
            <a href="#">
                <button class="btn btn-success my-3">Apply Now!!!</button>
            </a>
        </div>
    </div>
</div>


    </div>
</div>
<!-- Ends the container div that wraps the row and column layout for the images. -->

</body>
</html>

