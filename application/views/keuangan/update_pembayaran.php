<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body class="min-vh-100 d-flex align-items-center">
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


    <div class="card w-50 m-auto p-3">
        <h3 class="text-center">Update Data </h3>
        <?php foreach ($pembayaran as $data_pembayaran) : ?>
        <form method="post" action="<?php echo base_url('Keuangan/aksi_update_pembayaran') ?>"
            enctype="multipart/form_data">
            <input name="id" type="hidden" value="<?php echo $data_pembayaran->id ?>">
            <div class="mb-3 col-6">
                <label for="kelas" class="form-label">Siswa</label>
                <select name="id_siswa" class="form-select">
                    <option selected value="<?php echo $data_pembayaran->id_siswa ?>">
                        <?php echo tampil_full_siswa($data_pembayaran->id_siswa) ?></option>
                    <?php foreach ($siswa as $row) : ?>
                    <option value="<?php echo tampil_full_siswa($row->id_siswa) ?>">
                        <?php echo $row->nama_siswa ?>
                    </option>
                    <?php endforeach ?>
                </select>

            </div>
            <!-- <div class="mb-3 col-6">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select">
                    <option selected value="<?php echo $data_pembayaran->id_kelas ?>">
                        <?php echo tampil_full_kelas_byid($data_pembayaran->id_kelas) ?></option>
                    <?php foreach ($kelas as $row) : ?>
                    <option value="<?php echo $row->id ?>">
                        <?php echo $row->tingkat_kelas . ' ' . $row->jurusan_kelas ?>
                    </option>
                    <?php endforeach ?>
                </select>

            </div> -->
            <div class="mb-3 col-6">
                <label for="kelas" class="form-label">Jenis Pembayaran</label>
                <select name="jenis_pembayaran" class="form-select">
                    <option selected value="<?php echo $data_pembayaran->jenis_pembayaran ?>">
                        <?php echo $data_pembayaran->jenis_pembayaran ?></option>
                    <option value="Pembayaran SPP ">Pembayaran SPP</option>
                    <option value="Pembayaran Uang Gedung ">Pembayaran Uang Gedung</option>
                    <option value="Pembayaran Seragam ">Pembayaran Seragam</option>
                </select>

            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                    <input type="text" class="form-control" id="total_pembayaran" name="total_pembayaran"
                        value="<?php echo $data_pembayaran->total_pembayaran ?> ">
                </div>



                <div class="flex justify-content-between">
                    <div>
                        <a href="<?php echo base_url('keuangan/pembayaran'); ?>"
                            class=" flex items-center p-2 m-10 w-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2  rounded w-7/6">
                            <span>Kembali</span>
                        </a>
                    </div>
                    <div>
                        <button type="submit"
                            class="flex items-center p-2 m-10 w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded w-7/6"
                            name=" submit">Confirm</button>
                    </div>
                </div>

        </form>
        <?php endforeach ?>
    </div>
    </div>
</body>
<script>

</script>

</html>