<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Montly Individual Score Info</h2>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Please choose a date range and employee to see individual score between dates choosen.</h4>
            </div>
            <div class="widget-body">
                <form class="needs-validation" novalidate method="post" action="<?php echo base_url("scores/see_montly_individual_score"); ?>">
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Employee *</label>
                        <div class="col-lg-6">
                            <div class="select">
                                <select name="employee_id" class="custom-select form-control" required="">
                                    <option value="all">All</option>
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
                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Date Range*</label>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar"></i>
                                                            </span>
                                    <input type="text" name="date_range" class="form-control" id="daterange" placeholder="Select value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="em-separator separator-dashed"></div>

                    <div>
                        <button class="btn btn-gradient-03" type="submit">Go to Individual Score</button>
                        <a href="<?php echo base_url("scores"); ?>" class="btn btn-shadow">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>