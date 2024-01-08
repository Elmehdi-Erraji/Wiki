<?php

if (isset($_SESSION['role_id'])) {
    $user_type = $_SESSION['role_id'];
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

<!-- Brand Logo Light -->
<a href="#" class="logo logo-light">
    <span class="logo-lg">
        <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" alt="logo">
    </span>
    <span class="logo-sm">
        <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" alt="small logo">
    </span>
</a>

<!-- Brand Logo Dark -->
<a href="#" class="logo logo-dark">
    <span class="logo-lg">
        <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" alt="dark logo">
    </span>
    <span class="logo-sm">
        <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" alt="small logo">
    </span>
</a>

<!-- Sidebar -left -->
<div class="h-100" id="leftside-menu-container" data-simplebar>
    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title">Main</li>

       

        <?php if ($user_type === 1) { ?>
            <li class="side-nav-item">
            <a href="dashboard" class="side-nav-link">
                <i class="ri-dashboard-3-line"></i>
                <span> Dashboard </span>
            </a>
        </li>
            <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers" class="side-nav-link">
                <i class="ri-group-2-line"></i>
                <span> Users </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarUsers">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="user-add">Add User</a>
                    </li>
                    <li>
                        <a href="user-list">User List</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarServices" aria-expanded="false" aria-controls="sidebarServices" class="side-nav-link">
            <i class="ri-pages-line"></i>
                <span> Wiki's </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarServices">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="wiki-list.php">Wiki's List</a>
                    </li>
                    <li>
                        <a href="wiki-add.php">Wiki's Add</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarFAQ" aria-expanded="false" aria-controls="sidebarFAQ" class="side-nav-link">
                <i class="ri-questionnaire-line"></i>
                <span> Comments </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarFAQ">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="dash-comments">Comments List</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php } ?>


        <?php if ($user_type === 2) { ?>
            <li class="side-nav-item">
            <a href="announcment-list" class="side-nav-link">
                <i class="ri-dashboard-3-line"></i>
                <span> Dashboard </span>
            </a>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarServices" aria-expanded="false" aria-controls="sidebarServices" class="side-nav-link">
                <i class="ri-pencil-ruler-2-line"></i>
                <span> Announces </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarServices">
                <ul class="side-nav-second-level">
                <li>
                        <a href="reservations-list.php">Add Announces</a>
                    </li>
                    <li>
                        <a href="reservations-list.php">Announces List</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarFAQ" aria-expanded="false" aria-controls="sidebarFAQ" class="side-nav-link">
                <i class="ri-questionnaire-line"></i>
                <span> Comments </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarFAQ">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="dash-comments">Comments List</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php } ?>
        <?php if ($user_type === 3) { ?>
            <li class="side-nav-item">
            <a href="list" class="side-nav-link">
                <i class="ri-dashboard-3-line"></i>
                <span> Dashboard </span>
            </a>
       
            <li class="side-nav-item">
                <a href="users" class="side-nav-link">
                <i class="ri-mail-line"></i>
                    <span> Messages </span>
                </a>
             </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarFAQ" aria-expanded="false" aria-controls="sidebarFAQ" class="side-nav-link">
                <i class="ri-questionnaire-line"></i>
                <span> Comments </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarFAQ">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="dash-comments">Comments List</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php } ?>
    </ul>
    <!--- End Sidemenu -->
</div>

</div>


    <div class="clearfix"></div>
</div>
</div>

<?php } ?>
<!-- ========== Left Sidebar End ========== -->