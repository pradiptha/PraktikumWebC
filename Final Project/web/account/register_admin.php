<?php
include 'account.php';

// if( isset($_SESSION["login"])) {
//     header("Location: mahasiswa.php");
//     exit;
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/custom.css" />

    <!--Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet" />
    <!-- <script src="https://kit.fontawesome.com/yourcode.js"></script> -->

    <title>Halaman Registrasi Admin</title>
</head>

<body>
    <div class="container">
        <div class="card text-center" id="cardRegis">
            <div class="card-title">
                <h1 class="card-title">Registrasi Admin</h1>
            </div>
            <div class="card-body ">
                <form id="registrationForm" method="POST" action="account.php?act=registerAdmin" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                NIP tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                Email tidak valid
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                Username tidak valid
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="3" placeholder="Masukkan Password" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                Password min. 3 karakter
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="code">code</label>
                            <input type="password" class="form-control" id="code" name="code" placeholder="Masukkan code" required>
                            <div class="valid-feedback">
                                Bagus!
                            </div>
                            <div class="invalid-feedback">
                                code tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submitButton" id="submitButton" class="registerbtn btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>