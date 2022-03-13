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
    <input type="file" id="file" name="uploaded_file" accept="image/x-png,image/jpg,image/jpeg"></input><br/>
    <button type="submit" name="Upload" >Upload</button>
  </form>
<script type="text/javascript">


var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 200000){
       alert("File has exeded the maximum size of: 200kb");
       this.value = "";
    };
};
</script>
<script type="text/javascript">
var fileInput = document.getElementById("file");
fileInput .onchange = function(e) {
  e.preventDefault();
  var file = fileInput.files && fileInput.files[0];
  var img = new Image();
  img.src = window.URL.createObjectURL(file);
  img.onload = function() {
    var width = img.naturalWidth,
      height = img.naturalHeight;
    window.URL.revokeObjectURL(img.src);
	if (width <= 64 && height <= 32) {
	} else if (width <= 128 && height <= 64) {
    } else if (width <= 2048 && height <= 1024) {
	} else {
      fileInput.value = ""
      alert("Your image doesnt match the accepted dimentions of: 2048/1024, 128/64, 64/32")
    }
  };
};
</script>
</body>
</html>
