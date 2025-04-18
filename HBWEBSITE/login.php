<?php
require __DIR__ . '/admin/inc/db_config.php';
require __DIR__ . '/admin/inc/essentials.php';

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    // Kullanıcıyı çek
    $res = select(
      "SELECT * FROM `user_cred` WHERE `email`=?",
      [$data['email']],
      's'
    );
    if (!$res || $res->num_rows !== 1) {
        alert('error','Geçersiz e‑posta veya şifre.');
        exit;
    }
    $user = mysqli_fetch_assoc($res);

    // Şifre kontrolü
    if (!password_verify($data['password'], $user['password'])) {
        alert('error','Geçersiz e‑posta veya şifre.');
        exit;
    }

    // Oturum aç
    session_start();
    $_SESSION['userLogin'] = true;
    $_SESSION['userId']    = $user['id'];

    redirect('index.php');
}
