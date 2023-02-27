<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>BTO</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.png') }}">
    {{-- <link href="/toastr/build/toastr.min.css" rel="stylesheet"> --}}
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-datetimepicker.min.css') }}">

	<!-- FullCalendar CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/fullcalendar.min.css') }}">

	<link rel="stylesheet" href="{{asset('fontawesome-free/css/all.css')}}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

	<!-- Chart JS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/plugins/morris/morris.css') }}">

	<!-- Summernote CSS -->
	<link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}">

	<link rel="stylesheet" href="{{ asset('css/miEstilo.css') }}">

    @yield('css')
    <script>
        window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
]) !!};

    </script>

<body>
    @php
        $nombre_usuario = Auth::user()->email;
        if (Auth::user()->datosUsuario) {
            $nombre_usuario = Auth::user()->datosUsuario->nombre.' '.Auth::user()->datosUsuario->paterno.' '.Auth::user()->datosUsuario->materno;
        }elseif(Auth::user()->empleado){
            $nombre_usuario = Auth::user()->empleado->nombre.' '.Auth::user()->empleado->paterno.' '.Auth::user()->empleado->materno;
		}
    @endphp

    </head>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Loader -->
        <div id="loader-wrapper">
            <div id="loader">
                <div class="loader-ellips">
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                </div>
            </div>
        </div>
        <!-- /Loader -->

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{route('inicio')}}" class="logo">
                    <img src="{{ asset('assets/admin/img/logo.png') }}" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <div class="page-title-box">
                <h3>BOLIVIAN TECHNOLOGY OUTSOURCING</h3>
            </div>
            <!-- /Header Title -->

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Flag -->
                <!-- /Flag -->

                <!-- Notifications -->
                {{-- <li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/admin/img/profiles/avatar-02.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/admin/img/profiles/avatar-03.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/admin/img/profiles/avatar-06.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
													<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/admin/img/profiles/avatar-17.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/admin/img/profiles/avatar-13.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
													<p class="noti-time"><span class="notification-time">2 days ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li> --}}
                <!-- /Notifications -->

                <!-- Message Notifications -->
                {{-- <li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Messages</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
                            <img alt="" src="{{asset('assets/admin/img/profiles/avatar-09.jpg')}}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">Richard Miles </span>
													<span class="message-time">12:28 AM</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{asset('assets/admin/img/profiles/avatar-02.jpg')}}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">John Doe</span>
													<span class="message-time">6 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{asset('assets/admin/img/profiles/avatar-03.jpg')}}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Tarah Shropshire </span>
													<span class="message-time">5 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{asset('assets/admin/img/profiles/avatar-05.jpg')}}">
												</div>
                      </span>
												<div class="list-body">
													<span class="message-author">Mike Litorus</span>
													<span class="message-time">3 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="{{asset('assets/admin/img/profiles/avatar-08.jpg')}}">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Catherine Manseau </span>
													<span class="message-time">27 Feb</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="chat.html">View all Messages</a>
							</div>
						</div>
					</li> --}}
                <!-- /Message Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset('imgs/users/' . Auth::user()->foto) }}"
                                alt="Foto"><span class="status online"></span></span>
                        <span>{{ $nombre_usuario }}</span>
                    </a>
                    <div class="dropdown-menu" align="right">
                        <a class="dropdown-item" href="{{route('users.config',Auth::user()->id)}}">Mi Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('users.config',Auth::user()->id)}}">Mi Perfil</a>
                    <a class="dropdown-item" href="login.html">Cerrar sesión</a>
                </div>
            </div>
            <!-- /Mobile Menu -->

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span>Inicio</span></a>
                        </li>
                        @if (Auth::user()->tipo == 'ADMINISTRADOR')
                            @include('includes.menu.menu_admin')
                        @endif
						@if (Auth::user()->tipo == 'AUXILIAR')
                            @include('includes.menu.menu_auxiliar')
                        @endif
						@if (Auth::user()->tipo == 'EMPLEADO')
                            @include('includes.menu.menu_empleado')
                        @endif
						<li class="{{ request()->is('user/configurar/cuenta*') ? 'active' : '' }}">
							<a href="{{route('users.config',Auth::user()->id)}}"><i class="la la-cog"></i> <span>Configuración</span></a>
						</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
        <!-- /Page Wrapper -->

		<input type="hidden" id="token" value="{{csrf_token()}}">

        <!-- /Main Wrapper -->
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" data-reff=""></div>
        <!-- jQuery -->
        {{-- <script type="text/javascript" src="/toastr/toastr.js"></script> --}}

        <script>
            lenguaje = {
                "decimal": "",
                "emptyTable": "No se encontraron registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                "infoFiltered": "(Filtrado de _MAX_ total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": '<i class="fa fa-fast-backward"></i>',
                    "last": '<i class="fa fa-fast-forward"></i>',
                    "next": '<i class="fa fa-step-forward"></i>',
                    "previous": '<i class="fa fa-step-backward"></i>'
                }
            };

        </script>

		<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
		<!-- Slimscroll JS -->
		<script src="{{ asset('assets/admin/js/jquery.slimscroll.min.js') }}"></script>
		<!-- Select2 JS -->
		<script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
		<!-- Datetimepicker JS -->
		<script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
		<!-- Datatable JS -->
		<script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/dataTables.bootstrap4.min.js') }}"></script>

		<!-- FullCalendar JS -->
		<script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/fullcalendar.js') }}"></script>
		<script src="{{ asset('assets/admin/js/locale/es.js') }}"></script>

        <!-- Summernote JS -->
		<script src="{{asset('summernote/summernote.min.js')}}"></script>

		<!-- Chart JS -->
		<script src="{{ asset('assets/admin/plugins/morris/morris.js') }}"></script>
		<script src="{{ asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{ asset('assets/admin/js/app.js') }}"></script>

        @yield('js')
</body>

</html>
