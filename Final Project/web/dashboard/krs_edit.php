<?php

include "dashboard.php";

$nama = $_SESSION['nama'];
$role = $_SESSION['role'];

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION["role"] == "0") {
    header("Location: index.php");
    exit;
} elseif ($_SESSION["role"] == "2") {
    header("Location: index.php");
    exit;
}

$querySemester = mysqli_query($koneksi, "SELECT * FROM semester");
$queryMatakuliah = mysqli_query($koneksi, "SELECT * FROM matakuliah");

if (isset($_GET['id_krs'])) {
    $id_krs = $_GET['id_krs'];
    $queryKrs = mysqli_query($koneksi, "SELECT * FROM krs WHERE id_krs=$id_krs");
    $krs = mysqli_fetch_assoc($queryKrs);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Sistem Informasi Udayana</title>
    <link href="../src/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Sistem Perkuliahan</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Hai, <?= $nama; ?> </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <?php if ($role == "1") { ?>
                        <a class="dropdown-item" href="profil_mahasiswa.php">Lihat Profil</a>
                    <?php } elseif ($role == "2") { ?>
                        <a class="dropdown-item" href="profil_dosen.php">Lihat Profil</a>
                    <?php } elseif ($role == "0") { ?>
                        <a class="dropdown-item" href="profil_admin.php">Lihat Profil</a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="mahasiswa.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Daftar Mahasiswa
                        </a>
                        <a class="nav-link" href="dosen.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Daftar Dosen
                        </a>
                        <a class="nav-link" href="kelas.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                            Daftar Kelas
                        </a>
                        <a class="nav-link" href="bimbingan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                            Daftar Bimbingan
                        </a>
                        <?php if ($role == "0") { ?>
                            <a class="nav-link" href="matakuliah.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Matakuliah
                            </a>
                        <?php } ?>
                        <?php if ($role == "1") { ?>
                            <a class="nav-link active" href="krs.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-copy"></i></div>
                                KRS
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h3 class="mt-4">Edit KRS Mahasiswa</h3>
                    <div class="card mb-4">

                        <form action="function.php?act=tambahMatkul" id="tambah" method="POST">
                            <div class="form-group ml-4 ">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="semester" id="semester" class="form-control col-sm-3">
                                    <?php while ($semester = mysqli_fetch_assoc($querySemester)) { ?>
                                        <option value="<?= $semester['id_semester'] ?>" <?php echo ($semester['id_semester'] == $krs['id_semester']) ? 'selected' : ''; ?>><?= $semester['semester'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group ml-4 ">
                                <label for="mahasiswa" class="form-label">Matakuliah</label>
                                <select name="mahasiswa" id="mahasiswa" class="form-control col-sm-3">
                                    <option value="">Pilih Matakuliah</option>
                                    <?php while ($matakuliah = mysqli_fetch_assoc($queryMatakuliah)) { ?>
                                        <option value="<?= $matakuliah["id_mk"]; ?>" <?php echo ($matakuliah['id_mk'] == $krs['id_mk']) ? 'selected' : ''; ?>><?= $matakuliah["matakuliah"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary ml-4 mb-3" value="Edit Matakuliah">
                        </form>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistem Informasi Udayana 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>