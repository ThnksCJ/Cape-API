<?PHP

  if(!empty($_FILES['uploaded_file']))
  {
    $path = "capes/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      header("Location: index.php");
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>

<!DOCTYPE html>
<html>
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
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p>Upload Cape Image</p>
    <input type="file" name="uploaded_file"></input><br/>
    <button type="submit" name="Upload">Upload</button>
  </form>
</body>
</html>
