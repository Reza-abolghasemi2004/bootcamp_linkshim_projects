<?php
$jsonFile = 'users.json';

if (file_exists($jsonFile)) {
    $data = json_decode(file_get_contents($jsonFile), true);
} else {
    $data = [];
}

$username = $_POST['username'];
$password = $_POST['password'];

foreach ($data as $user) {
    if ($user['username'] === $username) {
        die('نام کاربری تکراری است. لطفاً نام کاربری دیگری انتخاب کنید.');
    }
}

$id = count($data) + 1;     //اضافه کردن دستی

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$data[] = [
    'id' => $id,
    'username' => $username,
    'password' => $hashedPassword
];

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

echo 'ثبت نام با موفقیت انجام شد!';
?>
