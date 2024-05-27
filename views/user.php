<?php
require_once ('header.php');

use Project\Handlers\User;

if (!isset($_SESSION['username'])) {
  $err = "Önce giriş yapmalısınız!";
  require_once __DIR__ . '/userError.php';
  return;
}

use Project\Classes\DB;

$DB = (new DB())->connect();

$stmt = $DB->query("SELECT * FROM users WHERE ID = " . $params['id']);

$user = $stmt->fetch();

if (empty($user)) {
  $err = "Kullanıcı bulunamadı!";
  require_once ('userError.php');
  return;
}

?>

<div class="container">
  <h1 class="text-primary">Kullanıcı Bilgilerini Düzenle</h1>
  <hr>
  <div class="row">
    <div class="col-md-9">
      <form class="form" action="/user" method="POST">
        <h3><?= $user['ID'] ?> ID'li kullanıcının bilgileri:</h3>
        <input name="id" type="text" class="d-none" value="<?= $user['ID'] ?>">
        <label class="col-lg-3">Kullanıcı Adı:</label>
        <div class="col-lg-8">
          <input class="form-control" name="username" type="text" value="<?= $user['username'] ?>">
        </div>
        <label class="col-lg-3">E-Posta Adresi:</label>
        <div class="col-lg-8">
          <input class="form-control" name="email" type="text" value="<?= $user['email'] ?>">
        </div>
        <label class="col-lg-3">Yeni Parola:</label>
        <div class="col-lg-8">
          <input class="form-control" name="password" type="text" placeholder="***">
        </div>
        <label class="col-lg-3">Parola Tekrarı:</label>
        <div class="col-lg-8">
          <input class="form-control" name="confirm_password" type="text" placeholder="***">
        </div>
        <label class="col-lg-3"></label>
        <div class="col-lg-8">
          <button class="form-control btn btn-success" type="submit"> Değişiklikleri Kaydet </button>
          <label class="col-lg-3"></label>
          <a href="/users">
            <button class="form-control btn btn-primary"> Geri Dön </button>
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<hr>

<?php
require_once ('footer.php');
?>