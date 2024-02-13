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

                        <h4 class="page-title">
                            <?php echo _lang['user_achievements']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap"
                                    id="alternative-page-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="all">
                                                <?php echo _lang['title']; ?>
                                            </th>
                                            <th class="all">
                                                <?php echo _lang['user']; ?>
                                            </th>
                                            <th>
                                                <?php echo _lang['added_date']; ?>
                                            </th>
                                            <th>
                                                <?php echo _lang['status']; ?>
                                            </th>
                                            <th style="width: 85px;">
                                                <?php echo _lang['action']; ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while ($achievement = $allAchievement->fetch_assoc()) {  ?>
                                        <tr>
                                            <td>
                                                <?php echo $achievement['achievement_title']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->getUsersById($achievement['user_id'])['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $achievement['creation_date']; ?>
                                            </td>
                                            <td>
                                                <?php if ($achievement['status'] === 'Pending'): ?>
                                                <span class="badge bg-dark">
                                                    <?php echo _lang['pending']; ?>
                                                </span>
                                                <?php elseif ($achievement['status'] === 'Acepted'): ?>
                                                <span class="badge bg-success">
                                                    <?php echo _lang['acepted']; ?>
                                                </span>
                                                <?php elseif ($achievement['status'] === 'Regect'): ?>
                                                <span class="badge bg-warning">
                                                    <?php echo _lang['regect']; ?>
                                                </span>
                                                <?php elseif ($achievement['status'] === 'Archive'): ?>
                                                <span class="badge bg-info">
                                                    <?php echo _lang['archive']; ?>
                                                </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="table-action">
                                                <?php if ($rbac->checkPermissionOperationByName('view')) { ?>
                                                <a href="./user_achievements?id=<?php echo $achievement['id']; ?>"
                                                    class="action-icon"><i class="mdi mdi-eye"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->