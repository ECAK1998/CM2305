# RUN GUI2.py WITH PYTHON TO OPEN PROGRAM

from tkinter import *
from tkinter import messagebox
from classes import *
from guifunctions import *

class Window(Frame):
	def __init__(self, master):
		Frame.__init__(self, master)
		self.mainWindow()

	def mainWindow(self):
		self.grid()

		global Students
		global Groups

		csv_user_input = Entry(self)
		csv_user_input.grid(row=3, column=0)

		label_title = Label(self, text="Main Menu")

		button_importcsv = Button(self, text="Import file", command=lambda: testimport(csv_user_input.get(), buttons))
		button_importcsv.grid(row=3, column=1)

		button_create_groups = Button(self, text="Create groups", state=DISABLED, command=self.creategroupswindow)
		button_create_groups.grid(row=4, column=0)

		button_displaydata = Button(self, text="Display read data", state=DISABLED, command=self.displaydatawindow)
		button_displaydata.grid(row=5, column=0)

		button_search = Button(self, text="Search for a student", state=DISABLED, command=self.searchwindow)
		button_search.grid(row=6, column=0)

		button_sortdata = Button(self, text="Sort read data", state=DISABLED, command=self.sortdatawindow)
		button_sortdata.grid(row=7, column=0)

		button_writecsv = Button(self, text="Create sorted CSV file", state=DISABLED, command=lambda: outputcsv())
		button_writecsv.grid(row=8, column=0)

		button_quit = Button(self, text="Quit program", command=self.quit)
		button_quit.grid(row=9, column=0)

		buttons = [button_create_groups, button_displaydata, button_search, button_sortdata, button_writecsv]

	def creategroupswindow(self):
		T = Toplevel(self)
		T.wm_title("Group creator")
		T.grid()

		label_title = Label(T, text="Group Creator")
		label_title.grid(row=1, column=0)

		group_number_input = Entry(T, text="Number of groups")
		group_number_input.grid(row=2, column=0)

		max_students_input = Entry(T, text="Max number of students per group")
		max_students_input.grid(row=2, column=1)

		button_create_groups = Button(T, text="Create Groups", command=lambda: creategroups(len(Students), group_number_input.get(), max_students_input.get()))
		button_create_groups.grid(row=2, column=2)

	def displaydatawindow(self):
		T = Toplevel(self)
		T.wm_title("CSV data")
		T.grid()

		label_title = Label(T, text="CSV Data")
		label_title.grid(row=1, column=0)
	
		T.list = Listbox(T, height=20, width=100)
		scroll = Scrollbar(T, command=T.list.yview)
		T.list.configure(yscrollcommand=scroll.set)

		T.list.grid(row=4, column=0,)
		scroll.grid(row=4, column=1, sticky=E)

		for x in Students:
			T.list.insert(END, x.getFirstname() + " " + x.getSurname() + " " + x.getID() + " " + x.getCourse() + " " + x.getYear())
		T.list.selection_set(END)

	def searchwindow(self):
		T= Toplevel(self)
		T.wm_title("Search students")
		T.grid()

		label_title = Label(T, text="Search for Students")
		label_title.grid(row=1, column=0)

		search_input = Entry(T)
		search_input.grid(row=2, column=0)

		button_create_student = Button(T, text="Add student", command=self.createstudentwindow)
		button_create_student.grid(row=4, column=0)

		button_search_name = Button(T, text="Search by Full name", command=lambda: searchByName(search_input.get(), label_result))
		button_search_name.grid(row=2, column=1)

		button_search_ID = Button(T, text="Search by ID", command=lambda: searchByID(search_input.get(), label_result))
		button_search_ID.grid(row=2, column=2)

		label_result = Label(T, text="")
		label_result.grid(row=3, column=1)

	def createstudentwindow(self):
		T = Toplevel(self)
		T.wm_title("Add student")
		T.grid()

		label_title = Label(T, text="Add student to data list")
		label_title.grid(row=1, column=0)

		label_ID = Label(T, text="Enter student's ID")
		label_ID.grid(row=2, column=0)

		input_ID = Entry(T)
		input_ID.grid(row=2, column=1)

		label_surname = Label(T, text="Enter student's surname")
		label_surname.grid(row=3, column=0)

		input_surname = Entry(T)
		input_surname.grid(row=3, column=1)

		label_firstname = Label(T, text="Enter student's firstname")
		label_firstname.grid(row=4, column=0)

		input_firstname = Entry(T)
		input_firstname.grid(row=4, column=1)

		label_firstname2 = Label(T, text="Enter student's second-name")
		label_firstname2.grid(row=5, column=0)

		input_firstname2 = Entry(T)
		input_firstname2.grid(row=5, column=1)

		label_tutor = Label(T, text="Enter student's tutor")
		label_tutor.grid(row=6, column=0)

		input_tutor = Entry(T)
		input_tutor.grid(row=6, column=1)

		label_course = Label(T, text="Enter student's course")
		label_course.grid(row=7, column=0)

		input_course = Entry(T)
		input_course.grid(row=7, column=1)

		label_year = Label(T, text="Enter student's year")
		label_year.grid(row=8, column=0)

		input_year = Entry(T)
		input_year.grid(row=8, column=1)

		label_email = Label(T, text="Enter student's email")
		label_email.grid(row=9, column=0)

		input_email = Entry(T)
		input_email.grid(row=9, column=1)

		label_group = Label(T, text="Enter student's group")
		label_group.grid(row=10, column=0)

		input_group = Entry(T)
		input_group.grid(row=10, column=1)

		button_submit = Button(T, text="Add student", command=lambda: createstudent(input_ID.get(), input_surname.get(), input_firstname.get(), input_firstname2.get(), input_tutor.get(), input_course.get(), input_year.get(), input_email.get(), input_group.get()))
		button_submit.grid(row=11, column=3)

	def sortdatawindow(self):
		T = Toplevel(self)
		T.wm_title("Sort data")
		T.grid() 

		label_title = Label(T, text="Assign students")
		label_title.grid(row=1, column=0)

		button_random_assign = Button(T, text="Randomly assign students to a group", command=lambda: assignstudents(Students, Groups))
		button_random_assign.grid(row=2, column=0)

		ID_input = Entry(T)
		ID_input.grid(row=2, column=1)

		button_reassign = Button(T, text="Reassign student", command= lambda: self.reassignwindow(ID_input.get()))
		button_reassign.grid(row=3, column=1)

	def reassignwindow(self, ID):
		T = Toplevel(self)
		T.wm_title("Group management")
		T.grid()

		label_title = Label(T, text="Reassign the entered student")
		label_title.grid(row=1, column=0)

		student = getstudentbyID(ID)

		button_deletestudent = Button(T, text="Delete student", command=lambda: deletestudent(student))
		button_deletestudent.grid(row=3, column=0)

		Group_input = Entry(T)
		Group_input.grid(row=2, column=1)

		button_reassign = Button(T, text="Assign student to group", command=lambda: reassigngroup(student,Group_input.get()))
		button_reassign.grid(row=2, column=2)

		#for x in students:
		#	if ID == x.getID():
		#		entered_student = getstudentbyID(ID)
		#	else:
		#		messagebox.showinfo("No student found with the entered ID")
		#
		#		group_input = Entry(T)
		#		group_input.grid(row=3, column=0)
		#
		#		button_group = Button(T, text="Assign student to group", command=lambda: entered_student.setGroup(group_input.get()))
		

def main():
	root = Tk()
	root.title("Group sorting program")
	root.resizable(False, False)
	func = Window(root)
	root.mainloop()

if __name__ == "__main__":
	main()