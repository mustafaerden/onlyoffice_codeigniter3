<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Office Management | <?php echo $title; ?></title>
    <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("assets"); ?>/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("assets"); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets"); ?>/img/favicon-16x16.png">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url("assets"); ?>/vendors/css/base/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets"); ?>/vendors/css/base/elisyam-1.5.min.css">
</head>
<body class="bg-white">
<!-- Begin Preloader -->
<div id="preloader">
    <div class="canvas">
        <img src="<?php echo base_url("assets"); ?>/img/logo.png" alt="logo" class="loader-logo">
        <div class="spinner"></div>
    </div>
</div>
<!-- End Preloader -->
<!-- Begin Container -->
<div class="container-fluid no-padding h-100">
    <div class="row flex-row h-100 bg-white">
        <!-- Begin Left Content -->
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12 no-padding">
            <div class="">
                <div class="elisyam-overlay overlay-08"></div>
                <div class="authentication-col-content-2 mx-auto text-center">
                    <div class="logo-centered">

                            <img src="<?php echo base_url("assets"); ?>/img/logo_white.png" alt="logo">

                    </div>
                    <h1>Office Management System</h1>
                    <span class="description">
<!--                                Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas.-->
                            </span>
                </div>
            </div>
        </div>
        <!-- End Left Content -->
        <!-- Begin Right Content -->
        <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 col-12 my-auto no-padding">
            <!-- Begin Form -->
            <div class="authentication-form-2 mx-auto">
                <div class="tab-content" id="animate-tab-content">
                    <!-- Begin Sign In -->
                    <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">
                        <?php echo $this->session->flashdata('durum'); ?>
                        <h3>Please login with your username and password</h3>
                        <form method="post" action="<?php echo base_url("userop/do_login"); ?>">
                            <div class="group material-input">
                                <input type="text" name="username" required>
                                <?php if (isset($form_error)): ?>
                                    <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("username"); ?></i></strong></small>
                                <?php endif; ?>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Username</label>
                            </div>
                            <div class="group material-input">
                                <input type="password" name="password" required>
                                <?php if (isset($form_error)): ?>
                                    <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("password"); ?></i></strong></small>
                                <?php endif; ?>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Password</label>
                            </div>
                            <?php echo $widget;?>
                            <?php echo $script;?>
                            <div class="sign-btn text-center">
                                <button type="submit" class="btn btn-lg btn-gradient-01">Sign In</button>
                            </div>
                        </form>

                    </div>
                    <!-- End Sign In -->
                </div>
            </div>
            <!-- End Form -->
        </div>
        <!-- End Right Content -->
    </div>
    <!-- End Row -->
</div>
<!-- End Container -->
<!-- Begin Vendor Js -->
<script src="<?php echo base_url("assets"); ?>/vendors/js/base/jquery.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/base/core.min.js"></script>
<!-- End Vendor Js -->
<!-- Begin Page Vendor Js -->
<script src="<?php echo base_url("assets"); ?>/vendors/js/app/app.min.js"></script>
</body>
</html>