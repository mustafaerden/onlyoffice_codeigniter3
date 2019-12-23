<?php $user = get_active_user(); ?>
<header class="header">
    <nav class="navbar fixed-top">
        <!-- Begin Search Box-->
        <div class="search-box">
            <button class="dismiss"><i class="ion-close-round"></i></button>
            <form id="searchForm" action="#" role="search">
                <input type="search" placeholder="Search something ..." class="form-control">
            </form>
        </div>
        <!-- End Search Box-->
        <!-- Begin Topbar -->
        <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
            <!-- Begin Logo -->
            <div class="navbar-header">
                <a href="<?php echo base_url("dashboard"); ?>" class="navbar-brand">
                    <div class="brand-image brand-big">
                        <img src="<?php echo base_url("assets"); ?>/img/office_logo.png" alt="logo" class="logo-big">
                    </div>
                    <div class="brand-image brand-small">
                        <img src="<?php echo base_url("assets"); ?>/img/logo.png" alt="logo" class="logo-small">
                    </div>
                </a>
                <!-- Toggle Button -->
                <a id="toggle-btn" href="#" class="menu-btn active">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <!-- End Toggle -->
            </div>
            <!-- End Logo -->
            <!-- Begin Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">

                <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?php echo base_url("assets"); ?>/img/avatar/support.png" alt="avatar" class="avatar rounded-circle"></a>
                    <ul aria-labelledby="user" class="user-size dropdown-menu" style="display: none;">
                        <li class="welcome">
                            <p class="text-center"><?php echo $user->name . ' ' . $user->last_name; ?></p>
                        </li>

                        <li>
                            <a href="<?php echo base_url("users/update_form/$user->id"); ?>" class="dropdown-item">
                                Account Settings
                            </a>
                        </li>
                        <li class="separator"></li>
                        <li><a rel="nofollow" href="<?php echo base_url("logout"); ?>" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
                    </ul>
                </li>

            </ul>
            <!-- End Navbar Menu -->
        </div>
        <!-- End Topbar -->
    </nav>
</header>