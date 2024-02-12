<?php
///template/financial/recharge.php
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
                                <li class="breadcrumb-item"><a href="./remittance">
                                        <?php echo (_lang['documents']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['new_document']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['new_document']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="./recharge?add=r" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">
                                                <?php echo _lang['amount']; ?>
                                            </label>
                                            <input type="number" id="amount" name="amount"
                                                class="form-control" placeholder="<?php echo _lang['amount']; ?>">
                                        </div>

                                       


                                    </div> <!-- end col-->

    

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2">
                                            <?php echo _lang['recharge']; ?>
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