drop database if exists `sjnhs`;
create database if not exists `sjnhs`;
use `sjnhs`;


create table if not exists tblAccount(
	account_number int auto_increment NOT NULL PRIMARY KEY,
	account_username varchar(100) NOT NULL UNIQUE,
	account_password varchar(100) NOT NULL,
	account_type varchar(45) NOT NULL CHECK
	(account_type = 'ADMINISTRATOR' OR account_type = 'REGISTRAR'
		OR account_type = 'FACULTY' OR account_type = 'STUDENT'),
	account_datetime datetime NOT NULL default now(),
	account_email varchar(100) NOT NULL UNIQUE
)ENGINE = innodb;

create table if not exists tblLog(
	log_number int auto_increment NOT NULL PRIMARY KEY,
	log_user varchar(100) NOT NULL,
	log_datetime datetime NOT NULL default now(),
	log_ip varchar(100) NOT NULL,
	Foreign Key (log_user) references tblAccount(account_username)
)ENGINE = InnoDB;


create table if not exists tblStudent(
	student_id int auto_increment NOT NULL PRIMARY KEY,
	student_number varchar(100) NOT NULL UNIQUE,
	student_fname varchar(100) NOT NULL,
	student_mname varchar(100) NULL,
	student_lname varchar(100) NOT NULL,
	student_gender varchar(45) NOT NULL CHECK (student_gender = 'MALE' OR student_gender = 'FEMALE'
	OR student_gender = 'male' OR student_gender = 'female'),
	student_address varchar(200) NOT NULL,
	student_contact varchar(13) NULL default null,
	student_birthdate date NOT NULL,
	student_email varchar(100) NOT NULL UNIQUE,
	student_status varchar(45) NOT NULL default 'ACTIVE'
	CHECK(student_status = 'ACTIVE' OR student_status = 'INACTIVE')
)ENGINE = innodb;


create table if not exists tblFaculty(
	faculty_id int auto_increment NOT NULL PRIMARY KEY,
	faculty_number varchar(100) NOT NULL UNIQUE,
	faculty_fname varchar(100) NOT NULL,
	faculty_mname varchar(100) NULL,
	faculty_lname varchar(100) NOT NULL,
	faculty_gender varchar(45) NOT NULL CHECK (student_gender = 'MALE' OR student_gender = 'FEMALE'
	OR student_gender = 'male' OR student_gender = 'female'),
	faculty_address varchar(200) NOT NULL,
	faculty_contact varchar(13) NULL default null,
	faculty_birthdate date NOT NULL,
	faculty_email varchar(100) NOT NULL UNIQUE,
	faculty_status varchar(45) NOT NULL default 'ACTIVE'
	CHECK(student_status = 'ACTIVE' OR student_status = 'INACTIVE')
)Engine = innodb;


create table if not exists tblDepartment(
	department_id int auto_increment NOT NULL PRIMARY KEY,
	department_name varchar(100) NOT NULL UNIQUE
)ENGINE = innodb;

create table if not exists tbldepartmentfaculty(
	df_id int auto_increment NOT NULL PRIMARY KEY,
	department_name varchar(100) NOT NULL,
	faculty_number varchar(100) NOT NULL UNIQUE,
	Foreign Key (department_name) references tblDepartment(department_name),
	Foreign Key (faculty_number) references tblFaculty(faculty_number)
)ENGINE = innodb;	

create table if not exists tblyear(
	year_id int auto_increment NOT NULL PRIMARY KEY,
	year_name varchar(100) NOT NULL UNIQUE
)ENGINE = innodb;

create table if not exists tblsection(
	section_id int auto_increment NOT NULL PRIMARY KEY,
	section_name varchar(100) NOT NULL UNIQUE
)ENGINE = innodb;

create table if not exists tblyearsection(
	ys_id int auto_increment NOT NULL PRIMARY KEY,
	year_name varchar(100) NOT NULL,
	section_name varchar(100) NOT NULL UNIQUE,
	Foreign Key (year_name) references tblYear(year_name),
	Foreign Key (section_name) references tblsection(section_name)
)ENGINE = innodb;

create table if not exists tblstudentlevel(
	studentlevel_id int auto_increment NOT NULL PRIMARY KEY,
	studentlevel_student varchar(100) NOT NULL,
	studentlevel_ys int NOT NULL,
	studentlevel_datetime datetime NOT NULL default now(),
	studentlevel_acadyear varchar(45) NOT NULL,
	studentlevel_status varchar(45) NOT NULL default 'ACTIVE'
	check(studentlevel_status = 'ACTIVE' OR studentlevel_status = 'INACTIVE'),
	Foreign Key (studentlevel_ys) references tblyearsection(ys_id)
) engine = innodb;

create table if not exists tblsubject(
	subject_id int auto_increment NOT NULL PRIMARY KEY,
	subject_name varchar(100) NOT NULL UNIQUE
);

create table if not exists tblyearsubject(
	ysu_id int auto_increment NOT NULL PRIMARY KEY,
	year_name varchar(100) NOT NULL,
	subject_name varchar(100) NOT NULL UNIQUE,
	Foreign Key(year_name) references tblyear(year_name),
	Foreign Key(subject_name) references tblsubject(subject_name)
)ENGINE = innodb;

create table if not exists tblfacultysubject(
	fs_id int auto_increment NOT NULL PRIMARY KEY,
	faculty_number varchar(100) NOT NULL,
	subject_name varchar(100) NOT NULL,
	fs_status varchar(45) NOT NULL default 'ACTIVE'
	CHECK(fs_status = 'ACTIVE' OR fs_status = 'INACTIVE'),
	fs_datetime datetime NOT NULL default now(),
	Foreign Key(subject_name) references tblsubject(subject_name),
	Foreign Key(faculty_number) references tblfaculty(faculty_number)
)ENGINE = innodb;

create table if not exists tblenrollment(
	enrollment_number int auto_increment NOT NULL PRIMARY KEY,
	enrollment_id varchar(100) NOT NULL UNIQUE,
	enrollment_student int NOT NULL,
	enrollment_subject int NOT NULL,
	enrollment_acadyear varchar(10) NOT NULL,
	enrollment_datetime datetime NOT NULL default now(),
	Foreign Key(enrollment_student) references tblstudentlevel(studentlevel_id),
	Foreign Key(enrollment_subject) references tblfacultysubject(fs_id)
)ENGINE = innodb;

create table if not exists tblgrade(
	grade_id int auto_increment NOT NULL PRIMARY KEY,
	grade_student int NOT NULL,
	grade_fs int NOT NULL,
	grade_quarter int NOT NULL check(grade_quarter = 1 OR
	grade_quarter = 2 OR grade_quarter = 3 OR grade_quarter = 4),
	grade_datetime datetime NOT NULL default now(),
	grade_remarks varchar(45) NOT NULL default 'NONE'
	check(grade_remarks = 'PASS' OR grade_remarks = 'FAIL'),
	foreign key (grade_fs) references tblfacultysubject(fs_id),
	foreign key (grade_student) references tblenrollment(enrollment_student)
)engine = innodb;