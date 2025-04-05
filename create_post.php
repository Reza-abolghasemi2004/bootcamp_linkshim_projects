<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posts = json_decode(file_get_contents('data/posts.json'), true) ?? [];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = uniqid();

    $posts[] = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'author' => $_SESSION['user']['username'],
        'created_at' => date('Y-m-d H:i:s')
    ];

    file_put_contents('data/posts.json', json_encode($posts, JSON_PRETTY_PRINT));
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="style_blog.css">

</head>
<body>
<div class="container">
    <h1>Create a New Post</h1>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Content:</label>
        <textarea name="content" required></textarea>

        <button type="submit">Create</button>
    </form>
</div>
</body>
</html>
