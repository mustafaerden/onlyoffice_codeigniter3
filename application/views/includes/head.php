<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
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
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("assets"); ?>/img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("assets"); ?>/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets"); ?>/img/favicon-16x16.png">

<?php $this->load->view("includes/styles"); ?>