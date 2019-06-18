<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Rainforest</title>
	<link rel="icon" type="text/css" href="../Gallery/RF3.ico">		
	<link href="../bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="../css/Products.css">
	<link rel="stylesheet" type="text/css" href="../css/MultiLevelMenu.css">
	<link rel="stylesheet" type="text/css" href="../css/Menu.css">
	<link rel="stylesheet" type="text/css" href="../css/Fonts.css">	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="../js/modernizr.custom.js"></script>
	<script src="../bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>  	 
  	<script type="../text/javascript" src="js/java.js"></script>	 
</head>
<body>
	<!--<h1>Rainforest</h1><br>-->
	<header class="bp-header cf" style="padding: 0">
		<div class="dummy-logo">
			<div class="dummy-icon foodicon">
				<img src="../Gallery/RF3.png" style="max-width:4.5em;margin-top:5%;">
			</div>
		</div>
	</header>
	<!--<button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>-->
	<nav id="ml-menu" class="menu">
		<button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
		<div class="menu__wrap">
			<ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="User">
				<li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-1" aria-owns="submenu-1" href="#">View categories</a></li>
				<li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-2" aria-owns="submenu-2" href="#">View Users</a></li>
				<li class="menu__item" role="menuitem"><a class="menu__link" data-submenu="submenu-3" aria-owns="submenu-3" href="#">My account</a></li>
			</ul>
			<!-- Submenu 1 -->
			<ul data-menu="submenu-1" id="submenu-1" class="menu__level" tabindex="-1" aria-label="Buy">
				<li class="menu__item" role="menuitem"><a class="menu__link" href="/admin/categories">View categories</a></li>
				<li class="menu__item" role="menuitem"><a class="menu__link" href="/admin/categories/add-categories">Add categories</a></li>
			</ul>
			<!-- Submenu 2 -->
			<ul data-menu="submenu-2" id="submenu-2" class="menu__level" tabindex="-1" aria-label="Buy">
				<li class="menu__item" role="menuitem"><a class="menu__link menu__link" href="/admin/users">View Users</a></li>
			</ul>
			<!-- Submenu 3 -->
			<ul data-menu="submenu-3" id="submenu-3" class="menu__level" tabindex="-1" role="menu" aria-label="Vender">
				<li class="menu__item" role="menuitem"><a class="menu__link  menu__link--current" href="/admin/index">Settings</a></li>
				<li class="menu__item" role="menuitem"><a class="menu__link" href="/admin/logout">Log out</a></li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top:3%; margin-left:33%">
        @yield('content')    	
	</div>
	@yield('script')
	<script src="../js/classie.js"></script>
	<script src="../js/dummydata.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/menu.js"></script>
</body>
</html>