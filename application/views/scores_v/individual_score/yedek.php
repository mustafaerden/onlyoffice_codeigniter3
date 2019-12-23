<?php

if ($individual){ ?>

    <div class="row">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <h2 class="page-header-title"><?php echo $individual[0]->name; ?> <?php echo $individual[0]->last_name; ?>'s Score on <?php $origDate = $individual[0]->date;
                    $newDate = date("M-d-Y", strtotime($origDate));
                    echo $newDate; ?></h2>
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>"><i class="ti ti-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url("scores/individual_score"); ?>">Choose Another Person or Date</a></li>
                        <li class="breadcrumb-item active"><?php echo $individual[0]->name; ?> <?php echo $individual[0]->last_name; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <?php echo $this->session->flashdata('durum'); ?>
            <!-- Export -->
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions">
                    <h4 class="d-inline-block"><?php $origDate = $individual[0]->date;
                        $newDate = date("M-d-Y", strtotime($origDate));
                        echo $newDate; ?> <?php echo $individual[0]->name . ' ' . $individual[0]->last_name; ?></h4>
                    <p class="float-right"><b>Total Transfers:</b> <span style="width:100px;"><span class="badge-text badge-text-small success" style="padding: 5px 30px;"><?php echo $totalSale; ?></span></span></p>
                </div>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table id="export-table" class="table mb-0 table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="100">Time From</th>
                                <th width="100">Time To</th>
                                <th width="100">Transfers</th>
                                <!--                                    <th width="200">Actions</th>-->

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($individual as $i){ ?>

                                <tr>
                                    <td>
                                        <?php
                                        $origTimeFrom = $i->time_from;
                                        $newTimeFrom = date("h:i-A", strtotime($origTimeFrom));
                                        echo $newTimeFrom;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $origTimeTo = $i->time_to;
                                        $newTimeTo = date("h:i-A", strtotime($origTimeTo));
                                        echo $newTimeTo;
                                        ?>
                                    </td>
                                    <td><?php echo $i->sale; ?></td>
                                    <!--                                        <td>-->
                                    <!--                                            <a href="#" class="btn btn-primary btn-square btn-sm"><i class="la la-edit"></i>Edit</a>-->
                                    <!--                                            <button-->
                                    <!--                                                    class="btn btn-danger btn-square btn-sm removeButton"-->
                                    <!--                                                    data-url="#">-->
                                    <!--                                                <i class="la la-close"></i>Delete-->
                                    <!--                                            </button>-->
                                    <!--                                        </td>-->
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Export -->
        </div>
    </div>
<?php } else { ?>

    <div class="row">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <h2 class="page-header-title">No Info Available</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <!-- Export -->
            <div class="widget has-shadow">
                <div class="widget-body">
                    <div class="alert alert-shadow alert-lg" role="alert">
                        <i class="la la-rocket mr-2"></i>
                        <strong>Opps!</strong> No info available on this date for this employee! <a href="<?php echo base_url("scores/individual_score"); ?>">Select another date.</a>
                    </div>
                </div>
            </div>
            <!-- End Export -->
        </div>
    </div>

<?php }

?>

