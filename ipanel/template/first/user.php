<?php
///template/first/user.php
?>


<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?php echo(_lang['user_status']); ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        

                        <?php if ($rbac->checkPermissionOperationByName('statistics')) { ?>

            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><?php echo _lang['top_performing']; ?></h4>
                            <div class="dropdown">
                            
                                
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th><?php echo _lang['user']; ?></th>
                                            <th><?php echo _lang['enter']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $topPerformingResult = $user->getTopPerforming();
                                            while ($topPerformingDetails = $topPerformingResult->fetch_assoc()) {
                                                ?>
                                        <tr>

                                            <td>
                                                <h5 class="font-15 mb-1 fw-normal"><?php echo $topPerformingDetails["name"]; ?></h5>
                                                <span class="text-muted font-13"><?php echo $topPerformingDetails["unit_name"]; ?></span>
                                                <span class="text-muted font-11"><?php echo $topPerformingDetails["company_name"]; ?></span>
                                            </td>
                                            <td><?php echo $topPerformingDetails["login_count"]; ?></td>
                                           
                                        </tr>
                                        <?php } ?>
                                    
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
                <!-- end col-->

                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><?php echo _lang['last_user_login']; ?></h4>
                            
                        </div>

                        <div class="card-body pt-2">

                        <?php 
                                        $lastLoginUsersResult = $user->getLastLoginUsers();
                                            while ($lastLoginUsersDetails = $lastLoginUsersResult->fetch_assoc()) {
                                                ?>
                            <div class="d-flex align-items-start">
                                
                                <div class="w-100 overflow-hidden">
                                    <span class="badge badge-success-lighten float-end">#<?php echo $lastLoginUsersDetails["user_id"]; ?></span>
                                    <h5 class="mt-0 mb-1"><?php echo $lastLoginUsersDetails["name"]; ?></h5>
                                    <span class="font-13"><?php echo $lastLoginUsersDetails["unit_name"]; ?></span>
                                    <span class="font-12"><?php echo $lastLoginUsersDetails["company_name"]; ?></span>
                                    <br/>
                                    <span class="font-11"><?php echo $lastLoginUsersDetails["last_login_time"]; ?></span>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->

                <!-- end col -->
            </div>
            <!-- end row-->
<?php } ?>

        </div> <!-- container -->

    </div> <!-- content -->

</div>