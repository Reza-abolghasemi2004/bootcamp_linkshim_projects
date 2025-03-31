<?php
session_start();
$posts = json_decode(file_get_contents('data/posts.json'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reza and Parnia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('includes/header.php'); ?>
<h1>Welcome to My Blog</h1>
<?php foreach($posts as $post): ?>
    <div class="post">
        <h2><a href="view_post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
        <p><?php echo substr($post['content'], 0, 150); ?>...</p>
    </div>
<?php endforeach; ?>
<?php include('includes/footer.php'); ?>
</body>
</html>
