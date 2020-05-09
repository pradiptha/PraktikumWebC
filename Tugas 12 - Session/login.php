<?php
include 'db.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // var_dump($_POST);
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["password"]) {

            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];
            $_SESSION['flash'] = true;
            header("Location: index.php");
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
} else if (isset($_SESSION["login"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="https://oauth2.unud.ac.id/css/login.css"> -->
</head>

<body>
    <div class="main">
        <div class="container container-login">
            <div class="booking-content">
                <div class="booking-image">
                    <div class="back-wall"></div>
                    <img class="booking-img" src="https://oauth2.unud.ac.id/images/unud-login.jpg" alt="Background Image">
                    <div class="dis-follow">
                        <span class="txt1"> Universitas Udayana </span>
                    </div>
                </div>
                <div class="booking-form">
                    <form method="POST" action="" id="booking-form">
                        <h2 style="text-align: center">Login</h2>
                        <?php if (isset($error)) : ?>
                            <p style="color: red;">username/password salah!</p>
                        <?php endif; ?>
                        <div class="form-group form-input">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" value="" class="rounded w-100" style="border: 1px solid #999999">
                        </div>
                        <div class="form-group form-input">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" value="" class="rounded w-100" style="border: 1px solid #999999">
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password" role="button"></span>
                        </div>
                        <div class="form-submit form-input">
                            <button type="submit" class="submit w-100" name="login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>