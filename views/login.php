<?php
require_once ('header.php');

use Project\Handlers\User;

if (isset($_SESSION['username'])) {
  $err = "Zaten giriş yaptın, " . $_SESSION['username'] . "!";
  require_once __DIR__ . '/userError.php';
//   echo
//     "<div class='container'>
//       </br>
//       <h2> Önce giriş yapmalısınız! </h2>
//       </br>
//       <a href='/login'>
//           <button class='btn btn-primary'> Giriş Yap </button>
//       </a>
//   </div>";
  return;
}

?>

<div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white">
                <div class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2 text-uppercase">Giriş Yap</h2>
                    <p class="text-white-50 mb-5">
                        Giriş yapmak için kullanıcı adı ve parolanızı girin.
                    </p>
                    <form class="form" action="/login" method="POST">
                        <div class="form-outline mb-4">
                            <input name="username" type="username" placeholder="Kullanıcı Adı"
                                class="form-control form-control-lg" required />
                        </div>
                        <!-- <div class="form-outline mb-4">
                            <input name="email" type="email" placeholder="E-Mail Address" class="form-control form-control-lg" required />
                        </div> -->
                        <div class="form-outline mb-4">
                            <input name="password" type="password" placeholder="Parola"
                                class="form-control form-control-lg" required />
                        </div>
                        <div class="form-outline mb-4 d-grid gap-2">
                            <button type="submit" class="btn btn-info">Giriş Yap</button>
                        </div>
                        <div>
                            <p class="mb-2">
                                Hesabınız yok mu?
                                <a class="text-white-50 fw-bold" href="./register">Kaydol!</a>
                            </p>
                        </div>
                        <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once ('footer.php');
?>