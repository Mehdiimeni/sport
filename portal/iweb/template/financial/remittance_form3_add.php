<?php
///template/financial/remittance_form3_add.php
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
                                <li class="breadcrumb-item"><a href="./remittance_form3">
                                        <?php echo (_lang['cash']); ?>
                                    </a></li>
                                <li class="breadcrumb-item active">
                                    <?php echo _lang['new_cash']; ?>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php echo _lang['new_cash']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="./remittance_form3?add=r" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">

                                            
                                            <div class="form-group">
                                                <label for="priority"><?php echo _lang['priority']; ?> :</label>
                                                <select class="form-control" id="priority" name="priority">
                                                <option value="" selected><?php echo _lang['select']; ?></option>    
                                                <option value="High"><?php echo _lang['high']; ?></option>
                                                    <option value="Medium"><?php echo _lang['medium']; ?></option>
                                                    <option value="Low"><?php echo _lang['low']; ?></option>
                                                </select>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="ref"><?php echo _lang['ref']; ?> :</label>
                                                <input type="text" class="form-control" id="ref" name="ref" >
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">* <?php echo _lang['amount']; ?> :</label>
                                                <input type="text" class="form-control" id="amount" name="amount"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="currency">* <?php echo _lang['currency_type']; ?> :</label>
                                                <select class="form-control" id="currency" name="currency" required>
                                                <option value="" selected><?php echo _lang['select']; ?></option> 
                                                    <option value="EUR"><?php echo _lang['eur']; ?> </option>
                                                    <option value="USD"><?php echo _lang['usd']; ?> </option>
                                                    <option value="AED"><?php echo _lang['aed']; ?> </option>
                                                    <option value="RUB"><?php echo _lang['rub']; ?> </option>
                                                    <option value="RMB"><?php echo _lang['rmb']; ?> </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="agent_id">* <?php echo _lang['nominated_person']; ?> :</label>
                                                <select class="form-control" id="agent_id" name="agent_id" required>
                                                <option value="" selected><?php echo _lang['select']; ?></option> 
                                                <?php while($agent = $allAgent->fetch_assoc()){ ?>
                                                    <option value="<?php echo($agent['id']); ?>" ><?php echo($agent['name']); ?></option> 
                                                    <?php } ?>   
                                                
                                                </select>
                                            </div>
                                           

                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            
                                            <div class="form-group">
                                                <label for="remittancePurpose">* <?php echo _lang['remittance_purpose']; ?> :</label>
                                                <textarea class="form-control" id="remittancePurpose"
                                                    name="remittancePurpose" rows="3" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="paymentInstruction"><?php echo _lang['payment_instruction']; ?> :</label>
                                                <textarea class="form-control" id="paymentInstruction"
                                                    name="paymentInstruction" rows="3"></textarea>
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