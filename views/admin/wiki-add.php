
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

    <script src="https://cdn.tiny.cloud/1/nsfmao5824o0u5lkezu6n9nzx5pdxiywmnou62t28plpkfvx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
            font-size: 14px;
            /* Adjust the font size as needed */
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
                                    <h4 class="header-title">Add a new Wiki</h4>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form action="addWiki" method="POST" id="addWiki" enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    
                                            <div class="mb-3">
                                                    <label for="title" class="form-label">Article Title</label>
                                                    <input type="text" id="title" class="form-control" name="title" placeholder="Enter Article Title">
                                                    <span id="titleError" class="error"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Article Content</label>
                                                    <textarea id="content" class="form-control" name="content" placeholder="Enter Article Content"></textarea>
                                                    <span id="contentError" class="error"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Select Category</label>
                                                    <select class="form-select" id="category" name="category">
                                                    <option value="" selected disabled>Select a category</option>
                                                    <?php foreach ($categoris as $category) : ?>
                                                            <option value="<?php echo $category->getId(); ?>"><?php echo $category->getcategoryName(); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span id="categoryError" class="error"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tags" class="form-label">Select Tags</label>
                                                    <select multiple class="form-select" id="tags" name="tags[]" size="5">
                                                    <?php foreach ($tags as $tag) : ?>
                                                            <option value="<?php echo $tag->getId(); ?>"><?php echo $tag->getTagName(); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span id="tagsError" class="error"></span>
                                                </div>

                                                <!-- Display selected tags in an input field -->
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Selected Tags" id="selectedTagsInput" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="clearSelectedTagsBtn">Clear</button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="article_image" class="form-label">Upload Article Image</label>
                                                    <input type="file" id="article_image" name="article_image" class="form-control" accept="image/jpeg, image/png, image/jpg">
                                                    <span id="imageError" class="error"></span>
                                                </div>

                                                <button type="submit" id="submitArticleButton" class="btn btn-primary" name="addWiki">Submit Wiki</button>
                                            </form>
                                            <script>
                                                // Function to update the selected tags in the input field
                                                function updateSelectedTags() {
                                                    const selectTagsElement = document.getElementById('tags');
                                                    const selectedTagsInput = document.getElementById('selectedTagsInput');
                                                    let selectedTags = '';

                                                    for (const option of selectTagsElement.options) {
                                                        if (option.selected) {
                                                            selectedTags += `${option.textContent}, `;
                                                        }
                                                    }

                                                    // Update the input field value
                                                    selectedTagsInput.value = selectedTags.slice(0, -2); // Remove the trailing comma and space
                                                }

                                                // Event listener to update selected tags when the selection changes
                                                document.getElementById('tags').addEventListener('click', updateSelectedTags);

                                                // Clear button functionality
                                                document.getElementById('clearSelectedTagsBtn').addEventListener('click', function() {
                                                    document.getElementById('tags').selectedIndex = -1;
                                                    updateSelectedTags();
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
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>
</body>

</html>