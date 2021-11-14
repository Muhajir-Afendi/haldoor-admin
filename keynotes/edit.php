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


                <!-- Fetch Contents  -->
                <?php

                    require_once "../api/config.php";

                    $fetch_modal = "SELECT `id`, `title`, `body`, `facebook`, `youtube`, `instagram`, `twitter`, `image` FROM `keynotes` WHERE `id` = ?";

                    $stmt = $conn -> prepare($fetch_modal);
                    $stmt->bind_param("s", $_GET["id"]);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        echo "<script type='text/javascript'> window.location.replace('/keynotes/listing.php'); </script>";
                        exit();
                    }
                    else
                    {

                        $stmt->bind_result($id, $title, $body, $facebook, $youtube, $instagram, $twitter, $image);
                        $stmt->fetch();

                    }

                ?>

                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Keynote</h4>
                        
                        <form method="POST" id="keynotes-form">

                            <div class="row" style="margin-top: 3rem">

                                <input type="hidden" name="action" id="action" value="edit">
                                <input type="hidden" name="editing_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="editing_image" value="<?php echo $image; ?>">

                                <!-- Title -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" required="required">
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                    </div>
                                </div>

                                <!-- Facebook -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $facebook; ?>">
                                    </div>
                                </div>

                                <!-- Youtube -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo $youtube; ?>">
                                    </div>
                                </div>

                                <!-- Instagram -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $instagram; ?>">
                                    </div>
                                </div>

                                <!-- Twitter -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $twitter; ?>">
                                    </div>
                                </div>


                                <!-- Body -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" name="body" id="body" cols="30" rows="10" required="required"><?php echo $body; ?></textarea>
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
    <script src="../js/keynotes/edit.js"></script>
    <script src="../js/errors.js"></script>

</body>

</html>