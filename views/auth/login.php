<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/wiki/app/routes/../../public/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="/wiki/app/routes/../../public/js/config.js"></script>

    <!-- App css -->
    <link href="/wiki/app/routes/../../public/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="/wiki/app/routes/../../public/css/icons.min.css" rel="stylesheet" type="text/css" />

    <style>
        .error-message {
            color: red;
            font-size: 14px;
            /* Adjust the font size as needed */
        }
    </style>
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="/wiki/app/routes/../../public/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">

                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>

                                        <!-- form -->
                                        <form id="loginForm" action="login" method="post">
                                        <?php
                                            session_start();
                                            if (isset($_SESSION['login_error'])) {
                                                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
                                                unset($_SESSION['login_error']); 
                                            }
                                            ?>
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email">
                                                <span id="emailError" class="error-message"></span> <!-- Error span for email -->
                                            </div>
                                            <div class="mb-3">
                                                <a href="forgetPassword" class="text-muted float-end"><small>Forgot your password?</small></a>
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                                <span id="passwordError" class="error-message"></span> <!-- Error span for password -->
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit" name="login"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span> </button>
                                            </div>

                                            <div class="text-center mt-4">
                                                <p class="text-muted fs-16">Sign in with</p>
                                                <div class="d-flex gap-2 justify-content-center mt-3">
                                                    <a href="#" class="btn btn-soft-primary"><i class="ri-facebook-circle-fill"></i></a>
                                                    <a href="#" class="btn btn-soft-danger"><i class="ri-google-fill"></i></a>
                                                    <a href="#" class="btn btn-soft-info"><i class="ri-twitter-fill"></i></a>
                                                    <a href="#" class="btn btn-soft-dark"><i class="ri-github-fill"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                        <script>
                                            document.getElementById('loginForm').addEventListener('submit', function(event) {
                                                event.preventDefault(); // Prevent form submission for now
                                                // Basic validation for email and password
                                                let email = document.getElementById('emailaddress').value.trim();
                                                let password = document.getElementById('password').value.trim();

                                                let valid = true;

                                                // Validation checks - customize these as needed
                                                if (email === '') {
                                                    document.getElementById('emailError').textContent = 'Email is required';
                                                    valid = false;
                                                } else {
                                                    document.getElementById('emailError').textContent = '';
                                                }

                                                if (password === '') {
                                                    document.getElementById('passwordError').textContent = 'Password is required';
                                                    valid = false;
                                                } else {
                                                    document.getElementById('passwordError').textContent = '';
                                                }

                                                if (valid) {
                                                    // If all validations pass, submit the form
                                                    this.submit();
                                                }
                                            });
                                        </script>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Don't have an account? <a href="register" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Mehdi
        </span>
    </footer>
    <!-- Vendor js -->

    <!-- App js -->
    <script src="/wiki/app/routes/../../public/js/app.min.js"></script>

</body>

</html>