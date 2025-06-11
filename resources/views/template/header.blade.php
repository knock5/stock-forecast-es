<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BUBIN CATERING</title>
  <!-- <link rel="shortcut icon" type="image/png" href="{{asset('user5/images/logo.png')}}" /> -->
  <link rel="stylesheet" href="{{asset('user5/css/styles.min.css')}}" />
  <!-- <link href="assets/js/leaflet-routing-machine/dist/leaflet-routing-machine.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.dataTables.css">
 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
 
</head>

<body>
@include('sweetalert::alert')


  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
          <a href="#" class="text-nowrap logo-img">
            <!-- <img src="assets/images/logo.png" width="50" alt="" /> -->
          </a>
          <h5 class="ms-2 fw-bold"> BUBIN CATERING</h5>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Dashboard</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/dataset')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Data Stok Barang</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/masuk')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Data Masuk Barang</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/keluar')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Data Keluar Barang</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/prediksi')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Prediksi</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/akun')}}" aria-expanded="false">
      <span>
        <i class="ti ti-layout-dashboard"></i>
      </span>
      <span class="hide-menu">Data Akun</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="{{url('/akun')}}" aria-expanded="false">
      <span>
      <i class="ti ti-login"></i>
      </span>
      <span class="hide-menu">Logout</span>
    </a>
  </li>
  
 
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>

    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
             
              
            </ul>
          </div>
        </nav>
      </header>

      <div class="container-fluid">