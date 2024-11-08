<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
   // Redirect to login page if not logged in
   header("location:../index.php");
   exit;
}
// Admin dashboard content goes here
?>

<body>

   <!-- تضمين الهيدر -->
   <?php include("../include/header.php"); ?>

   <div class="container-fluid">
    <div class="col-md-12">
  
   <div class="row">

         <!-- القائمة الجانبية -->
         <div class="col-md-2" style="margin-left:-30px"> <!-- تعديل عرض القائمة الجانبية إلى col-md-2 -->
            <?php include("sidenav.php"); ?>
         </div>

         <!-- محتوى الصفحة -->
         <div class="col-md-10" style="margin-left:30px"> <!-- تخصيص عرض المحتوى الرئيسي بـ col-md-10 -->
            <h4 class="my-2">Admin Dashboard</h4>
            <div class="col-md-12 my-1">
               <div class="row">
                  <div class ="col-md-12">

             
                  <?php
                  include("../include/connection.php"); 
                  $ad = mysqli_query($connect, "SELECT * FROM admin");  
                  $num = mysqli_num_rows($ad);
                  ?>
                     <div class="row">
                        <!-- بطاقة عدد الإداريين -->
                        <div class="col-md-3 bg-success mx-2 card">
                           <a href="admin.php" style="color: white; text-decoration: none; display: block;">
                              <i class="fas fa-users-cog"></i>
                              <h5>Total Admin</h5>
                              <h3><?php echo $num; ?></h3>
                           </a>
                        </div>

                        <!-- بطاقة عدد الأطباء -->
                        <div class="col-md-3 bg-info mx-2 card">
                           <?php
                           
                           $doctor = mysqli_query($connect,"SELECT *
                              FROM doctors WHERE status='Approved'");

                              $num2 = mysqli_num_rows($doctor);
                           
                           ?>
                           <a href="doctor.php" style="color: white; text-decoration: none; display: block;">
                              <i class="fas fa-user-md"></i>
                              <h5>Total Doctors</h5>
                              <h3><?php echo $num2?></h3>
                           </a>
                        </div>

                        <!-- بطاقة عدد المرضى -->
                        <div class="col-md-3 bg-warning mx-2 card">
                           <a href="patients.php" style="color: white; text-decoration: none; display: block;">
                              <i class="fas fa-procedures"></i>
                              <h5>Total Patients</h5>
                              <h3>0</h3>
                           </a>
                        </div>

                        <!-- بطاقة عدد التقارير -->
                        <div class="col-md-3 bg-danger mx-2 card">
                           <a href="reports.php" style="color: white; text-decoration: none; display: block;">
                              <i class="fas fa-flag"></i>
                              <h5>Total Reports</h5>
                              <h3>0</h3>
                           </a>
                        </div>

                        <!-- بطاقة عدد طلبات العمل -->
<div class="col-md-3 bg-warning mx-2 card">
   <?php
   include("../include/connection.php");

   // Correct SQL query syntax
   $job = mysqli_query($connect, "SELECT * FROM doctors WHERE status='Pending'");

   // Check if the query was successful
   if ($job) {
       // Get the number of rows
       $num1 = mysqli_num_rows($job);
   } else {
       // Handle query failure and set $num1 to 0
       $num1 = 0;
       echo "Error: " . mysqli_error($connect); // Debugging message
   }
   ?>
   <a href="job_request.php" style="color: white; text-decoration: none; display: block;">
      <i class="fas fa-briefcase"></i>
      <h5>Total Job Requests</h5>
      <h3><?php echo $num1; ?></h3>
   </a>
</div>

                        <!-- بطاقة إجمالي الدخل -->
                        <div class="col-md-3 bg-success mx-2 card">
                           <a href="income.php" style="color: white; text-decoration: none; display: block;">
                              <i class="fas fa-dollar-sign"></i>
                              <h5>Total Income</h5>
                              <h3>0</h3>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>

   <!-- ربط Bootstrap JS و jQuery -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>