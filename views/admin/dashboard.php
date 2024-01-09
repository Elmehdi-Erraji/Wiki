<?php

require_once __DIR__ . '/../../vendor/autoload.php';


use app\Controllers\UserController;
use app\Controllers\CategoryController;
use app\Controllers\WikiController;

$cat = new CategoryController();
list($catCount)=$cat->showData();

$wiki = new WikiController();
list($wikiCount)=$wiki->showData();

$data = new UserController();
list($userCount) = $data->showData();

$errors = $_SESSION['updateUserErrors'] ?? [];
unset($_SESSION['updateUserErrors']); // Clear the errors after displaying them




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="fully responsive." name="description" />
    <meta content="Mehdi" name="author" />

    <!-- App favicon -->
    <!-- <link rel="stylesheet" href="/Brief-10-ImmoConnect/app/routes/../../public/csschat/chatbox.css"> -->

    <link rel="shortcut icon" href="/wiki/app/routes/../../public/images/favicon.ico">


    <!-- Theme Config Js -->
    <script src="/Brief-10-ImmoConnect/app/routes/../../public/assets/js/config.js"></script>

    <!-- App css -->
    <link href="/Brief-10-ImmoConnect/app/routes/../../public/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="/Brief-10-ImmoConnect/app/routes/../../public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  
    <!-- Icons css -->
    <link href="/Brief-10-ImmoConnect/app/routes/../../public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <?php include 'includes/dash1-header.php';?>
      
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

                        <div class="col-xxl-3 col-sm-6">
                            <div class="card widget-flat text-bg-primary">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-group-2-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                                    <h2 class="my-2"><?php echo $userCount; ?></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-sm-6">
                            <div class="card widget-flat text-bg-info">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-file-text-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Wiki's</h6>
                                    <h2 class="my-2"><?php echo $wikiCount; ?></h2>

                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-xxl-3 col-sm-6">
                            <div class="card widget-flat text-bg-purple">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-folder-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Categories</h6>
                                    <h2 class="my-2"><?php echo $catCount; ?></h2>

                                </div>
                            </div>
                        </div>
                        <!-- end col-->
                    </div>


                    <!-- end row -->

                    <div class="row">


                        <div class="col-xl-8">
                            <!-- Todo-->
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="p-3">
                                        <div class="app-search d-none d-lg-block">
                                            <form id="searchForm" style="width: 40%;">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search..." id="searchInput">
                                                    <span class="ri-search-line search-icon text-muted"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div id="yearly-sales-collapse" class="collapse show">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>E-mail</th>
                                                        
                                                        <th>Status</th>
                                                        <th>Role</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBody">
                                                    <!-- Table data will be dynamically populated here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        fetchData();

                                        document.getElementById('searchInput').addEventListener('input', async function(event) {
                                            const searchTerm = event.target.value.toLowerCase();
                                            await filterTable(searchTerm);
                                        });
                                    });

                                    async function filterTable(searchTerm) {
                                        const tableRows = document.querySelectorAll('#tableBody tr');

                                        for (const row of tableRows) {
                                            let found = false;
                                            const columns = row.getElementsByTagName('td');

                                            for (const column of columns) {
                                                const text = column.textContent.toLowerCase();

                                                if (text.includes(searchTerm)) {
                                                    found = true;
                                                    break; // Exit loop if found in this column
                                                }
                                            }

                                            if (found) {
                                                row.style.display = ''; // Show row if search term found in any column
                                            } else {
                                                row.style.display = 'none'; // Hide row if search term not found in any column
                                            }
                                        }
                                    }

                                    function fetchData() {
                                        var xhr = new XMLHttpRequest();

                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    var data = JSON.parse(xhr.responseText);
                                                    populateTable(data);
                                                } else {
                                                    console.error('Error fetching data: ' + xhr.status);
                                                }
                                            }
                                        };

                                        xhr.open('GET', 'fetchUsers', true);
                                        xhr.send();
                                    }

                                        function populateTable(data) {
                                           console.log(data);
                                        var tableBody = document.getElementById('tableBody');
                                        tableBody.innerHTML = '';

                                        console.log(data);
                                        data.forEach(function(row) {
                                            var newRow = document.createElement('tr');

                                            newRow.innerHTML = `
                                            <td>${row.id}</td>
                                            <td>${row.username}</td>
                                            <td>${row.email}</td>
                                            <td>${row.status}</td>
                                            <td>${row.role_id}</td>
                                            <td >
                                                <a href="Delete?user_id=${row.id}" class="btn btn-danger">Delete</a>
                                                <a href="Update?user_id=${row.id}" class="btn btn-info">Update</a>
                                                                                                                
                                            </td>
                                        `;

                                            tableBody.appendChild(newRow);
                                        });
                                    }
                                    
                                </script>



                            </div>

                        </div>
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
                        <!-- END wrapper -->

                        <!-- Theme Settings -->


                    <!-- Vendor js -->
                <script src="/Brief-10-ImmoConnect/app/routes/../../public/assets/js/vendor.min.js"></script>
                <!-- App js -->
                <script src="/Brief-10-ImmoConnect/app/routes/../../public/assets/js/app.min.js"></script>

</body>

</html>