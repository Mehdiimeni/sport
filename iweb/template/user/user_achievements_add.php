<?php
///template/user/user_achievements_add.php
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
                                <li class="breadcrumb-item"><a href="./user_achievements">
                                        <?php echo (_lang['achievements']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['new_achievements']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['new_achievements']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="./user_achievements?add=r" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="achievement_title" class="form-label">
                                                <?php echo _lang['title']; ?>
                                            </label>
                                            <input type="text" id="achievement_title" name="achievement_title"
                                                class="form-control" placeholder="<?php echo _lang['enter_title']; ?>">
                                        </div>

                                        <div class="form-group">
                                                <label for="provinces_id">* <?php echo _lang['provinces_name']; ?> :</label>
                                                <select class="form-control" id="provinces_id" name="provinces_id" required>
                                                <option value="" selected><?php echo _lang['select']; ?></option> 
                                                <?php while($province = $allProvince->fetch_assoc()){ ?>
                                                    <option value="<?php echo($province['id']); ?>" ><?php echo($province['provinces_name']); ?></option> 
                                                    <?php } ?>   
                                                
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="federations_id">* <?php echo _lang['federations_name']; ?> :</label>
                                                <select class="form-control" id="federations_id" name="federations_id" required>
                                                <option value="" selected><?php echo _lang['select']; ?></option> 
                                                <?php while($federations = $allFederations->fetch_assoc()){ ?>
                                                    <option value="<?php echo($federations['id']); ?>" ><?php echo($federations['federations_name']); ?></option> 
                                                    <?php } ?>   
                                                
                                                </select>
                                            </div>

                                        <div class="mb-3">
                                            <label for="achievement_description" class="form-label">
                                                <?php echo _lang['description']; ?>
                                            </label>
                                            <textarea class="form-control" id="achievement_description"
                                                name="achievement_description" rows="5"
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