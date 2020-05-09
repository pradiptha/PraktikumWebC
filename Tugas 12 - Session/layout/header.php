<div class="rounded cf card navbar shadow">
    <ul class="float-left">
        <li><a href="./" style="text-decoration: underline;">Home</a></li>
        <li><a href="tentang.php">Tentang</a></li>
        <li><a href="pengajar.php">Pengajar</a></li>
        <li><a href="kontak.php">Kontak</a></li>
    </ul>
    <div class="float-right search mr">
        <input class="rounded" type="text" name="" id="" placeholder="Search..">
    </div>
</div>
<?php if (isset($_SESSION['flash'])) :
    if ($_SESSION['role'] == 'mahasiswa') {
        $bg = 'bg-red';
    } elseif ($_SESSION['role'] == 'dosen') {
        $bg = 'bg-green';
    } elseif ($_SESSION['role'] == 'admin') {
        $bg = 'bg-blue';
    }
    if ($_SESSION['flash'] == true) : ?>
        <div class="alert mt shadow rounded <?= $bg ?>">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Hai, <?= $_SESSION['username'] ?>! anda login sebagai <?= $_SESSION['role'] ?>
        </div>
    <?php $_SESSION['flash'] = false;
    endif ?>
<?php endif ?>