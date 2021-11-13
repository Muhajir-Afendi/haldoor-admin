<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <!-- Head -->
    <?php include('statics/head.php') ?>

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

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">

            <div class="auth-box row">
                
                <div class="col-lg-3"></div>

                <div class="col-lg-6 col-md-6 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/img/logo.png" alt="Haldoor" style="width: 20%">
                        </div>
                        <h2 class="mt-3 text-center text-dark">Sign In</h2>
                        <p class="text-center">Enter your email address and password to access admin panel.</p>

                        <form class="mt-4" id="singin-form" method="POST">
                            
                            <div class="row">

                                <!-- Email -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" placeholder="enter your email" required="required">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" type="password" placeholder="enter your password" required="required">
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center" style="margin-bottom: 20px">
                                    <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Main JavaScript -->
    <?php include('statics/scripts.php') ?>

    <!--Custom JavaScript -->
    <script src="js/signin.js"></script>
    <script src="js/errors.js"></script>

</body>

</html>