# RUN GUI2.py WITH PYTHON TO OPEN PROGRAM

class Student:

	# Variables initiated to allow data to be stored for the export sorted CSV functionality
	studentID = "" 
	surname = "" 
	firstname = "" 
	firstname2 = "" 
	tutor = "" 
	course = "" 
	year = "" 
	email = "" 
	group = ""


	def __init__(self, studentID, surname, firstname, firstname2, tutor, course, year, email, group): # Create a student

		self.studentID = studentID
		self.surname = surname

		# Combines firstname and firstname2 if there is a firstname2 entered
		if firstname2 != "":
			self.firstname = firstname + " " + firstname2
		else:
			self.firstname = firstname

		self.fullname = firstname + " " + surname
		self.tutor = tutor
		self.course = course
		self.year = year
		self.email = email
		self.group = group

	# Allows for group to be set (???to be used after assignment???)
	def setGroup(self, group):
		self.group = group

	# Allows for a student to be removed from a group
	def removeStudent(self):
		self.group.members.remove(self)

	def studentdata(self):
		return self.firstname , self.surname, self.studentID, self.tutor, self.course, self.year, "GROUP: ", self.group

	# Functions to retrieve data
	def getStudentID(self):
		return(self.studentID)
	def getFirstname(self):
		return(self.firstname)
	def getSurname(self):
		return(self.surname)
	def getFullname(self):
		return(self.fullname)
	def getTutor(self):
		return(self.tutor)
	def getCourse(self):
		return(self.course)
	def getYear(self):
		return(self.year)
	def getEmail(self):
		return(self.email)
	def getGroup(self):
		return(self.group)

class Group:
	def __init__(self, groupnum, supervisor, maxstudents): # Create a group

		self.groupnum = int(groupnum)
		self.supervisor = supervisor
		self.maxstudents = int(maxstudents)

		self.members = []

	def addStudent(self, student): # Assign a student to the group
		self.members.append(student)

	# Functions to retrieve data
	def getGroupnum(self):
		return(self.groupnum)
	def getSupervisor(self):
		return(self.supervisor)
	def getMaxstudents(self):
		return(self.maxstudents)