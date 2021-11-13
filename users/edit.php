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
                        <h4 class="card-title">New User</h4>
                        
                        <form action="create" method="POST" id="users-form">

                            <div class="row" style="margin-top: 3rem">

                                <input type="hidden" id="editing_id" name="edit" value="<?php echo $_GET['user-id']; ?>">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">Name</label>
                                        <input type="text" pattern="^[A-Za-z ]{5,191}$" class="form-control" name="user_name" id="user_name" value="<?php echo $_GET['user-name']; ?>" required="required">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_email">Email</label>
                                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $_GET['user-email']; ?>" required="required">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Password</label>
                                        <input type="password" min="8" max="16" class="form-control" name="user_pwd" id="pwd">
                                        <small class="text-muted">Use min of 8 characters and 16 as maximum</small>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Confirm Password</label>
                                        <input type="password" min="8" max="16" class="form-control" name="user_cpwd" id="cpwd">
                                        <small id="cpwdHelp" class="text-muted">Re enter password</small>
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
    <script src="../js/users/edit.js"></script>
    <script src="../js/errors.js"></script>

</body>

</html>