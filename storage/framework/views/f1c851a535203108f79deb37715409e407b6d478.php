<?php
session_start();
$_SESSION['email']=$user->email;
$_SESSION['activity']=$user->status;
$_SESSION['Id']=$user->id;
  if(isset($_POST['submit'])){    
    include 'conn.php';   
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //Check connection
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    $id = $_SESSION['Id'];        

      $username = $_POST['username'];
      $pass = $_POST['password'];
      $cpass = $_POST['cpassword'];     

      if($username != ''){
        mysqli_query($conn, "UPDATE users SET UserName = '$username' WHERE Id = '$id'");
        $_SESSION['username'] = $_POST['username'];
        echo "<script>alert('User Name updated succesfully');</script>";
      }
      $apassdb = mysqli_query($conn, "SELECT Password From users WHERE Id = '$id'");
      $row = mysqli_fetch_assoc($apassdb);
      $hash = $row['Password'];   
      if($_POST['apassword'] != ''){
        if(mysqli_num_rows($apassdb) > 0){
          if(password_verify($_POST['apassword'], $hash)){
            if($pass != ''  && $cpass != '' && $pass == $cpass){    
              $passHash = password_hash($pass, PASSWORD_DEFAULT);   
              mysqli_query($conn, "UPDATE users SET Password = '$passHash' WHERE Id = '$id'");        
              if(app()->getLocale() == 'en'){
                echo "<script>alert('User password updated successfully');</script>";  
              }elseif(app()->getLocale() == 'es'){
                echo "<script>alert('Contraseña de usuario actualizada correctamente');</script>";
              }
              
            }else{
              if(app()->getLocale() == 'en'){
                echo "<script>alert('The password hasn't been updated')</script>";
              }elseif(app()->getLocale() == 'es'){
                echo "<script>alert('La contraseña no ha sido actualizada')</script>";
              }              
            }
          }else{
            if(app()->getLocale() == 'en'){
              echo "<script>alert('The actual password do not match the database actual password')</script>";
            }elseif(app()->getLocale() == 'es'){
              echo "<script>alert('La contraseña actual no coincide con la contraseña en nuestro registro')</script>";
            }            
          }
        } 
      }
    }  
  ?>

<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>

  <meta charset="utf-8">
  <link rel="icon" type="text/css" href="Gallery/RF1.ico"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">  
  <title>
    <?php if(app()->getLocale() == 'en'): ?>
      <?php echo e(__('messages.profile')); ?>

    <?php elseif(app()->getLocale() == 'es'): ?>
      <?php echo e(__('messages.profile')); ?>

    <?php endif; ?>
  </title>

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
          <?php if(app()->getLocale() == 'en'): ?>
            <?php echo e(__('messages.buyer')); ?>

          <?php elseif(app()->getLocale() == 'es'): ?>
            <?php echo e(__('messages.buyer')); ?>

          <?php endif; ?> 
        </div>
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="fas fa-dollar-sign"></i>
              <span>
                <?php if(app()->getLocale() == 'en'): ?>
                  <?php echo e(__('messages.buy')); ?>

                <?php elseif(app()->getLocale() == 'es'): ?>
                  <?php echo e(__('messages.buy')); ?>

                <?php endif; ?>
              </span>
            </a>
          </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
           <?php if(app()->getLocale() == 'en'): ?>
            <?php echo e(__('messages.cart')); ?>

           <?php elseif(app()->getLocale() == 'es'): ?>
            <?php echo e(__('messages.cart')); ?>

           <?php endif; ?>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="/cart">
                <i class="fas fa-shopping-cart"></i>
              <span>
                <?php if(app()->getLocale() == 'en'): ?>
                  <?php echo e(__('messages.cart-link')); ?>

                <?php elseif(app()->getLocale() == 'es'): ?>
                  <?php echo e(__('messages.cart-link')); ?>

                <?php endif; ?>
              </span>
            </a>
          </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          <?php if(app()->getLocale() == 'en'): ?>
            <?php echo e(__('messages.seller')); ?>

          <?php elseif(app()->getLocale() == 'es'): ?>
            <?php echo e(__('messages.seller')); ?>

          <?php endif; ?>
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-exchange-alt"></i>
              <span>
                <?php if(app()->getLocale() == 'en'): ?>
                  <?php echo e(__('messages.sell')); ?>

                <?php elseif(app()->getLocale() == 'es'): ?>
                  <?php echo e(__('messages.sell')); ?>

                <?php endif; ?>
              </span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.products')); ?>:
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.products')); ?>:
                  <?php endif; ?>
                </h6>
                <a class="collapse-item" href="/user-seller/products">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.my-products')); ?>

                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.my-products')); ?>

                  <?php endif; ?>
                </a>
                <a class="collapse-item" href="/user-seller/add-products">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.add-products')); ?>

                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.add-products')); ?>

                  <?php endif; ?>
                </a>
                <a class="collapse-item" href="/user-seller/trackings">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.product-tracking')); ?>

                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.product-tracking')); ?>

                  <?php endif; ?>
                </a>
              </div>
            </div>
          </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidebar-heading">
          <?php if(app()->getLocale() == 'en'): ?>
            <?php echo e(__('messages.account')); ?>

          <?php elseif(app()->getLocale() == 'es'): ?>
            <?php echo e(__('messages.account')); ?>

          <?php endif; ?>
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>
              <?php if(app()->getLocale() == 'en'): ?>
                <?php echo e(__('messages.settings')); ?>

              <?php elseif(app()->getLocale() == 'es'): ?>
                <?php echo e(__('messages.settings')); ?>

              <?php endif; ?>
            </span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">
                <?php if(app()->getLocale() == 'en'): ?>
                  <?php echo e(__('messages.configuration')); ?>

                <?php elseif(app()->getLocale() == 'es'): ?>
                  <?php echo e(__('messages.configuration')); ?>

                <?php endif; ?>
              </h6>
              <a class="collapse-item" href="/profile">
                <?php if(app()->getLocale() == 'en'): ?>
                  <?php echo e(__('messages.profile')); ?>

                <?php elseif(app()->getLocale() == 'es'): ?>
                  <?php echo e(__('messages.profile')); ?>

                <?php endif; ?>
              </a>
              <a class="collapse-item" href="/order-tracking">
                <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.product-tracking')); ?>

                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.product-tracking')); ?>

                  <?php endif; ?>
              </a>
              <a class="collapse-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <?php if(app()->getLocale() == 'en'): ?>
                    <?php echo e(__('messages.log-out')); ?>

                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <?php echo e(__('messages.log-out')); ?>

                  <?php endif; ?>
              </a>
              <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="get" style="display: none;">
                        <?php echo csrf_field(); ?>
              </form>
            </div>
          </div>
        </li>
        <div class="sidebar-heading">
          <?php if(app()->getLocale() == 'en'): ?>
            LANGUAGE
          <?php elseif(app()->getLocale() == 'es'): ?>
            IDIOMA
          <?php endif; ?> 
        </div>
        <li class="nav-item">
            <?php if(app()->getLocale() == 'en'): ?>
              <a class="nav-link"  href="<?php echo e(url('locale/es')); ?>" ><i class="fa fa-language"></i> ES</a>
            <?php elseif(app()->getLocale() == 'es'): ?>
              <a class="nav-link"  href="<?php echo e(url('locale/en')); ?>" ><i class="fa fa-language"></i> EN</a>
            <?php endif; ?> 
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
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e($user->name); ?></span>
                  <img class="img-profile rounded-circle" src="uploads/avatars/<?php echo e($user->avatar); ?>">
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
              <?php if(app()->getLocale() == 'en'): ?>
                <h3 class="m-0 font-weight-bold text-primary"><?php echo e($user->name); ?>'s <?php echo e(__('messages.profile')); ?></h3>
              <?php elseif(app()->getLocale() == 'es'): ?>
                <h3 class="m-0 font-weight-bold text-primary"><?php echo e(__('messages.profile')); ?> de <?php echo e($user->name); ?></h3>
              <?php endif; ?>              
            </div>
            <div class="card-body">
              <div class="text-center">     
                <img src="uploads/avatars/<?php echo e($user->avatar); ?>" onerror="this.src='../uploads/avatars/avatar.png'" id="custom-img-button" width="150px" height="150px" style="border-radius:50%; cursor: pointer;  border-style:outset; border-width: 5px; border-color: #d63031 #0984e3">       
                <!--<img src="Gallery/avatar.png" height="150px" width="150px" class="avatar img-circle" alt="avatar">-->     
              </div>
              <form class="form-horizontal" action="<?php echo e(URL::to('/profile')); ?>" method="post" enctype="multipart/form-data">                   
                <br/>
                <div class="form-group">
                  <input type="file" class="alert alert-dark" name="avatar" id="avatar" hidden="hidden">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <div class="col-lg-10 col-sm-9 col-md-9 col-8" style="float: left; padding-right: 0">
                    <?php if(app()->getLocale() == 'en'): ?>
                      <span id="custom-text" style="cursor:pointer" class="form-control"><?php echo e(__('messages.file')); ?>.</span>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                      <span id="custom-text" style="cursor:pointer" class="form-control"><?php echo e(__('messages.file')); ?>.</span>
                    <?php endif; ?>                     
                  </div>
                  <div class="col-lg-2 col-sm-3 col-md-3 col-4" style="float: right; padding-left: 0">
                    <?php if(app()->getLocale() == 'en'): ?>
                      <span class="btn btn-success form-control" id="custom-button"><?php echo e(__('messages.file-btn')); ?></span>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                      <span class="btn btn-success form-control" id="custom-button"><?php echo e(__('messages.file-btn')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.name')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.name')); ?>:</label>
                  <?php endif; ?> 
                  <div class="col-lg-12">
                    <input disabled="true" class="form-control" type="text" placeholder="<?php echo e($user->name); ?>">
                  </div>
                </div>
                <div class="form-group">            
                  <?php
                    include 'conn.php';   
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                    $id = $user->id;            
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                    $row = mysqli_fetch_assoc($sql);
                  ?>
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label">Current <?php echo e(__('messages.username')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.username')); ?> Actual:</label>
                  <?php endif; ?> 
                  <div class="col-lg-12">                    
                    <input disabled="true" class="form-control" type="text" name="name" placeholder="<?=$row['username']?>">
                  </div>
                </div>
                <div class="form-group">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.username')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.username')); ?>:</label>
                  <?php endif; ?> 
                  <div class="col-lg-12">
                    <?php if(app()->getLocale() == 'en'): ?>
                      <input class="form-control" type="text" name="username" placeholder="<?php echo e(__('messages.username')); ?>">
                    <?php elseif(app()->getLocale() == 'es'): ?>
                      <input class="form-control" type="text" name="username" placeholder="<?php echo e(__('messages.username')); ?>">
                    <?php endif; ?>                 
                  </div>
                </div>    
                <!--<div class="form-group">
                  <label class="col-lg-3 control-label">Country:</label>
                  <div class="col-lg-8">
                    <div class="ui-select">
                      <select id="user_time_zone" class="form-control">
                        <option hidden='selected'>Select an option</option>
                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                        <option value="Alaska">(GMT-09:00) Alaska</option>
                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                        <option value="Arizona">(GMT-07:00) Arizona</option>
                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                        <option value="Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US &amp; Canada)</option>
                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                      </select>
                    </div>
                  </div>
                </div>-->
                <div class="form-group">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label">Actual <?php echo e(__('messages.password')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.password')); ?> Actual:</label>
                  <?php endif; ?> 
                  <div class="col-md-12">
                    <input class="form-control" name="apassword" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                  </div>
                </div>
                <div class="form-group">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.password')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.password')); ?>:</label>
                  <?php endif; ?>                  
                  <div class="col-md-12">
                    <input class="form-control" name="password" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                  </div>
                </div>
                <div class="form-group">
                  <?php if(app()->getLocale() == 'en'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.confirm')); ?><?php echo e(__('messages.password')); ?>:</label>
                  <?php elseif(app()->getLocale() == 'es'): ?>
                    <label class="col-md-3 control-label"><?php echo e(__('messages.confirm')); ?> la <?php echo e(__('messages.password')); ?>:</label>
                  <?php endif; ?>
                  <div class="col-md-12">
                    <input class="form-control" name="cpassword" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-12">
                    <?php if(app()->getLocale() == 'en'): ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="<?php echo e(__('messages.save-changes')); ?>">
                    <?php elseif(app()->getLocale() == 'es'): ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="<?php echo e(__('messages.save-changes')); ?>">
                    <?php endif; ?>
                    <span></span>
                    <?php if(app()->getLocale() == 'en'): ?>
                      <input type="reset" class="btn btn-secondary" value="<?php echo e(__('messages.reset')); ?>">
                    <?php elseif(app()->getLocale() == 'es'): ?>
                      <input type="reset" class="btn btn-secondary" value="<?php echo e(__('messages.reset')); ?>">
                    <?php endif; ?>                    
                  </div>
                </div>
              </form>
            </div>
          </div>

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
  <script>
    
    $(document).ready(function() {      

      $("form").on("mousemove", function() {
        var numu = 0;
        var nump = 0;
        var pass = document.getElementsByName("password");
        var cpass = document.getElementsByName("cpassword");
        $("input[type='text']").each(function(i) {
          if ($(this).val()) {
            numu++;
            if (numu == 1) {
              $("input[type='submit']").prop("disabled", false);
            } else {
              $("input[type='submit']").prop("disabled", true);
            }
          }
        });
        
        $("input[type='password'").each(function(i) {
          if ($(this).val()){
            if(pass != cpass){
              nump++;
              if (nump == 3) {
                $("input[type='submit']").prop("disabled", false);
              }else{
                $("input[type='submit']").prop("disabled", true);
              }
            }
            else if(pass != cpass){
              document.write("passwords not match");
            }
          }         
        });                     
        /*if (num == 3) {
          $("input[type='submit']").prop("disabled", false);
        } else {
          $("input[type='submit']").prop("disabled", true);
        }*/
      });   
      const realFileBtn = document.getElementById("avatar");
      const customBtn = document.getElementById("custom-button");
      const customTxt = document.getElementById("custom-text");
      const customImgBtn = document.getElementById("custom-img-button");

      customImgBtn.addEventListener("click", function(){
        realFileBtn.click();  
      });

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

</html>
<?php /**PATH D:\rainforest\resources\views/settings.blade.php ENDPATH**/ ?>