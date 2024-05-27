<?php
require_once 'header.php';

if (!isset($_SESSION['username'])) {
    $err = "Önce giriş yapmalısınız!";
    require_once __DIR__ . '/userError.php';
    return;
}

use Project\Classes\DB;

$DB = (new DB())->connect();

$stmt = $DB->query("SELECT * FROM users");

?>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Kullanıcı Adı</th>
                <th scope="col">E-Posta</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($users))
                echo '<tr><td colspan="4"> Hiç kullanıcı yok! </td></tr>';
            else
                foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"> <?= $user['ID'] ?> </th>
                        <td> <?= $user['username'] ?> </td>
                        <td> <?= $user['email'] ?> </td>
                        <td>
                            <a href="./user?id=<?= $user['ID'] ?>">
                                <button class="btn btn-primary"> Düzenle </button>
                            </a>
                            <button class="btn btn-danger" onClick="return deleteUser(<?= $user['ID'] ?>);"> Sil </button>
                        </td>
                    </tr>
                <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    function deleteUser(id) {
        if (confirm("<?= $user['username'] ?> isimli üyeye dair her şey silinecektir.\nOnaylıyor musunuz?")) {
            window.location = 'user?id=' + id + '&delete=true';
            return;
        }
    }
</script>

<?php
require_once 'footer.php';
?>