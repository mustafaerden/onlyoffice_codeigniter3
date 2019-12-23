<!DOCTYPE html>
<html lang="en">
<head>

<?php $this->load->view("includes/head"); ?>
<link rel="stylesheet" href="<?php echo base_url("assets"); ?>/css/datatables/datatables.min.css">
<link rel="stylesheet" href="<?php echo base_url("assets"); ?>/css/sweet-alert/sweetalert2.min.css">

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
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/datatables.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url("assets"); ?>/vendors/js/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/js/components/tables/tables.js"></script>
<script src="<?php echo base_url("assets"); ?>/js/components/sweet-alert/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){

        $(".removeButton").click(function () {

            var $data_url = $(this).data("url");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $data_url;
                }
            })
        });

    });

</script>
<!-- End Page Scripts Js -->
</body>
</html>