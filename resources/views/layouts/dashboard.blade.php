<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - Sistem Pengaduan RT RW</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>

    <link rel="icon" href="/img/logo.png" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center mt-4 mb-4" href="/dashboard">
                <div class="sidebar-brand-icon mb-3">
                    <img src="/img/logo.png" alt="Logo" style="width: 50px; height: 50px" />
                </div>
                <div class="sidebar-brand-text mx-3">Sistem Pengaduan RT RW</div>
            </a>

            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading mt-3">
                Pengaduan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/pengaduan">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Daftar Pengaduan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/dashboard/kategori">
                    <i class="fa-solid fa-tag"></i>
                    <span>Kategori</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

            @guard(['admin', 'petugas'])
                <!-- Heading -->
                <div class="sidebar-heading mt-3">
                    Pengguna
                </div>

                <!-- Nav Item - Charts -->

                @guard(['admin'])
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/petugas">
                            <i class="fa-solid fa-users"></i>
                            <span>Daftar Petugas</span></a>
                    </li>
                @endguard

                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/user">
                        <i class="fa-solid fa-user"></i>
                        <span>Daftar User</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block mt-3">
            @endguard


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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php $profile =
                                Auth::guard('user')->user() ??
                                (Auth::guard('admin')->user() ??
                                    Auth::guard('petugas')->user()); ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-inline text-gray-600 small">
                                    {{ $profile->nama }}
                                </span>

                                @if($profile->foto_profil)
                                    <img
                                        src="/storage/{{ $profile->foto_profil }}"
                                        alt="{{ $profile->nama }}"
                                        class="rounded-circle"
                                        style="width: 30px; height: 30px"
                                    />
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/dashboard/profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" onclick="clickLogout()">
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

                    <!-- Page Heading -->
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            @yield('title')
                        </h1>

                        <div class="mr-auto mt-2 mt-lg-0 mr-lg-0 ml-lg-auto">
                            @yield('actions')
                        </div>
                    </div>

                    @yield('content')

                    <div class="pb-4"></div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <script src="/js/main.js"></script>

    <script>
        function clickLogout() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan keluar dari sistem ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/auth/logout',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Anda telah berhasil keluar dari sistem ini.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/';
                            })
                        },
                        error: function (xhr) {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Gagal keluar dari sistem ini.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    })
                }
            })
        }
    </script>
    @yield('scripts')
</body>

</html>
