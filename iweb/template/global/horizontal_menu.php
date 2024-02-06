<?php
///template/global/horizontal_menu.php
?>

        <!-- ========== Horizontal Menu Start ========== -->
        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-briefcase"></i><?php echo (_lang['my_briefcase']); ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-apps">
                                        
                                                <a href="./remittance" class="dropdown-item"> <?php echo _lang['documents']; ?></a>
                                                <a href="./remittance_form1" class="dropdown-item"> <?php echo _lang['transfer']; ?></a>
                                                <a href="./remittance_form2" class="dropdown-item"> <?php echo _lang['cheque']; ?></a>
                                                <a href="./remittance_form3" class="dropdown-item"> <?php echo _lang['cash']; ?></a>
                                                <a href="./remittance_form4" class="dropdown-item"> <?php echo _lang['agent']; ?></a>

                                        
                                    </div>
                                </li>
                            

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ========== Horizontal Menu End ========== -->
        <div class="content-page">