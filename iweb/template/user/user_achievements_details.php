<?php
///template/user/user_achievements_details.php
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
                                <li class="breadcrumb-item"><a href="./user_achievement">
                                        <?php echo (_lang['achievements']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['achievement_details']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['achievement_details']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-8 col-lg-6">
                    <!-- project card -->
                    <div class="card d-block">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">



                                <h3 class="mt-0">
                                    <?php echo $achievementDetail['achievement_title']; ?>
                                </h3>

                                    <h4 class="mt-0">
                                        <?php echo $achievementDetail['provinces_name']; ?>
                                    </h4>
                                    <!-- project title-->
                               

                                    <h4 class="mt-0">
                                        <?php echo $achievementDetail['federations_name']; ?>
                                    </h4>
                                    <!-- project title-->
                               

                                <!-- project title-->
                            </div>

                            <?php if ($achievementDetail['status'] === 'Pending'): ?>
                                <div class="badge bg-dark mb-3">
                                    <?php echo _lang['pending']; ?>
                                </div>
                            <?php elseif ($achievementDetail['status'] === 'Acepted'): ?>
                                <div class="badge bg-success mb-3">
                                    <?php echo _lang['acepted']; ?>
                                </div>
                            <?php elseif ($achievementDetail['status'] === 'Regect'): ?>
                                <div class="badge bg-warning mb-3">
                                    <?php echo _lang['regect']; ?>
                                </div>
                            <?php elseif ($achievementDetail['status'] === 'Archive'): ?>
                                <div class="badge bg-info mb-3">
                                    <?php echo _lang['archive']; ?>
                                </div>
                            <?php endif; ?>


                            <p class="text-muted mb-2">
                                <?php echo $achievementDetail['achievement_description']; ?>
                            </p>


                            <div class="row">
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">
                                        <?php echo _lang['user']; ?>
                                    </p>
                                    <div class="d-flex">
                                        <img src="<?php echo ($userProfile['file_path'] . $userProfile['file_name']); ?>"
                                            alt="<?php echo ($userProfile['name']); ?>" class="rounded-circle me-2"
                                            height="24" />
                                        <h5>
                                            <?php echo ($userProfile['name']); ?>
                                        </h5>
                                    </div>
                                    <!-- end assignee -->
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <h5>
                                            <?php echo _lang['added_date']; ?>
                                        </h5>
                                        <p>
                                            <?php echo $achievementDetail['creation_date']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <h5>
                                            <?php echo _lang['last_uapdate_date']; ?>
                                        </h5>
                                        <p>
                                            <?php echo $achievementDetail['last_updated_date']; ?>
                                        </p>
                                    </div>
                                </div>

                            </div>


                        </div> <!-- end card-body-->

                    </div> <!-- end card-->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 mb-3">
                                <?php $parent_id = $_GET['parent_id'] ?? null;
                                echo _lang['comments']; ?> (
                                <?php echo ($comment->getTotalCommentPart()); ?>)
                            </h4>
                            <form action="./user_achievement?id=<?php echo ($_GET['id']); ?>" method="post">
                                <textarea class="form-control form-control-light mb-2"
                                    placeholder="<?php echo _lang['write_message']; ?>" id="example-textarea" rows="3"
                                    name="comment_text" id="comment_text"></textarea>

                                <?php if ($rbac->checkPermissionOperationByName('local', 'u')) { ?>
                                    <input type="hidden" name="parent_id" id="parent_id" value="<?php echo ($parent_id); ?>">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="local" class="form-check-input" id="local">
                                            <label class="form-check-label" for="checkbox-signup">
                                                <?php echo _lang['local']; ?> <a href="#" class="text-muted">
                                                    <?php echo _lang['just_local_comment']; ?>
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="text-end">

                                    <div class="btn-group mb-2 ms-2">


                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <?php echo _lang['submit']; ?>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <?php while ($commentDetail = $allComments->fetch_assoc()) {

                                if ($commentDetail['company_id'] != '') {
                                    if ($commentDetail['company_id'] != $structure->getCompanyByUnitId($_SESSION['unit_id']))
                                        continue;

                                }

                                ?>




                                <div class="d-flex align-items-start mt-2">

                                    <div class="d-flex">
                                        <img class="me-2 rounded-circle"
                                            src="<?php echo ($commentDetail['file_path'] . $commentDetail['file_name']); ?>"
                                            alt="<?php echo ($commentDetail['name']); ?>" height="32">
                                    </div>
                                    <div class="w-100 overflow-hidden">
                                        <h5 class="mt-0">
                                            <?php echo ($commentDetail['name']); ?> <small class="text-muted float-end">
                                                <?php echo ($commentDetail['creation_date']); ?>
                                            </small>
                                        </h5>
                                        <?php echo ($commentDetail['comment_text']); ?>

                                        <?php if ($rbac->checkPermissionOperationByName('reply', 'u')) { ?>
                                            <a href="./user_achievement?id=<?php echo ($_GET['id']); ?>&parent_id=<?php echo ($commentDetail['id']); ?>"
                                                class="text-muted font-13 d-inline-block mt-2"><i class="mdi mdi-reply"></i>
                                                <?php echo _lang['reply']; ?>
                                            </a>
                                        <?php } ?>
                                        <?php $replyComments = $comment->getCommentPartByParentId($commentDetail['id']);
                                        while ($replyDetail = $replyComments->fetch_assoc()) { ?>
                                            <div class="d-flex align-items-start mt-3">
                                                <div class="pe-3"></div>

                                                <div class="w-100 overflow-hidden">

                                                    <h5 class="mt-0"><img class="me-2 rounded-circle"
                                                            src="<?php echo ($replyDetail['file_path'] . $replyDetail['file_name']); ?>"
                                                            alt="<?php echo ($replyDetail['name']); ?>" height="32">
                                                        <?php echo ($replyDetail['name']); ?> <small
                                                            class="text-muted float-end">
                                                            <?php echo ($replyDetail['creation_date']); ?>
                                                        </small>
                                                    </h5>
                                                    <?php echo ($replyDetail['comment_text']); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div> <!-- end card-body-->
                    </div>

                    <!-- end card-->
                </div> <!-- end col -->

                <div class="col-lg-6 col-xxl-4">

                    <div class="card">
                        <div class="card-body">
                            <?php if ($rbac->checkPermissionOperationByName('attach', 'u')) { ?>
                                <form action="achievement?id=<?php echo ($_GET['id']); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="mb-3 mt-3 mt-xl-0">
                                        <label for="attach_file" class="mb-0">
                                            <?php echo _lang['attach_file']; ?>
                                        </label>
                                        <div class="input-group">
                                            <?php if ($rbac->checkPermissionOperationByName('local', 'u')) { ?>

                                                <input type="checkbox" id="switch3" name="local" checked
                                                    data-switch="success" />
                                                <label for="switch3" data-on-label="<?php echo _lang['local']; ?>"
                                                    data-off-label="<?php echo _lang['global']; ?>"></label>

                                            <?php } ?>
                                        </div>
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="file_title" required
                                                id="file_title" aria-describedby="basic-addon1"
                                                placeholder="<?php echo _lang['file_title']; ?>">
                                        </div>

                                        <div class="input-group">
                                            <input type="file" name="attach_file" required id="attach_file"
                                                class="form-control">

                                            <button class="btn btn-outline-secondary" type="submit">
                                                <?php echo _lang['attach']; ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>



                            <h5 class="card-title mb-3">
                                <?php echo (_lang['sended_files']); ?>
                            </h5>
                            <?php foreach ($allFileInfo as $fileInfo) {

                                if (!empty($fileInfo['CompanyId']) && $fileInfo['CompanyId'] != $structure->getCompanyByUnitId($_SESSION['unit_id'])) {
                                    continue;
                                }


                                ?>
                                <div class="card mb-1 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded">
                                                        .
                                                        <?php echo $fileInfo['fileType']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col ps-0">
                                                <a href="./user_achievement?id=<?php echo ($_GET['id']); ?>&file=<?php echo $fileInfo['downloadLink']; ?>"
                                                    class="text-muted fw-bold">
                                                    <?php echo empty($fileInfo['fileTitle']) ? $fileInfo['fileName'] : $fileInfo['fileTitle']; ?>
                                                </a>
                                                <p class="mb-0">
                                                    <?php echo $fileInfo['fileSize']; ?>
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="./user_achievement?id=<?php echo ($_GET['id']); ?>&file=<?php echo $fileInfo['downloadLink']; ?>"
                                                    class="btn btn-link btn-lg text-muted">
                                                    <i class="ri-download-2-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->