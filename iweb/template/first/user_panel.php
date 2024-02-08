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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo _lang['project_name_owner']; ?></a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo _lang['my_dashboard']; ?></a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo _lang['my_dashboard']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="card rounded-0 shadow-none m-0">
                                                    <a href="./remittance" >
                                                    <div class="card-body text-center">
                                                        <i class="ri-file-line text-muted font-24"></i>
                                                        <h3><span><?php echo $financial->getTotalRemittance(); ?></span></h3>
                                                        <p class="text-muted font-15 mb-0"><?php echo _lang['documents']; ?></p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="card rounded-0 shadow-none m-0">
                                                    <a href="./remittance_form1" >
                                                    <div class="card-body text-center">
                                                        <i class="ri-file-transfer-line text-muted font-24"></i>
                                                        <h3><span><?php echo $financial->getTotalForm1(); ?></span></h3>
                                                        <p class="text-muted font-15 mb-0"><?php echo _lang['transfer']; ?></p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="card rounded-0 shadow-none m-0">
                                                    <a href="./remittance_form2" >
                                                    <div class="card-body text-center">
                                                        <i class="ri-layout-top-2-line text-muted font-24"></i>
                                                        <h3><span><?php echo $financial->getTotalForm2(); ?></span></h3>
                                                        <p class="text-muted font-15 mb-0"><?php echo _lang['cheque']; ?></p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                           
                
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="card rounded-0 shadow-none m-0">
                                                    <a href="./remittance_form3" >
                                                    <div class="card-body text-center">
                                                        <i class="ri-money-dollar-box-line text-muted font-24"></i>
                                                        <h3><span><?php echo $financial->getTotalForm3(); ?></span></h3>
                                                        <p class="text-muted font-15 mb-0"><?php echo _lang['cash']; ?></p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="card rounded-0 shadow-none m-0">
                                                    <a href="./remittance_form4" >
                                                    <div class="card-body text-center">
                                                        <i class="ri-briefcase-line text-muted font-24"></i>
                                                        <h3><span><?php echo $financial->getTotalForm4(); ?></span></h3>
                                                        <p class="text-muted font-15 mb-0"><?php echo _lang['agent']; ?></p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                            
                        </div>
                        <!-- end row-->




                        
                    </div> <!-- container -->

                </div> <!-- content -->



            </div>