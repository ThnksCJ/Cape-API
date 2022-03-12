<?php 

if(isset($_GET['remove'])){
    $u0=$_GET['remove'];
    $d1=json_decode(file_get_contents('users.json'),true);
    if(isset($d1[$u0])){
        unset($d1[$u0]);
        file_put_contents('users.json',json_encode($d1,JSON_PRETTY_PRINT));
        header("Location: index.php");
    }
}
if(isset($_GET['remove'])){
    $u0=$_GET['remove'];
	$lines  = file('uuid.json');
	$search = $u0;
	$result = '';
	foreach($lines as $line) {
    	if(stripos($line, $search) === false) {
        	$result .= $line;
    }
}
file_put_contents('uuid.json', $result);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capes API</title>
    <link rel="shortcut icon" href="assets/NABIA.png" />
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header><h1>Nabia | Capes API</h1>
    <a class="add" href="add.php">Add User</a>
    <a class="add">⠀⠀</a>
    <a class="add" href="upload.php">Upload Cape</a>
</header>
<table id="users">
    <tr>
        <th>User</th>
        <th>Cape</th>
        <th>Remove</th>
    </tr>
    <?php $d1=json_decode(file_get_contents('users.json'));foreach($d1 as $e2=>$h3){?>
        <tr>
            <td><?php echo $e2 ?></td>
            <td><img src="capes/<?php echo $h3 ?>" alt="" width="128" height="64"></td>
            <td style="text-align: center"><a href="index.php?remove=<?php echo $e2 ?>">X</a></td>
        </tr>
        <?php }?>
</table>
</body>
</html>
