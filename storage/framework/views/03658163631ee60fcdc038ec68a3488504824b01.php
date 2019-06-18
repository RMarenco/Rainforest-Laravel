<?php
session_start();  
include 'configs/funciones.php';
include 'configs/config.php';
require_once('database.php');     
$Db=Database::connect();

  /*if(!isset($_SESSION['activity'])){    
    echo '<script>setTimeout(function(){window.location.href="/login"}, 0);</script>';    
  }*/
  

  if(isset($add) && isset($quan)){
    $idp = clear($add);
    $quan = clear($quan);
    if(!isset($_SESSION['Id'])){
      echo "<script>window.location.href='/login'</script>";
    }
    else{
      $id_client = clear($_SESSION["Id"]);
      $idSeller = $Db->query("SELECT idUser FROM products WHERE idProduct = '$idp'")->fetchColumn();

      $pq = $Db->query("SELECT quantity FROM products WHERE idProduct = '$idp'")->fetchColumn();
      $v = $Db->query("SELECT count(*) FROM cart WHERE idClient = '$id_client' AND idProduct = '$idp'")->fetchColumn();

      if($v>0){
        $f = $Db->query("UPDATE products SET quantity = quantity - $quan WHERE idProduct = '$idp' AND quantity >= '$quan'");
        if($pq >= $quan){
          $q = $Db->query("UPDATE cart SET quantity = quantity + $quan WHERE idClient = '$id_client' AND idProduct = '$idp'");
          alert("it has been added to the shopping cart");
          redir("?=products");
        }       


      }else{      
        $f = $Db->query("UPDATE products SET quantity = quantity - $quan WHERE idProduct = '$idp' AND quantity >= '$quan'");  
        if($pq >= $quan){
          $q = $Db->query("INSERT INTO cart (idClient, idProduct, quantity, idSeller) VALUES ('$id_client', '$idp', '$quan', '$idSeller')");
          alert("it has been added to the shopping cart");
          redir("?=products");
        }          
      }
    }
  }

  if(isset($user->email)){
    echo "<script>window.location.href='/'</script>";
  }else{

  }
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Rainforest - Index</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/botones.css" rel="stylesheet">
    <link href="css/Products.css" rel="stylesheet">
    <script src="js/modernizr.custom.js"></script>
  </head>
  <body id="page-top">   
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
          <img src="Gallery/RF1.png" style="max-width:6em;padding-left:15px;padding-right:-10px;">
          <div class="sidebar-brand-text mx-3" style="font-family: 'Abel', sans-serif;font-size:20px;">RAINFOREST</div>
        </div>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          BUYER
        </div>
        <li class="nav-item">
          <a class="nav-link" href="/index">
            <i class="fas fa-dollar-sign"></i>
            <span>Buy</span></a>
          </li>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            CART
          </div>
          <li class="nav-item">
            <a class="nav-link" href="/cart">
              <i class="fas fa-shopping-cart"></i>
              <span>Cart</span></a>
            </li>                      
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
          </ul>
          <!-- End of Sidebar -->
          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
              <!-- Topbar -->
              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" style="color:#224abe!important;"class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                  <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                      <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button style="color:#fff!important;" class=" btn btn-primary" type="button"><i style="color:#fff!important;" class="fas fa-search fa-sm"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </li>
                  <li class="nav-item dropdown no-arrow mx-1"><a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-bag fa-fw"></i><!-- Counter - Alerts --><span class="badge badge-danger badge-counter"></span></a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" style="cursor: pointer;" aria-labelledby="alertsDropdown">
                      <h6 class="dropdown-header">Categories</h6>
                      <a class="dropdown-item d-flex align-items-center" onclick="cat('0');">
                        <div class="mr-3">
                          <div class="icon-circle  bg-success" style="color:#fff;"><i class="fas fa-times text-white"></i></div>
                        </div>
                        <div>All Products</div>
                      </a>
                      <?php
                      require_once('database.php');
                      $Db = Database::connect();
                      $catsql = $Db->query('SELECT * FROM categories');
                      $CatFor = $catsql->fetchAll();
                      foreach($CatFor as $CatEach){                        
                        ?>
                        <a class="dropdown-item d-flex align-items-center" onclick="cat('<?=$CatEach['idCategory']?>');">
                          <div class="mr-3">
                            <div class="icon-circle bg-success" style="color:#fff;"><?=$CatEach['Icon']?>
                          </div>
                        </div>
                        <div><?=$CatEach['category']?></div>
                      </a>
                      <?php
                    }
                    ?>
                  </div>
                </li>              
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">NOT LOGGED IN</span>
                    <img class="img-profile rounded-circle" src="uploads/avatars/avatar.png">
                  </a>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
                </li>
              </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->

            <div class="container-fluid">
              <div class="compare-basket">
                <button style="color:#fff!important;font-family:'Abel',sans-serif;" class="action action--button action--compare btn btn-5 btn-5a icon-tab button"><span class="action__text">Compare</span></button>
              </div>
              <div class="view">
                <div class="grid"> <!-- GRID PRODUCT -->
                  <div class="row"> <!-- PRODUCTOS -->
                    <?php
                    require_once('database.php');
                    $Db = Database::connect();
                    if(isset($cat) && $cat > 0){
                      $idc=clear($cat);
                      $Statement2 = $Db->query('SELECT * FROM products WHERE status = "On" AND quantity > 0 AND idCategory = '.$idc.'');
                    }else if(isset($cat) && $cat == 0 || !isset($cat)){
                      $Statement2 = $Db->query('SELECT * FROM products WHERE status = "On" AND quantity > 0');  
                    }                      

                    $Productos = $Statement2->fetchAll();
                    foreach($Productos as $Producto)
                    {
                      ?>

                      <div class="col-xl-3 col-md-6 mb-4">
                        <div class="product card border-blue shadow h-100 py-2" style="border-radius: 25px 25px 25px 25px;margin-right:2%;margin-bottom:4%;"> 
                          <div class="product__info card-body">
                            <div class="row no-gutters align-items-center ">
                              <div class="col mr-2" style="font-family:'Abel',sans-serif;text-align:center;"><br>
                                <h3 class="product__title text-s font-weight-bold text-primary text-uppercase mb-2"><?=$Producto['product']?></h3>                                  
                                <?php
                                if($Producto['discount']>0){
                                  echo '<span class="product__price highlight h5 mb-0 font-weight-bold" style="color:red"><strike>$'.number_format($Producto['price'], 2, '.', '').'</strike></span><br/>';
                                  echo '<span class="product__price highlight h5 mb-0 font-weight-bold" style="color:green">$'.number_format(($Producto['price']-($Producto['price']*($Producto['discount']/100))), 2, '.', '').'</span>';
                                }else{
                                  echo "<br/>";
                                  echo '<p><span class="product__price highlight h5 mb-0 font-weight-bold text-gray-800">$'.number_format($Producto['price'], 2, '.', '').'</span>';
                                }
                                ?>
                                <span class="product__year extra highlight"></span>
                                <span class="product__region extra highlight"></span>
                                <span class="product__varietal extra highlight"><?=$Producto['description']?></span>
                                <br>
                                <span class="product__price highlight h5 mb-0 font-weight-bold text-gray-800"><?=$Producto['quantity']?></span>

                                <img class="product__image" src="products/<?=$Producto['image']?>" alt="Product_Image" />
                                <button style="margin-top:1em;color:#fff!important;font-family:'Abel',sans-serif;" onclick="add<?=$Producto['idProduct']?>('<?=$Producto['idProduct']?>');" class="action action--button action--buy btn btn-5 btn-5a icon-cart button"><span class="action__text">Add to cart</span></button>
                                <label style="margin-top:-10%;margin-right:-22px;"class="action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-2x fa-plus"></i><i class="fa fa-2x fa-check"></i><span class="action__text action__text--invisible">Add to compare</span></label>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div id="modal_<?=$Producto['idProduct']?>" class="modale">
                        <!-- Modal content -->
                        <div class="modale-content" id="ctn_<?=$Producto['idProduct']?>">

                          <div class="modale-header">
                            <span class="close" onclick='close_<?=$Producto['idProduct']?>("<?=$Producto['idProduct']?>")'>&times;</span>
                            <h5 style="float: left!important;">Add this product to cart?</h5>
                          </div>
                          <div class="modal-body">
                            
                            <img style="height: 160px; width: 160px" src="products/<?=$Producto['image']?>">
                            <input style="float: right; width: 50%; top: 40%; position: relative;" type="number" min="1" max="<?=$Producto['quantity']?>" class="form-control form-control-user" placeholder="Quantity" required id="idq_<?=$Producto['idProduct']?>">
                          </div>
                          <div class="modale-footer">
                            <h5 style="float: right; position: relative; top: 25%;"><?=$Producto['product']?></h5>
                            <button class="action action--button action--buy btn btn-5 btn-5a icon-cart button" style="background: #dcdcdc; color: #000; width: 150px; height: 40px; font-size: 14px; margin:0" onclick='quantity<?=$Producto['idProduct']?>("<?=$Producto['idProduct']?>");'><span class="action__text">Add to cart</span></button>
                          </div>

                        </div>    
                      </div>
                      <script>
                        // Get the modal
                        var modal<?=$Producto['idProduct']?> = document.getElementById('modal_<?=$Producto['idProduct']?>');
                        var modal_content<?=$Producto['idProduct']?> = document.getElementById('ctn_<?=$Producto['idProduct']?>');                        

                        // When the user clicks on the button, open the modal
                        function add<?=$Producto['idProduct']?>(idpa) {
                          modal<?=$Producto['idProduct']?>.classList.add('show');
                          modal<?=$Producto['idProduct']?>.style.opacity = "1";
                          modal_content<?=$Producto['idProduct']?>.classList.add('show');
                          
                        }
                        function quantity<?=$Producto['idProduct']?>(idp){
                          var q = document.getElementById('idq_<?=$Producto['idProduct']?>').value;
                          if(q>0){
                            window.location="?p=products&add="+idp+"&quan="+q;
                          }
                        }     
                        // When the user clicks on <span> (x), close the modal
                        function close_<?=$Producto['idProduct']?>(e) {
                          modal<?=$Producto['idProduct']?>.style.opacity = "0";
                          setTimeout(function(){modal<?=$Producto['idProduct']?>.classList.remove('show');}, 500);
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.addEventListener("click", function(event) {
                          if (event.target == modal<?=$Producto['idProduct']?>) {
                            modal<?=$Producto['idProduct']?>.style.opacity = "0";
                            setTimeout(function(){modal<?=$Producto['idProduct']?>.classList.remove('show');}, 400);
                            
                          }
                        });
                      </script>
                      <?php
                    }
                    ?>                      
                  </div>
                </div>
              </div>
              
              <section class="compare">
                <button  class="action action--close"><i style="top:25px;" class="fa fa-times fa-2x"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
              </section>
            </div>
            
          </div>
          <footer class="sticky-footer bg-white"><div class="container my-auto"><div class="copyright text-center my-auto"><span>Copyright &copy; Rainforest 2019</span></div></div></footer>
        </div>
        <!--End Page Content-->
      </div>
      
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>  
  
  
  <script type="text/javascript">
    function cat(idc){
      window.location="?p=products&cat="+idc;      
    }
  </script>
  <script type="text/javascript">
    function cart(idp){
      var quan = prompt("how much do you want to add?", 1);

      if(quan.length>0){
        window.location="?p=products&add="+idp+"&quan="+quan;
      }
    }
  </script>
  <script src="js/CompareBasket.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
</body>
</html><?php /**PATH D:\rainforest\resources\views/UAindex.blade.php ENDPATH**/ ?>