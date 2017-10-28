import csv

class someData:
	"""Class which would store data"""
	someString = ""
	someInteger = 0

	def __init__(self, someString, someInteger):
		self.someString = someString
		self.someInteger = someInteger


def main():
	#make list of tuples to save
	someList = []
	someList.append(someData("Bob",1))
	someList.append(someData("Alice",2))
	someList.append(someData("Eve",3))

	#save list to file
	f = open("testfile.csv","w") #w specifies we want to write to file
	for item in someList:
		f.write(item.someString + "," + str(item.someInteger) + "\n") #\n specifies new line
	f.close() #close open file to free up system resources

	print("Done.")


if __name__ == "__main__":
	main()
