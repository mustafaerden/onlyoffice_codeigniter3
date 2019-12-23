<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Update User Role</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url("user_roles/update/$user_role->id"); ?>">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label">Title *</label>
                        <div class="col-lg-9">
                            <input type="text" name="title" placeholder="Enter User Role Title" class="form-control" value="<?php echo $user_role->title; ?>">
                            <?php if (isset($form_error)): ?>
                                <small style="color:#DD4B39;font-size:14px;"><strong><i><?php echo form_error("title"); ?></i></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Update User Role</button>
                        <a href="<?php echo base_url("user_roles"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>