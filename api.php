<?php

if (!file_exists('users.json')) {
    touch('users.json');
}

if (!file_exists('uuid.json')) {
    touch('uuid.json');
}

if (!file_exists('./logs/API-USAGE-'.date("j.n.Y").'.log')) {
    touch('./logs/API-USAGE-'.date("j.n.Y").'.log');
    file_put_contents('./logs/API-USAGE-'.date("j.n.Y").'.log', "".PHP_EOL, FILE_APPEND);
}

ob_start();
$imgLoc = 'http://node1.cjstevenson.com:25506/capes/';

if (!array_key_exists('username', $_GET)) {
    http_response_code(400);
    header("Content-Type: application/json");
    die('{status:"error", msg:"Missing parameter: username", usage:"http://node1.cjstevenson.com:25506/api.php?username=(USERNAME)"}');
}

$username = $_GET['username'];

if (empty($username)) {
    http_response_code(400);
    die('{status:"error", msg:"Invalid parameter: username"}');
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
}

header("Content-Type: image/png");
$data  = "[".date("F j, Y, g:i a")."] API Used: | Username: ".$username." | Cape: ".$img.PHP_EOL;
file_put_contents('./logs/API-USAGE.log', $data, FILE_APPEND);
file_put_contents('./logs/API-USAGE-'.date("j.n.Y").'.log', $data, FILE_APPEND);
print(file_get_contents($img_path));
