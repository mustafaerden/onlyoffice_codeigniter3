<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Update <?php echo $user->name . ' ' . $user->last_name; ?>' s Password</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url("users/update_password/$user->id"); ?>">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Password *</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo $user->password; ?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("password"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Confirm Password *</label>
                        <div class="col-lg-9">
                            <input type="password" name="re_password" placeholder="Enter Password Again" class="form-control" value="<?php echo $user->password; ?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("re_password"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Update Password</button>
                        <a href="<?php echo base_url("users"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>