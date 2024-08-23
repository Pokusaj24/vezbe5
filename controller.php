<?php
require_once 'DAO.php';
session_start();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($action == 'Login') {
        $user = isset($_POST["user"]) ? test_input($_POST["user"]) : ""; 
        $pass = isset($_POST["pass"]) ? test_input($_POST["pass"]) : ""; 

        if (!empty($user) && !empty($pass)) {
            $dao = new DAO();
            $exists = $dao->klijentExist($user, $pass);

            if ($exists) {
                $_SESSION['klijent'] = $dao->getKlijentbyUsername($user);
                include 'prikaz.php';
            } else {
                $msg = "Invalid username or password.";
                include 'index.php';
            }
        } else {
            $msg = "Please fill in all fields.";
            include 'index.php';
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET" && $action == 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
