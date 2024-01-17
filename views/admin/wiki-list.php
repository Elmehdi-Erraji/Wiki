<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Wiki List </title>
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
                                        <a href="wiki-add"><button type="button" class="btn btn-info">Add a new Wiki</button></a>
                                        <br>
                                        <br>

                                    </div>


                                    <div id="yearly-sales-collapse" class="collapse show">

                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0" id="userTable">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Title</th>
                                                        <th>Created at</th>
                                                        <th>Category</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($wikies as $wiki) : ?>
                                                        <tr>
                                                            <td><?php echo $wiki->getId(); ?></td>
                                                            <td><?php echo $wiki->getTitle(); ?></td>
                                                            <td><?php echo $wiki->getCreatedAt(); ?></td>
                                                            <td><?php echo $wiki->getCategoryName(); ?></td>
                                                            <td> <?php
                                                                    $statusId = $wiki->getStatus();
                                                                    if ($statusId === 0) { // Adjust this condition based on your role IDs
                                                                        echo '<span class="badge bg-info-subtle text-info">Pending</span>';
                                                                    } else if ($statusId === 1) { // Adjust this condition based on your role IDs
                                                                        echo '<span class="badge bg-warning-subtle text-warning">Accepted</span>';
                                                                    } else if ($statusId === 2) { // Adjust this condition based on your role IDs
                                                                        echo '<span class="badge bg-secondary">Refuded</span>';
                                                                    }
                                                                    ?></td>
                                                            <td>
                                                                <a href="Delete-Wiki?wiki_id=<?php echo $wiki->getId(); ?>" class="btn btn-danger">Delete</a>
                                                                <a href="#" class="btn btn-warning update-visibility" data-wikiid="<?php echo $wiki->getId(); ?>" data-bs-toggle="modal" data-bs-target="#update-wiki-status-modal">Update Visibility</a>
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

                    <div class="modal fade" id="update-wiki-status-modal" tabindex="-1" aria-labelledby="update-wiki-status-modal-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="update-wiki-status-modal-label">Update Wiki Visibility</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <!-- Form for updating wiki visibility -->
                                    <form action="updateWikiStatus" method="POST" id="updateWikiStatusForm">
                                        <!-- Hidden input field to store the wiki ID -->
                                        <input type="hidden" id="update-wiki-id" name="wikiId" value="">
                                        <div class="mb-3">
                                            <label for="update-wiki-status" class="form-label">Select Visibility</label>
                                            <select class="form-select" id="update-wiki-status" name="wikiStatus">
                                                <option value="0">Pending</option>
                                                <option value="1">Accepted</option>
                                                <option value="2">Refused</option>
                                            </select>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" name="updateWikiStatus">Update Visibility</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const updateVisibilityButtons = document.querySelectorAll('.update-visibility');

                            updateVisibilityButtons.forEach(button => {
                                button.addEventListener('click', function(event) {
                                    const wikiId = this.getAttribute('data-wikiid');

                                    // Set the modal form field with wiki ID
                                    document.getElementById('update-wiki-id').value = wikiId;

                                    // Display the modal
                                    const updateWikiStatusModal = new bootstrap.Modal(document.getElementById('update-wiki-status-modal'));
                                    updateWikiStatusModal.show();

                                    // Add event listener for modal hiding event
                                    updateWikiStatusModal._element.addEventListener('hidden.bs.modal', function() {
                                        // Remove the modal overlay manually when the modal is closed
                                        document.body.classList.remove('modal-open');
                                        const modalBackdrop = document.querySelector('.modal-backdrop');
                                        if (modalBackdrop) {
                                            modalBackdrop.remove();
                                        }
                                    });
                                });
                            });

                            // Validate form before submitting (if needed)
                            document.getElementById('updateWikiStatusForm').addEventListener('submit', function(event) {
                                // You can add form validation logic here if needed
                            });
                        });
                    </script>

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