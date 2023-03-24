<?php

define('BRIDGE_KEY', '<your-token>');
// Load core Wp
require_once __DIR__ . '/wp-config.php';
require_once __DIR__ . '/wp-load.php';

header("Content-Type: application/json");
$res = [
    "status" => false
];
$req = json_decode(file_get_contents('php://input'), true);
// file_put_contents('bridge.log', var_export($req, true));
function dr()
{
    global $res;
    sleep(1);
    echo json_encode($res);
    die();
}
function de(int $code, string $message)
{
    global $res, $req;
    $res['error']['code'] = $code;
    $res['error']['message'] = $message;
    $res['request'] = $req;
    dr();
}
function ds(string $message)
{
    global $res;
    $res['status'] = true;
    $res['message'] = $message;
    dr();
}

function insert_api_user(array $params)
{
    global $res;
    $user_id = wp_insert_user( $params );
    // перевірка, чи вдалося створити користувача
    if ( ! is_wp_error( $user_id ) ) {
        ds('Новий користувач був успішно створений з ID ' . $user_id);
    } else {
        de(3, $user_id->get_error_message());
    }
}

// Check HTTPS
// if ( empty($_SERVER["HTTPS"]) ) {
//     de(0, "Must only https!");
// }

// CHECK request
if ( empty($req) ) {
    de(1, "Empty request!");
}

// Validate  BridgeKey
if ($req['token'] !== BRIDGE_KEY) {
    de(2, "Empty request!");
}

switch ($req['module']) {
    case 'createUser':
        $res['module'] = "createUser";
        $params = [
            'user_login' => $req['user_login'] ?? "",
            'user_email' => $req['user_email'] ?? "",
            'user_pass' => $req['user_pass'] ?? ""
        ];
        insert_api_user($params);
        break;
    default:
        de(404, "Mo exists module!");
        break;

}

dr();

// створення масиву з даними для нового користувача
$user_data = array(
    'user_login' => "baran11",
    'user_email' => "test@tttt.co",
    'user_pass' => "MAtepo7546",
);

// створення нового користувача
$user_id = wp_insert_user( $user_data );

// перевірка, чи вдалося створити користувача
if ( ! is_wp_error( $user_id ) ) {
    echo 'Новий користувач був успішно створений з ID ' . $user_id;
} else {
    echo 'Сталася помилка при створенні користувача: ' . $user_id->get_error_message();
}
//Цей код можна вставити в файл функцій вашої теми або в плагін, який ви створюєте. Будьте обережні при використанні функції //wp_insert_user(), оскільки вона може створити нового користувача з дуже обмеженими правами, якщо не встановлені відповідні //параметри.
$user = wp_signon( [
    'user_login'    => "baran11",
    'user_password' => "MAtepo7546",
    'remember'      => true
] );

// перевірка, чи вдалося авторизувати користувача
if ( ! is_wp_error( $user ) ) {
    echo 'Користувач успішно авторизований з ID ' . $user->ID;
} else {
    echo 'Сталася помилка при авторизації користувача: ' . $user->get_error_message();
}
