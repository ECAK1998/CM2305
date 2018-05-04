<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Grouping Tool</title>

</head>
<body>

<h1>Grouping Tool</h1>

	<form method="post" enctype="multipart/form-data" class="import-block">
    	Select student file to import:
    	<input type="file" accept=".csv" name="studentFileToImport" id="studentFileToImport"/>
    	<br>
    	Select tutor file to import:
    	<input type="file" accept=".csv" name="tutorFileToImport" id="tutorFileToImport"/>
    	<input type="submit" name="importFiles" id="importFiles" value="Import Files" disabled/>
	</form>

	<br>

	<form method="post" enctype="multipart/form-data">
		<input type="submit" name="group" id="group" value="Group Students"/>
	</form>

	<br>
	<br>

	<form method="post" enctype="multipart/form-data">
		Delete Student By ID:
		<input type="text" name="searchID" placeholder="Student ID"/>
		<input type="submit" name="deleteID" id="deleteID" value="Delete"/>
	</form>

	<br>
	<br>

	<form method="post" enctype="multipart/form-data">
		Delete Student By Name:
		<input type="text" name="searchName" placeholder="Student Name"/>
		<input type="submit" name="deleteName" id="deleteName" value="Delete"/>
	</form>

	<br>
	<br>

	<form method="post" enctype="multipart/form-data">
		Add New Student:
		<input type="text" name="studentID" placeholder="Student ID"/>
		<input type="text" name="firstname" placeholder="Firstname"/>
		<input type="text" name="surname" placeholder="Surname"/>
		<input type="text" name="tutorID" placeholder="Tutor ID"/>
		<input type="text" name="courseID" placeholder="Course ID"/>
		<input type="text" name="year" placeholder="Year"/>
		<input type="text" name="email" placeholder="Email Address"/>
		<input type="text" name="group" placeholder="Group Number"/>
		<input type="submit" name="addStudent" id="addStudent" value="Add Student"/>
	</form>

	<br>

	<script>
	$('.import-block input').change(function() {
    	$('#importFiles').prop('disabled', !($('#studentFileToImport').val() && $('#tutorFileToImport').val()));
  	});
	</script>

</body>
</html>

<?php
$students = array();
$tutors = array();
$studentFileName = "";
$tutorFileName = "";

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
		if (stripos($name, ($value->firstname . " " . $value->surname)) !== false) {
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
	unset($students[$studentIndex]);
	return $students;
}
function deleteTutorByIndex($tutors, $tutorIndex) {
	//Delete an individual tutors by their index in the list
	unset($tutors[$tutorIndex]);
	return $tutors;
}
function writeToFile($fileName, $data) {
	file_put_contents($fileName, "");
	$fp = fopen($fileName, "w");

	foreach ($data as $line) {
    	fputcsv($fp, $line);
	}
	fclose($fp);
}
function uploadFile($fileID) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES[$fileID]["name"]);
	$fileType = pathinfo($target_file, PATHINFO_EXTENSION);

	// Allow certain file formats
	if($fileType != "csv") {
    	echo "Sorry, only CSV files are allowed.";
	}
	else {
    	if (move_uploaded_file($_FILES[$fileID]["tmp_name"], $target_file)) {
    	    echo "The file " . basename($_FILES[$fileID]["name"]) . " has been imported.<br>";

    	} else {
    	    echo "Sorry, there was an error importing your file: " . $fileID;
    	}
	}
}
function studentToOutput($students) {
	$studentData = array();
	$count = 0;
	foreach ($students as $student) {
		$studentData[$count] = array($student->ID, $student->surname, $student->firstname, $student->tutor, $student->course, $student->year, $student->email, $student->group);
		$count += 1;
	}
	return $studentData;
}
function tutorToOutput($tutors) {
	$tutorData = array();
	$count = 0;
	foreach ($tutors as $tutor) {
		$tutorData[$count] = array($tutor->ID, $tutor->surname, $tutor->firstname, $tutor->groupNum);
		$count += 1;
	}
	return $tutorData;
}

if(array_key_exists("group", $_POST)) {
	$students = readStudents("uploads/studentFile.csv");
	$tutors = readTutors("uploads/tutorFile.csv");

	$students = createGroups($students, $tutors, count($tutors));

	$studentData = studentToOutput($students);
	$tutorData = tutorToOutput($tutors);

	writeToFile("uploads/studentFile.csv", $studentData);
	writeToFile("uploads/tutorFile.csv", $tutorData);

	echo "Students have been grouped.";
} elseif(array_key_exists("importFiles", $_POST)) {
	$studentFileName = $_FILES["studentFileToImport"]["name"];
	uploadFile("studentFileToImport");
	$students = readStudents("uploads/" . $studentFileName);
	$tutorFileName = $_FILES["tutorFileToImport"]["name"];
	uploadFile("tutorFileToImport");
	$tutors = readTutors("uploads/" . $tutorFileName);
} elseif(array_key_exists("deleteID", $_POST)) {
	$students = readStudents("uploads/studentFile.csv");
	$index = searchByID($students, $_POST["searchID"]);
	if($index != -1) {
		$students = deleteStudentByIndex($students, $index);
		$studentData = studentToOutput($students);
		writeToFile("uploads/studentFile.csv", $studentData);
		echo "Student deleted successfully.";
	} else {
		echo "Student " . $_POST["searchID"] . " does not exist.";
	}
} elseif(array_key_exists("deleteName", $_POST)) {
	$students = readStudents("uploads/studentFile.csv");
	$index = searchByName($students, $_POST["searchName"]);
	if($index != -1) {
		$students = deleteStudentByIndex($students, $index);
		$studentData = studentToOutput($students);
		writeToFile("uploads/studentFile.csv", $studentData);
		echo "Student deleted successfully.";
	} else {
		echo "Student " . $_POST["searchName"] . " does not exist.";
	}
} elseif(array_key_exists("addStudent", $_POST)) {
	echo "Test"; //DOES NOT EXECUTE! WHY?!?
	$students = readStudents("uploads/studentFile.csv");
	displayStudentsSmall($students);
	$student = createStudentArray($_POST["studentID"], $_POST["surname"], $_POST["firstname"], $_POST["tutorID"], $_POST["courseID"], $_POST["year"], $_POST["email"], $_POST["group"]);
	echo $student;
	$students = addNewStudent($students, $student);
	$studentData = studentToOutput($students);
	writeToFile("uploads/studentFile.csv", $studentData);
	echo "Student Added!";
}
?>
