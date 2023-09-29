<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</head>

<body>





    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>

    </button>
    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?php echo base_url('keuangan/index')?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('keuangan/pembayaran') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap"> Data Pembayaran</span>

                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url('keuangan/') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Pemabayaran Uang Gedung</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('keuangan/') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Pemabayaran Seragam</span>

                    </a>
                </li> -->



                <li>

                    <a href="<?php echo base_url('Login/logout'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a href="">Navbar</a>
                <ul class="d-flex p-2 ">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">......</a></li>
                        <li><a class="dropdown-item" href="#">......</a></li>
                        <li><a class="dropdown-item" href="#">......</a></li>
                    </div>
                </div>

            </div>
        </nav>
        <!-- <h1 class="p-4"><i>Dashboard Sekolah</i></h1> -->
        <br>

        <div class="row p-4">
            <div class=" col-3 card p-2">
                <div class="card-body">
                    <p class="fs-4">Pemabayaran SPP</p>
                    <hr>
                    <br>
                    <h5 class="mb-0">
                        <strong class="fs-2">200 Siswa </strong>
                        <small class="text-success ms-2">
                            Rp. <i class="fas fa-arrow-down fa-sm pe-1">45.890.000 </i></small>
                    </h5>
                    <br>
                    <a href="#" class="btn btn-primary d-grid gap-2">Data Lengkap</a>
                </div>
            </div>
            <br>
            <div class=" col-3 card p-2">
                <div class="card-body">
                    <p class="fs-4">Pembayaran Uang Gedung</p>
                    <hr>
                    <br>
                    <h5 class="mb-0">
                        <strong class="fs-2">200 Siswa</strong>
                        <small class="text-success ms-2">
                            Rp. <i class="fas fa-arrow-down fa-sm pe-1">56.790.000</i></small>
                    </h5>
                    <br>
                    <a href="" class="btn btn-primary d-grid gap-2">Data
                        Lengkap</a>
                </div>
            </div>
            <br>
            <div class=" col-3 card p-2">
                <div class="card-body">
                    <p class="fs-4">Pembayaran Seragam</p>
                    <hr>
                    <br>
                    <h5 class="mb-0">
                        <strong class="fs-2">200 Siswa</strong>
                        <small class="text-success ms-2">
                            Rp. <i class="fas fa-arrow-down fa-sm pe-1">36.659.000</i></small>
                    </h5>
                    <br>
                    <a href="#" class="btn btn-primary d-grid gap-2">Data Lengkap</a>
                </div>
            </div>
            <!-- <div class=" col-3 card p-2">
                <div class="card-body">
                    <p>Guru</p>
                    <h5 class="mb-0">
                        <strong class="fs-1"></strong>
                        <small class="text-danger ms-2">
                            <i class="fas fa-arrow-down fa-sm pe-1"></i></small>
                    </h5>
                    <a href="#" class="btn btn-primary d-grid gap-2">Data Lengkap</a>
                </div>
            </div>
            <div class=" col-3 card p-2">
                <div class="card-body">

                    <p>Keuangan</p>
                    <h5 class="mb-0">
                        <strong class="fs-1"><?php echo $keuangan ?></strong>
                        <small class="text-success ms-2">
                            <i class="fas fa-arrow-down fa-sm pe-1">RP.20.0000</i></small>
                        <small class="text-danger ms-2">
                            <i class="fas fa-arrow-down fa-sm pe-1">- RP.50.0000</i></small>
                        <small class="text-info ms-2">
                            <i class="fas fa-arrow-down fa-sm pe-1">Per 23/09/28</i></small>
                    </h5>

                    <br>
                    <hr>
                    <br>
                    <a href="<?php echo base_url('admin/keuangan') ?>" class="btn btn-primary d-grid gap-2">Data
                        Lengkap</a>
                </div>
            </div> -->
        </div>
        <br>


    </div>
</body>

</html>