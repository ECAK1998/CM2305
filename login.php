<!DOCTYPE html>
<html>
<head>
</head>

<?php

	$students = array("c0000000" => "acb", "c1111111" => "def","c2222222" => "ghi");
	$lectures = array("l0000000" => "acb", "l1111111" => "def","l2222222" => "ghi");
	$moderators = array("m0000000" => "acb");

?>


<body>

<?php

while (True) {
	foreach($students as $name => $password) {
		if ($_POST["name"] == $name && $_POST["password"] == $password) {
			echo "<h1> Welcome student </h1>";
			$access_type = 1; 
			break 2;
		}
	}

	foreach($lectures as $name => $password) {
		if ($_POST["name"] == $name && $_POST["password"] == $password) {
			echo "<h1> Welcome lecturer </h1>";
			$access_type = 2; 
			break 2;
		}
	}

	foreach($moderators as $name => $password) {
		if ($_POST["name"] == $name && $_POST["password"] == $password) {
			echo "<h1> Welcome moderator </h1>";
			$access_type = 3; 
			break 2;
		}
	}
	echo "Incorrect username/password";
	echo "<form action='SignIn.php'method='post'>";
	echo "<input type='submit' name='name' value='Try Again'><br>";
	echo "</form>";
	$access_type = 0;
	break;
}

if ($access_type == 1) { #STUDENTS
	#VIEW TASK FILES/GROUP FILES and UI	
		echo "<br><br>Approved Files:</br>";
	$entries = array();
	$handle = opendir('approved/');
	if ($handle = opendir('approved/')) {
    	while (false !== ($entry = readdir($handle))) {
        	if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
        		array_push($entries, $entry);
        	}
    	}
    	closedir($handle);
    	sort($entries);
    	foreach ($entries as $e) { 
    		echo "<br><a href='download.php?file=".$e."'>".$e."</a>";  #OPEN/DOWLOAD FILES $e = filename
    	}
	}
}

if ($access_type == 2) { #LECTURER
	#UPLOAD PROPOSAL FILES
	#if (file_exists($_POST["name"].'/') != True) { //CREATE A UNIQUE FOLDER FOR FIRST TIME LOGIN IN
	#	mkdir($_POST["name"]);
	#	echo "Personal folder created (for first time users only).";
	#}
	echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
    echo "<h2>Upload File</h2>";
    echo "<label for='fileSelect'>Filename:</label>";
    echo "<input type='file' name='file' id='fileSelect'></br>";
    echo "<input type='hidden' value=".$_POST["name"]." name='name'/>";
    echo "<input type='hidden' value=".$_POST["password"]." name='password'/>";
    echo "<input type='submit' name='submit' value='Upload'>";
    echo "</form>";
	#EDIT AND RESUBMIT REJECTED FILES

}


if ($access_type == 3) { #MODERATOR
	#VIEW UPLOADED FILES
	echo "<br><br>Unattended files:</br>";

	$entries = array();
	$handle = opendir('upload/');
	if ($handle = opendir('upload/')) {
    	while (false !== ($entry = readdir($handle))) {
        	if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
        		array_push($entries, $entry);
        	}
    	}
    	closedir($handle);
    	sort($entries);
    	foreach ($entries as $e) { 
    		echo "<br><a href='download.php?file=".$e."'>".$e."</a>"; #OPEN/DOWLOAD FILES $e = filename
    		echo "<form action='upload.php' method='post' enctype='multipart/form-data' style='display: inline;'></br>";
    		echo    "<input type='hidden' name='file' value='".$e."'>";
    		echo    "<input type='hidden' value=".$_POST["name"]." name='name'>";
    		echo    "<input type='hidden' value=".$_POST["password"]." name='password'>";
    		echo    "<input type='submit' name='submit' value='Approve'>";
    		echo    "<input type='submit' name='submit' value='Reject'>"; 
    		echo "</form></br>";
    	}
	}
	echo "<br><br>Approved Files:</br>";
	$entries = array();
	$handle = opendir('approved/');
	if ($handle = opendir('approved/')) {
    	while (false !== ($entry = readdir($handle))) {
        	if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
        		array_push($entries, $entry);
        	}
    	}
    	closedir($handle);
    	sort($entries);
    	foreach ($entries as $e) { 
    		echo "<br><a href='download.php?file=".$e."'>".$e."</a>";  #OPEN/DOWLOAD FILES $e = filename
    		echo "<form action='upload.php' method='post' enctype='multipart/form-data' style='display: inline;'>  ";
    		echo    "<input type='hidden' name='file' value='".$e."'>";
    		echo    "<input type='hidden' name='folder' value='approved/'>";
    		echo    "<input type='hidden' value=".$_POST["name"]." name='name'>";
    		echo    "<input type='hidden' value=".$_POST["password"]." name='password'>";
    		echo    "<input type='submit' name='submit' value='Delete'>";
    		echo "</form>"; 
    	}
	}

	$entries = array();
	$handle = opendir('rejected/');
	echo "<br><br>Rejected Files:</br>";
	if ($handle = opendir('rejected/')) {
    	while (false !== ($entry = readdir($handle))) {
        	if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
        		array_push($entries, $entry);
        	}
    	}
    	closedir($handle);
    	sort($entries);
	    foreach ($entries as $e) { 
	    	echo "<br><a href='download.php?file=".$e."'>".$e."</a>";  #OPEN/DOWLOAD FILES $e = filename
    		echo "<form action='upload.php' method='post' enctype='multipart/form-data' style='display: inline;'>  ";
    		echo    "<input type='hidden' name='file' value='".$e."'>";
    		echo    "<input type='hidden' name='folder' value='rejected/'>";
    		echo    "<input type='hidden' value=".$_POST["name"]." name='name'>";
    		echo    "<input type='hidden' value=".$_POST["password"]." name='password'>";
    		echo    "<input type='submit' name='submit' value='Delete'>";
    		echo "</form>"; 	
	    }
	}
	#SORT UPLOADED FILES
	#FILES APPROVED/REJECTED
}

if ($access_type > 0) {
	echo "</br></br></br>";
	echo "<form action='SignIn.php'method='post'>";
	echo "<input type='submit' value='Log Out'><br>";
	echo "</form>";
}

?>