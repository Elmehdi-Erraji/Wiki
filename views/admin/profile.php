<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Profile </title>
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
        .error-message {
            color: red;
            font-size: 14px;
            /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper1">


        <!-- ========== Topbar Start ========== -->
        <?php include 'includes/dash1-header.php'; ?>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'includes/dash1-menue.php'; ?>
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
                        <div class="col-sm-12">
                            <div class="profile-bg-picture" style="background-image:url('/Brief-10-ImmoConnect/app/routes/../../public/assets/images/bg-profile.jpg')">
                                <span class="picture-bg-overlay"></span>
                                <!-- overlay -->
                            </div>
                            <!-- meta -->
                            <div class="profile-user-box">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="profile-user-img"><img src="/wiki/app/routes/<?php echo $user->getImage(); ?>" alt="" class="avatar-lg rounded-circle"></div>
                                        <div class="">
                                            <h4 class="mt-4 fs-17 ellipsis"><?php echo $user->getUsername(); ?></h4>
                                            <?php
                                            $roleId = $user->getRoleId();
                                            if ($roleId === 1) {
                                                echo '<p class="font-13"><span class="badge bg-primary">Admin</span></p>';
                                            } else if ($roleId === 2) {
                                                echo '<p class="font-13"><span class="badge bg-info-subtle text-info">Author</span></p>';
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex justify-content-end align-items-center gap-2">

                                            <a href="wiki-add" class="btn btn-primary">
                                                <i class="ri-add-line align-text-bottom me-1 fs-16 lh-1"></i>
                                                Add Wiki
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ meta -->
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card p-0">
                                <div class="card-body p-0">
                                    <div class="profile-content">
                                        <ul class="nav nav-underline nav-justified gap-0">

                                            <li class="nav-item"><a id="editProfileLink " class="nav-link active" data-bs-toggle="tab" data-bs-target="#edit-profile" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Settings</a></li>
                                            <li class="nav-item"><a class="nav-link " data-bs-toggle="tab" data-bs-target="#Wikies" type="button" role="tab" aria-controls="home" aria-selected="true" href="#Wikies">My Wikies</a></li>
                                        </ul>

                                        <div class="tab-content m-0 p-4">
                                            <!-- settings -->
                                            <div id="edit-profile" class="tab-pane active">
                                                <div class="user-profile-content">
                                                    <form action="updateProfile" method="POST" id="userForm" enctype="multipart/form-data">
                                                        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                                                        <div class="row row-cols-sm-2 row-cols-1">
                                                            <div class="mb-2">
                                                                <label class="form-label" for="FullName">Username</label>
                                                                <input type="text" name="username" value="<?php echo $user->getUsername(); ?>" id="FullName" class="form-control">
                                                                <span id="fullNameError" class="error-message"></span> <!-- Error span for username -->
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="Email">Email</label>
                                                                <input type="email" name="email" value="<?php echo $user->getEmail(); ?>" id="Email" class="form-control">
                                                                <span id="emailError" class="error-message"></span> <!-- Error span for email -->
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="file" class="form-label">Upload Image </label>
                                                                <input type="file" id="file" name="user_image" class="form-control" accept="image/jpeg, image/png, image/jpg">
                                                                <span id="imageError" class="error-message"></span> <!-- Error span for image upload -->
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit" name="updateProfile"><i class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                                    </form>

                                                    <script>
                                                        document.getElementById('userForm').addEventListener('submit', function(event) {
                                                            event.preventDefault(); // Prevent form submission for now
                                                            let username = document.getElementById('FullName').value.trim();
                                                            let email = document.getElementById('Email').value.trim();
                                                            let fileInput = document.getElementById('file');
                                                            let valid = true;

                                                            // Validation checks - customize these as needed
                                                            if (username === '') {
                                                                document.getElementById('fullNameError').textContent = 'Username is required';
                                                                valid = false;
                                                            } else {
                                                                document.getElementById('fullNameError').textContent = '';
                                                            }

                                                            if (email === '') {
                                                                document.getElementById('emailError').textContent = 'Email is required';
                                                                valid = false;
                                                            } else {
                                                                document.getElementById('emailError').textContent = '';
                                                            }

                                                            // Check if passwords are provided and match

                                                            // Add validation for file upload (image) if provided
                                                            if (fileInput.value.trim() !== '') {
                                                                if (fileInput.accept.includes(fileInput.files[0].type)) {
                                                                    document.getElementById('imageError').textContent = '';
                                                                } else {
                                                                    document.getElementById('imageError').textContent = 'Please select a valid image file (jpeg, png, jpg)';
                                                                    valid = false;
                                                                }
                                                            }

                                                            if (valid) {
                                                                // If all validations pass, submit the form
                                                                this.submit();
                                                            }
                                                        });
                                                    </script>


                                                </div>
                                            </div>

                                            <!-- properties -->
                                            <div id="Wikies" class="tab-pane">
                                                <div class="row m-t-10">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">

                                                                <thead>
                                                                    <tr>
                                                                        <th>Id</th>
                                                                        <th>Wiki Title</th>
                                                                        <th>Category</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach($MyWikies as $MyWiki) :?>
                                                                    <tr>
                                                                        <td><?php echo $MyWiki->getId(); ?></td>
                                                                        <td><?php echo $MyWiki->getTitle(); ?></td>
                                                                        <td><?php echo $MyWiki->getCategoryName(); ?></td>
                                                                        
                                                                        <td><?php
                                                                            $statusId = $MyWiki->getStatus();
                                                                            if ($statusId === 0) { // Adjust this condition based on your role IDs
                                                                                echo '<span class="badge bg-info-subtle text-info">Pending</span>';
                                                                            } else if ($statusId === 1) { // Adjust this condition based on your role IDs
                                                                                echo '<span class="badge bg-warning-subtle text-warning">Accepted</span>';
                                                                            } else if ($statusId === 2) { // Adjust this condition based on your role IDs
                                                                                echo '<span class="badge bg-secondary">Refuded</span>';
                                                                            }
                                                                       ?> </td>
                                                                        <td>
                                                                        <a href="Delete-Wiki?wiki_id=<?php echo $MyWiki->getId(); ?>" class="btn btn-danger">Delete</a>
                                                                        <a href="Update-Wiki?wiki_id=<?php echo $MyWiki->getId(); ?>" class="btn btn-info">Update</a>
                                                                        </td>
                                                                    </tr>
                                                                        <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                </div>
                <!-- end row -->

            </div>
            <!-- container -->
        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © <b>Mehdi</b>
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


    <!-- Vendor js -->
    <script src="/wiki/app/routes/../../public/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="/wiki/app/routes/../../public/js/app.min.js"></script>

</body>

</html>