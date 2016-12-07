$(document).ready(function(){
	$("#btnRetrieve").click( function(){
			
			if($("#efactcode").val() === undefined || $("#efactcode").val() == ''){
					alert("Select a faculty number.");
			}
			else{
			var faculty = $("#efactcode").val();
				
				$.ajax({
						url: "facultydetails.php",
						type: "GET",
						dataType: "xml",
						data: "faculty="+faculty,
						success: function(xmldata){
								$(xmldata).find("profile").each( function(){
									var lastname = $(this).find('lastname').text();
									var contact = $(this).find('contact').text();
									var email = $(this).find('email').text();
									var address = $(this).find('address').text();
									$("#elastname").val(lastname);
									$("#econtact").val(contact);
									$("#eemail").val(email);
									$("#eaddress").val(address);
									
								});//succcess
						},
						error: function(){
								alert("Cannot retrieve faculty record from server.");
						}
					
				});//$.ajax
			
			}
			
	});//btnViewDetails
	
	$("#efactcode").change(	function(){
					var faculty = $("#efactcode").val();
				
				$.ajax({
						url: "js/facultydetails.php",
		type: "GET",
					dataType: "xml",
					data: "faculty="+faculty,
					success: function(xmldata){
						$(xmldata).find("profile").each( function(){
							var lastname = $(this).find('lastname').text();
							var contact = $(this).find('contact').text();
							var email = $(this).find('email').text();
							var address = $(this).find('address').text();
							$("#elastname").val(lastname);
							$("#econtact").val(contact);
							$("#eemail").val(email);
							$("#eaddress").val(address);
							
						});//succcess
					},
					error: function(){
						alert("Cannot retrieve faculty record from server.");
					}
					
				});//$.ajax
					
	});



});