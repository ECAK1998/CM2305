# RUN GUI2.py WITH PYTHON TO OPEN PROGRAM

from importcsv import *

def testimport(csvfile1, buttonslist): # Function used from the main window that error checks the .CSV file after calling the inputcsv function
	
	print(csvfile1) # Prints the name of the CSV file entered - I.E. TO CHECK IT'S WORKING
	try:
		csv_import(csvfile1)
	except FileNotFoundError:
		messagebox.showinfo("Error importing file", "File not found.")
	else:
		messagebox.showinfo("Importing file complete", "File read in.")
		for x in buttonslist:
			x.config(state="normal")

def creategroups(Numofstudents, Numofgroups, maxstudents): # Creates a suitable number of group objects based off manual input from the create groups window
	import math
	global Groups

	max_num_students = math.ceil((int(Numofstudents) / int(Numofgroups))) # NOT USED AS OF YET COULD BE USED IN FUTURE FOR SOMETHING I CAN'T REMEBER AS OF WRITING THIS

	groups_count = int(Numofgroups)

	while groups_count > 0:
		Groups.append(Group(groups_count, "", maxstudents))
		groups_count = groups_count - 1

	print(Groups) # TEST THE GROUPS HAVE BEEN CREATED

def displaystudents(label): # Function called to display the raw data imported from the CSV
	global Students

	for x in Students:
		label.config(text=x.studentdata())

def createstudent(ID, surname, firstname, firstname2, tutor, course, year, email, group): # Create a brand new student from a manual input
	global Students

	Students.append(Student(ID, surname, firstname, firstname2, tutor, course, year, email, group))
	messagebox.showinfo("Confirmation Pop-up", "Student added to data list")
	# ??? IMPLEMENT A WAY TO SET THE GROUP IN THIS FUNCTION PERHAPS ???

def searchByID(ID, label): # Function used to display a student's data based off an ID manual input
	global Students

	for x in Students:
		if x.getID() == ID:
			label.config(text=x.studentdata())
			break
		else:
			label.config(text="Invalid ID, no student found")

def searchByName(name, label): # Function used to display a student's data based off a name manual input
	global Students

	for x in Students:
		if x.getFirstname() == name:
			label.config(text=x.studentdata())
			break
		else:
			label.config(text="No student found with that name")

def getstudentbyID(ID): # Function used to return a student from an manually entered ID
	global Students

	for x in Students:
		if x.getID() == ID:
			return x

def assignstudents(students, groups): # Function called on press of a button that randomly assigns all students to groups
	from random import shuffle

	shuffle(students) # Shuffles the Students list as to ensure groups are completely random
	assigned_students = []

	for group in groups:
		for student in students:
			if (student not in assigned_students) and (len(group.members) <= (group.maxstudents - 1)):
				group.addStudent(student)
				student.setGroup(group.getGroupnum())
				assigned_students.append(student)
				print(student.getGroup())
	messagebox.showinfo("Conformation Pop-up"," Students assigned to groups")

def reassigngroup(student, group): # Function used to set a student's group after entering their ID
	student.setGroup(group)
	messagebox.showinfo("Conformation Pop-up", "Students assigned to group")

def deletestudent(student): # Function to delete a student object completely from the program
	global Students

	Students.remove(student)
	student.removeStudent()
	messagebox.showinfo("Conformation Pop-up", "Student deleted")

def outputcsv(): # Function called on button press to export all sorted data to a predefined CSV file
	global Students

	f = open("output.csv","w") # w specifies we want to write to file
	f.write("studentID, surname, firstname, firstname2, tutor, course, year, email, group\n")
	for x in Students:
		f.write(str(x.studentID) + "," +  str(x.surname) + "," +  str(x.firstname) + "," 
		+  str(x.firstname2) + "," +  str(x.tutor) + "," +  str(x.course) + "," +  str(x.year) 
		+ "," +  str(x.email) + "," +  str(x.group) + "\n") # \n specifies new line
	f.close() # Close open file to free up system resources
	print("Done.")
