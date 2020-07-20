<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tempatin Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<!-- <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" /> -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
			<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!--[if lte IE 8]>
		<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
		<script src="{{ asset('assets/js/respond.min.js') }}"></script>
		<![endif]-->
	</head>

	<body class="skin-1">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<img src="{{asset('assets/images/gallery/1.png')}}" style="height:25px;" alt="">
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" />
								<span class="user-info">
									<small>Welcome,</small>
									{{Auth::user()->nama_user}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								@if(Auth::user()->role_id==1)
								<li>
									<a href="{{url('merchant/edit')}}">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li class="divider"></li>
								@endif

								<li>
									<a href="{{url('logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				@if (Auth::check()&&Auth::user()->role_id==0)
				<ul class="nav nav-list">
					<li class="{{ Request::is('master/dashboard') ? 'active open' : ''}}">
						<a href="{{url('master/dashboard')}}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="{{ Request::is('master/room/category')||Request::is('master/building/type')||Request::is('master/package')||Request::is('master/facility/category')||Request::is('master/room/setup')||Request::is('master/form') ? 'active open' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Atribut Ruangan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="{{ Request::is('master/room/category') ? 'active open' : ''}}">
								<a href="{{url('master/room/category')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Ruangan
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/facility/category') ? 'active open' : ''}}">
								<a href="{{url('master/facility/category')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Fasilitas
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/package') ? 'active open' : ''}}">
								<a href="{{url('master/package')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Durasi
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/building/type') ? 'active open' : ''}}">
								<a href="{{url('master/building/type')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Bangunan
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/room/setup') ? 'active open' : ''}}">
								<a href="{{url('master/room/setup')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Setup Ruangan
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/form') ? 'active open' : ''}}">
								<a href="{{url('master/form')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Merchant
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="{{ Request::is('master/data/user')||Request::is('master/data/promo')||Request::is('master/data/room')||Request::is('master/data/orders')||Request::is('master/data/ruangan')||Request::is('master/data/order') ? 'active open' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Database </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="{{ Request::is('master/data/user') ? 'active open' : ''}}">
								<a href="{{ url('master/data/user')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('master/data/room') ? 'active open' : ''}}">
								<a href="{{ url('master/data/room')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Ruangan
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{{ Request::is('master/data/promo') ? 'active open' : ''}}">
								<a href="{{url('master/data/promo')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Promo
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{{ Request::is('master/data/orders') ? 'active open' : ''}}">
								<a href="{{url('master/data/orders')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Order
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				</ul><!-- /.nav-list -->
				@endif

				@if (Auth::check()&&Auth::user()->role_id==1)
				<ul class="nav nav-list">
					<li class="{{ Request::is('merchant/dashboard') ? 'active open' : ''}}">
						<a href="{{url('merchant/dashboard')}}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="{{ Request::is('merchant/edit') ? 'active open' : ''}}">
						<a href="{{url('merchant/edit')}}">
							<i class="menu-icon fa fa-user-o"></i>
							<span class="menu-text"> Profile </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="{{ Request::is('merchant/room')||Request::is('merchant/promo')||Request::is('merchant/orders')||Request::is('merchant/building')||Request::is('merchant/facility/category')||Request::is('merchant/room/setup')||Request::is('merchant/form') ? 'active open' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Kelola Tempat </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="{{ Request::is('merchant/building') ? 'active open' : ''}}">
								<a href="{{url('merchant/building')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Kelola Bangunan
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{{ Request::is('merchant/room') ? 'active open' : ''}}">
								<a href="{{url('merchant/room')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Kelola Ruangan
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{{ Request::is('merchant/promo') ? 'active open' : ''}}">
								<a href="{{url('merchant/promo')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Kelola Promo
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{{ Request::is('merchant/orders') ? 'active open' : ''}}">
								<a href="{{url('merchant/orders')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Kelola Order
								</a>

								<b class="arrow"></b>
							</li>

							<!-- <li class="{{ Request::is('merchant/room/setup') ? 'active open' : ''}}">
								<a href="{{url('merchant/room/setup')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Setup Ruangan
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('merchant/facility/category') ? 'active open' : ''}}">
								<a href="{{url('merchant/facility/category')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Jenis Fasilitas
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('merchant/form') ? 'active open' : ''}}">
								<a href="{{url('merchant/form')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Merchant
								</a>

								<b class="arrow"></b>
							</li> -->
						</ul>
					</li>

					<!-- <li class="{{ Request::is('merchant/data/user')||Request::is('merchant/data/ruangan')||Request::is('merchant/data/order') ? 'active open' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Database </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="{{ Request::is('merchant/data/user') ? 'active open' : ''}}">
								<a href="{{ url('merchant/data/user')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="{{ Request::is('merchant/data/room') ? 'active open' : ''}}">
								<a href="{{ url('merchant/data/room')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Ruangan
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li> -->

					<li class="{{ Request::is('merchant/schedule') ? 'active open' : ''}}">
						<a href="{{url('merchant/schedule')}}">
							<i class="menu-icon fa fa-calendar-o"></i>
							<span class="menu-text"> Booking </span>
						</a>

						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->
				@endif

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
                                    @yield('content')
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->



		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>
