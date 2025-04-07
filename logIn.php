<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location:dashboard.php");
    exit();
}
$user = [];
if (file_exists("data/user.json")) {
    $user = json_decode(file_get_contents("data/user.json"), true);
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) or empty($password)){
        $errors[] = "Username or Password is empty";
    }else{
        foreach ($user as $user) {
            if ($user["username"] == $username and $user["password"] == $password){
                $_SESSION["user"] = $user;
                header("location:dashboard.php");
                exit();
            }
        }
        $errors[] = "Username or Password is invalid";
    }
}
?>














