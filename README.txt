Run groupManagement.php

This is how I imagine the program working:
Area to upload student and tutor csv files. Once the files have been uploaded they need to be checked to ensure they are formatted correctly. If they are formatted correctly, they can be uploaded to the database. There should then be a button to that will group the students and relay the grouped data to the user below the buttons. Once grouped, there should be additional functionality to add/move/remove individual students (database should be updated after each change).

13/03/18 - Sean:
   Made a basic interface for the grouping tool, a lot needs to be done before being functional:

   IMPORTANT - Haven't yet heard from the UI team for any rough designs for the grouping tool

   - Need to complete upload.php (similar to the file upload system) so that student/tutor files can be stored on the server.
   - The grouping functions work theoretically but I can't get it working for whatever reason, all I want at the moment is for the grouped data to be printed to the screen after the final button is clicked.
   - After that is working, this needs to be integrated with the datbase.

20/03/18 - Ethan:

	> changed instances of 'i' variable to '$c' where wrong variable was used to iterate a for loop
	> changed instances of 'studentArray' to 'tutorArray' in the tutorArray class
	> changed instances of '.' to '->' when calling class functions

	group.php no longer throws any errors, but at the moment it ony displays '1122334455' when it finishes whatever it's doing.


30/04/18 - Sean:
	Managed to fix the program and the most basic functionality of sorting students into groups now works correctly.
	To run the program in WAMP you run groupManagement.php, in your uploads folder you MUST have two csv files named formattedStudents.csv and formattedTutors.csv
	Then upload the two files that are contained in the examples folder here on github.
	Next you can click the group button to group the students; the two empty files in the upload folder will now be populated.
	Hopefully from here it will be very easy to simply read the csv files into the database.
	I'm going to try to work on the additional functionality tonight.

01/05/2018 - Ethan:
	> Small correction: studentFile.csv and tutorFile.csv are needed for input; 'formatted' files are the output (correction to the README.txt I've not changed the actual program)
	> Group is set correctly, although the 'tutor' field for student is changed to the tutor which leads the group they are assigned to as opposed to their personal tutor. Was this intentional? I probably should have made that clearer when defining the necessary fields. However the databse is bound to be restructured multiple times during development and these small changes would be corrected if we had more time to spend on this. Gppd job getting this working.
