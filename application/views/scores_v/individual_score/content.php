<?php

if ($individual){ ?>

        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Daily Individual Score</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url("scores/individual_score"); ?>">Choose Another Person or Date</a></li>
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
                        <h4 class="d-inline-block">
                            <?php $origDate = $individual[0]->date;
                            $newDate = date("d-M-Y", strtotime($origDate));
                            echo $newDate; ?>
                        </h4>
                        <p class="float-right"><b>Total Transfers:</b> <span style="width:100px;"><span class="badge-text badge-text-small <?php echo ($totalTph < 0.7) ? 'danger' : 'success'; ?>" style="padding: 5px 30px;"><?php echo $totalSale; ?></span></span></p>
                        <p class="float-right"><b>Total TPH:</b> <span style="width:100px;"><span class="badge-text badge-text-small <?php echo ($totalTph < 0.7) ? 'danger' : 'success'; ?>" style="padding: 5px 30px;"><?php echo $totalTph; ?></span></span></p>
                    </div>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table id="export-table" class="table mb-0 table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="50" class="text-center">Total</th>
                                    <th width="50" class="text-center">TPH</th>
                                    <th width="50" class="text-center">PT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($individual as $i){ ?>

                                    <tr>
                                        <td><?php echo $i->name . ' ' . $i->last_name ?></td>
                                        <td class="text-center <?php echo ($i->tph < 0.7) ? 'bg-danger text-white' : 'bg-success text-white'; ?>"><?php echo $i->total_sale; ?></td>
                                        <td class="text-center <?php echo ($i->tph < 0.7) ? 'bg-danger text-white' : 'bg-success text-white'; ?>"><?php echo $i->tph; ?></td>
                                        <td class="text-center bg-info text-white"><?php echo $i->pt; ?></td>
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

