<?php
require 'function.php';
$page = 0;
$sort = 'nim';
$order = 'asc';
if (isset($_GET["q"])) {
    $key = $_GET["q"];
    $mahasiswa = query("SELECT * FROM mahasiswa WHERE nama LIKE '%$key%' OR nim LIKE '%$key%' OR email LIKE '%$key%' OR fakultas LIKE '%$key%' ORDER BY nim");
} else if (isset($_GET['sort']) && isset($_GET['order'])) {
    $sort = $_GET['sort'];
    $order = $_GET['order'];
    $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY $sort $order");
} else {
    $halaman = 5;
    $page = isset($_GET["p"]) ? (int) $_GET["p"] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    $total = mysqli_num_rows($result);
    $pages = ceil($total / $halaman);
    $sql = "SELECT * FROM mahasiswa ORDER BY nim LIMIT $mulai,$halaman";
    $mahasiswa = query($sql);
    $no = $mulai + 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAK</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title cf">
                <div class="title-row">
                    <h2>Daftar <b>Mahasiswa<b></h2>
                </div>
                <div class="btn-row">
                    <a class="btn-add bg-green" href="add.php"><i class="fas fa-plus-circle fa-lg"></i>Tambah Data Mahasiswa</a>
                </div>
            </div>
            <div class="search-wrapper ">
                <div class=" field cf">
                    <div class="search-field f-left" style="width: 50%;">
                        <form action="" method="get">
                            <label for="cari" style="display:block;">Cari</label>
                            <input type="text" name="q" placeholder="<?php if (isset($_GET["q"])) echo $_GET["q"]; ?>">
                            <!-- <input class="btn-search" type="submit" value="Search" name="search"> -->
                            <button class="btn-search" type="submit">Search</button>
                            <!-- <input class="btn-reset" type="submit" value="Clear" name="reset" onclick="location.href='index.php';"> -->
                            <a href="./" class="btn">Clear</a>
                        </form>
                    </div>
                    <div class="sort-field f-left" style="width: 50%">
                        <form action="" method="get" class="cf" style="margin-left: 166px;">
                            <div class="f-left">
                                <label for="sort" style="display:block;">Sort</label>
                                <select name="sort" id="sort" style="width: 150px; margin-right: 3px">
                                    <option value="nim" <?= ($sort == "nim" ? 'selected' : ''); ?>>Nim</option>
                                    <option value="nama" <?= ($sort == "nama" ? 'selected' : ''); ?>>Nama</option>
                                    <option value="jenisKelamin" <?= ($sort == "jenisKelamin" ? 'selected' : ''); ?>>Jenis Kelamin</option>
                                    <option value="tglLahir" <?= ($sort == "tglLahir" ? 'selected' : ''); ?>>Tanggal Lahir</option>
                                    <option value="email" <?= ($sort == "email" ? 'selected' : ''); ?>>Email</option>
                                    <option value="fakultas" <?= ($sort == "fakultas" ? 'selected' : ''); ?>>Fakultas</option>
                                </select>
                            </div>
                            <div class="f-left">
                                <label for="order" style="display:block;">Order By</label>
                                <select name="order" id="order" style="width: 150px;">
                                    <option value="asc" <?= ($order == "asc" ? 'selected' : ''); ?>>Ascending</option>
                                    <option value="desc" <?= ($order == "desc" ? 'selected' : ''); ?>>Descending</option>
                                </select>
                                <button class="btn-search" type="submit">Sort</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-data">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Lahir</th>
                            <th>Email</th>
                            <th>Fakultas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($mahasiswa as $row) :
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row["nim"] ?></td>
                                <td><a href="detail.php?id=<?= $row["idMhs"] ?>"><?= $row["nama"] ?></a></td>
                                <td><?= $row["jenisKelamin"] ?></td>
                                <td><?= $row["tglLahir"] ?></td>
                                <td><?= $row["email"] ?></td>
                                <td><?= $row["fakultas"] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $row["idMhs"] ?>" class="edit"><i class="far fa-edit fa-lg"></i></a>
                                    <a href="delete.php?id=<?= $row["idMhs"] ?>" onclick="return confirm('Hapus Data?');" class="delete"><i class="fas fa-trash-alt fa-lg"></i></a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <?php if ($page) : ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <a href="?p=<?= $i; ?>" class="<?php if ($i == $page) {
                                                            echo ("active");
                                                        } ?>"><?= $i; ?></a>
                    <?php endfor ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>