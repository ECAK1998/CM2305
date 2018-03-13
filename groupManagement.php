<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Grouping Tool</title>

</head>
<body>

<h1>Grouping Tool</h1>
    
    <!--Assuming that files can be uploaded using the file upload system-->
    <form action="upload.php" method="post" enctype="multipart/form-data">
    	Select file to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload">
    	<input type="submit" name="submit" value="Upload File">
	</form>

	<br>

	<form action="group.php" method="post" enctype="multipart/form-data">
		<input type="submit" name="group" value="Group Students">
	</form>

</body>
</html>