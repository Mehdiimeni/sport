<?php
///template/user/user_position_details.php
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
                                        <?php echo (_lang['my_requests']); ?>
                                    </a></li>
                                <li class="breadcrumb-item"><a href="./user_position">
                                        <?php echo (_lang['user_position']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['position_details']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['position_details']; ?>
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
                                    <?php echo $positionDetail['position_title']; ?>
                                </h3>
                                <?php if ($rbac->checkPermissionOperationByName('action')) { ?>
                                <div class="dropdown">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <?php if ($rbac->checkPermissionOperationByName('acepted')) { ?>
                                                    <a href="javascript:void(0);" id="Acepted" class="dropdown-item operation-link" data-operation="Acepted" data-tableset="user_position" data-id="<?php echo $positionDetail['id']; ?>"><?php echo _lang['acepted']; ?></a>
                                                    <?php } ?>
                                                   
                             
                                <?php if ($rbac->checkPermissionOperationByName('regect')) { ?>
                                    <a href="javascript:void(0);" id="Regect" class="dropdown-item operation-link" data-operation="Regect" data-tableset="user_position" data-id="<?php echo $positionDetail['id']; ?>"><?php echo _lang['regect']; ?></a>
                                <?php } ?>
                                <?php if ($rbac->checkPermissionOperationByName('pending')) { ?>
                                    <a href="javascript:void(0);" id="Pending" class="dropdown-item operation-link" data-operation="Pending" data-tableset="user_position" data-id="<?php echo $positionDetail['id']; ?>"><?php echo _lang['pending']; ?></a>
                                <?php } ?>
                                <?php if ($rbac->checkPermissionOperationByName('archive')) { ?>
                                    <a href="javascript:void(0);" id="Archive" class="dropdown-item operation-link" data-operation="Archive" data-tableset="user_position" data-id="<?php echo $positionDetail['id']; ?>"><?php echo _lang['archive']; ?></a>
                                <?php } ?>
                         
                                                </div>
                                            </div>


                                    <?php } ?>

                                <!-- project title-->
                            </div>

                            <?php if ($positionDetail['status'] === 'Pending'): ?>
                                <div class="badge bg-dark mb-3">
                                    <?php echo _lang['pending']; ?>
                                </div>
                            <?php elseif ($positionDetail['status'] === 'Acepted'): ?>
                                <div class="badge bg-success mb-3">
                                    <?php echo _lang['acepted']; ?>
                                </div>
                            <?php elseif ($positionDetail['status'] === 'Regect'): ?>
                                <div class="badge bg-warning mb-3">
                                    <?php echo _lang['regect']; ?>
                                </div>
                            <?php elseif ($positionDetail['status'] === 'Archive'): ?>
                                <div class="badge bg-info mb-3">
                                    <?php echo _lang['archive']; ?>
                                </div>
                            <?php endif; ?>


                            <p class="text-muted mb-2">
                                <?php echo $positionDetail['position_description']; ?>
                            </p>


                            <div class="row">
                            <div class="col-md-4">
                                                <!-- assignee -->
                                                <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase"><?php echo _lang['user']; ?></p>
                                                <div class="d-flex">
                                                    <img src="<?php echo('.'.$userProfile['file_path'].$userProfile['file_name']);?>" alt="<?php echo($userProfile['name']);?>" class="rounded-circle me-2" height="24" />
                                                        <h5 >
                                                        <?php echo($userProfile['name']);?>
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
                                            <?php echo $positionDetail['creation_date']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <h5>
                                            <?php echo _lang['last_uapdate_date']; ?>
                                        </h5>
                                        <p>
                                            <?php echo $positionDetail['last_updated_date']; ?>
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
                            <form action="./user_position?id=<?php echo ($_GET['id']); ?>"
                                method="post">
                                <textarea class="form-control form-control-light mb-2"
                                    placeholder="<?php echo _lang['write_message']; ?>" id="example-textarea" rows="3"
                                    name="comment_text" id="comment_text"></textarea>
                                    <?php if ($rbac->checkPermissionOperationByName('local')) { ?>
                                    <input type="hidden" name="parent_id" id="parent_id" value="<?php echo($parent_id); ?>">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="local" class="form-check-input" id="local">
                                            <label class="form-check-label" for="checkbox-signup"><?php echo _lang['local']; ?> <a href="#" class="text-muted"><?php echo _lang['just_local_comment']; ?></a></label>
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
                                
                                if($commentDetail['company_id'] != '')
                                {
                                    if($commentDetail['company_id'] != $structure->getCompanyByUnitId($_SESSION['unit_id']))
                                    continue;
                                    
                                }
                                
                                ?>
                            
                           
                            

                            <div class="d-flex align-items-start mt-2">
                            <div class="d-flex">
                                            <img class="me-2 rounded-circle" src="<?php echo('.'.$commentDetail['file_path'].$commentDetail['file_name']);?>" alt="<?php echo($commentDetail['name']);?>" height="32">
                                            </div>
                                            <div class="w-100 overflow-hidden">
                                            <div class="me-3"></div>
                                                <h5 class="mt-0"><?php echo ($commentDetail['name']); ?> <small class="text-muted float-end"><?php echo ($commentDetail['creation_date']); ?></small></h5>
                                                <?php echo ($commentDetail['comment_text']); ?>

                                                <?php if ($rbac->checkPermissionOperationByName('reply')) { ?>
                                                <a href="./position?position_id=<?php echo ($_GET['id']); ?>&parent_id=<?php echo ($commentDetail['id']); ?>" class="text-muted font-13 d-inline-block mt-2"><i
                                                    class="mdi mdi-reply"></i><?php echo _lang['reply']; ?></a>
                                                    <?php } ?>
                                                    <?php $replyComments = $comment->getCommentPartByParentId($commentDetail['id']); while ($replyDetail = $replyComments->fetch_assoc()) { ?>
                                                <div class="d-flex align-items-start mt-3">
                                                    <div class="pe-3"></div>
                                                
                                                    <div class="w-100 overflow-hidden">
                                                    <h5 class="mt-0"><img class="me-2 rounded-circle" src="<?php echo('.'.$replyDetail['file_path'].$replyDetail['file_name']);?>" alt="<?php echo($replyDetail['name']);?>" height="32"><?php echo ($replyDetail['name']); ?> <small class="text-muted float-end"><?php echo ($replyDetail['creation_date']); ?></small></h5>
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

                <?php if ($rbac->checkPermissionOperationByName('assign')) { ?>
                <div class="card-body">
                        <div
                            class="border-dashed border-2 border h-100 w-100 rounded d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);" class="text-center text-muted p-2" data-bs-toggle="modal"
                                data-bs-target="#AssignTo">
                                <i class="mdi mdi-plus h3 my-0"></i>
                                <h4 class="font-16 mt-1 mb-0 d-block">
                                    <?php echo _lang['assign']; ?>
                                </h4>
                            </a>
                        </div>
                    </div> <!-- end card-body -->
<?php } ?>

                <div class="card">
                        <div class="card-body">
                        <?php if ($rbac->checkPermissionOperationByName('attach')) { ?>
                            <form action="position?position_id=<?php echo($_GET['id']);?>" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3 mt-xl-0">
            <label for="attach_file" class="mb-0">
                <?php echo _lang['attach_file']; ?>
            </label>
            <div class="input-group">
            <?php if ($rbac->checkPermissionOperationByName('local')) { ?>
               
                <input type="checkbox" id="switch3" name="local" checked data-switch="success"/>
                <label for="switch3" data-on-label="<?php echo _lang['local']; ?>" data-off-label="<?php echo _lang['global']; ?>"></label>

                <?php } ?>
            </div>
            <div class="input-group">
  
               <input type="text" class="form-control" name="file_title" required id="file_title"  aria-describedby="basic-addon1" placeholder="<?php echo _lang['file_title']; ?>">
            </div>
               
            <div class="input-group">
                <input type="file" name="attach_file" required id="attach_file" class="form-control">
                
                <button class="btn btn-outline-secondary" type="submit"><?php echo _lang['attach']; ?></button>
            </div>
        </div>
    </form>
                        <?php } ?>


                                    
                            <h5 class="card-title mb-3">
                                <?php echo (_lang['sended_files']); ?>
                            </h5>
                            <?php foreach($allFileInfo as $fileInfo){ 
    
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
                                            <a href="./position?position_id=<?php echo($_GET['id']);?>&file=<?php echo $fileInfo['downloadLink']; ?>"
                                                class="text-muted fw-bold">
                                                <?php echo empty($fileInfo['fileTitle']) ? $fileInfo['fileName'] : $fileInfo['fileTitle']; ?>

                                            </a>
                                            <p class="mb-0">
                                                <?php echo $fileInfo['fileSize']; ?>
                                            </p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="./position?position_id=<?php echo($_GET['id']);?>&file=<?php echo $fileInfo['downloadLink']; ?>"
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


                    <div class="modal fade" id="AssignTo" tabindex="-1" aria-labelledby="AssignToLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AssignToLabel"><?php echo _lang['assign']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-3">
                                <form action="./position?position_id=<?php echo ($_GET['id']); ?>" method="post"  enctype="multipart/form-data">
                                    
                                <input type="hidden" value="position" id="section_part_name" name="section_part_name">
                                <input type="hidden" value="<?php echo ($_GET['id']); ?>F" id="section_element_id" name="section_element_id">
                                
                                <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label"><?php echo _lang['assign']; ?> <?php echo _lang['role']; ?></label>
                                        <select class="form-select select2" name="receiver_rbac_id" data-toggle="select2"
                                            aria-label="Default select example">
                                            <option selected><?php echo _lang['assign']; ?> <?php echo _lang['role']; ?></option>
                                            <?php 
                                            $rbacInfo = $rbac->getRbacInfoByOperationName('view');
                                            while ($rbacInfoDetail = $rbacInfo->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $rbacInfoDetail['id'];?>"><?php echo $rbacInfoDetail['rbac_name'];?></option>
                                    
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="AssignTask" class="form-label"><?php echo _lang['assign']; ?> <?php echo _lang['admins']; ?></label>
                                        <select class="select2 form-control select2-multiple" name="receiver_person_id_a[]" data-toggle="select2"
                                            multiple="multiple" data-placeholder="<?php echo _lang['choose']; ?>">
                                            <?php 
                                            $rbacAdminsInfo = $rbac->getAdminsByOperationName('view');
                                            while ($rbacAdminsInfoDetail = $rbacAdminsInfo->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rbacAdminsInfoDetail['id']; ?>"><?php echo $rbacAdminsInfoDetail['name']; ?></option>
                                            <?php } ?>
                                           
                                            
                                            
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="AssignTask" class="form-label"><?php echo _lang['assign']; ?> <?php echo _lang['users']; ?></label>
                                        <select class="select2 form-control select2-multiple" name="receiver_person_id_u[]" data-toggle="select2"
                                            multiple="multiple" data-placeholder="<?php echo _lang['choose']; ?>">
                                            
                                            <?php 
                                            $rbacUsersInfo = $rbac->getUsersByOperationName('view');
                                            while ($rbacUsersInfoDetail = $rbacUsersInfo->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rbacUsersInfoDetail['id']; ?>"><?php echo $rbacUsersInfoDetail['name']; ?></option>
                                               <?php } ?>
                                            
                                        </select>
                                    </div>

                                    <div>
                                        <label for="description" class="form-label"><?php echo _lang['description']; ?></label>
                                        <textarea class="form-control" id="description" name="forwards_description" rows="4"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signup" name="sender_signature">
                                            <label class="form-check-label" for="checkbox-signup"><?php echo _lang['signature']; ?> <a href="#" class="text-muted"><?php echo _lang['signature_note']; ?></a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo _lang['close']; ?></button>
                                    <button type="submit" name="forward" value="position" class="btn btn-primary"><?php echo _lang['assign']; ?></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

 