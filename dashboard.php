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

// Get existing posts to display
$posts = json_decode(file_get_contents('data/posts.json'), true) ?? [];
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
    <div>
        <a href="create_post.php" class="btn btn-signup">+ Create New Post</a>
        <a href="logout.php" class="btn btn-login">Logout</a>
    </div>

    <h2>Your Posts</h2>
    <div class="posts-container">
        <?php foreach ($posts as $post): ?>
            <?php if ($post['author'] === $_SESSION['user']['username']): ?>
                <div class="post">
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><?= htmlspecialchars($post['content']) ?></p>
                    <small>Posted on <?= $post['created_at'] ?></small>
                    <div class="post-actions">
                        <a href="edit_post.php?id=<?= $post['id'] ?>" class="edit-btn">Edit</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>