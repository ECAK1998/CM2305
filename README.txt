This is the code for the Grouping tool GUI

To make the groups, click "create groups" then click the create groups button then return to the main menu

group.php - made some edits to it read and group students correctly

	> I'm using $_SESSION to pass the $students array between pages, im not sure the best way to do this
		and at current it doesn't always work

	%% Sean has since upadated this, not sure how it will work with the new code %%

groupAddStudent - this page is not complete, has no functionality at present

groupingTool - Main page, displays all groups read from the $students array

groupSearch - Searches through the students based either on name or id and displays all the students found
	
	> Here I wrote some simple search functions to search through the $students array, these should be replaced with seans code

groupUpload - Where files are uploaded and groups created

	> upload doesn't work, create groups button will use the already uploaded csvs

