<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

	<title>Sign In</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<nav class="navbar container-fluid">
		<div class="row text-muted">
			<p class="mb-0">
				<a class="text-muted" href="{{ route('admin.change-lang', Lang::locale() == 'ar' ? 'en' : 'ar') }}">
					<strong>{{ Lang::locale() == 'ar' ? 'en' : 'ar' }}</strong>
				</a >
			</p>
		</div>
	</nav>

	@yield('content')

	<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>