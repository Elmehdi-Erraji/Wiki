<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// include '../../app/controllers/UserController.php';

use app\Controllers\UserController;

$userController = new UserController();
$users = $userController->getAllUsers();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Users List </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="fully responsive." name="description" />
    <meta content="Mehdi" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="/wiki/app/routes/../../public/images/favicon.ico">


    <!-- Theme Config Js -->
    <script src="/wiki/app/routes/../../public/js/config.js"></script>

    <!-- App css -->
    <link href="/wiki/app/routes/../../public/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="/wiki/app/routes/../../public/css/icons.min.css" rel="stylesheet" type="text/css" />


    <!-- Icons css -->
    <link href="/wiki/app/routes/../../public/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->

        <?php include 'includes/dash1-header.php' ?>

        <!-- ========== Topbar Start ========== -->


        <!-- ========== Left Sidebar Start ========== -->

        <?php include 'includes/dash1-menue.php' ?>

        <!-- ========== Left Sidebar End ========== -->



        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Welcome!</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Welcome!</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">


                        <div class="col-xl-8">
                            <!-- Todo-->
                            <div class="card">
                                <div class="card-body p-0">

                                    <div class="p-3">
                                        <div class="card-widgets">
                                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                                        </div>
                                        <a href="user-add"><button type="button" class="btn btn-info">Add a new User</button></a>
                                        <br>
                                        <br>
                                        <div class="app-search d-none d-lg-block">
                                            <form style="width: 40%;" id="searchForm">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search..." id="searchInput">
                                                    <span class="ri-search-line search-icon text-muted"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div id="yearly-sales-collapse" class="collapse show">

                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0" id="userTable">
                                                <thead>
                                                    <tr>
                                                        <th>Img</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        
                                                        <th>Status</th>
                                                        <th>Role</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($users as $user) : ?>
                                                        <tr>
                                                            <td class="table-user">
                                                                <img src="/wiki/app/routes/<?php echo $user->getImage(); ?>" class="me-2 rounded-circle" />
                                                            </td>
                                                            <td><?php echo $user->getUsername(); ?></td>
                                                            <td><?php echo $user->getEmail(); ?></td>
                                                            
                                                            <td>
                                                                <?php
                                                                $status = $user->getStatus();
                                                                if ($status === 0) {
                                                                    echo '<span class="badge bg-warning-subtle text-warning">Active</span>';
                                                                } else if ($status === 'not_returned') {
                                                                    echo '<span class="badge bg-pink-subtle text-pink">Not Returned</span>';
                                                                } else if ($status === 1) {
                                                                    echo '<span class="badge bg-secondary">Desactive</span>';
                                                                } 
                                                                ?>
                                                            </td>
                                                            <td> <?php
                                                                    $roleId = $user->getRoleId();
                                                                    if ($roleId === 1) { // Adjust this condition based on your role IDs
                                                                        echo '<span class="badge bg-primary">Admin</span>';
                                                                    } else if ($roleId === 2) { // Adjust this condition based on your role IDs
                                                                        echo '<span class="badge bg-info-subtle text-info">Author</span>';
                                                                    } 
                                                                    ?></td>
                                                            <td>
                                                                <a href="Delete?user_id=<?php echo $user->getId(); ?>" class="btn btn-danger">Delete</a>
                                                                <a href="Update?user_id=<?php echo $user->getId(); ?>" class="btn btn-info">Update</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container -->

            </div>





            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Created by<b> Mehdi</b>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->


    <!-- Vendor js -->
    <script src="/wiki/app/routes/../../public/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="/wiki/app/routes/../../public/js/app.min.js"></script>

</body>

</html>