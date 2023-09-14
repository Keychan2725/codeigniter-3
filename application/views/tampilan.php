<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>
<style>
.background {
    background-image: url(https://foto.data.kemdikbud.go.id/getImage/20328986/12.jpg);
    background-size: cover;

}

.background-image-black {
    height: 100vh;
    background-color: rgb(0, 0, 0, 0.4);
}
</style>

<body class="background ">
    <h1 class="my-5 fw-bold text-center">Selamat datang <?php echo $this->session->userdata('username') ?></h1>
    <a href="<?php echo base_url('Login/logout'); ?>" class="btn btn-primary">Log out</a>
    <div class="background-image-black  align-item-center" style="padding-top: 8%;">

        <h1 class="text-center text-white "><i>Pendaftaran Online</i></h1>
        <hr class="text-white">
        <center>
            <img class="" src="https://binusasmg.sch.id/ppdb/logobinusa.png" alt="" width="300px" height="250px">
        </center>
        <br>
        <h2 class="text-center text-white "><i>SMK BINA NUSANTARA</i></h2>
        <br>
        <h3 class="text-center text-danger">Cerdas Santun</h3>
        <h3 class="text-center text-white"> Berbudi Luhur </h3>
        <br>
        <div class="text-center text-white ">
            <a href="" class="btn btn-primary">Detail</a>
            <a href="login" class="btn btn-danger">Login</a>
        </div>

    </div>
</body>

</html>