$(document).ready(function(){
	$("#btnRetrieve").click( function(){
		
		if($("#estudent_number").val() === undefined || $("#estudent_number").val() == ''){
				alert("Choose a student number.");
		}
		else{
				var student = $("#estudent_number").val();
		$.ajax({
				type: "GET",
				url: "studentdetails.php",
				data: "student="+student,
				dataType: "xml",
				success: function(xmldata){
						$(xmldata).find('profile').each(function(){
							var lastname = $(this).find('lastname').text();
							var contact = $(this).find('contact').text();
							var email = $(this).find('email').text();
							var address = $(this).find('address').text();
								$("#elastname").val(lastname);
								$("#econtact").val(contact);
								$("#eemail").val(email);
								$("#estudent_address").val(address);
						});
				},
				error: function(){
						alert("Cannot retrieve data from server.");
				}
				
		});//$.ajax
			
			}
			
	});
	
	$("#estudent_number").change(function(){
			
		var student = $("#estudent_number").val();
		$.ajax({
				type: "GET",
		url: "./js/studentdetails.php",
			data: "student="+student,
			dataType: "xml",
			success: function(xmldata){
				$(xmldata).find('profile').each(function(){
					var lastname = $(this).find('lastname').text();
					var contact = $(this).find('contact').text();
					var email = $(this).find('email').text();
					var address = $(this).find('address').text();
					$("#elastname").val(lastname);
					$("#econtact").val(contact);
					$("#eemail").val(email);
					$("#estudent_address").val(address);
				});
			},
			error: function(){
				alert("Cannot retrieve data from server.");
			}
			
		});//$.ajax
			
			
		});

		
});//document.ready

