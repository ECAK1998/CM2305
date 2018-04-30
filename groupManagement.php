<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>Grouping Tool</title>

</head>
<body>

<h1>Grouping Tool</h1>
    
    <form method="post" enctype="multipart/form-data">
    	Select file to upload:
    	<input type="file" accept=".csv" name="fileToUpload" id="fileToUpload"/>
    	<input type="submit" name="upload" id="upload" value="Upload"/>
	</form>

	<br>

	<form method="post" enctype="multipart/form-data">
		<input type="submit" name="group" id="group" value="Group Students"/>
	</form>

</body>
</html>

<?php
//This program uses arrays of student/tutor objects throughout, the classes of which are below.
class student {
	var $ID;
	var $surname;
	var $firstname;
	var $tutor;
	var $course;
	var $year;
	var $email;
	var $group;

	function __construct($studentArray) {
		$this->ID = $studentArray[0];
		$this->surname = $studentArray[1];
		$this->firstname = $studentArray[2];
		$this->tutor = $studentArray[3];
		$this->course = $studentArray[4];
		$this->year = $studentArray[5];
		$this->email = $studentArray[6];
		$this->group = $studentArray[7];
	}
}
class tutor {
	var $ID;
	var $surname;
	var $firstname;
	var $groupNum;

	function __construct($tutorArray) {
		$this->ID = $tutorArray[0];
		$this->surname = $tutorArray[1];
		$this->firstname = $tutorArray[2];
		$this->groupNum = $tutorArray[3];
	}
}
function readStudents($fName) {
	//Reads in from a formatted CSV student file and produces an array of student objects
	$row = 1;
	$student = array();
	$students = array();
	if (($handle = fopen($fName, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        $row++;
	        for ($c = 0; $c < $num; $c++) {
	            $student[$c] = $data[$c];
	        }
	        array_push($students, new student($student));
	    }
	    fclose($handle);
	}
	return $students;
}
function readTutors($fName) {
	//Reads in from a formatted CSV tutor file and produces an array of tutor objects
	$row = 1;
	$tutor = array();
	$tutors = array();
	if (($handle = fopen($fName, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        $row++;
	        for ($c = 0; $c < $num; $c++) {
	            $tutor[$c] = $data[$c];
	        }
	        array_push($tutors, new tutor($tutor));
	    }
	    fclose($handle);
	}
	return $tutors;
}
function createStudentArray($ID, $surname, $firstname, $tutor, $course, $year, $email, $group) {
	//Creates an individual student array
	$student = array(
    	"ID" => $ID,
	    "surname" => $surname,
	    "firstname" => $firstname,
	    "tutor" => $tutor,
	    "course" => $course,
	    "year" => $year,
	    "email" => $email,
	    "group" => $group
	);
	return $student;
}
function createTutorArray($ID, $surname, $firstname, $groupNum) {
	//Creates an individual tutor array
	$student = array(
    	"ID" => $ID,
	    "surname" => $surname,
	    "firstname" => $firstname,
	    "tutor" => $tutor,
	    "course" => $course,
	    "year" => $year,
	    "email" => $email,
	    "group" => $group
	);
	return $student;
}
function addNewStudent($students, $studentArray) {
	//Adds a new student to the list
	$student = new student($studentArray);
	array_push($students, $student);
	return $students;
}
function addNewTutor($tutors, $tutorArray) {
	//Adds a new tutor to the list
	$tutor = new tutor($tutorArray);
	array_push($tutors, $tutor);
	return $tutors;
}
function createGroups($students, $tutors, $numGroups) {
	//assigns the students to their groups
	//currently random but more functionality can be added at a later date, improvements should be made
	shuffle($students);
	$count = 1;
	foreach ($students as &$student) {
		if ($count > $numGroups) {
			$count = 1;
		}
		$student->group = $count;
		$student->tutor = $tutors[$count - 1]->ID;
		$count += 1;
	}
	unset($student);
	return $students;
}
function displayStudents($students) {
	//Displays information of all students in the list
	foreach ($students as &$student) {
		echo $student->ID . " ";
		echo $student->surname . " ";
		echo $student->firstname . " ";
		echo $student->tutor . " ";
		echo $student->course . " ";
		echo $student->year . " ";
		echo $student->email . " ";
		echo $student->group . " ";
		echo "<br>";
	}
	unset($student);
}
function displayStudentsSmall($students) {
	//Displays information of all students in the list
	foreach ($students as &$student) {
		echo $student->ID . " ";
		echo $student->surname . " ";
		echo $student->firstname . " ";
		echo $student->group . " ";
		echo "<br>";
	}
	unset($student);
}
function dispalyTutors($tutors) {
	//Displays information of all tutors in the list
	foreach ($tutors as &$tutor) {
		echo $tutor->ID . " ";
		echo $tutor->surname . " ";
		echo $tutor->firstname . " ";
		echo $tutor->groupNum . " ";
		echo "<br>";
	}
	unset($tutor);
}
function searchByID($aList, $ID) {
	//Searches the student or tutor list for a student/tutor with a specified ID and returns it's index in the list or -1 for not found
	$i = 0;
	foreach ($aList as &$value) {
		if ($value->ID == $ID) {
			return $i;
		}
		$i++;
	}
	unset($value);
	return -1;
}
function searchByName($aList, $name) {
	//Searches the student list for a student or tutor with a specified name and returns it's index in the list or -1 for not found
	$i = 0;
	foreach ($aList as &$value) {
		if (strpos($name, ($value->firstname . " " . $value->surname)) !== false ) {
			return $i;
		}
		$i++;
	}
	return -1;
}
function setGroupByIndex($students, $studentIndex, $group) {
	//Set the group of an individual student by their index in the list
	if ($studentIndex !== -1) {
		$students[$studentIndex]->group = $group;
	} else {
		echo "error";
	}
	return $students;
}
function deleteStudentByIndex($students, $studentIndex) {
	//Delete an individual student by their index in the list
	array_splice($students, $studentIndex, 1);
	return $students;
}
function deleteTutorByIndex($tutors, $tutorIndex) {
	//Delete an individual tutors by their index in the list
	array_splice($tutors, $tutorIndex, 1);
	return $tutors;
}
function writeToFile($fileName, $data) {
	file_put_contents($fileName, "");
	$fp = fopen($fileName, 'w');

	foreach ($data as $line) {
    	fputcsv($fp, $line);
	}

	fclose($fp);
}
function groupStudents($studentFile, $tutorFile) {
	$students = array();
	$studentData = array();
	$tutors = array();
	$tutorData = array();
	$students = readStudents($studentFile);
	$tutors = readTutors($tutorFile);

	$students = createGroups($students, $tutors, count($tutors));
	$count = 0;
	foreach ($students as $student) {
		$studentData[$count] = array($student->ID, $student->surname, $student->firstname, $student->tutor, $student->course, $student->year, $student->email, $student->group);
		$count += 1;
	}
	$count = 0;
	foreach ($tutors as $tutor) {
		$tutorData[$count] = array($tutor->ID, $tutor->surname, $tutor->firstname, $tutor->groupNum);
		$count += 1;
	}

	writeToFile("uploads/formattedStudents.csv", $studentData);
	writeToFile("uploads/formattedTutors.csv", $tutorData);

	echo "Students have been grouped";
}
function uploadFile() {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Allow certain file formats
	if($fileType != "csv" ) {
    	echo "Sorry, only CSV files are allowed. ";
	}
	else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	    echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
    	} else {
    	    echo "Sorry, there was an error uploading your file.";
    	}
	}
}

if(array_key_exists("group", $_POST)){
	groupStudents("uploads/studentFile.csv", "uploads/tutorFile.csv");
} elseif(array_key_exists("upload", $_POST)){
	uploadFile();
}
?>
