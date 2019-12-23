<?php
$permissions = json_decode($user_role->permissions);
?>

<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Update <?php echo $user_role->title; ?>' s Permissions</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-12">
        <?php echo $this->session->flashdata('durum'); ?>
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url("user_roles/update_permissions/$user_role->id"); ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Module Name</th>
                                <th class="text-center">Read</th>
                                <th class="text-center">Write</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (getControllerList() as $controllerName){ ?>
                            <tr>
                                <td><?php echo $controllerName; ?></td>
                                <td width="100" class="text-center">
                                    <input
                                            <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked" : ""; ?>
                                            name="permissions[<?php echo $controllerName; ?>][read]" class="js-switch" type="checkbox">
                                </td>
                                <td width="100" class="text-center">
                                    <input
                                            <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked" : ""; ?>
                                            name="permissions[<?php echo $controllerName; ?>][write]" class="js-switch" type="checkbox">
                                </td>
                                <td width="100" class="text-center">
                                    <input
                                            <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked" : ""; ?>
                                            name="permissions[<?php echo $controllerName; ?>][update]" class="js-switch" type="checkbox">
                                </td>
                                <td width="100" class="text-center">
                                    <input
                                            <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked" : ""; ?>
                                            name="permissions[<?php echo $controllerName; ?>][delete]" class="js-switch" type="checkbox">
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Update Permissions</button>
                        <a href="<?php echo base_url("user_roles"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>