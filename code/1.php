<?php
	if($_FILES){
		  echo $_FILES['pic']['tmp_name'];
	}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<img src="<?php echo $src?>" />
</body>
</html>

