<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Attendances</h2>
            <div>
                <a href="<?php echo base_url("attendances/add_attendance"); ?>" class="btn btn-shadow btn-gradient-03"><i class="la la-plus"></i>Add Attendance Info
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <?php echo $this->session->flashdata('durum'); ?>
        <!-- Export -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Attendances List</h4>

            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="export-table" class="table mb-0 table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time From</th>
                            <th>Time To</th>
                            <th>OnDuty</th>
                            <th>Comments</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($attendances) {
                            foreach ($attendances as $attendance){ ?>
                                <tr>
                                    <td><?php echo $attendance->name; ?> <?php echo $attendance->last_name; ?></td>
                                    <td>
                                        <?php
                                        $origDate = $attendance->date;
                                        $newDate = date("M-d-Y", strtotime($origDate));
                                        echo $newDate;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($attendance->time_from){
                                                echo $attendance->time_from;
                                            } else {
                                                echo '<span style="width:100px;"><span class="badge-text badge-text-small danger">Absent</span></span>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($attendance->time_to){
                                            echo $attendance->time_to;
                                        } else {
                                            echo '<span style="width:100px;"><span class="badge-text badge-text-small danger">Absent</span></span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo ($attendance->onDuty) ? '<span style="width:100px;"><span class="badge-text badge-text-small success">On Duty</span></span>' : '<span style="width:100px;"><span class="badge-text badge-text-small danger">Absent</span></span>'; ?></td>
                                    <td><?php echo $attendance->comments; ?></td>
                                    <td>
                                        <a href="<?php echo base_url("attendances/update_attendance/$attendance->id"); ?>" class="btn btn-outline-primary btn-square btn-sm"><i class="la la-edit"></i>Edit</a>
                                        <button
                                                class="btn btn-outline-danger btn-square btn-sm removeButton"
                                                data-url="<?php echo base_url("attendances/delete/$attendance->id");?>">
                                            <i class="la la-close"></i>Delete
                                        </button>
                                    </td>
                                </tr>
                         <?php   }
                         } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Export -->
    </div>
</div>