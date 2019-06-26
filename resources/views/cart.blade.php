<<<<<<< HEAD
<?php
session_start();
if($_SESSION['activity']==0){
  header('location:login.php');
}
include 'configs/funciones.php';
include 'configs/config.php';
require_once('conn.php');     
require_once('database.php');     
$Db=Database::connect();
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($end)){        
  $amount = clear($total_amount);

  $id_client = clear($_SESSION['Id']);
  $qd = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");

  while ($rd = mysqli_fetch_array($qd)) {
    $q = $conn->query("INSERT INTO buyout (idClient, date, amount, status, idSeller) VALUES ('$id_client', NOW(), '$amount', 0, '".$rd['idSeller']."')");
  }




  $sc = $conn->query("SELECT * FROM buyout WHERE idClient = '$id_client' ORDER BY id DESC LIMIT 1");
  $rc= mysqli_fetch_array($sc);

  $last_purchase = $rc['id'];

  $q2 = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");
  while($r2 = mysqli_fetch_array($q2)){

    $sp = $conn->query("SELECT * FROM products WHERE idProduct = '".$r2['idProduct']."'");
    $rp = mysqli_fetch_array($sp);
    if($rp['discount']>0){
      $amount = $rp['price']-($rp['price']*($rp['discount']/100));
    }else{
      $amount = $rp['price'];
    }

    $conn->query("INSERT INTO products_purchase (idPurchase, idProduct, quantity, amount, idSeller) VALUES ('$last_purchase', '".$r2['idProduct']."','".$r2['quantity']."','$amount', '".$r2['idSeller']."')");
  }
  $conn->query("DELETE FROM cart WHERE idClient = '$id_client'");
  alert("The purchase has been completed");
  redir("./");
}
if(isset($delete)){
  $idp = clear($delete);
  $quan = $Db->query("SELECT quantity FROM cart WHERE idProduct = '$idp'")->fetchColumn();
  $conn->query("UPDATE products set quantity = quantity + '$quan' WHERE idProduct = '$idp'");
  $conn->query("DELETE FROM cart WHERE idProduct = '$idp'");
}
if(isset($add)){
  $iap = clear($add);  
  $quan = clear($quan);
  $conn->query("UPDATE products set quantity = quantity - '$quan' WHERE idProduct = '$iap'");
  $conn->query("UPDATE cart set quantity = quantity + '$quan' where idProduct = '$iap'");
  redir("./cart");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cart</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="css/botones.css" rel="stylesheet">
  <link href="css/Products.css" rel="stylesheet">

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
        @if (app()->getLocale() == 'en')
        {{ __('messages.buyer') }}
        @elseif (app()->getLocale() == 'es')
        {{ __('messages.buyer') }}
        @endif 
      </div>
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="fas fa-dollar-sign"></i>
          <span>
            @if (app()->getLocale() == 'en')
            {{ __('messages.buy') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.buy') }}
            @endif
          </span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
       @if (app()->getLocale() == 'en')
       {{ __('messages.cart') }}
       @elseif (app()->getLocale() == 'es')
       {{ __('messages.cart') }}
       @endif
     </div>
     <li class="nav-item">
      <a class="nav-link" href="/cart">
        <i class="fas fa-shopping-cart"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.cart-link') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.cart-link') }}
          @endif
        </span>
      </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      {{ __('messages.seller') }}
      @elseif (app()->getLocale() == 'es')
      {{ __('messages.seller') }}
      @endif
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-exchange-alt"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.sell') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.sell') }}
          @endif
        </span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">
            @if (app()->getLocale() == 'en')
            {{ __('messages.products') }}:
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.products') }}:
            @endif
          </h6>
          <a class="collapse-item" href="/user-seller/products">
            @if (app()->getLocale() == 'en')
            {{ __('messages.my-products') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.my-products') }}
            @endif
          </a>
          <a class="collapse-item" href="/user-seller/add-products">
            @if (app()->getLocale() == 'en')
            {{ __('messages.add-products') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.add-products') }}
            @endif
          </a>
          <a class="collapse-item" href="/user-seller/trackings">
            @if (app()->getLocale() == 'en')
            {{ __('messages.product-tracking') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.product-tracking') }}
            @endif
          </a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      {{ __('messages.account') }}
      @elseif (app()->getLocale() == 'es')
      {{ __('messages.account') }}
      @endif
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.settings') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.settings') }}
          @endif
        </span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">
            @if (app()->getLocale() == 'en')
            {{ __('messages.configuration') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.configuration') }}
            @endif
          </h6>
          <a class="collapse-item" href="/profile">
            @if (app()->getLocale() == 'en')
            {{ __('messages.profile') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.profile') }}
            @endif
          </a>
          <a class="collapse-item" href="/order-tracking">
            @if (app()->getLocale() == 'en')
            {{ __('messages.product-tracking') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.product-tracking') }}
            @endif
          </a>
          <a class="collapse-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            @if (app()->getLocale() == 'en')
            {{ __('messages.log-out') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.log-out') }}
            @endif
          </a>
          <form id="logout-form" action="{{ route('user.logout') }}" method="get" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      LANGUAGE
      @elseif (app()->getLocale() == 'es')
      IDIOMA
      @endif 
    </div>
    <li class="nav-item">
      @if (app()->getLocale() == 'en')
      <a class="nav-link"  href="{{ url('locale/es') }}" ><i class="fa fa-language"></i> ES</a>
      @elseif (app()->getLocale() == 'es')
      <a class="nav-link"  href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a>
      @endif 
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
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bell fa-fw"></i>
              <!-- Counter - Alerts -->
              <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Alerts Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 12, 2019</div>
                  <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-success">
                    <i class="fas fa-donate text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 7, 2019</div>
                  $290.29 has been deposited into your account!
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 2, 2019</div>
                  Spending Alert: We've noticed unusually high spending for your account.
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
          </li>
          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-envelope fa-fw"></i>
              <!-- Counter - Messages -->
              <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                Message Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                  <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                  <div class="status-indicator"></div>
                </div>
                <div>
                  <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                  <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                  <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                  <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                  <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div>
                  <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                  <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
          </li>
          <div class="topbar-divider d-none d-sm-block"></div>
          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
              <img class="img-profile rounded-circle" src="uploads/avatars/{{ $user->avatar }}">
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

          <!-- Page Heading 
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
        -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              @if (app()->getLocale() == 'en')
              {{ __('messages.cart-link') }}
              @elseif (app()->getLocale() == 'es')
              {{ __('messages.cart-link') }}
              @endif
            </h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    @if (app()->getLocale() == 'en')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                    
                    @elseif (app()->getLocale() == 'es')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                     
                    @endif                                                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    @if (app()->getLocale() == 'en')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>
                    @elseif (app()->getLocale() == 'es')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                     
                    @endif     
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $id_client = clear($_SESSION['Id']);
                  $q = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");
                  $total_amount = 0;
                  while($r = mysqli_fetch_array($q)){
                    $q2 = $conn->query("SELECT * FROM products WHERE idProduct = '".$r['idProduct']."'");                        
                    $r2 = mysqli_fetch_array($q2);
                    $product_name = $r2['product'];
                    $product_image = $r2['image'];
                    $quan = $r['quantity'];
                    $maxQuan = $r2['quantity'];
                    $Price_unit = $r2['price'];
                    $Discount = $r2['discount'];
                    $Price_discount = $r2['price']-($r2['price']*($r2['discount']/100));
                    if($Discount > 0){
                      $Total_Price = $quan * $Price_discount;
                    }else{
                      $Total_Price = $quan * $Price_unit;
                    }
                    $total_amount = $total_amount + $Total_Price;
                    ?>
                    <tr>
                      <td><?=$product_name?></td>
                      <td><img src="products/<?=$product_image?>" height="50px" width="50px"></td>
                      <td><?=$quan?></td>
                      <td>
                        <input type="number" id="add_<?=$r['idProduct']?>" max="<?=$maxQuan?>" class="form-control form-control-user" min="1">
                        <?php
                        if($r2['quantity']<1){
                          ?>
                          <button onclick="add('<?=$r['idProduct']?>')" class="btn btn-secondary" type="button" disabled>@if (app()->getLocale() == 'en')
                          {{ __('messages.add') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.add') }}
                          @endif</button>
                          <?php
                        }
                        else if($r2['quantity']>0){
                          ?>
                          <button onclick="add('<?=$r['idProduct']?>')" class="btn btn-secondary">
                          @if (app()->getLocale() == 'en')
                          {{ __('messages.add') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.add') }}
                          @endif</button>
                          <?php
                        }
                        ?>
                      </td>
                      <td>$<?=$Price_unit?></td>
                      <td><?=$Discount?>%</td>
                      <td>$<?=$Price_discount?></td>
                      <td>$<?=$Total_Price?></td>
                      <td><a style="color:#fff!important;background:red!important;" class="btn btn-5 btn-5a icon-remove button" onclick="del('<?=$r['idProduct']?>');">
                        <span>
                          @if (app()->getLocale() == 'en')
                          {{ __('messages.delete') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.delete') }}
                          @endif
                        </span></a>
                      </td> 
                    </tr>
                    <div id="update_<?=$r['idProduct']?>" class="modale">
                      <!-- Modal content -->
                      <div class="modale-content" id="updateCart_<?=$r['idProduct']?>" style="height: 47%">

                        <div class="modale-header">

                          <h5 style="float: left!important;">Cart Updated</h5>
                        </div>
                        <div class="modal-body" style="height:100%">
                          <img src="gallery/check.gif" width="100%">                          
                        </div>
                        <div class="modale-footer">                          
                          <button class="action action--button action--buy btn btn-5 btn-5a icon-cart button" id="btn_<?=$r['idProduct']?>" style="background: #dcdcdc; color: #000; width: 150px; height: 40px; font-size: 14px; margin:0"><span class="action__text">Ok</span></button>
                        </div>
                      </div>    
                      <script>
                        var modal<?=$r['idProduct']?> = document.getElementById("update_<?=$r['idProduct']?>");
                        var modal_content<?=$r['idProduct']?> = document.getElementById("updateCart_<?=$r['idProduct']?>");                        
                        function add(iap){
                          var q = document.getElementById('add_<?=$r['idProduct']?>').value;
                          
                          if(q < (<?=$r2['quantity']?> + 1) && q>0){
                            modal<?=$r['idProduct']?>.classList.add('show');
                            modal<?=$r['idProduct']?>.style.opacity = "1";
                            modal_content<?=$r['idProduct']?>.classList.add('show');

                            document.getElementById("btn_<?=$r['idProduct']?>").onclick = function(){
                              window.location="?p=cart&quan="+q+"&add="+iap;
                            }
                          }
                          window.addEventListener("click", function(event) {                              
                            if(event.target == modal<?=$r['idProduct']?>){
                              window.location="?p=cart&quan="+q+"&add="+iap;
                            }
                          });         
                        }
                      </script>            
                      <?php
                    }                
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <h2 style="float:right;">Grand Total: <b>$<?=$total_amount?></b></h2>
          <?php
          if($q->num_rows > 0){              
            ?>
            <form method="get" action="{{URL::to('/cart')}}">
              <input type="hidden" name="total_amount" value="<?=$total_amount?>"/>
              <button class="btn btn-primary" type="submit" name="end"><i class="fa fa-check"></i>@if (app()->getLocale() == 'en')
              {{ __('messages.finalize-purchase') }}
              @elseif (app()->getLocale() == 'es')
              {{ __('messages.finalize-purchase') }}
              @endif</button>
            </form>
            <?php
          }
          ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
    function del(idp){
      var conf = confirm("Are you sure you want to delete this from the cart?");

      if(conf == true){
        window.location="?p=cart&delete="+idp;
      }
    }
  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
=======
<?php
session_start();
if($_SESSION['activity']==0){
  header('location:login.php');
}
include 'configs/funciones.php';
include 'configs/config.php';
require_once('conn.php');     
require_once('database.php');     
$Db=Database::connect();
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($end)){        
  $amount = clear($total_amount);

  $id_client = clear($_SESSION['Id']);
  $qd = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");

  while ($rd = mysqli_fetch_array($qd)) {
    $q = $conn->query("INSERT INTO buyout (idClient, date, amount, status, idSeller) VALUES ('$id_client', NOW(), '$amount', 0, '".$rd['idSeller']."')");
  }




  $sc = $conn->query("SELECT * FROM buyout WHERE idClient = '$id_client' ORDER BY id DESC LIMIT 1");
  $rc= mysqli_fetch_array($sc);

  $last_purchase = $rc['id'];

  $q2 = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");
  while($r2 = mysqli_fetch_array($q2)){

    $sp = $conn->query("SELECT * FROM products WHERE idProduct = '".$r2['idProduct']."'");
    $rp = mysqli_fetch_array($sp);
    if($rp['discount']>0){
      $amount = $rp['price']-($rp['price']*($rp['discount']/100));
    }else{
      $amount = $rp['price'];
    }

    $conn->query("INSERT INTO products_purchase (idPurchase, idProduct, quantity, amount, idSeller) VALUES ('$last_purchase', '".$r2['idProduct']."','".$r2['quantity']."','$amount', '".$r2['idSeller']."')");
  }
  $conn->query("DELETE FROM cart WHERE idClient = '$id_client'");
  alert("The purchase has been completed");
  redir("./");
}
if(isset($delete)){
  $idp = clear($delete);
  $quan = $Db->query("SELECT quantity FROM cart WHERE idProduct = '$idp'")->fetchColumn();
  $conn->query("UPDATE products set quantity = quantity + '$quan' WHERE idProduct = '$idp'");
  $conn->query("DELETE FROM cart WHERE idProduct = '$idp'");
}
if(isset($add)){
  $iap = clear($add);  
  $quan = clear($quan);
  $conn->query("UPDATE products set quantity = quantity - '$quan' WHERE idProduct = '$iap'");
  $conn->query("UPDATE cart set quantity = quantity + '$quan' where idProduct = '$iap'");
  redir("./cart");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cart</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="css/botones.css" rel="stylesheet">
  <link href="css/Products.css" rel="stylesheet">

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
        @if (app()->getLocale() == 'en')
        {{ __('messages.buyer') }}
        @elseif (app()->getLocale() == 'es')
        {{ __('messages.buyer') }}
        @endif 
      </div>
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="fas fa-dollar-sign"></i>
          <span>
            @if (app()->getLocale() == 'en')
            {{ __('messages.buy') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.buy') }}
            @endif
          </span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
       @if (app()->getLocale() == 'en')
       {{ __('messages.cart') }}
       @elseif (app()->getLocale() == 'es')
       {{ __('messages.cart') }}
       @endif
     </div>
     <li class="nav-item">
      <a class="nav-link" href="/cart">
        <i class="fas fa-shopping-cart"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.cart-link') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.cart-link') }}
          @endif
        </span>
      </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      {{ __('messages.seller') }}
      @elseif (app()->getLocale() == 'es')
      {{ __('messages.seller') }}
      @endif
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-exchange-alt"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.sell') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.sell') }}
          @endif
        </span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">
            @if (app()->getLocale() == 'en')
            {{ __('messages.products') }}:
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.products') }}:
            @endif
          </h6>
          <a class="collapse-item" href="/user-seller/products">
            @if (app()->getLocale() == 'en')
            {{ __('messages.my-products') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.my-products') }}
            @endif
          </a>
          <a class="collapse-item" href="/user-seller/add-products">
            @if (app()->getLocale() == 'en')
            {{ __('messages.add-products') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.add-products') }}
            @endif
          </a>
          <a class="collapse-item" href="/user-seller/trackings">
            @if (app()->getLocale() == 'en')
            {{ __('messages.product-tracking') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.product-tracking') }}
            @endif
          </a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      {{ __('messages.account') }}
      @elseif (app()->getLocale() == 'es')
      {{ __('messages.account') }}
      @endif
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>
          @if (app()->getLocale() == 'en')
          {{ __('messages.settings') }}
          @elseif (app()->getLocale() == 'es')
          {{ __('messages.settings') }}
          @endif
        </span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">
            @if (app()->getLocale() == 'en')
            {{ __('messages.configuration') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.configuration') }}
            @endif
          </h6>
          <a class="collapse-item" href="/profile">
            @if (app()->getLocale() == 'en')
            {{ __('messages.profile') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.profile') }}
            @endif
          </a>
          <a class="collapse-item" href="/order-tracking">
            @if (app()->getLocale() == 'en')
            {{ __('messages.product-tracking') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.product-tracking') }}
            @endif
          </a>
          <a class="collapse-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            @if (app()->getLocale() == 'en')
            {{ __('messages.log-out') }}
            @elseif (app()->getLocale() == 'es')
            {{ __('messages.log-out') }}
            @endif
          </a>
          <form id="logout-form" action="{{ route('user.logout') }}" method="get" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <div class="sidebar-heading">
      @if (app()->getLocale() == 'en')
      LANGUAGE
      @elseif (app()->getLocale() == 'es')
      IDIOMA
      @endif 
    </div>
    <li class="nav-item">
      @if (app()->getLocale() == 'en')
      <a class="nav-link"  href="{{ url('locale/es') }}" ><i class="fa fa-language"></i> ES</a>
      @elseif (app()->getLocale() == 'es')
      <a class="nav-link"  href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a>
      @endif 
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
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bell fa-fw"></i>
              <!-- Counter - Alerts -->
              <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Alerts Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 12, 2019</div>
                  <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-success">
                    <i class="fas fa-donate text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 7, 2019</div>
                  $290.29 has been deposited into your account!
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 2, 2019</div>
                  Spending Alert: We've noticed unusually high spending for your account.
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
          </li>
          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-envelope fa-fw"></i>
              <!-- Counter - Messages -->
              <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                Message Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                  <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                  <div class="status-indicator"></div>
                </div>
                <div>
                  <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                  <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                  <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                  <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                  <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div>
                  <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                  <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
          </li>
          <div class="topbar-divider d-none d-sm-block"></div>
          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
              <img class="img-profile rounded-circle" src="uploads/avatars/{{ $user->avatar }}">
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

          <!-- Page Heading 
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
        -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              @if (app()->getLocale() == 'en')
              {{ __('messages.cart-link') }}
              @elseif (app()->getLocale() == 'es')
              {{ __('messages.cart-link') }}
              @endif
            </h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    @if (app()->getLocale() == 'en')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                    
                    @elseif (app()->getLocale() == 'es')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                     
                    @endif                                                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    @if (app()->getLocale() == 'en')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>
                    @elseif (app()->getLocale() == 'es')
                    <th>{{ __('messages.product-name') }}</th>
                    <th>{{ __('messages.product-image') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.add-units') }}</th>
                    <th>{{ __('messages.price-per-unit') }}</th>    
                    <th>{{ __('messages.applied-discount') }}</th>
                    <th>{{ __('messages.price-with-discount') }}</th>
                    <th>{{ __('messages.total-price') }}</th>
                    <th>{{ __('messages.action') }}</th>                     
                    @endif     
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $id_client = clear($_SESSION['Id']);
                  $q = $conn->query("SELECT * FROM cart WHERE idClient = '$id_client'");
                  $total_amount = 0;
                  while($r = mysqli_fetch_array($q)){
                    $q2 = $conn->query("SELECT * FROM products WHERE idProduct = '".$r['idProduct']."'");                        
                    $r2 = mysqli_fetch_array($q2);
                    $product_name = $r2['product'];
                    $product_image = $r2['image'];
                    $quan = $r['quantity'];
                    $maxQuan = $r2['quantity'];
                    $Price_unit = $r2['price'];
                    $Discount = $r2['discount'];
                    $Price_discount = $r2['price']-($r2['price']*($r2['discount']/100));
                    if($Discount > 0){
                      $Total_Price = $quan * $Price_discount;
                    }else{
                      $Total_Price = $quan * $Price_unit;
                    }
                    $total_amount = $total_amount + $Total_Price;
                    ?>
                    <tr>
                      <td><?=$product_name?></td>
                      <td><img src="products/<?=$product_image?>" height="50px" width="50px"></td>
                      <td><?=$quan?></td>
                      <td>
                        <input type="number" id="add_<?=$r['idProduct']?>" max="<?=$maxQuan?>" class="form-control form-control-user" min="1">
                        <?php
                        if($r2['quantity']<1){
                          ?>
                          <button onclick="add('<?=$r['idProduct']?>')" class="btn btn-secondary" type="button" disabled>@if (app()->getLocale() == 'en')
                          {{ __('messages.add') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.add') }}
                          @endif</button>
                          <?php
                        }
                        else if($r2['quantity']>0){
                          ?>
                          <button onclick="add('<?=$r['idProduct']?>')" class="btn btn-secondary">
                          @if (app()->getLocale() == 'en')
                          {{ __('messages.add') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.add') }}
                          @endif</button>
                          <?php
                        }
                        ?>
                      </td>
                      <td>$<?=$Price_unit?></td>
                      <td><?=$Discount?>%</td>
                      <td>$<?=$Price_discount?></td>
                      <td>$<?=$Total_Price?></td>
                      <td><a style="color:#fff!important;background:red!important;" class="btn btn-5 btn-5a icon-remove button" onclick="del('<?=$r['idProduct']?>');">
                        <span>
                          @if (app()->getLocale() == 'en')
                          {{ __('messages.delete') }}
                          @elseif (app()->getLocale() == 'es')
                          {{ __('messages.delete') }}
                          @endif
                        </span></a>
                      </td> 
                    </tr>
                    <div id="update_<?=$r['idProduct']?>" class="modale">
                      <!-- Modal content -->
                      <div class="modale-content" id="updateCart_<?=$r['idProduct']?>" style="height: 47%">

                        <div class="modale-header">

                          <h5 style="float: left!important;">Cart Updated</h5>
                        </div>
                        <div class="modal-body" style="height:100%">
                          <img src="gallery/check.gif" width="100%">                          
                        </div>
                        <div class="modale-footer">                          
                          <button class="action action--button action--buy btn btn-5 btn-5a icon-cart button" id="btn_<?=$r['idProduct']?>" style="background: #dcdcdc; color: #000; width: 150px; height: 40px; font-size: 14px; margin:0"><span class="action__text">Ok</span></button>
                        </div>
                      </div>    
                      <script>
                        var modal<?=$r['idProduct']?> = document.getElementById("update_<?=$r['idProduct']?>");
                        var modal_content<?=$r['idProduct']?> = document.getElementById("updateCart_<?=$r['idProduct']?>");                        
                        function add(iap){
                          var q = document.getElementById('add_<?=$r['idProduct']?>').value;
                          
                          if(q < (<?=$r2['quantity']?> + 1) && q>0){
                            modal<?=$r['idProduct']?>.classList.add('show');
                            modal<?=$r['idProduct']?>.style.opacity = "1";
                            modal_content<?=$r['idProduct']?>.classList.add('show');

                            document.getElementById("btn_<?=$r['idProduct']?>").onclick = function(){
                              window.location="?p=cart&quan="+q+"&add="+iap;
                            }
                          }
                          window.addEventListener("click", function(event) {                              
                            if(event.target == modal<?=$r['idProduct']?>){
                              window.location="?p=cart&quan="+q+"&add="+iap;
                            }
                          });         
                        }
                      </script>            
                      <?php
                    }                
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <h2 style="float:right;">Grand Total: <b>$<?=$total_amount?></b></h2>
          <?php
          if($q->num_rows > 0){              
            ?>
            <form method="get" action="{{URL::to('/cart')}}">
              <input type="hidden" name="total_amount" value="<?=$total_amount?>"/>
              <button class="btn btn-primary" type="submit" id="paypal-button" name="end"><i class="fa fa-check"></i>@if (app()->getLocale() == 'en')
              {{ __('messages.finalize-purchase') }}
              @elseif (app()->getLocale() == 'es')
              {{ __('messages.finalize-purchase') }}
              @endif</button>
            </form>
            <?php
          }
          ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
    function del(idp){
      var conf = confirm("Are you sure you want to delete this from the cart?");

      if(conf == true){
        window.location="?p=cart&delete="+idp;
      }
    }
  </script>
  <!-- Paypal script -->
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <script>
  paypal.Button.render({
    env: 'sandbox', // Or 'production'
    // Set up the payment:
    // 1. Add a payment callback
    payment: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/create-payment')
        .then(function(res) {
          // 3. Return res.id from the response
          return res.id;
        });
    },
    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/execute-payment', {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          // 3. Show the buyer a confirmation message.
          console.log(res);
          alert('PAYMENT WENT THROUGH !!');
        });
    }
  }, '#paypal-button');
</script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
