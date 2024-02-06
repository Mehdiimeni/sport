<?php
///template/financial/remittance.php
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo (_lang['my_briefcase']); ?></a></li>
                                            <li class="breadcrumb-item active"><?php echo _lang['documents']; ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo _lang['documents']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <a href="./remittance?add=r" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i><?php echo _lang['new_document']; ?></a>
                                            </div>
                                            
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="alternative-page-datatable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="all"><?php echo _lang['title']; ?></th>
                                                        <th><?php echo _lang['added_date']; ?></th>
                                                        <th><?php echo _lang['status']; ?></th>
                                                        <th style="width: 85px;"><?php echo _lang['action']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php  while ($remittance = $allRemittance->fetch_assoc()) {  ?>
    <tr>
        <td>
            <?php echo $remittance['remittance_title']; ?>
        </td>
        <td>
            <?php echo $remittance['creation_date']; ?>
        </td>
        <td>
            <?php if ($remittance['status'] === 'Pending'): ?>
                <span class="badge bg-dark"><?php echo $remittance['status']; ?></span>
            <?php elseif ($remittance['status'] === 'Acepted'): ?>
                <span class="badge bg-success"><?php echo $remittance['status']; ?></span>
            <?php elseif ($remittance['status'] === 'Regect'): ?>
                <span class="badge bg-warning"><?php echo $remittance['status']; ?></span>
            <?php elseif ($remittance['status'] === 'Archive'): ?>
                <span class="badge bg-info"><?php echo $remittance['status']; ?></span>
            <?php endif; ?>
        </td>
        <td class="table-action">
            <a href="./remittance?remittance_id=<?php echo $remittance['id']; ?>" class="action-icon"><i class="mdi mdi-eye"></i></a>
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
