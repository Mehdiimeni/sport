<?php
///template/financial/account.php
?>
<?php
///template/financial/remittance.php
?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">
                                        <?php echo (_lang['financial_affairs']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['account']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['account']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            

                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap"
                                    id="alternative-page-datatable">
                                    <thead class="table-light">
                                    <tr>
                                            <th scope="col">
                                                <?php echo _lang['date']; ?>
                                            </th>
                                            <th scope="col">
                                                <?php echo _lang['issue_tracking']; ?>
                                            </th>
                                            <th scope="col">
                                                <?php echo _lang['order_id']; ?>
                                            </th>
                                            <th scope="col">
                                                <?php echo _lang['amount']; ?>
                                            </th>
                                            <th scope="col">
                                                <?php echo _lang['status']; ?>
                                            </th>
                                            <th scope="col">
                                                <?php echo _lang['for']; ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  while ($payment = $allPayments->fetch_assoc()) {  ?>
                                        <tr>
                                            <td>
                                                <?php echo $payment['creation_date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $payment['RRN']; ?>
                                            </td>
                                            <td>
                                                <?php echo $payment['orderId']; ?>
                                            </td>
                                            <td>
                                                <?php echo $payment['Amount']; ?>
                                            </td>
                                            <td>
                                                <?php if ($payment['status'] === 0): ?>
                                                <span class="badge bg-success">
                                                    <?php echo _lang['confirmation']; ?>
                                                </span>
                                                <?php else : ?>
                                                <span class="badge bg-warnnig">
                                                    <?php echo _lang['disapproval']; ?>
                                                </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($payment['forSet'] === 'register'): ?>
                                                <span class="badge bg-success">
                                                    <?php echo _lang['register']; ?>
                                                </span>
                                                <?php else : ?>
                                                <span class="badge bg-success">
                                                    <?php echo _lang['recharge']; ?>
                                                </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->