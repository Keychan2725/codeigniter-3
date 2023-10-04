<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</head>

<body>






    <button data-drawer-target=" default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
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
                    <a href="<?php echo base_url('admin/index') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/daftar_siswa') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Daftar Siswa</span>

                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/user') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Account</span>

                    </a>
                </li>



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
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">.......</a></li>
                        <li><a class="dropdown-item" href="#">.......</a></li>
                        <li><a class="dropdown-item" href="#">.......</a></li>
                    </div>
                </div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        name="search">

                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <h1 class="p-4"><i>Daftar Siswa</i></h1>
        <br>

        <div class="row ">
            <div class="col-12 card p-2">
                <div class="card-body min-vh-100  align-items-center">
                    <a href="<?php echo base_url('admin/tambah_siswa') ?>"
                        class="inline-block rounded bg-sky-600 px-4 py-2  text-xs font-medium text-white hover:bg-sky-700 text-center btn btn-primary">Tambah</a>


                    <a href="<?php echo base_url('admin/export') ?>"
                        class="  inline-block rounded bg-green-600 px-4 py-2  text-xs font-medium text-white hover:bg-green-700 text-center btn btn-success">Export</a>
                    <button type="button"
                        class="inline-block rounded bg-sky-400 px-4 py-2  text-xs font-medium text-white hover:bg-sky-500 text-center btn btn-info"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import
                    </button>
                    <div class="card w-100 m-auto p-2">
                        <table class="table  table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No </th>
                                    <th scope="col">Nama </th>
                                    <th scope="col">Foto Siswa </th>
                                    <th scope="col">NISN </th>
                                    <th scope="col"> Gender </th>
                                    <th scope="col"> Kelas </th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($siswa as $row) : $no++
                                ?>
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $no ?></td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <?php echo $row->nama_siswa ?></td>

                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <img src="<?php echo base_url('images/siswa/'.$row->foto) ?>" width="50">
                                    </td>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->nisn ?></td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->gender ?>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <?php echo tampil_full_kelas_byid($row->id_kelas) ?>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <a href="<?php echo base_url('admin/update/') . $row->id_siswa ?>"
                                            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700">Ubah</a>

                                        <button onclick="hapus(<?php echo $row->id_siswa ?>)"
                                            class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">Hapus</button>
                                    </td>

                                </tr><?php endforeach ?>

                            </tbody>
                        </table>

                    </div>
                    </form>

                    <script>
                    function hapus(id) {
                        var yes = confirm("Yakin Ingin Menghapus Data Anda")
                        if (yes === true) {
                            window.location.href = "<?php echo base_url('admin/hapus_siswa/') ?>" + id;
                        }
                    }
                    </script>


                </div>
            </div>

        </div>
        <br>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import File</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> -->
                    </div>
                    <form action="<?php echo base_url('admin/import') ?>" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input name="file" type="file">
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700"
                                data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="import"
                                class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
                                Value="Import" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>








</body>

</html>