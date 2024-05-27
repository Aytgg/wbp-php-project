<?php
include_once ('header.html');
?>

<div class="container py-5">
    <h2><?= $err ?></h2>
    <br>

    <?php if (isset($_SESSION['username']) && $err == "Zaten giriş yaptın, " . $_SESSION['username'] . "!"): ?>
    <a href="/logout">
        <button class="btn btn-danger"> Çıkış Yap </button>
    </a>
    <?php elseif ($err != "Kullanıcı başarıyla güncellendi!")
    //(($err == "Önce giriş yapmalısınız!") || ($err == "Kullanıcı bulunamadı!") || ($err = "Hatalı Parola!"))
    : ?>
    <a href='/login'>
        <button class='btn btn-success'> Giriş Yap </button>
    </a>
    <?php endif ?>

    <button class="btn btn-primary" onclick="history.go(-1);"> Geri Dön </button>
</div>

<?php
include_once ('footer.html');
?>