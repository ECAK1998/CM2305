FOR 1ST PRESENTATION TO CLIENT.

The program is mostly self explanatory but some of it may not be so 
I'll just write some simple instructions/guideline just incase.

Run the given file 'example.csv' in the import csv slot.
After this I'd recommend creating the groups straight away.
-> After hitting the create groups button there are 2 UNLABELLED
   text input boxed the LEFT BOX is designated for DESIRED NO. OF GROUPS
   and the RIGHT BOX is designated for the MAX. NO. OF STUDENTS PER GROUP
-> I recommend using 4 for both values as this works well with the 16
   students that are contained in the file 'example.csv', if not you
   should be able to use other numbers however this hasn't been tested
   yet.

Anywhere else there is a text entry field the input should be a STUDENT
ID (APART FROM IN THE SEARCH FOR STUDENT WINDOW WHICH CAN TAKE A NAME ALSO),
examples of which you can find in the 'example.csv' file to demonstrate
how this works to the client.

Points to mention:

- The manually add/create a student functionality does not require all
  text input sections to be filled in to create a student.
- The Delete student functionality throws an error however seems to work
  without disrupting the rest of the program's functionality in any way
  this should be looked at in the future to potentially fix.
- Make sure to go into the sort read data button/window and click the
  'Randomly assign students to groups' button before exporting the data
  to the 'output.csv' file because it doesn't check if the data has been
  sorted before writing the data as of so far.
- The create sorted CSV file functionality prints the sorted data into
  a premade CSV file 'output.csv'.
