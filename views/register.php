<?php
require_once 'header.php';
?>

<div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white">
                <div class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2 text-uppercase">Kaydol</h2>
                    <p class="text-white-50 mb-5">
                        Kayıt olmak için kullanıcı adı, eposta ve parolanızı girin.
                    </p>
                    <form class="form" action="/register" method="POST">
                        <div class="form-outline mb-4">
                            <input name="username" type="username" placeholder="Kullanıcı Adı"
                                class="form-control form-control-lg" required />
                        </div>
                        <div class="form-outline mb-4">
                            <input name="email" type="email" placeholder="E-Posta"
                                class="form-control form-control-lg" required />
                        </div>
                        <div class="form-outline mb-4">
                            <input name="password" type="password" placeholder="Parola"
                                class="form-control form-control-lg" required />
                        </div>
                        <div class="form-outline mb-4">
                            <input name="confirm_password" type="password" placeholder="Parola Tekrarı"
                                class="form-control form-control-lg" required />
                        </div>
                        <div class="form-outline mb-4 d-grid gap-2">
                            <button type="submit" class="btn btn-info">Kaydol</button>
                        </div>
                        <div>
                            <p class="mb-2">
                                Zaten bir hesabınız var mı?
                                <a class="text-white-50 fw-bold" href="./login">Giriş Yap!</a>
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
require_once 'footer.php';
?>