<?php
///template/user/user_position_add.php
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
                                <li class="breadcrumb-item"><a href="./user_position">
                                        <?php echo (_lang['user_position']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['new_position']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['new_position']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="./user_position?add=r" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="position_title" class="form-label">
                                                <?php echo _lang['title']; ?>
                                            </label>
                                            <input type="text" id="position_title" name="position_title"
                                                class="form-control" placeholder="<?php echo _lang['enter_title']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="position_description" class="form-label">
                                                <?php echo _lang['description']; ?>
                                            </label>
                                            <textarea class="form-control" id="position_description"
                                                name="position_description" rows="5"
                                                placeholder="<?php echo _lang['enter_description']; ?>"></textarea>
                                        </div>


                                    </div> <!-- end col-->

                                    <div class="col-xl-6">
                                        <div class="mb-3 mt-3 mt-xl-0">
                                            <label for="attach_file" class="mb-0">
                                                <?php echo _lang['attach_file']; ?>
                                            </label>

                                            <input type="file" name="attach_file" id="attach_file"
                                                class="form-control">

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