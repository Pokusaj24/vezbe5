<?php 
require_once 'DAO.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['klijent']) && !empty($_SESSION['klijent'])) {
    $klijent = $_SESSION['klijent'];
    include './partials/header.php';
?>
<div class="container">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Password</th>
        </tr>
        <?php foreach ($klijent as $k) { ?>
        <tr>
            <td><?= $k["id"] ?></td>
            <td><?= $k["user"] ?></td>
            <td><?= $k["pass"] ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="controller.php?action=logout">Logout</a>
</div>
<?php 
    include './partials/footer.php';
} else {
    header('Location: index.php');
    exit();
}
?>
