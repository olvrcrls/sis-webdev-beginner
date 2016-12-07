$(document).ready(function(){

	$("#searchOverall").click(function(){
	
	
		var ay = $("#Overall_acadyear").val();
		var year = $("#Overall_year").val();
		
		if(ay === undefined || ay == ''){
			
			alert("Select Academic year.");
		
		}
		
		else if(year === undefined || year == ''){
			
			alert("Select year level.");
		
		}
		
		else{
				
				
				$.ajax({
						
						url: "./js/overallreport.php",
						dataType: "json",
						data: "ay="+ay+"&year="+year,
						success: function(data){
									var length = data.length;
									var content = '';
									for(var i = 0; i < length; i++){
												content += "<tr><td>"+data[i].sno+"</td><td>"+data[i].name+"</td><td>"+data[i].section+"</td><td>"+data[i].status+"</td></tr>";
										}//for
									if(content != ''){
											$("#tableBody").html(content);
											
									} else{
										content += "<tr><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td></tr>";
										$("#tableBody").html(content);
									}
									
									$("#Overall_totalnumber").html(length);
						
						},
						
						error: function(){
								alert('Cannot retrieve data from server.');
						}
						
				});//ajax
				
				
				
				
		}//else
	
	});//btnOverall
	
	
	
	$("#btnPerSection").click(function(){
			
			var ay = $("#perAy").val();
			var ys = $("#perYs").val();
			
			if(ay === undefined || ay == ''){
					alert("Select Academic year.");
			}
			
			else if (ys === undefined || ys == ''){
					alert("Select year level.");
			}
			
			else{
					
					$.ajax({
							
							url: "./js/persection.php",
							dataType: "json",
							data:"ay="+ay+"&section="+ys,
							success: function(data){
									var length = data.length;
									var content = '';
									for(var i = 0; i < length; i++){
										content += "<tr><td>"+data[i].sno+"</td><td>"+data[i].name+"</td><td>"+data[i].section+"</td><td>"+data[i].status+"</td></tr>";
									}//for
									if(content != ''){
										$("#tbPerSection").html(content);
										
									} else{
										content += "<tr><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td></tr>";
										$("#tbPerSection").html(content);
									}
									
									$("#perTotal").html(length);
							},
							error: function(){
									alert("Cannot retrieve record from server.");
							}
							
							
					});
					
					
					
					
			}
			
			
	});//btnPerSection
	
	
	
	$("#selectDepartment").change(function(){
			
			var department = $("#selectDepartment").val();
			
			$.ajax({
					
					url: "perfaculty.php",
					dataType: "json",
					data: "department="+department,
					success: function(data){
							var length = data.length;
							var content = '';
							for(var i = 0; i < length; i++){
								content += "<tr><td>"+data[i].fno+"</td><td>"+data[i].name+"</td><td>"+data[i].gender+"</td><td>"+data[i].status+"</td></tr>";	
							}
							
							if(content != ''){
									$("#tbFaculty").html(content);
							}else{
								content += "<tr><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td></tr>";
								$("#tbFaculty").html(content);	
							}
							
					},
					error: function(){
							
							alert("Cannot retrieve records from server.");
							}
					
					
			});
			
			
			
	});
	

});