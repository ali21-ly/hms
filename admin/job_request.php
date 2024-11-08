<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Request</title>
</head>
<body>

    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center">Job Request</h5>
                    <div id="show"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function showRequests() {
            $.ajax({
                url: "ajax_job_request.php",
                method: "POST",
                success: function(data) {
                    $("#show").html(data);
                }
            });
        }
        showRequests(); // Initial call to load requests

        // Approve button functionality
        $(document).on('click', '.approve', function() {
            var id = $(this).attr("id");

            $.ajax({
                url: "update_request_status.php",
                method: "POST",
                data: { id: id, action: "approve" },
                success: function(response) {
                    if (response === "success") {
                        alert("Request approved successfully!");
                        showRequests(); // Refresh requests after action
                    } else {
                        alert("Error: " + response);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        });

        // Reject button functionality
        $(document).on('click', '.reject', function() {
            var id = $(this).attr("id");

            $.ajax({
                url: "update_request_status.php",
                method: "POST",
                data: { id: id, action: "reject" },
                success: function(response) {
                    if (response === "success") {
                        alert("Request rejected successfully!");
                        showRequests(); // Refresh requests after action
                    } else {
                        alert("Error: " + response);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        });
    });
</script>


</body>
</html>
