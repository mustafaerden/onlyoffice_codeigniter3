<!DOCTYPE html>
<html lang="en">
<head>

<?php $this->load->view("includes/head"); ?>

</head>
<body id="page-top">
<!-- Begin Preloader -->
<?php $this->load->view("includes/styles"); ?>
<!-- End Preloader -->
<div class="page">
    <!-- Begin Header -->
    <?php $this->load->view("includes/header"); ?>
    <!-- End Header -->
    <!-- Begin Page Content -->
    <div class="page-content d-flex align-items-stretch">
        <?php $this->load->view("includes/sidebar"); ?>
        <!-- End Left Sidebar -->
        <div class="content-inner">
            <div class="container-fluid">
                <!-- Begin Page Header and Main Content-->
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
                <!-- End Row Main Content -->
            </div>
            <!-- End Container -->
            <!-- Begin Page Footer-->
            <?php $this->load->view("includes/footer"); ?>
            <!-- End Page Footer -->
            <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Page Content -->
</div>
<!-- Begin Scripts Js -->
<?php $this->load->view("includes/scripts"); ?>
<script src="<?php echo base_url("assets"); ?>/js/components/validation/validation.min.js"></script>
<!-- End Page Scripts Js -->
</body>
</html>