<?php

  session_start();

  require_once "api/authorization.php";

  // Check if user is allowed this region
  check_admin();

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <!-- Head -->
    <?php include('statics/head.php') ?>

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Header -->
        <?php include('statics/header.php') ?>

        <!-- Sidebar -->
        <?php include('statics/sidebar.php') ?>

        <!-- Content -->
        <div class="page-wrapper">

            <div class="page-breadcrumb">

                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome Back!</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
                    
            </div>

            <div class="container-fluid">

                <div class="card-group">

                    <!-- Graduations -->
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" id="graduations-number">0</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Graduations</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted">
                                        <i data-feather="user-plus"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="achievements-number">0</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Achievements</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keynotes -->
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" id="keynotes-number">0</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Keynotes</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

             </div>

            <footer class="footer text-center text-muted">
                All Rights Reserved. 
                <a href="/">HALDOOR</a>.
            </footer>

        </div>

    </div>

    <!-- Main JavaScript -->
    <?php include('statics/scripts.php') ?>

    <!--Custom JavaScript -->
    <script src="js/dashboard.js"></script>

</body>

</html>