<?php
include "../function.php";

if (isset($_GET["act"])) {
    $act = $_GET['act'];
    if ($act == "ikutKelas") {
        ikutKelas();
    } else if ($act == "tambahKRS") {
        tambahKRS();
    } else if ($act == "editProfil") {
        $id_mahasiswa = $_GET["id_mahasiswa"];
        editProfil($id_mahasiswa);
    } else if ($act == "buatKelas") {
        buatKelas();
    } else if ($act == "editKelas") {
        $id_kelas = $_GET["id_kelas"];
        editKelas($id_kelas);
    } else if ($act == "edit_dosen") {
        $id_dosen = $_GET["id_dosen"];
        edit_dosen($id_dosen);
    } else if ($act == "editMahasiswa") {
        $id_mahasiswa = $_GET["id_mahasiswa"];
        editMahasiswa($id_mahasiswa);
    } else if ($act == "editBimbingan") {
        $id_bimbingan = $_GET["id_bimbingan"];
        editBimbingan($id_bimbingan);
    } else if ($act == "hapusBimbingan") {
        $id_bimbingan = $_GET["id_bimbingan"];
        hapusBimbingan($id_bimbingan);
    } else if ($act == "bimbinganPA") {
        bimbinganPA();
    } else if ($act == "hapusMatkul") {
        $id_mk = $_GET['id_mk'];
        hapusMatkul($id_mk);
    } else if ($act == "tambahMatkul") {
        tambahMatkul();
    } else if ($act == 'hapusKRS') {
        $id_krs = $_GET['id_krs'];
        hapusKRS($id_krs);
    }
}

function ikutKelas()
{
    global $koneksi;

    $idKelas = htmlspecialchars($_GET['id_kelas']);
    $mahasiswa = htmlspecialchars($_SESSION['id']);
    $queryCek = mysqli_query($koneksi, "SELECT * FROM mahasiswa_kelas WHERE id_kelas = '$idKelas'");
    $tergabung = false;
    while ($data = mysqli_fetch_assoc($queryCek)) {
        if ($data['id_mahasiswa'] == $mahasiswa) {
            echo "<script>
        alert('Anda Sudah Bergabung ke Kelas Yang Dipilih!');
        document.location.href = 'kelas_lihat.php?id_kelas= $idKelas';
            </script>";
        }
        $tergabung = true;
    }
    if ($tergabung == false) {

        $queryKelas = "INSERT INTO mahasiswa_kelas VALUES ('','$mahasiswa', '$idKelas')";

        $exe = mysqli_query($koneksi, $queryKelas);

        if (!$exe) {
            die('Error pada database');
        }
        echo "<script>
        alert('Berhasil Untuk Bergabung ke Kelas Yang Dipilih!');
        document.location.href = 'kelas_lihat.php?id_kelas= $idKelas';
            </script>";
    }
}

function tambahKRS()
{
    global $koneksi;
    // die(var_dump($_POST));
    $semester = htmlspecialchars($_POST['semester']);
    $mahasiswa = htmlspecialchars($_SESSION['id']);
    $id_mk = htmlspecialchars($_POST['matakuliah']);
    $queryKRS = "INSERT INTO krs VALUES ('','$semester', '$mahasiswa', '$id_mk')";

    $exe = mysqli_query($koneksi, $queryKRS);

    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Menambahkan Matakuliah Yang Dipilih!');
        document.location.href = 'krs.php';
            </script>";
}

function editProfil($id_mahasiswa)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryProfil = "UPDATE mahasiswa SET nama = '$nama', nim = '$nim', email= '$email', alamat = '$alamat', tanggal_lahir = '$tgl_lahir' WHERE id_mahasiswa = '$id_mahasiswa'";
    $exe = mysqli_query($koneksi, $queryProfil);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Profil!');
        document.location.href = 'profil_mahasiswa.php';
            </script>";
}

function buatKelas()
{
    global $koneksi;
    // var_dump($_POST);
    $namaKelas = htmlspecialchars($_POST['namaKelas']);
    $jamKuliah = htmlspecialchars($_POST['jamKuliah']);
    $dosen = htmlspecialchars($_SESSION['id']);
    $kuotaKelas = htmlspecialchars($_POST['kuotaKelas']);
    $status = htmlspecialchars($_POST['status']);
    $queryKelas = "INSERT INTO kelas (id_mk,jam_kuliah,kuota_kelas,id_dosen,status) VALUES ('$namaKelas', '$jamKuliah', '$kuotaKelas', '$dosen', '$status')";

    $exe = mysqli_query($koneksi, $queryKelas);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    }
    echo "<script>
        alert('Berhasil Membuat Kelas Matakuliah!');
        document.location.href = 'kelas.php';
            </script>";
}

function editKelas($id_kelas)
{
    global $koneksi;
    // die(var_dump($_POST));
    $namaKelas = htmlspecialchars($_POST['namaKelas']);
    $jamKuliah = htmlspecialchars($_POST['jamKuliah']);
    $kuotaKelas = htmlspecialchars($_POST['kuotaKelas']);
    $status = htmlspecialchars($_POST['status']);
    $queryEdit = "UPDATE kelas SET id_mk = '$namaKelas', jam_kuliah = '$jamKuliah', kuota_kelas= '$kuotaKelas', status= '$status' WHERE id_kelas = '$id_kelas'";
    $exe = mysqli_query($koneksi, $queryEdit);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Kelas!');
        document.location.href = 'kelas.php';
            </script>";
}

function editDosen($id_dosen)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $nidn = htmlspecialchars($_POST['nidn']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryProfil = "UPDATE dosen SET nama = '$nama', nip = '$nip', nidn = '$nidn', email = '$email', alamat = '$alamat', tanggal_lahir = '$tgl_lahir' WHERE id_dosen = '$id_dosen'";
    $exe = mysqli_query($koneksi, $queryProfil);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Profil!');
        document.location.href = 'profil_dosen.php';
            </script>";
}

function editMahasiswa($id_mahasiswa)
{
    global $koneksi;
    $status = htmlspecialchars($_POST['status']);
    $queryStatus = "UPDATE mahasiswa SET status = '$status' WHERE id_mahasiswa = '$id_mahasiswa'";
    $exe = mysqli_query($koneksi, $queryStatus);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Status Mahasiswa!');
        document.location.href = 'mahasiswa.php';
            </script>";
}

function editBimbingan($id_bimbingan)
{
    global $koneksi;
    $dosen = htmlspecialchars($_POST['pa']);
    $mahasiswa = htmlspecialchars($_POST['mahasiswa']);
    $queryBimbingan = "UPDATE bimbingan SET id_mahasiswa = '$mahasiswa', id_dosen = '$dosen' WHERE id_bimbingan = '$id_bimbingan'";
    $exe = mysqli_query($koneksi, $queryBimbingan);
    if (!$exe) {
        die("Error description: " . mysqli_error($koneksi));
    }
    echo "<script>
        alert('Berhasil Update Bimbingan PA!');
        document.location.href = 'bimbingan.php';
            </script>";
}

function hapusBimbingan($id_bimbingan)
{
    global $koneksi;
    var_dump($_POST);
    global $koneksi;
    if (!mysqli_query($koneksi, "DELETE FROM bimbingan WHERE id_bimbingan = $id_bimbingan")) {
        echo ("Error description: " . mysqli_error($koneksi));
    }
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
            <script>
                    alert('Bimbingan berhasil dihapus!');
                    document.location.href = 'bimbingan.php';
                </script>	
            ";
    } else {
        echo "
        <script>
                    alert('Bimbingan gagal dihapus!');
                    document.location.href = 'bimbingan.php';
            </script>	
        ";
    }
}

function bimbinganPA()
{
    global $koneksi;
    $dosen = htmlspecialchars($_POST['pa']);
    $mahasiswa = htmlspecialchars($_POST['mahasiswa']);
    $queryBimbingan = "INSERT INTO bimbingan VALUES ('','$dosen', '$mahasiswa')";

    $exe = mysqli_query($koneksi, $queryBimbingan);

    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Menambah Bimbingan PA!');
        document.location.href = 'bimbingan.php';
            </script>";
}

function hapusMatkul($id_mk)
{
    global $koneksi;
    var_dump($_POST);
    global $koneksi;
    if (!mysqli_query($koneksi, "DELETE FROM matakuliah WHERE id_mk = $id_mk")) {
        echo ("Error description: " . mysqli_error($koneksi));
    }
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
            <script>
                    alert('Matakuliah berhasil dihapus!');
                    document.location.href = 'matakuliah.php';
                </script>	
            ";
    } else {
        echo "
        <script>
                    alert('Matakuliah gagal dihapus!');
                    document.location.href = 'matakuliah.php';
            </script>	
        ";
    }
}

function tambahMatkul()
{
    global $koneksi;
    $kode_mk = htmlspecialchars($_POST['kode_mk']);
    $matakuliah = htmlspecialchars($_POST['matakuliah']);
    $sks = htmlspecialchars($_POST['sks']);
    $queryMatkul = "INSERT INTO matakuliah VALUES ('','$kode_mk', '$matakuliah', '$sks')";

    $exe = mysqli_query($koneksi, $queryMatkul);

    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Menambah Matakuliah!');
        document.location.href = 'matakuliah.php';
            </script>";
}

function edit_dosen($id_dosen)
{
    global $koneksi;
    $status = htmlspecialchars($_POST['status']);
    $queryStatus = "UPDATE dosen SET status = '$status' WHERE id_dosen = '$id_dosen'";
    $exe = mysqli_query($koneksi, $queryStatus);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Status Dosen!');
        document.location.href = 'dosen.php';
            </script>";
}

function hapusKRS($id_krs)
{
    global $koneksi;
    var_dump($_POST);
    global $koneksi;
    if (!mysqli_query($koneksi, "DELETE FROM krs WHERE id_krs = $id_krs")) {
        echo ("Error description: " . mysqli_error($koneksi));
    }
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
            <script>
                    alert('Krs berhasil dihapus!');
                    document.location.href = 'krs.php';
                </script>	
            ";
    } else {
        echo "
        <script>
                    alert('Krs gagal dihapus!');
                    document.location.href = 'krs.php';
            </script>	
        ";
    }
}
