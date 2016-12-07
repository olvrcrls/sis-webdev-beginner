use `sjnhs`; 

INSERT into tblaccount(account_username,account_password,account_email,account_type)
			VALUES ('admin','admin','sjnhs.sis.system@gmail.com','ADMINISTRATOR');
INSERT into tblaccount(account_username,account_password,account_email,account_type)
			VALUES ('registrar','registrar','sjnhs.sis.registrar.system@gmail.com','REGISTRAR');
INSERT into tblaccount(account_username,account_password,account_email,account_type)
			VALUES ('faculty','faculty','sjnhs.sis.faculty.system@gmail.com','FACULTY');
INSERT into tblaccount(account_username,account_password,account_email,account_type)
			VALUES ('student','student','sjnhs.sis.student.system@gmail.com','STUDENT');



INSERT INTO `sjnhs`.`tbldepartment` (`department_id`, `department_name`) VALUES ('1', 'Science Department');
INSERT INTO `sjnhs`.`tbldepartment` (`department_id`, `department_name`) VALUES ('2', 'TLE Department');
INSERT INTO `sjnhs`.`tblfaculty` (`faculty_id`, `faculty_number`, `faculty_fname`, `faculty_mname`, `faculty_lname`, `faculty_gender`, `faculty_address`, `faculty_email`, `faculty_status`) VALUES ('2', 'FACULTY-00002', 'John Leonard', null, 'Soliman', 'MALE', 'MONTALBAN CITY', 'faculty1@mail.com', 'ACTIVE');
INSERT INTO `sjnhs`.`tblfaculty` (`faculty_id`, `faculty_number`, `faculty_fname`, `faculty_mname`, `faculty_lname`, `faculty_gender`, `faculty_address`, `faculty_email`, `faculty_status`) VALUES ('1', 'FACULTY-00001', 'Abegail', 'Apolonio', 'Soliman', 'FEMALE', 'MONTALBAN CITY', 'faculty2@mail.com', 'ACTIVE');
INSERT INTO `sjnhs`.`tblfaculty` (`faculty_id`, `faculty_number`, `faculty_fname`, `faculty_mname`, `faculty_lname`, `faculty_gender`, `faculty_address`, `faculty_email`, `faculty_status`) VALUES ('3', 'FACULTY-00003', 'Amelita', 'Cruz', 'Panelo', 'FEMALE', 'MARIKINA CITY', 'faculty3@mail.com', 'ACTIVE');
INSERT INTO `sjnhs`.`tbldepartmentfaculty` (`df_id`, `department_name`, `faculty_number`) VALUES ('1', 'Science Department', 'FACULTY-00001');
INSERT INTO `sjnhs`.`tbldepartmentfaculty` (`df_id`, `department_name`, `faculty_number`) VALUES ('2', 'Science Department', 'FACULTY-00002');
INSERT INTO `sjnhs`.`tbldepartmentfaculty` (`df_id`, `department_name`, `faculty_number`) VALUES ('3', 'TLE Department', 'FACULTY-00003');
select tblfaculty.faculty_number, faculty_fname, faculty_status, faculty_mname, faculty_lname, department_name from tblfaculty
inner join tbldepartmentfaculty on tblfaculty.faculty_number = tbldepartmentfaculty.faculty_number;

INSERT INTO tblStudent(student_number, student_fname, student_mname, student_lname,
				student_gender, student_address, student_contact, student_email, student_birthdate) 
				VALUES('SJNHS-2016-00001','oli','pascual','carlos','MALE','SAN JUAN CITY',null,'olibearrrpascualarlos@gmail.com','1996-04-21');

INSERT INTO tblStudent(student_number, student_fname, student_mname, student_lname,
				student_gender, student_address, student_contact, student_email, student_birthdate,student_status) 
				VALUES('SJNHS-2016-00002','Juan','Dela Cruz','Santos','MALE','SAN JUAN CITY',null,'example@gmail.com','1996-04-21','INACTIVE');


