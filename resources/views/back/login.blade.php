<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
		<title>Tes Kaspin</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			@if(session('status'))
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Alert!</h4>
					{{ session('status') }}
				</div>
			@endif

			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/unitedpalms-1/14.png">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<a href="../../demo13/dist/index.html" class="mb-12">
						<img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-40px" />
					</a>
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<form action="{{ url('login-user') }}" method="post" enctype="multipart/form-data" id="loginform" class="form-vertical">
                            {{ csrf_field() }}
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">SELAMAT DATANG DI KASPIN</h1>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fs-6 fw-bolder text-dark">Username</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
							</div>
							<div class="fv-row mb-10">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
								</div>
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
							</div>
                            <div class="text-center">
								<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Masuk</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
						</form>
						<center>atau</center><br>
						<a href="{{ url('barang-tamu') }}" class="btn btn-success btn-block w-100 mb-5">Tamu</a>
						<a href="{{ url('cv-afis') }}" class="btn btn-success btn-block w-100 mb-5">LIHAT CV SAYA</a>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
	</body>
</html>