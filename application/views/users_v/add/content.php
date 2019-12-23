<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Add New User</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url("users/save"); ?>">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Username *</label>
                        <div class="col-lg-9">
                            <input type="text" name="username" placeholder="Enter Username" class="form-control" value="<?php echo set_value('username');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("username"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">First Name *</label>
                        <div class="col-lg-9">
                            <input type="text" name="name" placeholder="Enter First Name" class="form-control" value="<?php echo set_value('name');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("name"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Last Name *</label>
                        <div class="col-lg-9">
                            <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo set_value('last_name');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("last_name"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php echo set_value('email');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("email"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">User Role *</label>
                        <div class="col-lg-9">
                            <div class="select">
                                <select name="user_role_id" class="custom-select form-control">
                                    <option value="">Select a User Role</option>
                                    <?php

                                    if ($user_roles) {

                                        foreach ($user_roles as $role) { ?>

                                            <option value="<?php echo $role->id; ?>"><?php echo $role->title; ?></option>


                                        <?php }

                                    }

                                    ?>

                                </select>
                                <?php if (isset($form_error)): ?>
                                    <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("user_role_id"); ?></i></strong></small>
                                <?php endif; ?>
                                <div class="invalid-feedback">
                                    Please select a user role
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Password *</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo set_value('password');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("password"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Confirm Password *</label>
                        <div class="col-lg-9">
                            <input type="password" name="re_password" placeholder="Enter Password Again" class="form-control" value="<?php echo set_value('re_password');?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("re_password"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Add User</button>
                        <a href="<?php echo base_url("users"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>