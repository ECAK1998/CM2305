# RUN GUI2.py WITH PYTHON TO OPEN PROGRAM

from tkinter import *
from tkinter import messagebox
from classes import *

Students = [] # List of student objects used as a global variable throughout the program
Groups = [] # List of group objects used as a global variable throughout the program
Supervisors = 4 # As far as I remember this is unused however don't want to remove it right now as to not break anything before the client meeting

def csv_import(filenamestudents, header=True): # Used to import a .csv file with a given name
	import csv

	with open(filenamestudents) as csvdatafile:
		rdr = csv.reader(csvdatafile)
		next(csvdatafile)
		for row in rdr:
			Students.append(Student(row[0], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8])) # Takes each cell and inputs it into a student object
			print(row[0], row[1], row[2]) # Prints part of the input for each student object to the command line - TEST TO ENSURE THE FUNCTION WORK

			#ALL CODE BELOW THIS POINT IS BACKUP IF THE ASSIGNMENT SYSTEM BREAKS, IT IS THE MANUAL INPUT OF GROUP DATA CODE

	#with open(filenamegroups) as csvfile: #reads the tutors.csv
	#		rdr = csv.reader(csvfile)
	#		next(csvfile)
	#		for row in rdr:
	#			Groups.append(Group(row[0], row[1], row[2]))
	#			print(row[0], row[1])