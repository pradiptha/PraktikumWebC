<?php
include '../function.php';

if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "register") {
        register();
    } else if ($act == "login") {
        login();
    } else if ($act == "registerDosen") {
        registerDosen();
    } else if ($act == "registerAdmin") {
        registerAdmin();
    }
}

function login()
{
    global $koneksi;
    $username = htmlspecialchars($_POST["username"]);
    $input_pass = htmlspecialchars($_POST['password']);
    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    $user_data = mysqli_fetch_assoc($user);
    $password = $user_data['password'];

    if ($user_data) {
        if (password_verify($input_pass, $password)) {
            $_SESSION['login'] = true;
            $role = $user_data['role'];
            $_SESSION['role'] = $role;
            $id_user = $user_data['id_user'];
            if ($role == 1) {
                $user = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_user = $id_user");
                $user_detail = mysqli_fetch_assoc($user);
                $_SESSION["id"] = $user_detail['id_mahasiswa'];
                $_SESSION["nama"] = $user_detail['nama'];
            } else if ($role == 2) {
                $user = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id_user = $id_user");
                $user_detail = mysqli_fetch_assoc($user);
                $_SESSION["id"] = $user_detail['id_dosen'];
                $_SESSION["nama"] = $user_detail['nama'];
            } else if ($role == 0) {
                $user = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_user = $id_user");
                $user_detail = mysqli_fetch_assoc($user);
                $_SESSION["id"] = $user_detail['id_admin'];
                $_SESSION["nama"] = $user_detail['nama'];
            }
            header("Location: ../dashboard");
        } else {
            echo "<script>
                alert('Username atau password salah!');
                document.location.href = '../index.php';
                </script>";
        }
    }
}

function register()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    // $query_user = "INSERT INTO user VALUES ('', '1', '$nim','$nama', '$email', '$alamat', '$tgl_lahir', 'aktif','$password')";
    $query_user = "INSERT INTO user (username,password,role) VALUES ('$username','$password','1')";
    $add_user = mysqli_query($koneksi, $query_user);
    if (!$add_user) {
        die('Query Error #01: ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        // echo "<script type='text/javascript'> success(); </script>";
        $last_id = mysqli_insert_id($koneksi);
        $query_user_detail = "INSERT INTO mahasiswa (id_user,nim,nama,email,alamat,tanggal_lahir,status) VALUES ('$last_id','$nim','$nama','$email','$alamat','$tgl_lahir','aktif')";
        $add_user_detail = mysqli_query($koneksi, $query_user_detail);
        if (!$add_user_detail) {
            mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $last_id");
            die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
        } else {
            echo "<script>
        alert('Berhasil Registrasi! Silahkan Login');
        document.location.href = '../index.php';
            </script>";
        }
    }
}

function registerDosen()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $nidn = htmlspecialchars($_POST['nidn']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_user = "INSERT INTO user (username,password,role) VALUES ('$username','$password','2')";
    $add_user = mysqli_query($koneksi, $query_user);

    if (!$add_user) {
        die('Query Error #01: ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        // echo "<script type='text/javascript'> success(); </script>";
        $last_id = mysqli_insert_id($koneksi);
        $query_user_detail = "INSERT INTO dosen (id_user,nip,nidn,nama,email,alamat,tanggal_lahir,status) VALUES ('$last_id','$nip','$nidn','$nama','$email','$alamat','$tgl_lahir','aktif')";
        $add_user_detail = mysqli_query($koneksi, $query_user_detail);
        if (!$add_user_detail) {
            mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $last_id");
            die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
        } else {
            echo "<script>
        alert('Berhasil Registrasi! Silahkan Login');
        document.location.href = '../index.php';
            </script>";
        }
    }
}

function registerAdmin()
{
    global $koneksi;
    var_dump($_POST);
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $code = htmlspecialchars($_POST['code']);
    // $query_user = "INSERT INTO adminsimak VALUES ('', '0', '$nip','$nama', '$email', '$alamat', '$tgl_lahir','$password')";
    if ($code == 'simakunggul') {
        $query_user = "INSERT INTO user (username,password,role) VALUES ('$username','$password','0')";
        $add_user = mysqli_query($koneksi, $query_user);
        if (!$add_user) {
            die('Query Error #01: ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
        } else {
            // echo "<script type='text/javascript'> success(); </script>";
            $last_id = mysqli_insert_id($koneksi);
            $query_user_detail = "INSERT INTO admin (id_user,nip,nama,email) VALUES ('$last_id','$nip','$nama','$email')";
            $add_user_detail = mysqli_query($koneksi, $query_user_detail);
            if (!$add_user_detail) {
                mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $last_id");
                die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
            } else {
                echo "<script>
        alert('Berhasil Registrasi Admin! Silahkan Login');
        document.location.href = '../index.php';
            </script>";
            }
        }
    }
}
