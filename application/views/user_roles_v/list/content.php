<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">User Roles</h2>
            <div>
                <?php if (isManager()){ ?>
                    <a href="<?php echo base_url("user_roles/add_user_role"); ?>" class="btn btn-shadow btn-gradient-03"><i class="la la-plus"></i>Add New User Role
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-12 col-12">
        <?php echo $this->session->flashdata('durum'); ?>
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4 class="d-inline-block">User Roles List</h4>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <?php if ($user_roles){ ?>
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th width="50" class="text-center">Is Active</th>
                            <th width="300" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_roles as $role){ ?>
                            <tr>
                                <td><?php echo $role->title; ?></td>
                                <td class="text-center">
                                    <input
                                            data-url="<?php echo base_url("user_roles/isActiveSetter/$role->id"); ?>"
                                            class="js-switch isActive" type="checkbox" <?php echo($role->isActive) ? 'checked' : ''; ?>>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("user_roles/permissions_form/$role->id"); ?>" class="btn btn-outline-success btn-square btn-sm"><i class="la la-user-secret"></i>Permissions</a>
                                    <a href="<?php echo base_url("user_roles/update_form/$role->id"); ?>" class="btn btn-outline-primary btn-square btn-sm"><i class="la la-edit"></i>Edit</a>
                                    <button
                                                class="btn btn-outline-danger btn-square btn-sm removeButton"
                                                data-url="<?php echo base_url("user_roles/delete/$role->id");?>">
                                        <i class="la la-close"></i>Delete
                                    </button>
                                </td>
                            </tr>
                        <?php }
                        }else { ?>
                            <div class="alert alert-primary alert-lg" role="alert">
                                <strong>No Data Available!</strong> Please use Add New User Role button to add a user role!
                            </div>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>