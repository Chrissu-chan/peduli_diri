
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Peduli Diri - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{  asset('assets/img/peduli_diri.svg')  }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/fontawesome/css/all.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/swal/dist/sweetalert2.min.css')}} ">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}} ">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" class="navbar-brand sidebar-gone-hide">PEDULI DIRI</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
            
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if(Auth::user()->avatar)
                            <img alt="image" src="{{ asset('assets/images/' . Auth::user()->avatar) }}" class="rounded-circle">
                            @else
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle">
                            @endif
                            <div class="d-sm-none d-lg-inline-block">{{ ucwords(Auth::user()->username) }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile', Auth::user()->id) }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="javascript:void(0)" onclick="logout()" role="button" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        @if (Auth::user()->role == "admin")
                            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-home"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-item {{ Request::is('perjalanan') ? 'active' : '' }}">
                                <a href="{{ route('destinasi.index') }}" class="nav-link"><i class="fas fa-clipboard"></i><span>Destinasi</span></a>
                            </li>
                            <!-- <li class="nav-item {{ Request::is('perjalanan/create') ? 'active' : '' }}">
                                <a href="{{ route('perjalanan.create') }}" class="nav-link"><i class="fas fa-book-open"></i><span>Data Pengguna</span></a>
                            </li> -->
                        @endif
                        @if (Auth::user()->role == 'user')
                            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-home"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-item {{ Request::is('scanner') ? 'active' : '' }}">
                                <a href="{{ route('scanner') }}" class="nav-link"><i class="fas fa-qrcode"></i><span>Scan QR</span></a>
                            </li>
                            <li class="nav-item {{ Request::is('perjalanan') ? 'active' : '' }}">
                                <a href="{{ route('perjalanan') }}" class="nav-link"><i class="fas fa-user"></i><span>Data Perjalanan</span></a>
                            </li>
                        @endif
                    </ul>
                    <!-- <img src="{{ asset('assets/img/peduli_diri.svg') }}" alt="logo" width="180" class="mb-5 mt-5 img-responsive"> -->
                </div>
            </nav>

            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet">Develop By Chrismadhani Adirangga, Fork to <a href="https://github.com/bayudiartaa" target="_blank">Bayudiarta</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
        
    <!-- General JS Scripts -->
    <script src="{{asset('assets/third-party/jquery.min.js')}}"></script>
    <script src="{{asset('assets/third-party/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/third-party/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/third-party/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/node_modules/swal/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.uploadPreview.min.js')}}"></script>
    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{ asset('assets/node_modules/instascan.min.js') }}"></script>
    @yield('script')
    <script>
        function logout() {
            Swal.fire({
            title: 'Apakah anda yakin akan Keluar?',
            icon: 'warning',
            showCancelButton: false,
            showConfirmButton: false,
            html : '<a href="{{ route('logout') }}" class="btn btn-info btn-lg">Keluar</a> <button href="javascript:void(0)" onclick="swal.close()" class="btn btn-danger btn-lg">Batal</button>'            
            });
        }
    </script>
</body>
</html>
    