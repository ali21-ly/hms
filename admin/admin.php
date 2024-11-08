<?php
session_start();
ob_start(); // استخدام ob_start لتخزين الإخراج مؤقتًا
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <!-- ربط Bootstrap و Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- تضمين الهيدر -->
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <!-- القائمة الجانبية -->
            <div class="col-md-2" style="margin-left:-30px"> <!-- القائمة الجانبية -->
                <?php include("sidenav.php");
                include("../include/connection.php");
                ?>
            </div>

            <!-- محتوى الصفحة -->
            <div class="col-md-10"> <!-- تخصيص عرض المحتوى الرئيسي -->
                <div class="row my-4">
                    <!-- قسم All Admin -->
                    <div class="col-md-6">
                        <h5 class="text-center">All Admin</h5>

                        <!-- الجدول الخاص بـ All Admin مباشرة بعد العنوان -->
                        <div class="col-md-8 mx-auto" > <!-- تحديد عرض الجدول 5 أعمدة وتوسيطه -->
                            <?php
                            $ad = $_SESSION['admin'];
                            $query = "SELECT * FROM admin WHERE username !='$ad'";
                            $res = mysqli_query($connect, $query);

                            $output = "
                                <table class='table table-bordered text-center'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th style='width: 10%'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ";

                            if (mysqli_num_rows($res) < 1) {
                                $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                            }

                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $username = $row['username'];

                                $output .= "
                                    <tr>
                                        <td>$id</td>
                                        <td>$username</td>
                                        <td>
                                           <a href='admin.php?id=$id'><button id='$id' class='btn btn-danger btn-sm'>Remove</button></a>
                                        </td>
                                    </tr>
                                ";
                            }

                            $output .= "
                                    </tbody>
                                </table>
                            ";

                            echo $output;

                            // تصحيح استعلام الحذف
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                $query = "DELETE FROM admin WHERE id='$id'";
                                mysqli_query($connect, $query);

                                // إعادة توجيه بعد الحذف لتجنب تكرار الحذف عند إعادة تحميل الصفحة
                                header("Location: admin.php");
                                exit();
                            }
                            ?>
                        </div>
                    </div>

                    <!-- قسم Add Admin -->
                    <div class="col-md-6">
                      <?php
                      if (isset($_POST['add'])) {
                        $uname = $_POST['uname'];
                        $pass = $_POST['pass'];
                        $image = $_FILES['img']['name'];

                        $error = array();

                        if (empty($uname)) {
                            $error['u'] = "Enter Admin Username";
                        } elseif (empty($pass)) {
                            $error['u'] = "Enter Admin Password";
                        } elseif (empty($image)) {
                            $error['u'] = "Add Admin Picture";
                        }
                           
                        if (count($error) == 0) {
                            $q = "INSERT INTO admin(username,password,profile)
                                  VALUES('$uname','$pass','$image')";

                            $result = mysqli_query($connect, $q);

                            if ($result) {
                                move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
                            }
                        }
                      }

                      if (isset($error['u'])) {
                        $er = $error['u'];
                        $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
                      } else {
                        $show = "";
                      }
                      ?>

                        <h5 class="text-center">Add Admin</h5>
                        <form method="post" enctype="multipart/form-data">
                            <?php
                            echo $show;
                            ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="uname" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Add Admin Picture</label>
                                <input type="file" name="img" class="form-control">
                            </div><br>
                            <input type="submit" name="add" value="Add New Admin" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap و jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


