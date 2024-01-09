<?php 

session_start();
if (!isset($_SESSION['user_id'])) {
    
    header('Location: login');
    exit();
}

use app\services\UserServices;
// Fetch user details by ID using UserDAO method
$userService = new UserServices();
$userId = $_SESSION['user_id'];
$user = $userService->getUserById($userId);

use app\controllers\WikiController;

$wikiController = new WikiController();

$MyWikies = $wikiController->getMyWikies($userId);

?>
<div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center gap-1">

                <!-- Topbar Brand Logo -->
                <div class="logo-topbar">
                    <!-- Logo light -->
                    <a href="index.html" class="logo-light">
                        <span class="logo-lg">
                            <img src="/wiki/app/routes/../../public/images/logo-sm.png" >
                        </span>
                        <span class="logo-sm">
                            <img src="/wiki/app/routes/../../public/images/logo-sm.png" >
                        </span>
                    </a>

                    <!-- Logo Dark -->
                    <a href="index.html" class="logo-dark">
                        <span class="logo-lg">
                            <img src="/wiki/app/routes/../../public/images/logo-sm.png" alt="dark logo">
                        </span>
                        <span class="logo-sm">
                            <img src="/wiki/app/routes/../../public/images/logo-sm.png" >
                        </span>
                    </a>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="ri-menu-line"></i>
                </button>

                <!-- Horizontal Menu Toggle Button -->
                <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>

                <!-- Topbar Search Form -->
                
            </div>

            <ul class="topbar-menu d-flex align-items-center gap-3">
                

                <li class="d-none d-sm-inline-block">
                    <div class="nav-link" id="light-dark-mode">
                        <i class="ri-moon-line fs-22"></i>
                    </div>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="/wiki/app/routes/<?php echo $user->getImage(); ?>"  width="32" class="rounded-circle">
                        </span>
                        <span class="d-lg-block d-none">
                            <h5 class="my-0 fw-normal"><?php echo $user->getUsername(); ?> <i
                                    class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                        <!-- item-->
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="profile" class="dropdown-item">
                            <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="logout" class="dropdown-item">
                            <i class="ri-lock-password-line fs-18 align-middle me-1"></i>
                            <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="logout" class="dropdown-item">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>