<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$posts = json_decode(file_get_contents('data/posts.json'), true) ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style_blog.css">
</head>
<body>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
    <a href="create_post.php">+ Create New Post</a>
    <a href="logout.php">Logout</a>
    <hr><br>

    <h2>Your Posts</h2>
    <?php if (empty($posts)): ?>
        <p>No posts yet. Start by creating one!</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <small>by <?= $post['author'] ?> | <?= $post['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
