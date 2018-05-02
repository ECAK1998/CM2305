<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>Grouping Tool</title>
</head>
<body>

<div class="w3-containter w3-center">
    <h1>Group Management</h1>
    <div class="w3-panel w3-gray">
        <p>Please select what you would like to do.</p>
    </div>
    <a href="groupingtool.php" class="w3-button w3-gray w3-round-large">Back to Main Menu</a>
    
    <hr>
</div>


<div class="w3-container">
    
    <form action="search_students.php" method="POST" enctype="multipart/form-data">
    	<div class="w3-card-4" style="width:40%">
        <header class="w3-container w3-gray">
            <h2>Enter a Student's ID to search:</h2>
        </header>
            <br>
    	    <input type="text" name="searchID" id="searchID" placeholder="Enter ID to seach" required>
    	    <input type="submit" class="w3-button w3-gray w3-round-large" name="searchbyID" value="Search by ID">
            <hr>
        </div>    
	</form>

	<br>

	<form action="search_students.php" method="POST" enctype="multipart/form-data">
        <div class="w3-card-4" style="width:40%">
        <header class="w3-container w3-gray">
            <h2>Enter a Student's name to search:</h2>
        </header>
        <br>
            <input type="text" name="searchName" id="searchName" placeholder="Enter Name to seach" required>
            <input type="submit" class="w3-button w3-gray w3-round-large" name="searchforName" value="Search by Name">
            <hr>
        </div>
       

    </form>
</div>
<?php
include ("group.php");
if(isset($_POST['searchName'])){
    if($_POST['searchName'] != ""){
        $studentfound = $_POST['searchName'];
        echo '<div class="w3-container" style="width:40%">';
        echo '<h2>Students Found:</h2>';
        echo '<div class="w3-bar">';
        $totalcount = 0;
        foreach($students as $student){
            
            $studentName = $student->getName();
            if(strpos($studentfound,$studentName) !== false && $student->getID() != null){
                
               
                echo '<div class="w3-cell-row" style="width:60%>';
                echo '<form action="edit_student.php" method="POST" enctype="multipart/form-data">';
                echo '<div class="w3-container w3-pale-green w3-center" style="width:40%">';
                echo "<h3>".$studentName."</h3>";
                echo "<h5> Group ".$student->getGroup()."</h5>";
                echo '<p><input  class="w3-button w3-gray w3-round-large" id="editGroup" name="editGroup" type="submit" value="Edit Student"></p>';
                echo '<hr>';
                echo "</div>";
                echo '</form>';
                echo "</div>";
                
                echo '<hr>';
                $totalcount++;
            }
            
        }
        echo "<h4>Total Found : ".$totalcount."</h4>";
        
        echo "</div>";
        echo '</div>';
    }
}
if(isset($_POST['searchID'])){
    if($_POST['searchID'] != ""){
            
        $searchID = $_POST['searchID'];
        echo '<div class="w3-container" style="width:40%">';
        echo '<h2>Students Found:</h2>';
        echo '<div class="w3-bar">';
        $totalcount = 0;
        foreach($students as $student){  
            $studentID = $student->getID();
            if($student->getID() == $searchID){
                echo '<div class="w3-cell-row" style="width:60%>';
                echo '<form action="edit_student.php" method="POST" enctype="multipart/form-data">';
                echo '<div class="w3-container w3-pale-green w3-center" style="width:40%">';
                echo "<h3>".$student->getName()."</h3>";
                echo "<h5> Group ".$student->getGroup()."</h5>";
                echo '<p><input  class="w3-button w3-gray w3-round-large" id="editGroup" name="editGroup" type="submit" value="Edit Student"></p>';
                echo '<hr>';
                echo "</div>";
                echo '</form>';
                echo "</div>";
                echo '<hr>';
                $totalcount++;
            }   
        }
    
        echo "<h4>Total Found : ".$totalcount."</h4>";
        
        echo "</div>";
        echo '</div>';
    }
}
?>
</body>
</html>