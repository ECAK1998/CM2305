<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>Grouping Tool</title>
</head>
<body>

</body>
<div class="w3-containter w3-center">
    <h1>Group Management</h1>
    <div class="w3-panel w3-gray">
        <p>Please select what you would like to do.</p>
    </div>
    <a href="groupingtool.php" class="w3-button w3-gray w3-round-large">Back to Main Menu</a>
    
    <hr>
</div>

<div class="w3-container">
    <form action="" method="post" enctype="multipart/form-data">
    	<p>Input the Students details<p>
    	<input type="text" name="studentID" id="studentID" placeholder="Input Student ID" required>
        <input type="text" name="studentForname" id="studentForname" placeholder="Student's  Forname" required>
        <input type="text" name="studentSurname" id="studentSurname" placeholder="Student's  Surname" required>
        <input type="text" name="studentCourse" id="studentCourse" placeholder="Student's  Course" required>
    	<input  class ="w3-button w3-gray w3-round-large" type="submit" name="submit" value="Add Student">
	</form>

	<br>

	
</div>

</body>
</html>