<?php
require_once __DIR__ . '/wp-load.php';

sleep(2);
$user = wp_signon( [
    'user_login'    => $_POST['email'] ?? "",
    'user_password' => $_POST['password'] ?? "",
    'remember'      => true
] );
 
// перевірка, чи вдалося авторизувати користувача
if ( is_wp_error( $user ) ) {
    echo $user->get_error_message();
    die();
} 

$redirectTo = $_POST['redirect_url'] ?? "http://example.com/";

echo "Авторизація на сайті blog.tsukor-norm.pp.ua ...";
header("refresh: 3; url=". $redirectTo); // перенаправлення на example.com через 10 секунд
?>
