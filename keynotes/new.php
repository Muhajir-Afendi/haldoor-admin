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

    <div class="preloader">
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
                        <h4 class="card-title">New Keynote</h4>
                        
                        <form action="keynotes/create" method="POST" id="keynotes-form">

                            <div class="row" style="margin-top: 3rem">

                                <input type="hidden" name="action" value="new">

                                <!-- Title -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" required="required">
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required="required">
                                    </div>
                                </div>

                                <!-- Facebook -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" required="required">
                                    </div>
                                </div>

                                <!-- Youtube -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" class="form-control" name="youtube" id="youtube" required="required">
                                    </div>
                                </div>

                                <!-- Instagram -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" required="required">
                                    </div>
                                </div>

                                <!-- Twitter -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" required="required">
                                    </div>
                                </div>


                                <!-- Body -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" name="body" id="body" cols="30" rows="10" required="required"></textarea>
                                    </div>
                                </div>

                                <!-- Save -->
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Save</button>
                                </div>

                            </div>

                        </form>

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
    <script src="../js/keynotes/new.js"></script>
    <script src="../js/errors.js"></script>

</body>

</html>