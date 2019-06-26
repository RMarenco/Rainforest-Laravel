<<<<<<< HEAD
<?php
session_start();
if($_SESSION['activity']==0){
  header('location:/login');
}
if(isset($_SESSION['email'])){
  if(isset($_POST['submit'])){
    require_once 'conn.php';
    include'conn.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $idUser = $_SESSION['Id'];

    $pName = $_POST['pName'];
    $pDescription = $_POST['pDescription'];
    $pPrice = $_POST['pPrice'];
    $pCategory = $_POST['pCategory'];
    $quantity = $_POST['pQuantity'];

    $pImage = $_FILES['pImage']['name'];
    $ruta = $_FILES['pImage']['tmp_name'];
    $destino = "../products/" . basename($pImage);
    $a = $_FILES['pImage'];

    $imageExtension = pathinfo($destino,PATHINFO_EXTENSION);
    /*if($imageExtension != 'gif'){*/
      if($imageExtension == 'jpg' || $imageExtension == 'JPG' || $imageExtension == 'JPEG' || $imageExtension == 'jpge' || $imageExtension == 'png' || $imageExtension == 'PNG' || $imageExtension != 'gif' || $imageExtension != 'GIF'){         
        if($pImage != '' && $ruta != '' && $destino != ''){
          copy($ruta, $destino);          
        }  
      }     
      if($pName != '' && $pDescription != '' && $pPrice != '' && $pCategory != null && $pImage != ''){
        mysqli_query($conn, "INSERT INTO products (product, description, price, discount, quantity, image, idCategory, idUser) VALUES ('$pName', '$pDescription', '$pPrice', 0, '$quantity', '$pImage', '$pCategory', $idUser)");
      }
    }
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
    <title>Add Products</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/botones.css" rel="stylesheet">
    <link href="../../css/Products.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
          <img src="../Gallery/RF1.png" style="max-width:6em;padding-left:15px;padding-right:-10px;">
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
                <img class="img-profile rounded-circle" src="../../uploads/avatars/{{ $user->avatar }}">
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
          <div style="align-content:center;"class="card o-hidden border-0 shadow-lg my-5">
            <div style="align-content:center;" class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-xl-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4" style="margin-left:1%;">Add Product</h1>
                    </div>
                    <form class="user" action="{{ route('add_product') }}" role="form" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?=$id=$user->id?>">
                      <input type="hidden" name="_token" value="{{ csrf_token()}}">   
                      <div class="form-group">
                        <input type="text" name="pName" class="form-control form-control-user" id="exampleFirstName" placeholder="Product Name">
                      </div>
                      <div class="form-group">
                        <textarea type="text" name="pDescription" class="form-control form-control-user" id="exampleFirstName" placeholder="Product Description"></textarea>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input type="number" min="0.01" max="10000.00" step="0.01" name="pPrice" class="form-control form-control-user" id="" placeholder="Price">
                        </div>
                        <div class="col-sm-6">
                          <input type="number" min="1" max="100" step="1" name="pQuantity" class="form-control form-control-user" id="" placeholder="Quantity">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <?php
                          include'conn.php';
                          $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                          $query = mysqli_query($conn, "SELECT idCategory, category FROM categories");
                          echo "<select id='pCategory' name='pCategory' class='form-control' style='font-size: .8rem; border-radius: 10rem; height:3rem; margin-bottom:15px;' required>";
                          echo "<option disabled selected value>Choose product category</option>";
                          while($d = mysqli_fetch_assoc($query)){             
                            echo "<option value='".$d['idCategory']."'>".$d['category']."</option>";
                          }
                          echo "</select>";
                          ?>
                        </div>
                        <div class="col-sm-4">
                          <input type="file" class="alert alert-dark" name="pImage" id="productImg" hidden="hidden" required>
                          <span id="custom-text" style="cursor:pointer" class="form-control form-control-user">No file choosen, yet.</span>      
                        </div>
                        <div class="col-sm-2">                                    
                          <span style="height:4em;background-color:green!important;" class="btn btn-primary btn-user btn-block" id="custom-button">Choose file</span>
                        </div>
                      </div>
                      <input type="submit" style="margin-top:5%;" class="btn btn-primary btn-user btn-block" value="add product">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Page Content-->
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Rainforest 2019</span>
          </div>
        </div>
      </footer>
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
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../js/sb-admin-2.min.js"></script>
  <script type="text/javascript">   
    $(document).ready(function() {
      /*document.getElementById("price").maxLength = "5";
      $(function () {
          $("#price").keydown(function (e) {
            if ((e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
              (e.keyCode >= 35 && e.keyCode <= 40) ||
              $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1) {
              return;
          }
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
            (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
          }
        });
      });*/

      $(function(){
        $("input[name=pName]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product name.");
        };
      });
      $(function(){
        $("input[name=pName]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("textarea[name=pDescription]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product description");
        };
      });
      $(function(){
        $("textarea[name=pDescription]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("input[name=pQuantity]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product quantity.");
        };
      });
      $(function(){
        $("input[name=pQuantity]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("input[name=pPrice]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product price.");
        };
      });
      $(function(){
        $("input[name=pPrice]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("select[name=pCategory]")[0].oninvalid = function () {
          this.setCustomValidity("Please select the product category.");
        };
      });
      $(function(){
        $("select[name=pCategory]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });

      const realFileBtn = document.getElementById("productImg");
      const customBtn = document.getElementById("custom-button");
      const customTxt = document.getElementById("custom-text");       

      customBtn.addEventListener("click", function(){
        realFileBtn.click();  
      });

      customTxt.addEventListener("click", function(){
        realFileBtn.click();  
      });

      realFileBtn.addEventListener("change", function(){
        if(realFileBtn.value){
          customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        }
      });
    });
  </script>
</body>
=======
<?php
session_start();
if($_SESSION['activity']==0){
  header('location:/login');
}
if(isset($_SESSION['email'])){
  if(isset($_POST['submit'])){
    require_once 'conn.php';
    include'conn.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $idUser = $_SESSION['Id'];

    $pName = $_POST['pName'];
    $pDescription = $_POST['pDescription'];
    $pPrice = $_POST['pPrice'];
    $pCategory = $_POST['pCategory'];
    $quantity = $_POST['pQuantity'];

    $pImage = $_FILES['pImage']['name'];
    $ruta = $_FILES['pImage']['tmp_name'];
    $destino = "../products/" . basename($pImage);
    $a = $_FILES['pImage'];

    $imageExtension = pathinfo($destino,PATHINFO_EXTENSION);
    /*if($imageExtension != 'gif'){*/
      if($imageExtension == 'jpg' || $imageExtension == 'JPG' || $imageExtension == 'JPEG' || $imageExtension == 'jpge' || $imageExtension == 'png' || $imageExtension == 'PNG' || $imageExtension != 'gif' || $imageExtension != 'GIF'){         
        if($pImage != '' && $ruta != '' && $destino != ''){
          copy($ruta, $destino);          
        }  
      }     
      if($pName != '' && $pDescription != '' && $pPrice != '' && $pCategory != null && $pImage != ''){
        mysqli_query($conn, "INSERT INTO products (product, description, price, discount, quantity, image, idCategory, idUser) VALUES ('$pName', '$pDescription', '$pPrice', 0, '$quantity', '$pImage', '$pCategory', $idUser)");
      }
    }
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
    <title>Add Products</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/botones.css" rel="stylesheet">
    <link href="../../css/Products.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
          <img src="../Gallery/RF1.png" style="max-width:6em;padding-left:15px;padding-right:-10px;">
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
                <img class="img-profile rounded-circle" src="../../uploads/avatars/{{ $user->avatar }}">
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
          <div style="align-content:center;"class="card o-hidden border-0 shadow-lg my-5">
            <div style="align-content:center;" class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-xl-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4" style="margin-left:1%;">Add Product</h1>
                    </div>
                    <form class="user" action="{{ route('add_product') }}" role="form" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?=$id=$user->id?>">
                      <input type="hidden" name="_token" value="{{ csrf_token()}}">   
                      <div class="form-group">
                        <input type="text" name="pName" class="form-control form-control-user" id="exampleFirstName" placeholder="Product Name">
                      </div>
                      <div class="form-group">
                        <textarea type="text" name="pDescription" class="form-control form-control-user" id="exampleFirstName" placeholder="Product Description"></textarea>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input type="number" min="0.01" max="10000.00" step="0.01" name="pPrice" class="form-control form-control-user" id="" placeholder="Price">
                        </div>
                        <div class="col-sm-6">
                          <input type="number" min="1" max="100" step="1" name="pQuantity" class="form-control form-control-user" id="" placeholder="Quantity">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <?php
                          include'conn.php';
                          $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                          $query = mysqli_query($conn, "SELECT idCategory, category FROM categories");
                          echo "<select id='pCategory' name='pCategory' class='form-control' style='font-size: .8rem; border-radius: 10rem; height:3rem; margin-bottom:15px;' required>";
                          echo "<option disabled selected value>Choose product category</option>";
                          while($d = mysqli_fetch_assoc($query)){             
                            echo "<option value='".$d['idCategory']."'>".$d['category']."</option>";
                          }
                          echo "</select>";
                          ?>
                        </div>
                        <div class="col-sm-4">
                          <input type="file" class="alert alert-dark" name="pImage" id="productImg" hidden="hidden" required>
                          <span id="custom-text" style="cursor:pointer" class="form-control form-control-user">No file choosen, yet.</span>      
                        </div>
                        <div class="col-sm-2">                                    
                          <span style="height:4em;background-color:green!important;" class="btn btn-primary btn-user btn-block" id="custom-button">Choose file</span>
                        </div>
                      </div>
                      <input type="submit" style="margin-top:5%;" class="btn btn-primary btn-user btn-block" value="add product">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Page Content-->
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Rainforest 2019</span>
          </div>
        </div>
      </footer>
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
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../js/sb-admin-2.min.js"></script>
  <script type="text/javascript">   
    $(document).ready(function() {
      /*document.getElementById("price").maxLength = "5";
      $(function () {
          $("#price").keydown(function (e) {
            if ((e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
              (e.keyCode >= 35 && e.keyCode <= 40) ||
              $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1) {
              return;
          }
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
            (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
          }
        });
      });*/

      $(function(){
        $("input[name=pName]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product name.");
        };
      });
      $(function(){
        $("input[name=pName]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("textarea[name=pDescription]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product description");
        };
      });
      $(function(){
        $("textarea[name=pDescription]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("input[name=pQuantity]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product quantity.");
        };
      });
      $(function(){
        $("input[name=pQuantity]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("input[name=pPrice]")[0].oninvalid = function () {
          this.setCustomValidity("Please enter the product price.");
        };
      });
      $(function(){
        $("input[name=pPrice]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });
      $(function(){
        $("select[name=pCategory]")[0].oninvalid = function () {
          this.setCustomValidity("Please select the product category.");
        };
      });
      $(function(){
        $("select[name=pCategory]")[0].oninput = function () {
          this.setCustomValidity("");
        };
      });

      const realFileBtn = document.getElementById("productImg");
      const customBtn = document.getElementById("custom-button");
      const customTxt = document.getElementById("custom-text");       

      customBtn.addEventListener("click", function(){
        realFileBtn.click();  
      });

      customTxt.addEventListener("click", function(){
        realFileBtn.click();  
      });

      realFileBtn.addEventListener("change", function(){
        if(realFileBtn.value){
          customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        }
      });
    });
  </script>
</body>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
</html>