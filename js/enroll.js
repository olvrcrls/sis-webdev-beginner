$(document).ready(function(){

	$("#enroll_student").change(function(){
	
		var student = $("#enroll_student").val();
		
		
		$.ajax({
				
				url: "enrollstudent.php",
				dataType: "xml",
				data: "student="+student,
				success: function(xmldata){
						
						var name = $(xmldata).find('name').text();
						var ys = $(xmldata).find('ys').text();
						$("#enroll_studentname").val(name);
						$("#enroll_yearsection").val(ys);
						
						
				},
				
				error: function(){
						
						alert("Unable to retrieve student information. Please refresh.");
						
				}
				
				
		});
			
			
	});//select enroll student name
	
	
	$("#enroll_subject").change(function(){
			
			var subject = $("#enroll_subject").val();
			
			
			$.ajax({
					
					url: "js/enrollstudentfaculty.php",
					dataType: "xml",
					data: "subject="+subject,
					success: function(xmldata){
							var faculty = $(xmldata).find('faculty').text();
							
							$("#enroll_facultyname").val(faculty);
					},
					error: function(){
							alert("Cannot retrieve faculty-in-charge information from server.");
					}
					
					
			});
			
			
			
	});


});