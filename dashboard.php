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
    <h1>Welcome, <?= $_SESSION['user']['username'] ?>!</h1>

    <div>
        <a href="create_post.php" class="btn btn-signup">+ Create New Post</a>
        <a href="logout.php" class="btn btn-login">Logout</a>
    </div>

    <hr><br>
    <h2>Your Posts</h2>

    <?php if (empty($posts)): ?>
        <p>No posts yet. Start by creating one!</p>
    <?php else: ?>
        <?php foreach (array_reverse($posts) as $post): ?>
            <?php if ($post['author'] === $_SESSION['user']['username']): ?>
                <div class="post" style="text-align: left; margin-bottom: 24px; background: #fff; padding: 16px; border-radius: 12px;">
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    <small style="color: #555;">By <?= $post['author'] ?> | <?= $post['created_at'] ?></small>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
