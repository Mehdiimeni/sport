<?php
///template/structure/company.php
?>


<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">
                            <?php echo (_lang['company']); ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($rbac->checkPermissionOperationByName('add')) { ?>
                            <div class="row mb-2">
                                <div class="col-sm-5">

                                    <a href="#" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                        data-bs-target="#addModal">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <?php echo (_lang['add']); ?>
                                    </a>
                                </div>

                            </div>
                            <?php } ?>

                            <div class="table-responsive">
                                <table id="scroll-vertical-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo (_lang['name']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['phone']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['activity']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['last_updated_date']); ?>
                                            </th>
                                            <th style="width: 125px;">
                                                <?php echo (_lang['actions']); ?>
                                            </th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                        <?php

                                        $company_profilesResult = $structure->getCompanies();
                                        while ($company_profilesDetails = $company_profilesResult->fetch_assoc()) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $company_profilesDetails['company_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $company_profilesDetails['company_phone']; ?>
                                                </td>
                                                <td>
                                                    <?php $activityResult = $structure->getActivityById($company_profilesDetails['activity_id']);
                                                   echo $activityResult['activity_name'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $company_profilesDetails['last_updated_date']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($rbac->checkPermissionOperationByName('delete')) { ?>
                                                    <a href="javascript:void(0);" class="action-icon delete-item"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-table="company_profiles"
                                                        data-id="<?php echo $company_profilesDetails['id']; ?>">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    <?php } ?>

                                                    <?php if ($rbac->checkPermissionOperationByName('edit')) { ?>
                                                    <a href="javascript:void(0);" class="action-icon edit-item"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-table="company_profiles"
                                                        data-id="<?php echo $company_profilesDetails['id']; ?>">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">
                                                    <?php echo (_lang['delete_item']); ?>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="<?php echo (_lang['close']); ?>">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo (_lang['delete_confirm']); ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <?php echo (_lang['close']); ?>
                                                </button>
                                                <button type="button" class="btn btn-danger confirm-delete">
                                                    <?php echo (_lang['delete']); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">
                                                    <?php echo (_lang['add']); ?>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="<?php echo (_lang['close']); ?>">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for adding company -->
                                                <form id="addForm" name="addForm" class="form-control">
                                                    <input type="hidden" class="form-control addField" name="table_set"
                                                        id="tableSet" value="company_profiles">
                                                    <div class="mb-3">
                                                        <label for="company_name" class="form-label">
                                                            <?php echo (_lang['name']); ?>
                                                        </label>
                                                        <input type="text" class="form-control addField"
                                                            id="company_name" name="company_name" required>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="company_phone" class="form-label">
                                                            <?php echo (_lang['phone']); ?>
                                                        </label>
                                                        <input class="form-control addField" id="company_phone"
                                                            name="company_phone" type="tel" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="activity_id" class="form-label">
                                                            <?php echo (_lang['activity']); ?>
                                                        </label>

                                                        <select class="form-control addField" name="activity_id"
                                                            id="activity_id">
                                                            <?php
                                                            $activitiesResult = $structure->getActivities();
                                                            while ($activitiesDetails = $activitiesResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($activitiesDetails['id']); ?>">
                                                                    <?php echo ($activitiesDetails['activity_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <button type="button" class="btn btn-primary" id="addDataBtn">
                                                        <?php echo (_lang['add']); ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">
                                                    <?php echo (_lang['edit_item']); ?>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="<?php echo (_lang['close']); ?>">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for editing company -->
                                                <form id="editForm" name="editForm" class="form-control">
                                                    <input type="hidden" class="form-control editField" name="table_set"
                                                        id="table_set">
                                                    <input type="hidden" class="form-control editField" name="id"
                                                        id="id">
                                                    <div class="mb-3">
                                                        <label for="company_name" class="form-label">
                                                            <?php echo (_lang['name']); ?>
                                                        </label>
                                                        <input type="text" class="form-control editField"
                                                            id="company_name" name="company_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="company_phone" class="form-label">
                                                            <?php echo (_lang['phone']); ?>
                                                        </label>
                                                        <input class="form-control editField" id="company_phone"
                                                            name="company_phone" type="tel" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="activity_id" class="form-label">
                                                            <?php echo (_lang['activity']); ?>
                                                        </label>

                                                        <select class="form-control editField" name="activity_id"
                                                            id="activity_id">
                                                            <?php
                                                            $activitiesResult = $structure->getActivities();
                                                            while ($activitiesDetails = $activitiesResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($activitiesDetails['id']); ?>">
                                                                    <?php echo ($activitiesDetails['activity_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <button type="button" class="btn btn-primary" id="editDataBtn">
                                                        <?php echo (_lang['save_changes']); ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


</div>