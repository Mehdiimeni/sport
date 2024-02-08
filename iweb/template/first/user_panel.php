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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $_SESSION["name"]; ?></a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $_SESSION["name"]; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            
        
                              

                                

                            <div class="col-xxl-3">
                                <div class="row">
                                    <div class="col-md-6 col-xxl-12">
                                        <div class="card bg-secondary card-bg-img" style="background-image: url(assets/images/bg-pattern.png);">
                                            <div class="card-body">
                                                <span class="float-end text-white-50 display-5 mt-n1"><i class="mdi mdi-contactless-payment"></i></span>
                                                <h4 class="text-white"><?php echo $_SESSION["name"]; ?></h4>
        
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
                                                        <span>1</span>
                                                        <span>2</span>
                                                        <span>3</span>
                                                        <span>4</span>
                                                    </div>
                                                </div>
        
                                                <div class="row mt-4">
                                                    <div class="col-4">
                                                        <p class="text-white-50 font-16 mb-1">انقضا</p>
                                                        <h4 class="text-white my-0">07/12</h4>
                                                    </div>
        
                                                    <div class="col-4">
                                                        <p class="text-white-50 font-16 mb-1">CVV2</p>
                                                        <h4 class="text-white my-0">497</h4>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="text-end">
                                                            <span class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block"></span>
                                                            <span class="avatar-sm bg-white opacity-25 rounded-circle d-inline-block ms-n3"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div> <!-- end col -->

                            

                         
                        </div> <!-- end row -->

                        
                        <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title mb-0">لیست پرداختی ها</h4>
                                        <div>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>امروز</option>
                                                <option value="1">هفته</option>
                                                <option value="2">ماه </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">نام</th>
                                                        <th scope="col">تاریخ</th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">مقدار</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
</div>

                    </div> <!-- container -->

                </div> <!-- content -->

               