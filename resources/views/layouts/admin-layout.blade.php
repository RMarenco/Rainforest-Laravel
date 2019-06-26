<<<<<<< HEAD
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8" />
	<title>Rainforest</title>
	<link rel="icon" type="text/css" href="../Gallery/RF3.ico">		
	<link href="../../bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="../../css/Products.css">
	<link rel="stylesheet" type="text/css" href="../../css/MultiLevelMenu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Fonts.css">	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="../../js/modernizr.custom.js"></script>
	<script src="../../bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>  	 
  	<script type="text/javascript" src="../../js/java.js"></script>	 
</head>
<body>
	
	<div class="container" style="margin-top:15%">
        @yield('content')    	
	</div>
	@yield('script')
	<script src="../js/classie.js"></script>
	<script src="../js/dummydata.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/menu.js"></script>
</body>
=======
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8" />
	<title>Rainforest</title>
	<link rel="icon" type="text/css" href="../Gallery/RF3.ico">		
	<link href="../../bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="../../css/Products.css">
	<link rel="stylesheet" type="text/css" href="../../css/MultiLevelMenu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Fonts.css">	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="../../js/modernizr.custom.js"></script>
	<script src="../../bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>  	 
  	<script type="text/javascript" src="../../js/java.js"></script>	 
</head>
<body>
	
	<div class="container" style="margin-top:15%">
        @yield('content')    	
	</div>
	@yield('script')
	<script src="../js/classie.js"></script>
	<script src="../js/dummydata.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/menu.js"></script>
</body>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
</html>