<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posts = json_decode(file_get_contents('data/posts.json'), true);
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = uniqid(); // ایجاد شناسه یکتا برای پست

    $posts[] = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'author' => $_SESSION['user']['username'],
        'created_at' => date('Y-m-d H:i:s')
    ];

    file_put_contents('data/posts.json', json_encode($posts));
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Create a New Post</h1>
<form method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>
    <button type="submit">Create Post</button>
</form>
</body>
</html>
