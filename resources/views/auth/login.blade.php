<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Acceso al Sistema</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/img/favicon.png')}}">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href={{ asset('assets/admin/css/bootstrap.min.css')}}>
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href={{asset('assets/admin/css/font-awesome.min.css')}}>
		<!-- Main CSS -->
        <link rel="stylesheet" href={{asset('assets/admin/css/style.css')}}>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
		@php
			$razon_social = App\RazonSocial::first();
		@endphp
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				{{-- <a href="{{ route('job.list') }}" class="btn btn-primary apply-btn">Apply Job</a>  --}}
				<div class="container">
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="{{route('inicio')}}"><img src="{{asset('imgs/'.$razon_social->logo)}}" alt="Dreamguy's Technologies"></a>
					</div>
          					<!-- /Account Logo -->
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">{{$razon_social->nombre}}</h3>
							<p class="account-subtitle">Acceso al Sistema</p>

							<!-- Account Form -->
								<form method="post" action="{{ route('login') }}">
								{{ csrf_field() }}

								<div class="form-group" {{ $errors->has('email') ? 'has-error' : ''}}>
									<label>Correo</label>
									<input type="email" name = "email" value="{{old('email')}}" class="form-control" required autofocus>
									{!! $errors->first('email','<span class="help-block text-danger">:message</span') !!}
								</div>


								<div class="form-group" {{ $errors->has('password') ? 'has-error' : ''}}>
									<div class="row">
										<div class="col">
											<label>Contraseña</label>
										</div>
										{{-- <div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Olvidaste tu contraseña?
											</a>
										</div> --}}
									</div>
									<input class="form-control" type="password" name="password" required>
									{!! $errors->first('password','<span class="help-block">:message</span') !!}
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Ingresar</button>
								</div>
							
							</form>
							<!-- /Account Form -->

						</div>
					</div>   
					 {{-- @include('..applicant.create') --}}
				</div>

			</div>

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
    <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
		<!-- Bootstrap Core JS -->
    <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
    <script src={{asset('"assets/admin/js/bootstrap.min.js"')}}></script>
		<!-- Custom JS -->
		<script src={{asset('"assets/admin/js/app.js"')}}></script>


    </body>
</html>
