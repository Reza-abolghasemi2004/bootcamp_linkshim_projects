<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents('data/users.json'), true) ?? [];
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit();
        }
    }
    $error = "Invalid username or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style_blog.css">

</head>
<body>
<div class="container">
    <h1>Login</h1>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-login">Login</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color:red; margin-top: 16px;"><?= $error ?></p>
    <?php endif; ?>

    <p style="margin-top: 20px;">Don't have an account?
        <a href="register.php" style="color: #007bff; text-decoration: underline;">Sign up here</a>
    </p>
</div>
</body>
</html>
