<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Users</h2>
            <div>
                <?php if (isAllowedWriteModule()){ ?>
                    <a href="<?php echo base_url("users/add_user"); ?>" class="btn btn-shadow btn-gradient-03"><i class="la la-plus"></i>Add New User
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
                <h4 class="d-inline-block">User List</h4>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="50" class="text-center">Is Active</th>
                            <th width="300" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($users){
                        foreach ($users as $user){ ?>
                            <tr>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->name . ' ' . $user->last_name; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td class="text-center">
                                    <input
                                            data-url="<?php echo base_url("users/isActiveSetter/$user->id"); ?>"
                                            class="js-switch isActive" type="checkbox" <?php echo($user->isActive) ? 'checked' : ''; ?>>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url("users/update_form/$user->id"); ?>" class="btn btn-outline-primary btn-square btn-sm"><i class="la la-edit"></i>Edit</a>
                                    <a href="<?php echo base_url("users/update_password_form/$user->id"); ?>" class="btn btn-outline-warning btn-square btn-sm"><i class="la la-unlock text-center"></i>Passw</a>

                                    <?php if (isAllowedDeleteModule()){ ?>
                                        <button
                                                class="btn btn-outline-danger btn-square btn-sm removeButton"
                                                data-url="<?php echo base_url("users/delete/$user->id");?>">
                                            <i class="la la-close"></i>Delete
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>