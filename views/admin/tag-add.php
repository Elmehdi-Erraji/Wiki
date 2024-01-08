<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Add </title>
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
    <style>
     .error {
        color: red;
        font-size: 14px; /* Adjust the font size as needed */
    }
</style>
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
                                    <h4 class="header-title">Add a new user</h4>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form action="addUser" method="POST" id="addUserForm" enctype="multipart/form-data">
                                                <!-- User Name -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Username</label>
                                                    <input type="text" id="name" class="form-control" name="username" placeholder="Username">
                                                    <span id="nameError" class="error"></span>
                                                </div>

                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                                    <span id="emailError" class="error"></span>
                                                </div>

                                                <!-- User Role -->
                                                <div class="mb-3">
                                                    <label for="user_role" class="form-label">User Role</label>
                                                    <select class="form-select" id="user_role" name="user_role">
                                                        <option value="1">Admin</option>
                                                        <option value="2">Author</option>
                                                        
                                                    </select>
                                                    <span class="error" id="userRoleError"></span>
                                                </div>
                                                

                                                <!-- User Status -->
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">User Status</label>
                                                    <select class="form-select" id="" name="status">
                                                        <option value="0">Active</option>
                                                        <option value="1">Deactivated</option>
                                                        <!-- Add more options if needed -->
                                                    </select>
                                                    <span class="error" id="statusError"></span>
                                                </div>

                                                <!-- Password -->
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span id="passwordError" class="error"></span>
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="mb-3">
                                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Re-enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span id="confirmPasswordError" class="error"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Upload Image</label>
                                                    <input type="file" id="file" name="user_image" class="form-control" accept="image/jpeg, image/png,image/jpg">
                                                    <span id="fileError" class="error"></span>
                                                </div>

                                                <button type="submit" id="submitButton" class="btn btn-primary" name="addUser">Submit</button>
                                            </form>
                                            <script>
                                                document.getElementById('addUserForm').addEventListener('submit', function(event) {
                                                    let isValid = true;

                                                    // Validation for Username
                                                    let username = document.getElementById('name').value.trim();
                                                    if (username === '') {
                                                        document.getElementById('nameError').textContent = 'Username is required';
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById('nameError').textContent = '';
                                                    }

                                                    // Validation for Email
                                                    let email = document.getElementById('email').value.trim();
                                                    if (email === '') {
                                                        document.getElementById('emailError').textContent = 'Email is required';
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById('emailError').textContent = '';
                                                    }

                                                    // Validation for Phone Number
                                                    let phone = document.getElementById('phone').value.trim();
                                                    if (phone === '') {
                                                        document.getElementById('phoneError').textContent = 'Phone number is required';
                                                        isValid = false;
                                                    } else if (!/^\d{10}$/.test(phone)) {
                                                        document.getElementById('phoneError').textContent = 'Please enter a valid 10-digit phone number';
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById('phoneError').textContent = '';
                                                    }

                                                    // Validation for Password
                                                    let password = document.getElementById('password').value.trim();
                                                    if (password === '') {
                                                        document.getElementById('passwordError').textContent = 'Password is required';
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById('passwordError').textContent = '';
                                                    }

                                                    // Validation for Confirm Password
                                                    let confirmPassword = document.getElementById('confirmPassword').value.trim();
                                                    if (confirmPassword === '') {
                                                        document.getElementById('confirmPasswordError').textContent = 'Confirm password is required';
                                                        isValid = false;
                                                    } else if (confirmPassword !== password) {
                                                        document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
                                                        isValid = false;
                                                    } else {
                                                        document.getElementById('confirmPasswordError').textContent = '';
                                                    }

                                                    if (!isValid) {
                                                        event.preventDefault(); // Prevent form submission if validation fails
                                                    }
                                                });
                                            </script>
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