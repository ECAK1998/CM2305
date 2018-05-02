CREATE TABLE Logins (
	UniID varchar(8) PRIMARY KEY,
	Role varchar(10),
	Email varchar(320),
	SaltedPassword varchar(40)
);

CREATE TABLE Files (
	FileID int PRIMARY KEY,
	FilePath varchar(230),
	FileName varchar(30),
	UploaderComments varchar(100)
);

CREATE TABLE ModFiles (
	FileID int,
	ModComments varchar(100),
	Status varchar(8),
	FOREIGN KEY (FileID) REFERENCES Files(FileID)
);

CREATE TABLE Groups (
	GroupID int PRIMARY KEY,
	ClientID varchar(8),
	FOREIGN KEY (ClientID) REFERENCES Clients(ClientID)
);

CREATE TABLE Clients (
	ClientID varchar(8),
	ClientName varchar(40),
	FOREIGN KEY (ClientID) REFERENCES Logins(UniID)
);

CREATE TABLE Students (
	StudentName varchar(40),
	DegreeScheme varchar(40),
	StudentID varchar(8),
	GroupID int,
	Year int,
	FOREIGN KEY (StudentID) REFERENCES Logins(UniID),
	FOREIGN KEY (GroupID) REFERENCES Groups(GroupID)
);