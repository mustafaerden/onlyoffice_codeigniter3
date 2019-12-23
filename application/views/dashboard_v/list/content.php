<?php //$user = get_active_user(); print_r($user);?>

<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Dashboard</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <?php echo $this->session->flashdata('durum'); ?>

<div class="row flex-row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Total Employees</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $all_employees; ?></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big la la-users"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Total Agents</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $all_agents; ?></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big la la-users"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Total Managers</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $all_managers; ?></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big la la-users"></i>
            </div>
        </div>
    </div>

</div>