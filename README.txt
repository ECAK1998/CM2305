~~~~~ Run groupManagement.php ~~~~~

This is how I imagine the program working:
Area to upload student and tutor csv files. Once the files have been uploaded they need to be checked to ensure they are formatted correctly. If they are formatted correctly, they can be uploaded to the database. There should then be a button to that will group the students and relay the grouped data to the user below the buttons. Once grouped, there should be additional functionality to add/move/remove individual students (database should be updated after each change).

03/17 - Week 2:
   Made a basic interface for the grouping tool, a lot needs to be done before being functional:

   IMPORTANT - Haven't yet heard from the UI team for any rough designs for the grouping tool

   - Need to complete upload.php (similar to the file upload system) so that student/tutor files can be stored on the server.
   - The grouping functions works theoretically but I can't get it working for whatever reason, all I want at the moment is for the             grouped data to be printed to the screen after the final button is clicked.
   - After that is working, this needs to be integrated with the database.
   
03/17 - Week 3:
   Really struggling to find what the problem is in group.php, this is what is holding back progress on the project. I have found and        fixed some issues but the page still will not run on a server. This week I have:
   
   - Reworked the createGroups() function, it is now much more straightforward and this assures me that the problem is not here
   - Fixed the variable declaration inside both classes, they are now declared as public variables.
   
   If I had to guess I would assume the problem is with reading the data into the program from the CSV files. I will ask for help with how    to check this in the upcoming group meeting.
   
03/17 - Week 4:
