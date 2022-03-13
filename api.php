<?php

ob_start();
$imgLoc = 'http://node1.cjstevenson.com:25506/capes/';

if (!array_key_exists('username', $_GET)) {
    http_response_code(400);
    header("Content-Type: application/json");
    die('{status:"error", msg:"Missing parameter: username", usage:"http://node1.cjstevenson.com:25506/api.php?username=(USERNAME)"}');
    $log  = "[".date("F j, Y, g:i a")."] API Used: | Missing parameter: Username".PHP_EOL;
    file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
}

$username = $_GET['username'];

if (empty($username)) {
    http_response_code(400);
    die('{status:"error", msg:"Invalid parameter: username"}');
    $log  = "[".date("F j, Y, g:i a")."] API Used: | Invalid parameter: Username".PHP_EOL;
    file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
}

$username = strtolower($username);

$img = "nabiacape.png";
$img_db = json_decode(file_get_contents('users.json'), true);

if (array_key_exists($username, $img_db))
    $img = $img_db[$username];

$img_path = __DIR__ . "/capes/" . $img;

if (!file_exists($img_path)) {
    http_response_code(500);
    header("Content-Type: application/json");
    die('{status:"error", msg:"Texture missing"}');
    $log  = "[".date("F j, Y, g:i a")."] API Used: | Error: Texture missing".PHP_EOL;
    file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
}

header("Content-Type: image/png");
$log  = "[".date("F j, Y, g:i a")."] API Used: | Username: ".$username." | Cape: ".$img.PHP_EOL;
file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
print(file_get_contents($img_path));
