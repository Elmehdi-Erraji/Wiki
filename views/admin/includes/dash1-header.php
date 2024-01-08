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
// Fetch user details by ID using UserServices instance method
$user = $userService->getUserById($userId);

?>
<div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center gap-1">

                <!-- Topbar Brand Logo -->
                <div class="logo-topbar">
                    <!-- Logo light -->
                    <a href="index.html" class="logo-light">
                        <span class="logo-lg">
                            <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" >
                        </span>
                        <span class="logo-sm">
                            <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" >
                        </span>
                    </a>

                    <!-- Logo Dark -->
                    <a href="index.html" class="logo-dark">
                        <span class="logo-lg">
                            <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" alt="dark logo">
                        </span>
                        <span class="logo-sm">
                            <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/logo-sm.png" >
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
                <div class="app-search d-none d-lg-block">
                    <form>
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search...">
                            <span class="ri-search-line search-icon text-muted"></span>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="topbar-menu d-flex align-items-center gap-3">
                <li class="dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="ri-search-line fs-22"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                        <form class="p-3">
                            <input type="search" class="form-control" placeholder="Search ..."
                                aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="ri-mail-line fs-22"></i>
                        <span class="noti-icon-badge badge text-bg-purple">2</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> Messages</h6>
                                </div>
                                
                            </div>
                        </div>

                        <div style="max-height: 300px;" data-simplebar>

                            <!-- item-->
                            <a href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <!-- <img src="/Brief-10-ImmoConnect/app/routes/" class="img-fluid rounded-circle" -->
                                                    alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold fs-14">Cristina Pride <small
                                                    class="fw-normal text-muted float-end ms-1">1 day ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Hi, How are you? What about our
                                                next meeting</small>
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <!-- item-->
                            <a href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img src="/Brief-10-ImmoConnect/app/routes/../../public/assets/images/users/avatar-5.jpg" class="img-fluid rounded-circle"
                                                    alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold fs-14">Shawn Millard <small
                                                    class="fw-normal text-muted float-end ms-1">4 day ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Yeah everything is fine</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                       

                    </div>
                </li>


                <li class="d-none d-sm-inline-block">
                    <div class="nav-link" id="light-dark-mode">
                        <i class="ri-moon-line fs-22"></i>
                    </div>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="/Brief-10-ImmoConnect/app/routes/<?php echo $user->getImage(); ?>"  width="32" class="rounded-circle">
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