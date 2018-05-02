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

include ("group.php");

if(isset($_SESSION["studentList"]) == false){
    $_SESSION["studentList"] = serialize("");
}else{
    print_r($_SESSION["studentList"]);
    $students = unserialize($_SESSION["studentList"]);
}
if(isset($_POST['group'])){
    $x = $_POST['group'];
    
    echo $x;
    if($x != "" ){
        groupStudents("uploads/studentFile.csv", "uploads/tutorFile.csv");
        
        //print_r($_SESSION["studentList"]);
        $students = unserialize($_SESSION["studentList"]);
        if($students != null){
            echo '<div class="w3-panel w3-green w3-card-4 w3-display-container">';
            ?>
            <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                <?php
            echo '<h3>Yay!</h3>';
            echo '<p>Groups have been created!</p>';
            echo '</div>';
        }else{
            echo '<div class="w3-panel w3-green w3-card-4 w3-display-container">';
            ?>
            <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-green w3-large w3-display-topright">&times;</span>
                <?php
            echo '<h3>Oh No!</h3>';
            echo '<p>Groups have not been created!</p>';
            echo '</div>';
        }
    }
}

?>

<div class="w3-containter w3-center">
    <h1>Group Management</h1>
    <div class="w3-panel w3-gray">
        <p>Please select what you would like to do.</p>
    </div>
    <div class="w3-bar">
        <a href="groupManagement.php" class="w3-button w3-gray w3-round-large">Create Groups</a>
        <a href="add_remove_student.php" class="w3-button w3-gray w3-round-large">Add a Student</a>
        <a href="search_students.php" class="w3-button w3-gray w3-round-large">Search for a student to edit</a>
    </div>
    <hr>
    <form action="groupManagement.php" method="GET" enctype="multipart/form-data">
    <ul class="w3-ul w3-center "style='width:60%'>
    <?php
    
    
    //if groups have not been made students will be empty
    if($students != null){
        //if groups have been made display them 
        $group_num = 1;
        //for each group create an item on the list
        for ($group_num = 1; $group_num <= 5; $group_num++) {
            //setup each group as a new item on the list
            echo "<li class='w3-container'>";
            echo '<header class="w3-container w3-gray">';  
            echo "  <h2>Group ".$group_num."</h2>";
            echo "</header>";
            //for each person found in that group display them
            foreach($students as $student){
                if($student->getGroup() == $group_num){
                    echo "<h5>".$student->getName()."</h5>";
                }
            }
            echo '<footer class="w3-container">';
            echo '  <input  class="w3-button w3-gray w3-round-large" id='.$group_num.' name="editGroup" type="submit" value="Edit Group">';    
            echo "</footer>";
            echo "</li>";
        } 
    }else{
        //if groups have not been made alert this to the user
        ?>
        <div class="w3-panel w3-yellow w3-card-4 w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
            class="w3-button w3-yellow w3-large w3-display-topright">&times;</span>
            <h3>Uh Oh!</h3>
            <p>Groups have not been created yet! Groups will be shown here once they have been created.</p>
        </div>
      <?php
    } 
    ?>
    </ul>
    </form>
</div>
</body>
</html>
