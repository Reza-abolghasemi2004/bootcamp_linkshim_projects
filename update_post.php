<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts = json_decode(file_get_contents('data/posts.json'), true) ?? [];

    foreach ($posts as &$post) {
        if ($post['id'] === $_POST['id'] && $post['author'] === $_SESSION['user']['username']) {
            $post['title'] = $_POST['title'];
            $post['content'] = $_POST['content'];
            $post['updated_at'] = date('Y-m-d H:i:s');
            break;
        }
    }

    file_put_contents('data/posts.json', json_encode($posts, JSON_PRETTY_PRINT));
    header('Location: dashboard.php');
    exit();
}
?>
