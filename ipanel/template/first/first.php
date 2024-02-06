<?php
///template/first/first.php
?>

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?php echo(_lang['ticket_status']); ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo(_lang['count_all']); ?>"><?php echo(_lang['count_all']); ?></h5>
                                    <h3 class="my-2 py-1"><?php echo $ticket->getTicketAllCount(); ?></h3>
                                    
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo(_lang['count_all_open_ticket']); ?>"><?php echo(_lang['count_all_open_ticket']); ?></h5>
                                    <h3 class="my-2 py-1"><?php echo $ticket->getTicketOpenCount(); ?></h3>
                                    
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="new-leads-chart" data-colors="#0acf97"></div>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo(_lang['count_all_close_ticket']); ?>"><?php echo(_lang['count_all_close_ticket']); ?></h5>
                                    <h3 class="my-2 py-1"><?php echo $ticket->getTicketCloseCount(); ?></h3>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="deals-chart" data-colors="#727cf5"></div>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo(_lang['count_all_reply_ticket']); ?>"><?php echo(_lang['count_all_reply_ticket']); ?></h5>
                                    <h3 class="my-2 py-1"><?php echo $ticket->getTicketReplyCount(); ?></h3>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="booked-revenue-chart" data-colors="#0acf97"></div>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-xl-4 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><?php echo _lang['top_performing']; ?></h4>
                            <div class="dropdown">
                            
                                
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th><?php echo _lang['user']; ?></th>
                                            <th><?php echo _lang['reply']; ?></th>
                                            <th><?php echo _lang['task']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $topPerformingResult = $ticket->getTopPerforming();
                                            while ($topPerformingDetails = $topPerformingResult->fetch_assoc()) {
                                                ?>
                                        <tr>

                                            <td>
                                                <h5 class="font-15 mb-1 fw-normal"><?php echo $topPerformingDetails["name"]; ?></h5>
                                                <span class="text-muted font-13"><?php echo $topPerformingDetails["unit_name"]; ?></span>
                                                <span class="text-muted font-11"><?php echo $topPerformingDetails["company_name"]; ?></span>
                                            </td>
                                            <td><?php echo $topPerformingDetails["max_reply_count"]; ?></td>
                                            <td><?php echo $topPerformingDetails["max_ticket_count"]; ?></td>
                                           
                                        </tr>
                                        <?php } ?>
                                    
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
                <!-- end col-->

                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title"><?php echo _lang['last_ticket_open']; ?></h4>
                            
                        </div>

                        <div class="card-body pt-2">

                        <?php 
                                        $lastOpenTicketsResult = $ticket->getLastOpenTickets();
                                            while ($lastOpenTicketsDetails = $lastOpenTicketsResult->fetch_assoc()) {
                                                ?>
                            <div class="d-flex align-items-start">
                                
                                <div class="w-100 overflow-hidden">
                                    <span class="badge badge-success-lighten float-end">#<?php echo $lastOpenTicketsDetails["ticket_id"]; ?></span>
                                    <h5 class="mt-0 mb-1"><?php echo $lastOpenTicketsDetails["name"]; ?></h5>
                                    <span class="font-13"><?php echo $lastOpenTicketsDetails["unit_name"]; ?></span>
                                    <span class="font-12"><?php echo $lastOpenTicketsDetails["company_name"]; ?></span>
                                    <br/>
                                    <span class="font-11"><?php echo $text_tools->truncateText($lastOpenTicketsDetails["message"],150) ; ?></span>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->

                

            <div class="col-xl-4 col-lg-6">


            <div class="card">
    <div class="card-body">
        <h4 class="header-title mb-4"><?php echo _lang['top_tags']; ?></h4>
        <canvas id="tagsChart" style="width: 100%; height: 300px;"></canvas>
    </div>
</div>
                <!-- end col -->
            </div>


        </div> <!-- container -->

    </div> <!-- content -->

</div>