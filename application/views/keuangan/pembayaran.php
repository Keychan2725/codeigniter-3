<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
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

                        <span class="flex-1 ml-3 whitespace-nowrap"> Data Pembayaran </span>

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
    <div class="p-7 sm:ml-64">
        <div class="card text-bg-light mb-3" width="100%">
            <div class="card-header fs-3">Data Pembayaran</div>
            <div class="card-body">
                <a href="<?php echo base_url('keuangan/tambah_pembayaran') ?>"
                    class="inline-block rounded bg-sky-600 px-4 py-2  text-xs font-medium text-white hover:bg-sky-700 text-center btn btn-primary">Tambah</a>


                <a href="<?php echo base_url('keuangan/export') ?>"
                    class="  inline-block rounded bg-green-600 px-4 py-2  text-xs font-medium text-white hover:bg-green-700 text-center btn btn-success">Export</a>
                <button type="button"
                    class="inline-block rounded bg-sky-400 px-4 py-2  text-xs font-medium text-white hover:bg-sky-500 text-center btn btn-info"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import
                </button>
                <table class="table table-striped table-hover">




                    <thead class="fs-5">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Siswa</th>
                            <!-- <th scope="col">Kelas</th> -->
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0; foreach ($pembayaran as $data ): $no++ ?>
                        <tr>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $no ?></td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo tampil_full_siswa($data->id_siswa) ?></td>
                            <!-- <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo tampil_full_kelas_byid($data->id_kelas) ?></td> -->
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $data->jenis_pembayaran ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo convRupiah($data->total_pembayaran) ?>
                            </td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <a href="<?php echo base_url('keuangan/update_pembayaran/') . $data->id ?>"
                                    class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700">Ubah</a>

                                <button onclick="hapus(<?php echo $data->id ?>)"
                                    class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">Hapus</button>

                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>

                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import File</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> -->
                    </div>
                    <form action="<?php echo base_url('keuangan/import') ?>" method="post"
                        enctype="multipart/form-data">

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
    </div>
</body>
<script>
function hapus(id) {
    var yes = confirm("Yakin Ingin Menghapus Data Anda")
    if (yes === true) {
        window.location.href = "<?php echo base_url('keuangan/hapus_data/') ?>" + id;
    }
}
</script>

</html>