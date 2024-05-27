<?php

namespace Project\Handlers;

use Project\Classes\DB;
use PDO;
use PDOException;

class User
{
    public function registerPage(): void
    {
        require_once __DIR__ . '/../../views/register.php';
    }

    public function loginPage(): void
    {
        require_once __DIR__ . '/../../views/login.php';
    }

    public static function login(): void
    {
        if (
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {
            try {
                $DB = (new DB())->connect();
                
                $stmt = $DB->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$_POST['username']]);
            } catch (PDOException $e) {
                echo ''. $e->getMessage();
                throw new PDOException('' . $e->getMessage());
            }
                
                
                
            $user = $stmt->fetch();
            if ($user) {
                if (
                    $_POST['username'] == $user['username'] &&
                    password_verify($_POST['password'], $user['password'])
                ) {
                    $_SESSION['username'] = $user['username'];
                    header('Location: /');

                    $_SESSION['TOKEN'] = md5(sha1($user['username'] . $user['password']));
                    setcookie('TOKEN', $_SESSION['TOKEN'], time() + 60 * 60 * 24); // giriş tokenini tutan 1 günlük cookie
                    /*

                    if md5(sha1($user->username . $user->password) != $_SESSION['TOKEN'])) {
                        //log out
                    }

                    if md5(sha1($user->username . $user->password) != $_COOKIE['TOKEN'])) {
                        //log out
                    }

                    */
                } else { // Eğer parola yanlışsa
                    $err = "Hatalı parola!";
                    require_once __DIR__ . '/../../views/userError.php';
                    return;
                }
            } else { // Eğer kullanıcı bulunamazsa
                $err = "Kullanıcı bulunamadı!";
                require_once __DIR__ . '/../../views/userError.php';
                return;
            }
        }
    }

    public static function register(): void
    {
        if (
            !empty($_POST['username']) &&
            !empty($_POST['email']) &&
            !empty($_POST['password']) &&
            !empty($_POST['confirm_password'])
        ) {
            if ($_POST['password'] == $_POST['confirm_password']) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $err = "Geçersiz e-posta adresi!";
                    require_once __DIR__ . '/../../views/userError.php';
                    return;
                }

                $DB = (new DB())->connect();

                $stmt = $DB->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$_POST['username']]);
                $user = $stmt->fetch();
                if (!$user) {
                    $stmt = $DB->prepare("SELECT * FROM users WHERE email = ?");
                    $stmt->execute([$_POST['email']]);
                    $user = $stmt->fetch();
                    if (!$user) { // Aynı isim veya email ile kayıtlı kullanıcı yoksa
                        $hashedPw = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $DB->prepare('INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)')
                            ->execute([$_POST['username'], $_POST['email'], $hashedPw]);

                        $err = "Kayıt başarılı!";
                        require_once __DIR__ . '/../../views/userError.php';
                        return;
                    } else { // Eğer e-posta adresi kullanımdaysa
                        $err = "Bu e-posta adresi zaten kullanımda!";
                        require_once __DIR__ . '/../../views/userError.php';
                        return;
                    }
                } else { // Eğer kullanıcı adı kullanımdaysa
                    $err = "Bu kullanıcı adı zaten kullanımda!";
                    require_once __DIR__ . '/../../views/userError.php';
                    return;
                }
            } else { // Eğer parolalar eşleşmiyorsa
                $err = "Parolalar eşleşmiyor!";
                require_once __DIR__ . '/../../views/userError.php';
                return;
            }
        }
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
        setcookie('TOKEN', '', time() - 60 * 60 * 24, '/');

        require_once __DIR__ . '/../../views/main.php';
    }

    public static function userPage($params): void
    {
        require_once __DIR__ . '/../../views/user.php';
    }

    public static function update(array $params = []): void
    {
        if (isset($params['id'])) {
            
            $DB = (new DB())->connect();
            
            $stmt = $DB->prepare("SELECT * FROM users WHERE ID = ?");
            $stmt->execute([$params["id"]]);
            
            $user = $stmt->fetch();

            if (empty($user)) {
                $err = "Kullanıcı bulunamadı!";
                require_once __DIR__ . '/../../views/userError.php';
                return;
            }

            if (isset($params['delete']) && ($params['delete'])) {
                $stmt = $DB->prepare("DELETE FROM users WHERE ID = ?");
                $stmt->execute([$params["id"]]);

                if ($_SESSION['username'] == $user['username']) {
                    session_unset();
                    session_destroy();
                    setcookie('TOKEN', '', time() - 60 * 60 * 24, '/');
                }

                $err = "Üye başarıyla silindi!";
                require_once __DIR__ . '/../../views/userError.php';
                return;
            }

            if (
                !empty($_POST['username']) &&
                !empty($_POST['email'])
            ) {
                $stmt = $DB->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$_POST['username']]);
                $userFound = $stmt->fetch();
                if (!empty($userFound)) {
                    if ($user['ID'] != $userFound['ID']) {
                        $err = "Bu kullanıcı adı zaten kullanımda!";
                        require_once __DIR__ . '/../../views/userError.php';
                        return;
                    }
                }

                $stmt = $DB->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$_POST['email']]);
                $userFound = $stmt->fetch();
                if (!empty($userFound)) {
                    if ($user['ID'] != $userFound['ID']) {
                        $err = "Bu e-posta adresi zaten kullanımda!";
                        require_once __DIR__ . '/../../views/userError.php';
                        return;
                    }
                }

                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $err = "Geçersiz e-posta adresi!";
                    require_once __DIR__ . '/../../views/userError.php';
                    return;
                }

                $stmt = $DB->prepare("UPDATE users SET username = ?, email = ? WHERE ID = ?");
                $stmt->execute([$_POST['username'], $_POST['email'], $params['id']]);

                if ($_SESSION['username'] == $user['username']) {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['TOKEN'] = md5(sha1($_POST['username'] . $user['password']));
                    setcookie('TOKEN', $_SESSION['TOKEN'], time() + 60 * 60 * 24, '/');
                }

                if (
                    !empty($_POST['password']) &&
                    !empty($_POST['confirm_password'])
                ) {
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        $hashedPw = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $stmt = $DB->prepare("UPDATE users SET `password` = ? WHERE ID = ?");
                        $stmt->execute([[$hashedPw], $params['id']]);

                        if ($_SESSION['username'] == $_POST['username']) {
                            $_SESSION['TOKEN'] = md5(sha1($_POST['username'] . $hashedPw));
                            setcookie('TOKEN', $_SESSION['TOKEN'], time() + 60 * 60 * 24, '/');
                        }
                    } else {
                        $err = "Parolalar eşleşmiyor!";
                        require_once __DIR__ . '/../../views/userError.php';
                        return;
                    }
                }
            }
        }

        $err = "Kullanıcı başarıyla güncellendi!";
        require_once __DIR__ . '/../../views/userError.php';
    }
}