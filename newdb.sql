

CREATE TABLE Users (
    UserID varchar(15),
    UserType varchar(15),
    SaltedPassword varchar(255),
    PRIMARY KEY (UserID)
);

CREATE TABLE Lecturers (
    UserID varchar(15),
    LecturerName varchar(32),
    Course varchar(32),
    Email varchar(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Groups (
    GroupNumber int,
    UserID varchar(15),
    PRIMARY KEY (GroupNumber),
    FOREIGN KEY (UserID) REFERENCES Lecturers(UserID)
);

CREATE TABLE Students (
    UserID varchar(15),
    StudentName varchar(32),
    TutorName varchar(32),
    Course varchar(32),
    Year int,
    Email varchar(255),
    GroupNumber int,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (GroupNumber) REFERENCES Groups(GroupNumber)
);

CREATE TABLE Moderators (
    UserID varchar(15),
    ModeratorName varchar(32),
    Email varchar(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Files (
    StudentCanDelete varchar(5),
    FileName varchar(255),
    FirstUploaded DATETIME,
    LastUploaded DATETIME,
    PRIMARY KEY (FileName)
);
