<?php
///template/user/login.php
?>
<!DOCTYPE html>
<html lang="<?php echo ($userLanguage); ?>" data-layout="topnav">

<head>
	<meta charset="utf-8" />
	<title>
		<?php echo (_lang['login_user']); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="57x57" href="./itheme/panel/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="./itheme/panel/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="./itheme/panel/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="./itheme/panel/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="./itheme/panel/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="./itheme/panel/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="./itheme/panel/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="./itheme/panel/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="./itheme/panel/icon/apple-icon-180x180.png">
	<link rel="icon" type="images/png" sizes="192x192" href="./itheme/panel/icon/android-icon-192x192.png">
	<link rel="icon" type="images/png" sizes="32x32" href="./itheme/panel/icon/favicon-32x32.png">
	<link rel="icon" type="images/png" sizes="96x96" href="./itheme/panel/icon/favicon-96x96.png">
	<link rel="icon" type="images/png" sizes="16x16" href="./itheme/panel/icon/favicon-16x16.png">
	<link rel="manifest" href="./itheme/panel/icon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="./itheme/panel/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="author" content="Mehdi Imeni: Imeni1982@gmail.com" />

	<!-- Theme Config Js -->
	<script src="itheme/panel/js/hyper-config.js"></script>

	<!-- App css -->
	<link href="itheme/panel/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-style" />

	<!-- Icons css -->
	<link href="itheme/panel/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative" dir="<?php echo ($userLanguageDir); ?>">
	<div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
		<svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
			<g fill-opacity='0.22'>
				<circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
				<circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
				<circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
				<circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
				<circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
			</g>
		</svg>
	</div>
	<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xxl-4 col-lg-5">
					<div class="card">

						<!-- Logo -->
						<div class="card-header py-4 text-center bg-primary">
							<a href="#">
								<span><img src="./itheme/panel/images/safe-group.png" alt="logo"></span>
							</a>
						</div>

						<div class="card-body p-4">

							<div class="text-center w-75 m-auto">
								<h4 class="text-dark-50 text-center pb-0 fw-bold">
									<?php echo (_lang['login_user']); ?>
								</h4>
								<!--<p class="text-muted mb-4">Enter your email address and password to access admin panel.
								</p>-->
							</div>
							<?php if (!empty($loginMessage) && $loginMessage != '') { ?>
								<div id="login-alert" class="alert alert-danger col-sm-12">
									<?php echo $loginMessage; ?>
								</div>
							<?php } ?>


							<div class="mb-3">

								<select class="form-control" id="language" name="language">
									<option value="">
										<?php echo (_lang['language_selection']); ?>
									</option>
									<?php foreach ($allLanguages as $key=>$value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php } ?>
								</select>

							</div>



							<form role="form" method="POST" action="">

								<div class="mb-3">
									<label for="emailaddress" class="form-label">
										<?php echo (_lang['email']); ?>
									</label>
									<input class="form-control" type="email" name="email" id="emailaddress" required=""
										placeholder="<?php echo (_lang['email']); ?>">
								</div>

								<div class="mb-3">

									<label for="password" class="form-label">
										<?php echo (_lang['password']); ?>
									</label>
									<div class="input-group input-group-merge">
										<input type="password" id="password" name="password" class="form-control"
											placeholder="<?php echo (_lang['password']); ?>">
										<div class="input-group-text" data-password="false">
											<span class="password-eye"></span>
										</div>
									</div>
								</div>


								<div class="mb-3 mb-0 text-center">
									<button class="btn btn-primary" type="submit" name="login"
										value="<?php echo (_lang['login']); ?>">
										<?php echo (_lang['login']); ?>
									</button>
								</div>

							</form>
						</div> <!-- end card-body -->
					</div>
					<!-- end card -->


					<!-- end row -->

				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->

	<footer class="footer footer-alt">

		<script>document.write(new Date().getFullYear())</script> © CRMSF
	</footer>
	<!-- Vendor js -->
	<script src="itheme/panel/js/vendor.min.js"></script>

	<!-- App js -->
	<script src="itheme/panel/js/app.min.js"></script>

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


</body>

</html>