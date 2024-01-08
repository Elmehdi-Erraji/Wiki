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
                        <div class="col-xl-6">
                            <div class="page-title-box">
                                <h4 class="page-title">Welcome!</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body p-0">

                                    <div class="p-3">
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#signup-modal">Add a new Tag</button>
                                        <br>
                                        <br>
                                    </div>


                                    <div id="yearly-sales-collapse" class="collapse show">

                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0" id="userTable">
                                                <thead>
                                                    <tr>
                                                        <th>Tag Id</th>
                                                        <th>Tag Name</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($users as $user) : ?>
                                                        <tr>

                                                            <td><?php echo $user->getUsername(); ?></td>
                                                            <td><?php echo $user->getEmail(); ?></td>

                                                            <td>
                                                                <a href="Delete?user_id=<?php echo $user->getId(); ?>" class="btn btn-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->


                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-body p-0">

                                    <div class="p-3">

                                        <a href="category-add"><button type="button" class="btn btn-info">Add a new Category</button></a>
                                        <br>
                                        <br>

                                    </div>


                                    <div id="yearly-sales-collapse" class="collapse show">

                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0" id="userTable">
                                                <thead>
                                                    <tr>
                                                        <th>Category Id</th>
                                                        <th>Category Name</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($users as $user) : ?>
                                                        <tr>

                                                            <td><?php echo $user->getUsername(); ?></td>
                                                            <td><?php echo $user->getEmail(); ?></td>



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
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container -->

            </div>

            <div class="modal fade" id="signup-modal" tabindex="-1" aria-labelledby="signup-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="signup-modal-label">Add a new Tag</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <!-- Your form content for adding a new tag -->
                            <form action="addTag" method="POST">
                                <div class="mb-3">
                                    <label for="tag-name" class="form-label">Tag Name</label>
                                    <input type="text" class="form-control" id="tag-name" name="tagName" placeholder="Enter tag name" required>
                                </div>
                                <!-- Add more form fields if needed -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addTag">Add Tag</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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