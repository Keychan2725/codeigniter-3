<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body class="min-vh-100 d-flex align-items-center">
    <?php $this->load->view('component/sidebar') ?>
    <div class="card w-50 m-auto p-3">
        <h3 class="text-center">Update Data </h3>
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value=" ">
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="nama" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" value=" ">
                </div>
                <div class="mb-3 col-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option selected>Pilih Gender</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" class="form-select">
                        <option selected>Pilih Kelas</option>
                        <?php foreach ($kelas as $row) : ?>
                            <option value="<?php echo $row->id ?>">
                                <?php echo $row->tingkat_kelas . ' ' . $row->jurusan_kelas ?>
                            </option>
                        <?php endforeach ?>
                    </select>

                </div>
                <button type="submit" class="flex items-center p-2 m-10 w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded w-7/6" name="submit">Confirm</button>
        </form>
    </div>

</body>
<script>

</script>

</html>