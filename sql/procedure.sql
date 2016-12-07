DELIMITER //
create procedure `createAccount`(in username varchar(100) , in password varchar(100) , in type varchar(100) , in email varchar(100))
BEGIN
	INSERT INTO tblAccount(account_username, account_password, account_type, account_email)
			VALUES (username,password,type,email);
END // DELIMITER ;


DELIMITER //
create procedure `assignFacultySubject`(in faculty varchar(100), in subject varchar(100), status varchar(45) )
begin
	declare id int;
	SELECT fs_id into id FROM tblfacultysubject WHERE faculty_number = faculty AND subject_name = subject;
	
	if(id is null) then
		INSERT INTO tblFacultySubject(faculty_number,subject_name,fs_status) VALUES (faculty,subject,status);

	elseif(id is not null) then
		call raise_error;

	end if;
end // delimiter ;