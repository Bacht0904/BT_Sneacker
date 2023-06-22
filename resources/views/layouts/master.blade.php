
<!DOCTYPE html>
<html lang="en">
    @section('head')
    <head>
        {{-- {!! Assets::renderHeader() !!} --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Graceful - @yield('title')</title>
        {{-- datepicker css --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-web.png') }}" type="image/x-icon">
    </head>
    @show
    <style>
        div.dataTables_wrapper div.dataTables_length select{
            width:50px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
            border:none !important;
            background: none !important;
        }
        body{
            color:#000;
        }
        body label{
            font-weight: 700;
            color: #333;
        }
        .modal-delete {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            /*overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-delete-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 20%;

            }

            /* The Close Button */
            .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            }

            .close:hover,
            .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            }
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            table th,
            table td{
                text-align:center;
                color:#000;
            }

    </style>
    <body  id="page-top">

        <!-- Page Wrapper -->
        <div  id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="{{ asset('assets/img/logo-web.svg') }}" alt="" width="60">
                    </div>
                    <div class="sidebar-brand-text mx-3">BT Sports Admin </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                @if (Auth::user()->role == 1)
                    {{-- brand --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand_m"
                            aria-expanded="true" aria-controls="brand">
                            <i class="fa-solid fa-building"></i>
                            <span>Thương hiệu</span>
                        </a>
                        <div id="brand_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-brand') }}">Danh sách thương hiệu</a>
                                <a class="collapse-item" href="{{ route('get-CreateBrand') }}">Thêm thương hiệu</a>
                            </div>
                        </div>
                    </li>
                    {{-- danh muc --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category_m"
                            aria-expanded="true" aria-controls="category">
                            <i class="fa-solid fa-list-check"></i>
                            <span>Danh mục</span>
                        </a>
                        <div id="category_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-category') }}">Danh sách danh mục</a>
                                <a class="collapse-item" href="{{ route('get-CreateCategory') }}">Thêm danh mục</a>
                            </div>
                        </div>
                    </li>
                    {{-- loai san pham --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_type_m"
                            aria-expanded="true" aria-controls="product_type">
                            <i class="fa-solid fa-cubes"></i>
                            <span>Loại sản phẩm</span>
                        </a>
                        <div id="product_type_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-productType') }}">Danh sách loại</a>
                                <a class="collapse-item" href="{{ route('get-CreateProductType') }}">Thêm loại</a>
                            </div>
                        </div>
                    </li>
                    {{-- San pham --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_m"
                            aria-expanded="true" aria-controls="product">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span>Sản phẩm</span>
                        </a>
                        <div id="product_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('products') }}">Danh sách sản phẩm</a>
                                <a class="collapse-item" href="{{ route('get-AddProduct') }}">Thêm sản phẩm mới</a>
                            </div>
                        </div>
                    </li>
                    {{-- slide --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#slide_m"
                            aria-expanded="true" aria-controls="slide">
                            <i class="fa-solid fa-tag"></i>
                            <span>Slide</span>
                        </a>
                        <div id="slide_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-slide') }}">Danh sách slide</a>
                                <a class="collapse-item" href="{{ route('get-CreateSlide') }}">Thêm slide</a>
                            </div>
                        </div>
                    </li>
                    {{-- don hang --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-invoice') }}">
                            <i class="fa-solid fa-box"></i>
                            <span>Danh sách đơn hàng</span>
                        </a>
                    </li>
                    {{-- Voucher --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#voucher_m"
                            aria-expanded="true" aria-controls="voucher">
                            <i class="fa-solid fa-tag"></i>
                            <span>Voucher</span>
                        </a>
                        <div id="voucher_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-voucher') }}">Danh sách voucher</a>
                                <a class="collapse-item" href="{{ route('get-CreateVoucher') }}">Thêm voucher</a>
                            </div>
                        </div>
                    </li>
                    {{-- feedback --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-feedback') }}">
                            <i class="fa-solid fa-comments"></i>
                            <span>Feedbacks</span>
                        </a>
                    </li>
                    {{-- role --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-role') }}">
                            <i class="fa-solid fa-user-gear"></i>
                            <span>Role</span>
                        </a>
                    </li>
                    {{-- user --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user_m"
                            aria-expanded="true" aria-controls="user">
                            <i class="fa-solid fa-user"></i>
                            <span>Người dùng</span>
                        </a>
                        <div id="user_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-user') }}">Danh sách người dùng</a>
                                <a class="collapse-item" href="{{ route('get-CreateAccount') }}">Thêm người dùng</a>
                            </div>
                        </div>
                    </li>
                    {{-- thong tin cua hang --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info-store') }}">
                            <i class="fa-solid fa-store"></i>
                            <span>Thông tin cửa hàng</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 2)
                    {{-- San pham --}}
                    {{-- brand --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand_m"
                            aria-expanded="true" aria-controls="brand">
                            <i class="fa-solid fa-building"></i>
                            <span>Thương hiệu</span>
                        </a>
                        <div id="brand_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-brand') }}">Danh sách thương hiệu</a>
                                <a class="collapse-item" href="{{ route('get-CreateBrand') }}">Thêm thương hiệu</a>
                            </div>
                        </div>
                    </li>
                    {{-- danh muc --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category_m"
                            aria-expanded="true" aria-controls="category">
                            <i class="fa-solid fa-list-check"></i>
                            <span>Danh mục</span>
                        </a>
                        <div id="category_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-category') }}">Danh sách danh mục</a>
                                <a class="collapse-item" href="{{ route('get-CreateCategory') }}">Thêm danh mục</a>
                            </div>
                        </div>
                    </li>
                    {{-- loai san pham --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_type_m"
                            aria-expanded="true" aria-controls="product_type">
                            <i class="fa-solid fa-cubes"></i>
                            <span>Loại sản phẩm</span>
                        </a>
                        <div id="product_type_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-productType') }}">Danh sách loại</a>
                                <a class="collapse-item" href="{{ route('get-CreateProductType') }}">Thêm loại</a>
                            </div>
                        </div>
                    </li>
                    {{-- San pham --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_m"
                            aria-expanded="true" aria-controls="product">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span>Sản phẩm</span>
                        </a>
                        <div id="product_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('products') }}">Danh sách sản phẩm</a>
                                <a class="collapse-item" href="{{ route('get-AddProduct') }}">Thêm sản phẩm mới</a>
                            </div>
                        </div>
                    </li>
                    {{-- slide --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#slide_m"
                            aria-expanded="true" aria-controls="slide">
                            <i class="fa-solid fa-tag"></i>
                            <span>Slide</span>
                        </a>
                        <div id="slide_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-slide') }}">Danh sách slide</a>
                                <a class="collapse-item" href="{{ route('get-CreateSlide') }}">Thêm slide</a>
                            </div>
                        </div>
                    </li>
                    {{-- don hang --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-invoice') }}">
                            <i class="fa-solid fa-box"></i>
                            <span>Danh sách đơn hàng</span>
                        </a>
                    </li>
                    {{-- Voucher --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#voucher_m"
                            aria-expanded="true" aria-controls="voucher">
                            <i class="fa-solid fa-tag"></i>
                            <span>Voucher</span>
                        </a>
                        <div id="voucher_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-voucher') }}">Danh sách voucher</a>
                                <a class="collapse-item" href="{{ route('get-CreateVoucher') }}">Thêm voucher</a>
                            </div>
                        </div>
                    </li>
                    {{-- feedback --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-feedback') }}">
                            <i class="fa-solid fa-comments"></i>
                            <span>Feedbacks</span>
                        </a>
                    </li>
                    {{-- user --}}
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user_m"
                            aria-expanded="true" aria-controls="user">
                            <i class="fa-solid fa-user"></i>
                            <span>Người dùng</span>
                        </a>
                        <div id="user_m" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Danh sách chức năng:</h6>
                                <a class="collapse-item" href="{{ route('list-user') }}">Danh sách người dùng</a>
                            </div>
                        </div>
                    </li>
                    {{-- thong tin cua hang --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('info-store') }}">
                            <i class="fa-solid fa-store"></i>
                            <span>Thông tin cửa hàng</span>
                        </a>
                    </li>
                @endif

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>


                        <h2>Hi! {{ Auth::User()->full_name }}</h2>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                            </li> --}}

                            <!-- Nav Item - Alerts -->
                            {{-- <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
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
                            </li> --}}

                            <!-- Nav Item - Messages -->
                            {{-- <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_1.svg') }}"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_2.svg') }}"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how
                                                would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_3.svg') }}"
                                                alt="...">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                                the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                                told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li> --}}

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::User()->full_name }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('assets/img/users') }}/{{ Auth::User()->avatar }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('get-Profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Tài khoản
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đổi mật khẩu
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>

                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Bạn có chắc đăng xuất?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{route('login')}}">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
@show

@section('script')
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
{{-- datepicker --}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

{{-- <script src="{{ asset('assets/ckeditor/build/ckeditor.js') }}"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
{{-- <script>
ClassicEditor
    .create( document.querySelector( '.editor' ), {

        licenseKey: '',



    } )
    .then( editor => {
        window.editor = editor;




    } )
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: p8v55eincfpa-2rypji8si6vw' );
        console.error( error );
    } );
</script> --}}
<script src="{{ asset('assets/ckeditor5/ckeditor.js') }}"></script>
<script>
    const watchdog = new CKSource.EditorWatchdog();

    window.watchdog = watchdog;

    watchdog.setCreator((element, config) => {
        return CKSource.Editor
            .create(element, config)
            .then(editor => {




                return editor;
            })
    });

    watchdog.setDestructor(editor => {



        return editor.destroy();
    });

    watchdog.on('error', handleError);

    watchdog
        .create(document.querySelector('.editor'), {

            licenseKey: '',



        })
        .catch(handleError);

    function handleError(error) {
        console.error('Oops, something went wrong!');
        console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
        console.warn('Build id: htigd95egk9l-6d7xove9x7ie');
        console.error(error);
    }
</script>

@show
