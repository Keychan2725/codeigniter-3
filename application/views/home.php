<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>

<body>
    <h1 style="text-align: center;">Welcome to codeigniter 3</h1>
    <table border="1">
        <tr>

            <th>No</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php $no = 0;
        foreach ($user as $row) : $no++ ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->email ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <table border="1">
        <tr>

            <th>No</th>
            <th>Nama Siswa</th>
            <th>NISN</th>
            <th>Gender</th>
            <th>Kelas</th>
        </tr>
        <br>
        <?php $no = 0;
        foreach ($nama as $row) : $no++ ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->nama_siswa ?></td>
                <td><?php echo $row->nisn ?></td>
                <td><?php echo $row->gender ?></td>
                <td><?php echo tampil_full_kelas_byid($row->id_kelas) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>