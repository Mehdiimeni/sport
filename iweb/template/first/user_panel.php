<?php
///template/first/user_panel.php
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
                                        <?php echo _lang['project_name_owner']; ?>
                                    </a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">
                                        <?php echo $_SESSION["name"]; ?>
                                    </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo $_SESSION["name"]; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">






                <div class="col-xxl-3">
                    <div class="row">
                        <div class="col-md-6 col-xxl-12">
                            <div class="card bg-secondary card-bg-img"
                                style="background-image: url(assets/images/bg-pattern.png);">
                                <div class="card-body">
                                    <span class="float-end text-white-50 display-5 mt-n1"><i
                                            class="mdi mdi-contactless-payment"></i></span>
                                    <h4 class="text-white">
                                        <?php echo $_SESSION["name"]; ?>
                                    </h4>

                                    <div class="row align-items-center mt-4">
                                        <div class="col-3 text-white font-12">
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                        </div>
                                        <div class="col-3 text-white font-12">
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                        </div>
                                        <div class="col-3 text-white font-12">
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                            <i class="mdi mdi-circle"></i>
                                        </div>
                                        <div class="col-3 text-white font-16 fw-bold">
                                            <span>3</span>
                                            <span>8</span>
                                            <span>8</span>
                                            <span>7</span>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <p class="text-white-50 font-16 mb-1">
                                                <?php echo _lang['expiration']; ?>
                                            </p>
                                            <h4 class="text-white my-0">05/11</h4>
                                        </div>

                                        <div class="col-4">
                                            <p class="text-white-50 font-16 mb-1">
                                                <?php echo _lang['cvv2']; ?>
                                            </p>
                                            <h4 class="text-white my-0">690</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-end">
                                                <span
                                                    class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block"></span>
                                                <span
                                                    class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block ms-n3"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      
                        <div class="col-md-6 col-xxl-12">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-users-alt float-end'></i>
                                        <h6 class="text-uppercase mt-0"><?php echo _lang['wallet']; ?></h6>
                                        <h2 class="my-2" id="active-users-count"><?php echo($walletBalance); ?></h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span> <?php echo($userScore); ?></span>
                                            <span class="text-nowrap"><?php echo _lang['score']; ?></span>  
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
                        </div>

                    </div> <!-- end col -->




                </div> <!-- end row -->


                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                <?php echo _lang['list_payments']; ?>
                            </h4>
                            <div>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option value="1">
                                        <?php echo _lang['week']; ?>
                                    </option>
                                    <option value="2">
                                        <?php echo _lang['month']; ?>
                                    </option>
                                    <option value="2">
                                        <?php echo _lang['year']; ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <?php echo _lang['date']; ?>
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
                        </div>
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->