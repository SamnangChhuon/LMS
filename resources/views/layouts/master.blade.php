<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>LMS | Land Management System</title>
  
  <link rel="icon" href="{{ asset('/img/logo.png') }}" type="image/png" sizes="16x16">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendor/cropperjs/css/cropper.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" title="Toggle"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/customer" class="nav-link">Customers</router-link>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <div class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div> --}}

        <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" title="Log Out"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off text-danger"></i></a>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" title="Land Management System">
      <img src="{{ asset('/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Land MS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/profile/' . Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link :to="{name: 'profile'}" class="d-block">
            {{ Auth::user()->name }}
          </router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'Reports'}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Reports</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'Customers'}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Customers</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'Products'}" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>Products</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'Income'}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>Income & Expense</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'Sale'}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Sale</p>
            </router-link>
          </li>

          @can('isAdmin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Management <i class="right fa fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'users'}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
              {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'developer'}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Developer</p>
            </router-link>
          </li>
          @endcan
          
          <li class="nav-item">
            <router-link :to="{name: 'profile'}" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>Profile</p>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <breadcrumbs></breadcrumbs>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <router-view></router-view>
      
      <vue-progress-bar></vue-progress-bar>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019. All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@auth
  <script>
  </script>
@endauth

<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/vendor/cropperjs/js/cropper.js') }}"></script>

</body>
</html>
