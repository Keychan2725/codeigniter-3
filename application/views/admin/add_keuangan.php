<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body class="min-vh-100 d-flex align-items-center ">


    <?php $this->load->view('component/sidebar') ?>


    <div class="card w-50 m-auto p-3">
        <h3 class="text-center ">Add Keuangan </h3>
        <br>
        <form action="<?php echo base_url('admin/aksi_add_keuangan')  ?>" method="post" class="row">
            <div class="mb-3 col-6">
                <label for="pemasukan" class="form-label">Pemasukan</label>
                <input type="number" placeholder="Rp" class="form-control" id="pemasukan" name="pemasukan">
            </div>
            <div class="mb-3 col-6">
                <label for="pengeluaran" class="form-label">Pengeluaran</label>
                <input type="number" placeholder="-Rp" class="form-control" id="pengeluaran" name="pengeluaran">
            </div>
            <div class="mb-3 col-6">
                <label for="tanggal" class="form-label"> Tanggal</label>
                <input type="date" placeholder="" class="form-control" id="tanggal" name="tanggal">
            </div>


            <br>
            <br>
            <div class="flex justify-content-between">
                <div>
                    <a href="<?php echo base_url('admin/keuangan'); ?>"
                        class=" flex items-center p-2 m-10 w-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2  rounded w-7/6">
                        <span>Kembali</span>
                    </a>
                </div>
                <div>
                    <button type="submit" onclick="jumlah(id)"
                        class="flex items-center p-2 m-10 w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded w-7/6"
                        name=" submit">Confirm</button>
                </div>
            </div>
        </form>
    </div>

</body>
<script>
function jumlah(id)
</script>

</html>