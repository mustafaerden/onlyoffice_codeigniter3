<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Add Attandance Info</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>You can use the form below to add attandance info for any employee.</h4>
            </div>
            <div class="widget-body">
                <form class="needs-validation" novalidate method="post" action="<?php echo base_url("attendances/save_attendance"); ?>" enctype="multipart/form-data">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Employee *</label>
                        <div class="col-lg-6">
                            <div class="select">
                                <select name="employee_id" class="custom-select form-control" required="">
                                    <option value="">Select an employee</option>
                                    <?php

                                    if ($employee) {

                                        foreach ($employee as $e) { ?>

                                            <option value="<?php echo $e->id; ?>"><?php echo $e->name . ' ' . $e->last_name; ?></option>


                                        <?php }

                                    }

                                    ?>

                                </select>
                                <div class="invalid-feedback">
                                    Please select an employee
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">On Duty *</label>
                        <div class="col-lg-6">
                            <div class="select">
                                <select name="onDuty" class="custom-select form-control" required="">
                                    <option value="">Select if employee is On Duty or Absent</option>
                                    <option value="1">On Duty</option>
                                    <option value="0">Absent</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select status of the employee
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Date*</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="date" name="date" class="form-control" placeholder="Date" value="<?php echo set_value('date');?>" required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Time From*</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="time" name="time_from" class="form-control" placeholder="Start Date" value="<?php echo set_value('time_from');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Time To*</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="time" name="time_to" class="form-control" placeholder="Time To" value="<?php echo set_value('time_to');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Comments</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="comments" placeholder="You can write any comments about employee here" ><?php echo set_value('comments');?></textarea>
                        </div>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Save</button>
                        <a href="<?php echo base_url("attendances"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>