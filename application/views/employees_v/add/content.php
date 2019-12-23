<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Add New Employee</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>You can use the form below to add a new employee.</h4>
            </div>
            <div class="widget-body">
                <form class="needs-validation" novalidate method="post" action="<?php echo base_url("employees/save_employee"); ?>" enctype="multipart/form-data">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">First Name *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter first name" value="<?php echo set_value('name');?>" required>
                                <div class="invalid-feedback">
                                    Please enter first name
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Last Name *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="<?php echo set_value('last_name');?>" required>
                                <div class="invalid-feedback">
                                    Please enter last name
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Title('agent' or 'manager')*</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" placeholder="Enter employee's title" value="<?php echo set_value('title');?>" required>
                                <div class="invalid-feedback">
                                    Please enter employee's title(agent or manager)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Email Address *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon addon-primary">
                                                            <i class="la la-at"></i>
                                                        </span>
                                <input type="email" name="email" class="form-control" placeholder="Enter employee's email" value="<?php echo set_value('email');?>">
                                <div class="invalid-feedback">
                                    Please enter email
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Phone Number *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon addon-primary">
                                                            <i class="la la-phone"></i>
                                                        </span>
                                <input type="number" name="phone" class="form-control" placeholder="Enter employee's phone number" value="<?php echo set_value('phone');?>">
                                <div class="invalid-feedback">
                                    Please enter phone number
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Address *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="address" class="form-control" placeholder="Enter address" value="<?php echo set_value('address');?>">
                                <div class="invalid-feedback">
                                    Please enter address
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Salary *</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="salary" class="form-control" placeholder="Enter salary" value="<?php echo set_value('salary');?>">
                                <div class="invalid-feedback">
                                    Please enter salary
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Image</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Birthday</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="date" name="birthday" class="form-control" placeholder="Birthday" value="<?php echo set_value('birthday');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Start Date</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo set_value('start_date');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Notes</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="notes" placeholder="You can write any notes about employee here" ><?php echo set_value('notes');?></textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Emergency Contact Name</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="emg_cont_name" class="form-control" placeholder="Enter emergency contact name" value="<?php echo set_value('emg_cont_name');?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Relationship to Employee</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="emg_cont_rel" class="form-control" placeholder="Enter relationship to employee" value="<?php echo set_value('emg_cont_rel');?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Contact Person's Phone</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="emg_cont_phone" class="form-control" placeholder="Enter contact person's phone" value="<?php echo set_value('emg_cont_phone');?>">
                            </div>
                        </div>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Save Employee</button>
                        <a href="<?php echo base_url("employees"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>