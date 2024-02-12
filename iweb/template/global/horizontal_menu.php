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
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-briefcase"></i>
                            <?php echo (_lang['dashboard']); ?>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <?php if (!$user->card_register()) { ?>
                                <a href="./card_register" class="dropdown-item">
                                    <?php echo _lang['card_register']; ?>
                                </a>
                            <?php } else { ?>
                                <a href="./user_panel" class="dropdown-item">
                                    <?php echo _lang['user_panel']; ?>
                                </a>
                                <a href="./remittance" class="dropdown-item">
                                    <?php echo _lang['documents']; ?>
                                </a>
                                


                            <?php } ?>


                        </div>
                    </li>
                    <?php if ($user->card_register()) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil-dribbble"></i> <?php echo _lang['professional_profiles']; ?><div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-apps">

                                <a href="./user_position" class="dropdown-item"><?php echo _lang['position']; ?></a>
                                <a href="./user_achievements" class="dropdown-item"><?php echo _lang['achievements']; ?></a>


                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($user->card_register()) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil-money-withdrawal"></i> <?php echo _lang['financial_affairs']; ?><div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-apps">

                                <a href="./recharge" class="dropdown-item"><?php echo _lang['recharge']; ?></a>
                                <a href="./account" class="dropdown-item"><?php echo _lang['account']; ?></a>


                            </div>
                        </li>
                    <?php } ?>


                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ========== Horizontal Menu End ========== -->
<div class="content-page">