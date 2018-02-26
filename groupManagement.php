<?php
//This program uses arrays of student/tutor objects throughout, the classes of which are below.
class student {
	var $studentID;
	var $surname;
	var $firstname;
	var $tutor;
	var $course;
	var $year;
	var $email;
	var $group;

	function __construct($studentArray) {
		$this->studentID = $studentArray["studentID"];
		$this->surname = $studentArray["surname"];
		$this->firstname = $studentArray["firstname"];
		$this->tutor = $studentArray["tutor"];
		$this->course = $studentArray["course"];
		$this->year = $studentArray["year"];
		$this->email = $studentArray["email"];
		$this->group = $studentArray["group"];
	}
	function displayStudent() {
		//Displays all elements of a student
		echo $this->studentID;
		echo $this->firstname;
		echo $this->tutor;
		echo $this->course;
		echo $this->year;
		echo $this->email;
		echo $this->group;
	}
	function setGroup($newGroup) {
		//Manually assigns a group number
		$this->group = $newGroup;
	}
	//Getters for individual elements
	function getID() {
		return $this->studentID;
	}
	function getName() {
		return $this->firstname + " " + $this->surname;
	}
	function getTutor() {
		return $this->tutor;
	}
	function getCourse() {
		return $this->course;
	}
	function getYear() {
		return $this->year;
	}
	function getEmail() {
		return $this->email;
	}
	function getGroup() {
		return $this->group;
	}
}
class tutor {
	var $tutorID;
	var $surname;
	var $firstname;
	var $groupNum;
	function __construct($tutorArray) {
		$this->tutorID = $studentArray["tutorID"];
		$this->surname = $studentArray["surname"];
		$this->firstname = $studentArray["firstname"];
		$this->groupNum = $studentArray["groupNum"];
	}
	function displayTutor() {
		//Displays all elements of a tutor
		echo $this->tutorID;
		echo $this->surname;
		echo $this->firstname;
		echo $this->groupNum;
	}
	//Getters for individual elements
	function getID() {
		return $this->tutorID;
	}
	function getName() {
		return $this->firstname + " " + $this->surname;
	}
	function getGroupNum() {
		return $this->groupNum;
	}
}
function readStudents($fName) {
	//Reads in from a formatted CSV student file and produces an array of student objects
	$row = 1;
	$student = array(
    	"studentID" => "",
	    "surname" => "",
	    "firstname" => "",
	    "tutor" => "",
	    "course" => "",
	    "year" => "",
	    "email" => "",
	    "group" => ""
	);
	$students = array();
	if (($handle = fopen($fName, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        $row++;
	        for ($c = 0; $c < $num; $c++) {
	            $student[i] = $data[$c];
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
	$tutor = array(
    	"tutorID" => "",
	    "surname" => "",
	    "firstname" => "",
	    "groupNum" => ""
	);
	$tutors = array();
	if (($handle = fopen($fName, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        $row++;
	        for ($c = 0; $c < $num; $c++) {
	            $tutor[i] = $data[$c];
	        }
	        array_push($tutors, new tutor($tutor));
	    }
	    fclose($handle);
	}
	return $tutors;
}
function createStudentArray($studentID, $surname, $firstname, $tutor, $course, $year, $email, $group) {
	//Creates an individual student array
	$student = array(
    	"studentID" => $studentID,
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
function createTutorArray($tutorID, $surname, $firstname, $groupNum) {
	//Creates an individual tutor array
	$student = array(
    	"tutorID" => $tutorID,
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
function createGroups($students, $numGroups) {
	//assigns the students to their groups
	//currently random but more functionality can be added at a later date
	//this in very badly done so it needs to be relooked at, however I'm pretty sure its working
	$numStudents = count($students);
	$studentsPerGroup = floor($numStudents / $numGroups);
	shuffle($students);
	for ($i = 0; $i < $numGroups; $i++) {
		for ($j = 0; $j < $studentsPerGroup; $j++) {
			($students[($i * $studentsPerGroup) + $j]).setGroup($i + 1);
		}
	}
	$count = 1;
	for ($i = ($i * $studentsPerGroup) + $j + 1; $i < $numStudents; $i++) {
		$students[$i].setGroup($count);
		$count++;
	}
	return $students;
}
function displayStudents($students) {
	//Displays information of all students in the list
	foreach ($students as &$value) {
		$value.displayStudent();
	}	
}
function dispalyTutors($tutors) {
	//Displays information of all tutors in the list
	foreach ($tutors as &$value) {
		$value.displayTutor();
	}	
}
function searchByID($aList, $ID) {
	//Searches the student or tutor list for a student/tutor with a specified ID and returns it's index in the list or -1 for not found
	$i = 0;
	foreach ($aList as &$value) {
		if ($value.getID() == $ID) {
			return $i;
		}
		$i++;
	}
	return -1;
}
function searchByName($aList, $name) {
	//Searches the student list for a student or tutor with a specified name and returns it's index in the list or -1 for not found
	$i = 0;
	foreach ($aList as &$value) {
		if (strpos($name, $value.getName()) !== false ) {
			return $i;
		}
		$i++;
	}
	return -1;
}
function setGroupByIndex($students, $studentIndex, $group) {
	//Set the group of an individual student by their index in the list
	if ($studentIndex !== -1) {
		$students[$studentIndex].setGroup($group);
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
function updateStudentDatabase($students) {
	//I'm not great at database code with PHP and I'm not 100% sure on the database architecture, so someone on the database team can use what I have made so far to communicate with the database
}
function updateTutorDatabase($tutors) {
}
?>
