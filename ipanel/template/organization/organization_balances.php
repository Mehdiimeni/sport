<?php
///template/organization/organization_balances.php
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
                            <?php echo (_lang['balances']); ?>
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
                                                <?php echo (_lang['company_name']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['bank_name']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['currency_type']); ?>
                                            </th>
                                            <th>
                                                <?php echo (_lang['amount']); ?>
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

                                        $balancesResult = $structure->getOrganizationBalances();
                                        while ($balancesDetails = $balancesResult->fetch_assoc()) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo ($structure->getCompanyNameById($balancesDetails['company_id'])['company_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($structure->getBankNameById($balancesDetails['bank_id'])['bank_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $balancesDetails['CurrencyType']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $balancesDetails['Amount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $balancesDetails['last_updated_date']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($rbac->checkPermissionOperationByName('delete')) { ?>
                                                        <a href="javascript:void(0);" class="action-icon delete-item"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-table="organization_balance"
                                                            data-id="<?php echo $balancesDetails['id']; ?>">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if ($balancesDetails['status'] === 'Active') { ?>
                                                        <?php if ($rbac->checkPermissionOperationByName('inactive')) { ?>
                                                            <a href="javascript:void(0);" class="action-icon inactive-item"
                                                                data-bs-toggle="modal" data-bs-target="#inactiveModal"
                                                                data-table="organization_balance"
                                                                data-id="<?php echo $balancesDetails['id']; ?>">
                                                                <i class="mdi mdi-smart-card"></i>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ($rbac->checkPermissionOperationByName('active')) { ?>
                                                            <a href="javascript:void(0);" class="action-icon active-item"
                                                                data-bs-toggle="modal" data-bs-target="#activeModal"
                                                                data-table="organization_balance"
                                                                data-id="<?php echo $balancesDetails['id']; ?>">
                                                                <i class="mdi mdi-smart-card-off"></i>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if ($rbac->checkPermissionOperationByName('edit')) { ?>
                                                        <a href="javascript:void(0);" class="action-icon edit-item"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-table="organization_balance"
                                                            data-id="<?php echo $balancesDetails['id']; ?>">
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


                                <div class="modal fade" id="activeModal" tabindex="-1" role="dialog"
                                    aria-labelledby="activeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="activeModalLabel">
                                                    <?php echo (_lang['active_item']); ?>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="<?php echo (_lang['close']); ?>">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo (_lang['active_confirm']); ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <?php echo (_lang['close']); ?>
                                                </button>
                                                <button type="button" class="btn btn-danger confirm-active">
                                                    <?php echo (_lang['active']); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="inactiveModal" tabindex="-1" role="dialog"
                                    aria-labelledby="inactiveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inactiveModalLabel">
                                                    <?php echo (_lang['inactive_item']); ?>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="<?php echo (_lang['close']); ?>">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo (_lang['inactive_confirm']); ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <?php echo (_lang['close']); ?>
                                                </button>
                                                <button type="button" class="btn btn-danger confirm-inactive">
                                                    <?php echo (_lang['inactive']); ?>
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
                                                <!-- Form for adding balances -->
                                                <form id="addForm" name="addForm" class="form-control">
                                                    <input type="hidden" class="form-control addField" name="table_set"
                                                        id="tableSet" value="organization_balance">
                                                    <input class="form-control addField" type="hidden"
                                                        name="unique_fields" id="unique_fields"
                                                        value="<?php echo $unique_fields; ?>">

                                                    <div class="mb-3">
                                                        <label for="company_id" class="form-label">
                                                            <?php echo (_lang['company']); ?>
                                                        </label>

                                                        <select class="form-control addField" name="company_id"
                                                            id="company_id">
                                                            <?php
                                                            $companyResult = $structure->getOrganizationCompanies();
                                                            while ($companyDetails = $companyResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($companyDetails['id']); ?>">
                                                                    <?php echo ($companyDetails['company_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="bank_id" class="form-label">
                                                            <?php echo (_lang['bank']); ?>
                                                        </label>

                                                        <select class="form-control addField" name="bank_id"
                                                            id="bank_id">
                                                            <?php
                                                            $bankResult = $structure->getOrganizationBanks();
                                                            while ($bankDetails = $bankResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($bankDetails['id']); ?>">
                                                                    <?php echo ($bankDetails['bank_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Amount" class="form-label">
                                                            <?php echo _lang['amount']; ?>
                                                        </label>
                                                        <input type="text" class="form-control addField" id="Amount"
                                                            name="Amount" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="CurrencyType" class="form-label">
                                                            <?php echo _lang['currency_type']; ?>
                                                        </label>
                                                        <select class="form-control addField" id="CurrencyType"
                                                            name="CurrencyType" required>
                                                            <option value="" selected>
                                                                <?php echo _lang['select']; ?>
                                                            </option>
                                                            <option value="EUR">
                                                                <?php echo _lang['eur']; ?>
                                                            </option>
                                                            <option value="USD">
                                                                <?php echo _lang['usd']; ?>
                                                            </option>
                                                            <option value="AED">
                                                                <?php echo _lang['aed']; ?>
                                                            </option>
                                                            <option value="RUB">
                                                                <?php echo _lang['rub']; ?>
                                                            </option>
                                                            <option value="RMB">
                                                                <?php echo _lang['rmb']; ?>
                                                            </option>
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
                                                <!-- Form for editing balances -->
                                                <form id="editForm" name="editForm" class="form-control">
                                                    <input type="hidden" class="form-control editField" name="table_set"
                                                        id="table_set">
                                                    <input type="hidden" class="form-control editField" name="id"
                                                        id="id">

                                                    <input class="form-control editField" type="hidden"
                                                        name="unique_fields" id="unique_fields"
                                                        value="<?php echo $unique_fields; ?>">

                                                        <div class="mb-3">
                                                        <label for="company_id" class="form-label">
                                                            <?php echo (_lang['company']); ?>
                                                        </label>

                                                        <select class="form-control editField" name="company_id"
                                                            id="company_id">
                                                            <?php
                                                            $companyResult = $structure->getOrganizationCompanies();
                                                            while ($companyDetails = $companyResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($companyDetails['id']); ?>">
                                                                    <?php echo ($companyDetails['company_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="bank_id" class="form-label">
                                                            <?php echo (_lang['bank']); ?>
                                                        </label>

                                                        <select class="form-control editField" name="bank_id"
                                                            id="bank_id">
                                                            <?php
                                                            $bankResult = $structure->getOrganizationBanks();
                                                            while ($bankDetails = $bankResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo ($bankDetails['id']); ?>">
                                                                    <?php echo ($bankDetails['bank_name']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Amount" class="form-label">
                                                            <?php echo _lang['amount']; ?>
                                                        </label>
                                                        <input type="text" class="form-control editField" id="Amount"
                                                            name="Amount" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="CurrencyType" class="form-label">
                                                            <?php echo _lang['currency_type']; ?>
                                                        </label>
                                                        <select class="form-control editField" id="CurrencyType"
                                                            name="CurrencyType" required>
                                                            <option value="" selected>
                                                                <?php echo _lang['select']; ?>
                                                            </option>
                                                            <option value="EUR">
                                                                <?php echo _lang['eur']; ?>
                                                            </option>
                                                            <option value="USD">
                                                                <?php echo _lang['usd']; ?>
                                                            </option>
                                                            <option value="AED">
                                                                <?php echo _lang['aed']; ?>
                                                            </option>
                                                            <option value="RUB">
                                                                <?php echo _lang['rub']; ?>
                                                            </option>
                                                            <option value="RMB">
                                                                <?php echo _lang['rmb']; ?>
                                                            </option>
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