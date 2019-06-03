<template>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark bg-danger border-bottom" style="background-color:#6f42c1!important">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" title="Toggle"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="{name: 'Customers'}" class="nav-link">Customers</router-link>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="{name: 'Reports'}" class="nav-link">Reports</router-link>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="{name: 'Sale'}" class="nav-link">Sale</router-link>
                </li>
            </ul>

            <div class="form-inline ml-3">
                <div class="input-group input-group-sm">
                <!-- <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" @click="searchit">
                    <i class="fa fa-search"></i>
                    </button>
                </div> -->
                </div>
            </div>

            <!-- <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" title="Log Out"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log Out <i class="fas fa-power-off text-white"></i></a>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
            </ul> -->

        </nav>

        <aside class="main-sidebar elevation-4 sidebar-light-info">
            <a href="index3.html" class="brand-link bg-gray-light" title="Land Management System">
                <img src="/img/logo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Land MS</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="/img/profile/{{Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info">
                        <router-link :to="{name: 'Profile'}" class="d-block">
                        <!-- {{ Auth::user()->name }} -->
                        </router-link>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                            <router-link :to="{name: 'IncomeExpense'}" class="nav-link">
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
                        <li class="nav-item">
                            <router-link :to="{name: 'Staffs'}" class="nav-link">
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>Staffs</p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Management <i class="right fa fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <router-link :to="{name: 'Users'}" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Users</p>
                                </router-link>
                                </li>
                                <li class="nav-item">
                                <router-link :to="{name: 'Developer'}" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Developer</p>
                                </router-link>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Inactive Page</p>
                                </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <router-link :to="{name: 'Profile'}" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>Profile</p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <router-view></router-view>
                
                <vue-progress-bar></vue-progress-bar>
            </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
            </div>
            <strong>Copyright &copy; 2019. All rights reserved.</strong>
        </footer>
    </div>
</template>

<script>
export default {
    
}
</script>