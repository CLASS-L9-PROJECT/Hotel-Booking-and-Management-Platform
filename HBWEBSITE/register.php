<?php
require __DIR__ . '/admin/inc/db_config.php';
require __DIR__ . '/admin/inc/essentials.php';

if (isset($_POST['register'])) {
    $frm = filteration($_POST);

    // Şifreler eşleşmeli
    if ($frm['password'] !== $frm['confirm_password']) {
        alert('error','Şifreler eşleşmiyor.');
        exit;
    }

    // Resmi yükle
    $img_r = uploadImage($_FILES['profile'], 'profiles/'); // veya FACILITIES_FOLDER gibi uygun
    if (in_array($img_r, ['inv_img','inv_size','upd_failed'])) {
        alert('error','Resim yüklenirken hata: '.$img_r);
        exit;
    }

    // Veritabanına ekle
    $hashed = password_hash($frm['password'], PASSWORD_DEFAULT);
    $q = "INSERT INTO `user_cred`
          (`name`,`email`,`phonenum`,`address`,`pincode`,`dob`,`profile`,`password`)
          VALUES (?,?,?,?,?,?,?,?)";
    $values = [
      $frm['name'],$frm['email'],$frm['phonenum'],
      $frm['address'],$frm['pincode'],$frm['dob'],
      $img_r,$hashed
    ];
    $res = insert($q, $values, 'ssssisss');
    if ($res == 1) {
        alert('success','Kayıt başarılı! Giriş yapabilirsiniz.');
    } else {
        alert('error','Kayıt başarısız, lütfen tekrar deneyin.');
    }
}
