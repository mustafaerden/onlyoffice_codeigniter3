<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Employees</h2>
            <?php if (isAllowedWriteModule()){ ?>
                <div>
                    <a href="<?php echo base_url("employees/add_employee"); ?>" class="btn btn-shadow btn-gradient-03"><i class="la la-plus"></i>Add New Employee
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
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Employee List</h4>

            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="export-table" class="table mb-0 table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Birthday</th>
                            <th>Start Date</th>
                            <th>Leave Date</th>
                            <th>Notes</th>
                            <th style="width: 50px;">Status</th>
                            <th>Emergency Contact Name</th>
                            <th>Relationship to Agent</th>
                            <th>Contact person's phone</th>
                            <th width="200">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($employees) {
                            foreach ($employees as $employee){ ?>
                                <tr>
                                    <td><?php echo $employee->id; ?></td>
                                    <td><?php echo $employee->name; ?> <?php echo $employee->last_name; ?></td>
                                    <td><img width="50" 
                                        src="<?php if ($employee->image) {
                                                echo base_url("uploads/employee-images/$employee->image");
                                        } else {
                                            echo base_url("assets/img/avatar/support.png");
                                        } ?>">
                                    </td>
                                    <td><?php echo $employee->title; ?></td>
                                    <td><?php echo $employee->email; ?></td>
                                    <td><?php echo $employee->phone; ?></td>
                                    <td><?php echo $employee->address; ?></td>
                                    <td><?php echo $employee->salary; ?>k</td>
                                    <td>
                                        <?php

                                        $origDate = $employee->birthday;

                                        $newDate = date("M-d-Y", strtotime($origDate));
                                        echo $newDate;

                                        ?>
                                    </td>
                                    <td>
                                        <?php

                                        $startDate = $employee->start_date;

                                        $newStartDate = date("M-d-Y", strtotime($startDate));
                                        echo $newStartDate;

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($employee->leave_date === NULL){
                                            echo '<span style="width:100px;"><span class="badge-text badge-text-small success">OnDuty</span></span>';
                                        } else{
                                            $leaveDate = $employee->leave_date;

                                            $newLeaveDate = date("M-d-Y", strtotime($leaveDate));
                                            echo $newLeaveDate;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $employee->notes; ?></td>
                                    <td>
                                        <input
                                                data-url="<?php echo base_url("employees/isActiveSetter/$employee->id"); ?>"
                                                class="js-switch isActive" type="checkbox" <?php echo($employee->isActive) ? 'checked' : ''; ?>>
                                    </td>
                                    <td><?php echo $employee->emg_cont_name; ?></td>
                                    <td><?php echo $employee->emg_cont_rel; ?></td>
                                    <td><?php echo $employee->emg_cont_phone; ?></td>
<!--                                    <td class="td-actions">-->
<!--                                        <a href="#"><i class="la la-edit edit"></i></a>-->
<!--                                        <a href="#"><i class="la la-close delete"></i></a>-->
<!--                                    </td>-->
                                    <td>
                                        <?php if (isAllowedUpdateModule()){ ?>
                                            <a href="<?php echo base_url("employees/update_employee/$employee->id"); ?>" class="btn btn-outline-primary btn-square btn-sm mb-1"><i class="la la-edit edit"></i>Edit</a>
                                        <?php } ?>

                                        <?php if (isAllowedDeleteModule()){ ?>
                                            <button
                                                    class="btn btn-outline-danger btn-square btn-sm removeButton"
                                                    data-url="<?php echo base_url("employees/delete/$employee->id");?>">
                                                <i class="la la-close delete"></i>Delete
                                            </button>
                                        <?php } ?>
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