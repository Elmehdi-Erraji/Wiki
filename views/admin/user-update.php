<?php
require_once __DIR__ . '../../../vendor/autoload.php';


include '../../app/controllers/UserController.php';

use app\Controllers\UserController;
use app\services\UserServices;

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch user details by ID using UserDAO method
    $userService = new UserServices();

    // Fetch user details by ID using UserServices instance method
    $userinfo = $userService->getUserById($userId);
    if (!$userinfo) {
        echo "User not found!";
        exit();
    }
} else {
    echo "Invalid user ID!";
    exit();
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Update </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="fully responsive." name="description" />
    <meta content="Mehdi" name="author" />

    <!-- App favicon -->
    <!-- <link rel="stylesheet" href="/Brief-10-ImmoConnect/app/routes/../../public/csschat/chatbox.css"> -->

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



                    <!-- end row -->

                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Update A User</h4>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <form action="updateUser" method="POST" id="updateUserForm" enctype="multipart/form-data">
                                                <input type="hidden" name="user_id" value="<?php echo $userinfo->getId(); ?>">

                                                <!-- User Name -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Usernmae</label>
                                                    <input type="text" id="name" class="form-control" name="username" placeholder="First Name" value="<?php echo $userinfo->getUsername(); ?>">
                                                    <span id="nameError" class="error">
                                                        <?php echo isset($errors['username']) ? $errors['username'] : ''; ?>
                                                    </span>
                                                </div>


                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $userinfo->getEmail(); ?>">
                                                    <span id="emailError" class="error">
                                                        <?php echo isset($errors['email']) ? $errors['email'] : ''; ?>
                                                    </span>
                                                </div>
                                                
                                                <!-- User Role -->
                                                <div class="mb-3">
                                                    <label for="user_role" class="form-label">User Role</label>
                                                    <select class="form-select" id="user_role" name="user_role">
                                                        <option value="1" <?php echo ($userinfo->getRoleId() == 1) ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="2" <?php echo ($userinfo->getRoleId() == 2) ? 'selected' : ''; ?>>Author</option>
                                                        <!-- Add more options if needed -->
                                                    </select>
                                                </div>
                                                <!-- User Status -->
                                                <div class="mb-3">
                                                    <label for="statut" class="form-label">User Status</label>
                                                    <select class="form-select" id="statut" name="status">
                                                        <option value="0" <?php echo ($userinfo->getStatus() == 0) ? 'selected' : ''; ?>>Active</option>
                                                        <option value="1" <?php echo ($userinfo->getStatus() == 1) ? 'selected' : ''; ?>>Desactive</option>
                                                        <!-- Add more options if needed -->
                                                    </select>

                                                </div>
                                                <button type="submit" id="submitButton" class="btn btn-primary" name="updateUser">Submit</button>
                                                <a href="dashboard"><button type="button" class="btn btn-dark">Back</button></a>
                                            </form>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-->
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