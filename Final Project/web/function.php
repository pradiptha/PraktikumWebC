<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_simak');

if (mysqli_connect_errno()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

session_start();
if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "hapusKelas") {
        $id_kelas = $_GET["id_kelas"];
        hapusKelas($id_kelas);
    }
}

function editAdmin($id_admin)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryProfil = "UPDATE adminsimak SET nama = '$nama', nip = '$nip', email = '$email', alamat = '$alamat', tanggal_lahir = '$tgl_lahir' WHERE id_admin = '$id_admin'";
    $exe = mysqli_query($koneksi, $queryProfil);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>
        alert('Berhasil Update Profil!');
        document.location.href = 'profil_dosen.php';
            </script>";
}

function hapusKelas($id_kelas)
{
    global $koneksi;
    if (!mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = $id_kelas")) {
        echo ("Error description: " . mysqli_error($koneksi));
    }
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        $result1 = hapusJoin($id_kelas);
        if ($result1 > 0) {
            echo "
            <script>
                    alert('Kelas berhasil dihapus!');
                    document.location.href = 'kelas.php';
                </script>	
            ";
        }
    } else {
        echo "
        <script>
                    alert('Mohon maaf masih terdapat mahasiswa yang mengikuti kelas tersebut!');
                    document.location.href = 'kelas.php';
            </script>	
        ";
    }
}

function hapusJoin($id_kelas)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM join_kelas WHERE id_kelas = $id_kelas");
    $result1 = mysqli_affected_rows($koneksi);
    return $result1;
}

function cari($keyword)
{
    global $koneksi;
    $query = "SELECT nim, nama, email, alamat, status FROM mahasiswa WHERE
	nim LIKE '%$keyword%' OR
	nama LIKE '%$keyword%' OR
	email LIKE '%$keyword%' OR
	alamat LIKE '%$keyword%' OR
    status LIKE '%$keyword%'
	ORDER BY nim";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
