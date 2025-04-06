<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jsonFile = 'data/users.json';

    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);
    } else {
        $data = [];
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($data as $user) {
        if ($user['username'] === $username) {
            $error = 'Username already taken. Try another.';
            break;
        }
    }

    if (!isset($error)) {
        $id = count($data) + 1;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data[] = [
            'id' => $id,
            'username' => $username,
            'password' => $hashedPassword
        ];

        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: login.php?registered=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style_blog.css">

</head>
<body>
<div class="container">
    <h1>Create Account</h1>

    <form method="POST">
        <input type="text" name="email" placeholder="Your Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-signup">Sign Up</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
