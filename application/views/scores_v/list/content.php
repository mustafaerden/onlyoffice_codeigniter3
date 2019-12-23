<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Scores</h2>
            <?php if (isAllowedWriteModule()) { ?>
                <div>
                    <a href="<?php echo base_url("scores/add_score"); ?>" class="btn btn-shadow btn-gradient-03"><i class="la la-plus"></i>Add Score Info
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <?php echo $this->session->flashdata('durum'); ?>
        <!-- Export -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4 class="d-inline-block">Scores List</h4>
<!--                <p class="float-right"><b>Total Transfers:</b> <span style="width:100px;"><span class="badge-text badge-text-small success" style="padding: 5px 30px;">16</span></span></p>-->
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="export-table" class="table mb-0 table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th width="50" class="text-center">Total</th>
                            <th width="50" class="text-center">TPH</th>
                            <th width="50" class="text-center">PT</th>
                            <?php if (isAllowedWriteModule()) { ?>
                                <th width="100" class="text-center">Actions</th>
                            <?php } ?>
                            

                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($scores) {
                            foreach ($scores as $score){ ?>
                                <tr>
                                    <td><?php echo $score->name; ?> <?php echo $score->last_name; ?></td>
                                    <td>
                                        <?php
                                        $origDate = $score->date;
                                        $newDate = date("d-M-Y", strtotime($origDate));
                                        echo $newDate;
                                        ?>
                                    </td>
                                    <td class="text-center <?php echo ($score->tph < 0.7) ? 'bg-danger text-white' : 'bg-success text-white'; ?>"><?php echo $score->total_sale; ?></td>
                                    <td class="text-center <?php echo ($score->tph < 0.7) ? 'bg-danger text-white' : 'bg-success text-white'; ?>"><?php echo $score->tph; ?></td>
                                    <td class="text-center bg-info text-white"><?php echo $score->pt; ?></td>
                                    <?php if (isAllowedWriteModule()) { ?>
                                        <td class="td-actions text-center">
                                    <?php if (isAllowedUpdateModule()) { ?>
                                        <a href="<?php echo base_url("scores/update_score/$score->id"); ?>"><i class="la la-edit edit"></i></a>
                                    <?php } ?>

                                    <?php if (isAllowedDeleteModule()) { ?>
                                        <a class="removeButton"
                                                data-url="<?php echo base_url("scores/delete/$score->id");?>">
                                        <i class="la la-close delete"></i></a>
                                    <?php } ?>
                                    </td>
                                    <?php } ?>
                                    
                                </tr>
                            <?php   }
                        } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Export -->
    </div>
</div>