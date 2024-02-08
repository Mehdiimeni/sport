<?php
///template/global/page_top.php
?>



<body dir="<?php echo ($_COOKIE['adminLanguageDir']); ?>">
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="./" class="logo-light">
                            <span class="logo-lg">
                                <img src="../itheme/panel/images/logo.png" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="../itheme/panel/icon/apple-icon-57x57.png" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="./" class="logo-dark">
                            <span class="logo-lg">
                                <img src="../itheme/panel/images/logo.png" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="../itheme/panel/icon/apple-icon-57x57.png" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">


                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <span class="align-middle d-none d-lg-inline-block">
                                <?php echo (_lang['language_selection']); ?>
                            </span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                            <?php foreach ($allLanguages as $key => $value) { ?>
                                <a href="javascript:void(0);" data-lang="<?php echo $key; ?>"
                                    class="lang-set dropdown-item">
                                    <span class="align-middle">
                                        <?php echo $value; ?>
                                    </span>
                                </a>
                            <?php } ?>

                        </div>
                    </li>

                    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function changeLanguage() {
                var selectedLanguage = document.getElementById("language").value;

                document.cookie = 'admin_language=' + selectedLanguage + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';

                location.reload();
            }

            document.getElementById("language").addEventListener("change", changeLanguage);
        });
    </script>


                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>




                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="#" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="<?php echo ('.' . $_SESSION["profile_image_path"]); ?><?php echo ($_SESSION["profile_image_name"]); ?>"
                                    alt="user-image" width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">
                                    <?php echo ($_SESSION["name"]); ?>
                                </h5>
                                <h6 class="my-0 fw-normal">
                                    <?php echo ($_SESSION["mobile"]); ?>
                                </h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <a href="./myaccount" class="dropdown-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>
                                    <?php echo (_lang['my_account']); ?>
                                </span>
                            </a>
                            <!-- item-->
                            <a href="./logout" class="dropdown-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>
                                    <?php echo (_lang['logout']); ?>
                                </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->