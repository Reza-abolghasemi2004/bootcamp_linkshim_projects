<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$posts = json_decode(file_get_contents('data/posts.json'), true) ?? [];

if (!isset($_GET['id'])) {
    echo "Invalid post ID.";
    exit();
}

$id = $_GET['id'];
$selectedPost = null;

foreach ($posts as $post) {
    if ($post['id'] === $id && $post['author'] === $_SESSION['user']['username']) {
        $selectedPost = $post;
        break;
    }
}

if (!$selectedPost) {
    echo "Post not found or you don't have permission.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style_blog.css">
</head>
<body>
<div class="container">
    <h1>Edit Post</h1>
    <form action="update_post.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($selectedPost['id']) ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($selectedPost['title']) ?>" required>
        <label for="content">Content:</label>
        <textarea name="content" required><?= htmlspecialchars($selectedPost['content']) ?></textarea>
        <button type="submit" class="btn btn-signup">Update</button>
    </form>
</div>
</body>
</html>
