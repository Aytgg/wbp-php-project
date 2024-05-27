<?php
require_once 'header.php';

if (isset($_SESSION['TOKEN']) && isset($_SESSION['username'])) {
    echo "<div class='container'><h1>Home page - " . $_SESSION['username'] . "</h1>
        </br></br>
        <div class='row'>
            <div class='col-lg-2'>
                <a href='/users'>
                    <button class='btn btn-primary'> Üyeleri Listele </button>
                </a>
            </div>
            <div class='col-lg-2'>
                <a href='/logout'>
                    <button class='btn btn-danger'> Çıkış Yap </button>
                </a>
            </div>
        </div>
    </div>";
} else
    echo
        "<div class='container'>
            <h1>Home page</h1>
            </br>
            <a href='/login'>
                <button class='btn btn-primary'> Giriş Yap </button>
            </a>
        </div>";

require_once 'footer.php';