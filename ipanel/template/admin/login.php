<?php
///template/admin/login.php
?>
<!DOCTYPE html>
<html lang="<?php echo ($adminLanguage); ?>" data-layout="topnav" >

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo (_lang['login_admin']); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="../itheme/panel/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../itheme/panel/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../itheme/panel/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../itheme/panel/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../itheme/panel/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../itheme/panel/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../itheme/panel/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../itheme/panel/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../itheme/panel/icon/apple-icon-180x180.png">
    <link rel="icon" type="images/png" sizes="192x192" href="../itheme/panel/icon/android-icon-192x192.png">
    <link rel="icon" type="images/png" sizes="32x32" href="../itheme/panel/icon/favicon-32x32.png">
    <link rel="icon" type="images/png" sizes="96x96" href="../itheme/panel/icon/favicon-96x96.png">
    <link rel="icon" type="images/png" sizes="16x16" href="../itheme/panel/icon/favicon-16x16.png">
    <link rel="manifest" href="../itheme/panel/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../itheme/panel/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="author" content="Mehdi Imeni: Imeni1982@gmail.com" />


    <!-- Theme Config Js -->
    <script src="../itheme/panel/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="../itheme/panel/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="../itheme/panel/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg pb-0" dir="<?php echo ($_COOKIE['adminLanguageDir']); ?>">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="#" class="logo-dark">
                        <span><img src="../itheme/panel/images/logo.png" alt="dark logo" height="200"></span>
                    </a>
                    <a href="#" class="logo-light">
                        <span><img src="../itheme/panel/images/logo.png" alt="logo" height="200"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">
                        <?php echo (_lang['login']); ?>
                    </h4>
                    <p class="text-muted mb-4">
                        <?php echo (_lang['login_tip1']); ?>
                    </p>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">
                            <?php echo (_lang['language_selection']); ?>
                        </label>
                        <fieldset>
                            <div class="form-group">

                                <select class="form-control" id="language" name="language">
                                    <option value="">
                                        <?php echo (_lang['language_selection']); ?>
                                    </option>
                                    <?php foreach ($allLanguages as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
                                    
                                </select>

                            </div>
                        </fieldset>

                        

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
                    </div>


                    <!-- form -->
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">
                                <?php echo (_lang['email']); ?>
                            </label>
                            <input class="form-control" placeholder="<?php echo (_lang['email']); ?>" name="email"
                                type="email" id="emailaddress" required="">
                        </div>
                        <div class="mb-3">

                            <label for="password" class="form-label">
                                <?php echo (_lang['password']); ?>
                            </label>
                            <input class="form-control" required="" id="password"
                                placeholder="<?php echo (_lang['password']); ?>" name="password" type="password">
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit" name="login"
                                value="<?php echo (_lang['login']); ?>"><i class="mdi mdi-login"></i>
                                <?php echo (_lang['login']); ?>
                            </button>
                        </div>

                    </form>
                    <!-- end form-->
                </div>



            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">
                    <?php echo (_lang['login_adver1']); ?>
                </h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i>
                    <?php echo (_lang['login_adver2']); ?>
                    . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    <?php echo (_lang['company_owner']); ?>
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="../itheme/panel/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../itheme/panel/js/app.min.js"></script>

</body>

</html>