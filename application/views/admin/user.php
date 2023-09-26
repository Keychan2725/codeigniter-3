<!DOCTYPE html>
<html lang="en">

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

<body class="min-vh-100 d-flex align-items-center">
    <?php $no = 0;
    foreach ($user as $row) : $no++ ?>

    <?php $this->load->view('component/sidebar') ?>
    <div class="card w-50 m-auto p-3 ">
        <h3 class="text-center fs-1">Akun <?php echo $this->session->userdata('username'); ?> </h3>
        <br>
        <div><?php $this->session->flashdata('message') ?></div>
        <div class="row d-flex">
            <form method="post" action="<?php echo base_url('admin/aksi_ubah_akun') ?>" enctype="multipart/form_data">
                <input name="id_siswa" type="hidden" value="<?php echo $row->id ?>">
                <div class="d-flex flex-row ">

                    <div class="p-2 col-6">
                        <label for="" class="form-label fs-5 ">Email </label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                            value="<?php echo $row->email ?>">
                    </div>
                    <div class="p-2 col-6">
                        <label for="" class="form-label fs-5">Username </label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            value="<?php echo $row->username ?>">
                    </div>
                </div>
                <br>
                <br>
                <div class="d-flex flex-row ">
                    <div class="p-2 col-6 >
                    <label for=" nama="" class="form-label fs-5">Password Baru </label>
                        <input type="text" class="form-control" id="password_baru" name="password_baru"
                            placeholder="Password Baru" value=>
                    </div>
                    <div class="p-2 col-6 >
                    <label for=" nama="" class="form-label fs-5"> Konfirmasi password</label>
                        <input type="text" class="form-control" id="password_konfirmasi" name="password_konfirmasi"
                            placeholder="Konfirmasi Paswword" value=>
                    </div>
                </div>








        </div>
        <div class="flex justify-content-between">
            <div>
                <a href="<?php echo base_url('admin/daftar_siswa'); ?>"
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

</body>
<script>

</script>

</html>