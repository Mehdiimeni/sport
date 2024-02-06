<?php
///template/structure/user_operation.php
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
                            <?php echo (_lang['user_operation']); ?>
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
                                <table id="scroll-vertical-datatable"
                                    class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo (_lang['role']); ?>
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

                                        $userOperationResult = $structure->getUserOperation();
                                        while ($userOperationDetails = $userOperationResult->fetch_assoc()) {

                                            ?>
                                            <tr>

                                                <td>
                                                    <?php echo $userOperationDetails['rbac_name']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $userOperationDetails['last_updated_date']; ?>
                                                </td>
                                                <td>


                                                    <?php if ($rbac->checkPermissionOperationByName('delete')) { ?>
                                                    <a href="javascript:void(0);" class="action-icon delete-item"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-table="permissions_operation"
                                                        data-id="<?php echo $userOperationDetails['id']; ?>">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    <?php } ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div class="modal fade" id="deleteModal" tabindex="-1" userOperation="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" userOperation="document">
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


                                <div class="modal fade" id="addModal" tabindex="-1" userOperation="dialog"
                                    aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" userOperation="document">
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
                                                <!-- Form for adding userOperation -->
                                                <form id="addForm" name="addForm" class="form-control">

                                                    <input type="hidden" class="form-control addField" name="table_set"
                                                        id="table_set" value="permissions_operation">
                                                    <input class="form-control addField" type="hidden"
                                                        name="unique_fields" id="unique_fields"
                                                        value="<?php echo $unique_fields; ?>">
                                                    <div class="mb-3">
                                                        <label for="rbac_id" class="form-label">
                                                            <?php echo (_lang['role']); ?>
                                                        </label>
                                                        <select class="form-control addField" name="rbac_id"
                                                            id="rbac_id">
                                                            <?php
                                                            $rbacResult = $structure->getRBAC();
                                                            while ($rbacDetails = $rbacResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($rbacDetails['id']); ?>">
                                                                    <?php echo ($rbacDetails['rbac_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="parts" class="form-label">
                                                            <?php echo (_lang['parts']); ?>
                                                        </label>

                                                        <select multiple="" class="form-control addField" id="optgroup"
                                                            name="parts" style="position: absolute; left: -9999px;">

                                                            <?php
                                                            $partResult = $structure->getUserParts();
                                                            while ($partDetails = $partResult->fetch_assoc()) { ?>
                                                                <optgroup
                                                                    label="<?php echo ($partDetails['users_parts_name']); ?>">

                                                                    <?php
                                                                    $subPartResult = $structure->getSubPartsByPart($partDetails['id']);
                                                                    while ($subPartDetails = $subPartResult->fetch_assoc()) { ?>

                                                                        <option value="<?php echo ($subPartDetails['id']); ?>">
                                                                            <?php echo ($subPartDetails['users_subparts_name']); ?>
                                                                        </option>
                                                                    <?php } ?>

                                                                </optgroup>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="operation" class="form-label">
                                                            <?php echo (_lang['operation']); ?>
                                                        </label>

                                                        <select id="operation" name="operation" multiple
                                                            class="form-control addField">
                                                            <?php
                                                            $operationResult = $structure->getOperations();
                                                            while ($operationDetails = $operationResult->fetch_assoc()) { ?>

                                                                <option value="<?php echo ($operationDetails['id']); ?>"
                                                                    id="customCheck<?php echo ($operationDetails['id']); ?>">
                                                                    <?php echo ($operationDetails['operation_name']); ?>
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


                                <div class="modal fade" id="editModal" tabindex="-1" userOperation="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" userOperation="document">
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
                                                <!-- Form for editing userOperation -->
                                                <form id="editForm" name="editForm" class="form-control">
                                                    <input type="hidden" class="form-control editField" name="table_set"
                                                        id="table_set">
                                                    <input type="hidden" class="form-control editField" name="id"
                                                        id="id">
                                                    <input class="form-control editField" type="hidden"
                                                        name="unique_fields" id="unique_fields"
                                                        value="<?php echo $unique_fields; ?>">
                                                    <div class="mb-3">
                                                        <label for="rbac_id" class="form-label">
                                                            <?php echo (_lang['role']); ?>
                                                        </label>
                                                        <select class="form-control editField" name="rbac_id"
                                                            id="rbac_id">
                                                            <?php
                                                            $rbacResult = $structure->getRBAC();
                                                            while ($rbacDetails = $rbacResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($rbacDetails['id']); ?>">
                                                                    <?php echo ($rbacDetails['rbac_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="parts" class="form-label">
                                                            <?php echo (_lang['parts']); ?>
                                                        </label>

                                                        <select multiple="" class="form-control editField" id="optgroup"
                                                            name="parts" style="position: absolute; left: -9999px;">

                                                            <?php
                                                            $partResult = $structure->getUserParts();
                                                            while ($partDetails = $partResult->fetch_assoc()) { ?>
                                                                <optgroup
                                                                    label="<?php echo ($partDetails['users_parts_name']); ?>">

                                                                    <?php
                                                                    $subPartResult = $structure->getSubPartsByPart($partDetails['id']);
                                                                    while ($subPartDetails = $subPartResult->fetch_assoc()) { ?>

                                                                        <option value="<?php echo ($subPartDetails['id']); ?>">
                                                                            <?php echo ($subPartDetails['users_subparts_name']); ?>
                                                                        </option>
                                                                    <?php } ?>

                                                                </optgroup>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="operation" class="form-label">
                                                            <?php echo (_lang['operation']); ?>
                                                        </label>

                                                        <select id="operation" name="operation" multiple
                                                            class="form-control editField">
                                                            <?php
                                                            $operationResult = $structure->getOperations();
                                                            while ($operationDetails = $operationResult->fetch_assoc()) { ?>

                                                                <option value="<?php echo ($operationDetails['id']); ?>"
                                                                    id="customCheck<?php echo ($operationDetails['id']); ?>">
                                                                    <?php echo ($operationDetails['operation_name']); ?>
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