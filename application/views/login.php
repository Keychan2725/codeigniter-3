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


</head>

<body class="min-vh-100 d-flex align-items-center bg-primary">
    <div class="card w-50 m-auto p-3">
        <h3 class="text-center">Login </h3>
        <br>
        <center>

            <img src="https://binusasmg.sch.id/ppdb/logobinusa.png" alt="" width="150px" height="130px">
            <br>
            <br>
            <h5>SMK BINA NUSANTARA</h5>
        </center>
        <br>
        <h6>Silahkan login ke akun anda</h6>
        <br>
        <form action="<?php echo base_url(); ?>Login/aksi_login" method="post" class="space-y-12">
            <div class="mb-3">
                <label for="nama" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Email" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Password</label>
                <input type="text" class="form-control" placeholder="Password" id="password" name="password">
            </div>

            don't have an <a href="tampilan" class="alert-link">account yet</a>?
            <br>
            <br>


            <button type="submit" class="btn btn-dark" name="submit">Login</button>
        </form>
    </div>

</body>
<script>

</script>

</html>