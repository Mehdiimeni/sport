<?php
///template/financial/remittance_form4_add.php
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
                                        <?php echo (_lang['my_briefcase']); ?>
                                    </a></li>
                                <li class="breadcrumb-item"><a href="./remittance_form4">
                                        <?php echo (_lang['agent']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['new_agent']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['new_agent']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="./remittance_form4?add=r" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">

                                            
                                            
                                           
                                            <div class="form-group">
                                                <label for="name">* <?php echo _lang['name']; ?> :</label>
                                                <input type="text" class="form-control" id="name" name="name" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">* <?php echo _lang['mobile']; ?> :</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    required>
                                            </div>
                                          
                                            
                                           

                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            
                                            <div class="form-group">
                                                <label for="description"><?php echo _lang['description']; ?> :</label>
                                                <textarea class="form-control" id="description"
                                                    name="description" rows="3" ></textarea>
                                            </div>
                                           
                                           
                                            

                                            <label for="attach_file" class="mb-0">
                                                <?php echo _lang['attach_file']; ?>
                                            </label>

                                            <input type="file" name="attach_file" id="attach_file" class="form-control">

                                        </div>


                                    </div> <!-- end col-->

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2">
                                            <?php echo _lang['submit']; ?>
                                        </button>
                                    </div>
                            </form>
                        </div>
                        <!-- end row -->


                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->