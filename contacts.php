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

            <div class="container-fluid">

                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">

                            <!-- Title -->
                            <div class="col-lg-8">
                                <h4 class="card-title">Contacts List</h4>
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
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <!-- Contacts container -->
                                <tbody id="contacts-table"></tbody>

                            </table>
                        </div>


                    </div>
                </div>
                <!-- Card -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#contacts-detail-modal" id="show-feedback-detail" style="display: none"></button>

                <div class="modal fade" id="contacts-detail-modal" tabindex="-1" role="dialog"
                    aria-labelledby="scrollableModalTitle" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollableModalTitle">Feedback Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <p id="feedback-contents">
                                </p>
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
    <script src="js/contacts.js"></script>

</body>

</html>