<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Udayana</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row cf">
            <?php include 'layout/sidemenu.php' ?>
            <div class="w-75 cf float-left rounded">
                <?php include 'layout/header.php' ?>
                <div class="rounded cf card content shadow mt">
                    <div class="img-cover img-unud">
                    </div>
                    <div class="container-content">
                        <h3>Informasi Terkini</h3>
                        <div class="cf float-left">
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/ppid.jpg" alt="">
                            </div>
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/usercare.jpg" alt="">
                            </div>
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/lapor.jpg" alt="">
                            </div>
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/gratifikasi.jpg" alt="">
                            </div>
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/rokok.jpg" alt="">
                            </div>
                            <div class="polaroid mr">
                                <img src="https://www.unud.ac.id/images/wtpunud.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'layout/footer.php' ?>
            </div>
        </div>

    </div>
</body>

</html>