<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">
            <?php if (isAllowedViewModule("dashboard")) { ?>
                <li><a href="<?php echo base_url("dashboard"); ?>"><i class="la la-tachometer"></i><span>Dashboard</span></a></li>
            <?php } ?>

            <?php if (isAllowedViewModule("employees")) { ?>
            <li><a href="#dropdown" aria-expanded="false" data-toggle="collapse"><i class="la la-users"></i><span>Employee Management</span></a>
                <ul id="dropdown" class="collapse list-unstyled pt-0">
                    <li><a href="<?php echo base_url("employees"); ?>">Employee List</a></li>
                    <li><a href="<?php echo base_url("employees/add_employee"); ?>">Add New Employee</a></li>
                </ul>
            </li>
            <?php } ?>

            <?php if (isAllowedViewModule("attendances")) { ?>
            <li><a href="<?php echo base_url("attendances"); ?>"><i class="la la-sign-in"></i><span>Attendances</span></a></li>
            <?php } ?>

            <?php if (isAllowedViewModule("scores")) { ?>
            <li><a href="#dropdown2" aria-expanded="false" data-toggle="collapse"><i class="la la-bar-chart"></i><span>Scores</span></a>
                <ul id="dropdown2" class="collapse list-unstyled pt-0">
                    <li><a href="<?php echo base_url("scores"); ?>">All Scores</a></li>
                    <?php if (isAllowedWriteModule("scores")){ ?>
                        <li><a href="<?php echo base_url("scores/add_score"); ?>">Add Score</a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url("scores/individual_score"); ?>">Daily Individual Score</a></li>
                    <li><a href="<?php echo base_url("scores/montly_individual_score"); ?>">Montly Individual Score</a></li>
                </ul>
            </li>
            <?php } ?>

            <?php if (isAllowedViewModule("users")) { ?>
            <li><a href="<?php echo base_url("users"); ?>"><i class="la la-user-secret"></i><span>Users</span></a></li>
            <?php } ?>

            <?php if (isAllowedViewModule("user_roles")) { ?>
            <li><a href="<?php echo base_url("user_roles"); ?>"><i class="la la-eye-slash"></i><span>User Permissions</span></a></li>
            <?php } ?>

        </ul>
        <ul class="list-unstyled">
            <li><a href="<?php echo base_url("logout"); ?>"><i style="color: #e76c90;" class="la la-power-off"></i><span>Logout</span></a></li>
        </ul>
        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>