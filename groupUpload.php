<?php
//start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>Grouping Tool</title>
</head>
<body>
<?php
include ('group.php');
//check to see if groups have been made

?>

<div class="w3-containter w3-center">
    <h1>Group Management</h1>
    <div class="w3-panel w3-gray">
        <p>Please select what you would like to do.</p>
    </div>
    <a href="groupingtool.php" class="w3-button w3-gray w3-round-large">Back to Main Menu</a>
    
    <hr>
</div>

<div class="w3-container">
    <div class="w3-card-4" style="width:40%">
        <header class="w3-container w3-gray">
            <h2>Select a file to upload:</h2>
            
        </header>
        <br>
    <!--Assuming that files can be uploaded using the file upload system-->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select file to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" name="submit" value="Upload File">
        </form>

        <br>
        <footer class="w3-container">
            <form action="groupingtool.php" method="POST" enctype="multipart/form-data">
                <input type="submit" id="group" name="group" value="Group Students">
                <hr>
            </form>
        </footer>   
    </div>
    
</div>
</body>
</html>