<?php
///template/user/user_achievements.php
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo _lang['user_achievements']; ?></a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo _lang['user_achievements']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3">برای عضویت لطفا فرم زیر را به دقت پر نمایید</h4>

                                        <form action="./card_register?add=r" method="post" enctype="multipart/form-data">
                                            <div id="progressbarwizard">

                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                                    <li class="nav-item">
                                                        <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                                                            <i class="mdi mdi-account-circle font-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">تکمیل پروفایل</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                                                            <i class="mdi mdi-face-man-profile font-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">پرداخت هزینه</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            
                                                <div class="tab-content b-0 mb-0">

                                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                                    </div>
                                            
                                                    <div class="tab-pane" id="account-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="national_id">شماره ملی</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="national_id" name="national_id"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="identity_card"> شماره شناسنامه</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="identity_card" name="identity_card" class="form-control"  required>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="address">آدرس</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="address" name="address" class="form-control"  required>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->

                                                        <ul class="list-inline wizard mb-0">
                                                            <li class="next list-inline-item float-end">
                                                                <a href="javascript:void(0);" class="btn btn-info">ثبت و پرداخت <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-pane" id="profile-tab-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name1">پرداخت مبلق 200 هزارتمان بابت ثبت نام و صدور کارت</label>
                                                                    
                                                                </div>
                                                                
                                        
                                                                
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                        <ul class="pager wizard mb-0 list-inline">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-light"><i class="mdi mdi-arrow-left me-1"></i>تکمیل مشخصات</button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="submit" class="btn btn-info">پرداخت</button>
                                                            
                                                            </li>
                                                        </ul>
                                                    </div>


                                                </div> <!-- tab-content -->
                                            </div> <!-- end #progressbarwizard-->
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                
                        </div> 
                        <!-- end row -->

                        
                    </div> <!-- container -->

                </div> <!-- content -->



            </div>