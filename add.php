<?php
ob_start();
if (isset($_POST['submit'])) {
    $cape = $_POST['cape'];
    $username = strtolower($_POST['username']);
    $json = json_decode(file_get_contents('users.json'), true);
    if (!isset($json[$username])) {
        $json[$username] = $cape;
        file_put_contents('users.json', json_encode($json, JSON_PRETTY_PRINT));
        header("Location: index.php");
        $log  = "[".date("F j, Y, g:i a")."] users.json Entry Added: | Cape: ".$cape." | Username: ".$username.PHP_EOL;
        file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
    }
    $username = strtolower($_POST['username']);
	if(isset($username)){
    	$file = fopen("uuid.json", "a");

    	$content = file_get_contents("uuid.json");

    	if(strpos($content, $username) === false){
        	fwrite($file, $username."\n");
    	}
    	$log  = "[".date("F j, Y, g:i a")."] uuid.json Entry Added: | Username: ".$username.PHP_EOL;
        file_put_contents('./logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
    	fclose($file);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cape API</title>
    <link rel="shortcut icon" href="assets/NABIA.png" />
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header><h1>Nabia | Capes API</h1>
    <a class="add" href="index.php">Home</a>
</header>
<form action="" method="post">
    <input type="text" name="username" placeholder="Username">
    <button type="submit" name="submit">Add</button>
    <select id="cape" name="cape" title="Cape" onchange="changeImage()">
        <option value="nabiacape.png">Choose A Cape</option>
        <?php
        $files = scandir('capes');
        unset($files[0], $files[1]);
        foreach ($files as $index => $file) {
            ?>
            <option value="<?php echo $file ?>"><?php echo $file ?></option>
            <?php
        }
        ?>

    </select>
</form>
<img id="preview" src="capes/nabiacape.png">
<script>
    function changeImage() {
        document.getElementById('preview').src = 'capes/' + document.getElementById('cape').value;
    }
</script>
</body>
</html>
