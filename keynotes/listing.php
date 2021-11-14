<?php

  session_start();

  require_once "../api/authorization.php";

  // Check if user is allowed this region
  check_admin();

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <!-- Head -->
    <?php include('../statics/head.php') ?>

</head>

<body>

    <div class="preloader" id="overlay">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Header -->
        <?php include('../statics/header.php') ?>

        <!-- Sidebar -->
        <?php include('../statics/sidebar.php') ?>

        <!-- Content -->
        <div class="page-wrapper">

            <div class="container-fluid">

                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">

                            <!-- Title -->
                            <div class="col-lg-8">
                                <h4 class="card-title">Keynotes List</h4>
                            </div>

                            <!-- Search -->
                            <div class="col-lg-4">
                                <div class="customize-input">
                                    <input class="form-control custom-radius border-1 bg-white"
                                        type="search" placeholder="Search" aria-label="Search" id="search-input">
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive my-5">
                            <table class="table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th width="10%">#</th>
                                        <th width="20%">Image</th>
                                        <th width="60%">Title</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>

                                <!-- Table Contents -->
                                <tbody id="keynotes-table"></tbody>
                                
                            </table>
                        </div>


                    </div>
                </div>
                <!-- Card -->


            </div>

            
            <footer class="footer text-center text-muted">
                All Rights Reserved. 
                <a href="/">HALDOOR</a>.
            </footer>

        </div>

    </div>

    <!-- Main JavaScript -->
    <?php include('../statics/scripts.php') ?>

    <!--Custom JavaScript -->
    <script src="../js/keynotes/listing.js"></script>
    <script src="../js/errors.js"></script>

</body>

</html>