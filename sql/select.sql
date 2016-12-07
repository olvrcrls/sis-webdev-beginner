use `sjnhs`;

select * from tbllog;
select * from tbldepartment;
select * from tblstudent;
select * from tblaccount;
select * from tblfaculty;
select * from tblyearsubject;
select * from tblsubject;
select * from tblfacultysubject;
select * from tblstudentlevel;
select * from tbldepartmentfaculty;
select * from tblenrollment;
select count(faculty_number) counter from tbldepartmentfaculty where department_name = 'science department';

select student_fname, student_lname, student_mname, studentlevel_id from tblstudentlevel inner join tblstudent
	on student_number = studentlevel_student;

select faculty_fname,faculty_mname,faculty_lname from tblfaculty inner join
				tblfacultysubject on tblfaculty.faculty_number = tblfacultysubject.faculty_number WHERE fs_id = 2;


select student_fname,student_lname,student_mname, year_name, section_name from tblstudentlevel inner join
	tblstudent on studentlevel_student = student_number inner join tblyearsection on studentlevel_ys = ys_id
    inner join tblenrollment on enrollment_student = studentlevel_id;

select year_name, section_name from tblstudentlevel inner join tblyearsection on 
		studentlevel_ys = ys_id WHERE studentlevel_student = '2013-01371-0';

SELECT studentlevel_student, student_fname, student_mname, student_lname,
					section_name, student_status FROM tblstudentlevel inner join
					tblstudent on studentlevel_student = student_number inner join
					tblyearsection on studentlevel_ys = ys_id WHERE studentlevel_acadyear = '2016-2017' AND year_name = '1';
select * from tblaccount;

SELECT studentlevel_student, student_fname, student_mname, student_lname FROM tblstudentlevel
		inner join tblstudent on studentlevel_student = student_number inner join tblyearsection
		on studentlevel_ys = ys_id where ys_id = 1;
SELECT tbldepartmentfaculty.faculty_number, faculty_fname, faculty_mname, faculty_lname FROM tbldepartmentfaculty
			inner join tblfaculty on tbldepartmentfaculty.faculty_number = tblfaculty.faculty_number;

select * from tblstudentlevel;
SELECT * from tblenrollment;

SELECT fs_id FROM tblfacultysubject WHERE faculty_number = 'FACULTY-00004';
/*VERIFIES THE FACULTY THAT IS ASSIGNED FOR THAT SUBJECT*/
SELECT studentlevel_student from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
WHERE enrollment_number = 4
; /*VERIFIES THE STUDENT THAT IS ENROLLED*/

SELECT enrollment_number from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
WHERE enrollment_subject = (SELECT fs_id FROM tblfacultysubject WHERE faculty_number = 'FACULTY-00003' AND fs_id = 2) AND enrollment_acadyear = '2016-2017';


SELECT student_number, student_fname, student_lname, student_mname, student_status FROM tblStudent inner join
	tblstudentlevel on student_number = studentlevel_student WHERE student_number = (SELECT studentlevel_student from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
WHERE enrollment_number = 4
);/*GETS THE STUDENT INFO*/


select * from tblfacultysubject;


/******FINAL*****/

select * from tblenrollment;
SELECT student_number, student_fname, student_lname, student_mname, student_status FROM tblStudent inner join
		tblstudentlevel on student_number = studentlevel_student WHERE student_number = (SELECT studentlevel_student from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
		WHERE enrollment_number = 4);


SELECT enrollment_number from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
	WHERE enrollment_subject = (SELECT fs_id FROM tblfacultysubject WHERE faculty_number = 'FACULTY-00003' AND fs_id = 2) AND enrollment_acadyear = '2016-2017';

