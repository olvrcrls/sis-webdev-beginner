$(document).ready( function(){
	
	$("#reenroll_student").change(function(){
			
			var student = $("#reenroll_student").val();
			
			if(student === undefined || student == ""){
					alert("No student reference given.");
			}
			
			$.ajax({
					
					dataType: "xml",
					url: "studentname.php",
					data: "student="+student,
					success: function(xmldata){
							
							var name = $(xmldata).find('name').text();
							$("#studentname").val(name);
							
					},
					error: function(){
							
							alert("Cannot fetch that student's information.");
							stop();
							
					}
			});
	});
	
	
	
	$("#assign_faculty").change(function(){
			
			var faculty = $("#assign_faculty").val();
			
			if(faculty === undefined || faculty == ""){
					alert("Faculty is now unassign.");
			}
			
			$.ajax({
					
					dataType: "xml",
					url: "./js/facultyname.php",
					data: "faculty="+faculty,
					success: function(xmldata){
							
							var faculty_name = $(xmldata).find('faculty').text();
							$("#facultyname").val(faculty_name);
							
							
					},
					error: function(){
					
					alert("Cannot fetch that faculty's information.");
					stop();
					
				}
					
					
			});
			
	});
});