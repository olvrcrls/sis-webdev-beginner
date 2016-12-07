$(document).ready(function(){

	$("#viewBtn").click(function(){
			
			var ay = $("#viewAy").val();
			var sub = $("#viewSub").val();
			
			if(ay === undefined || ay == ''){
					alert("Select Academic year.");
					
			}
			
			else if (sub === undefined || sub == ''){
					alert("Select the subject you are assigned.");
			}
			
			else{
					
					$.ajax({
							
							url: "facultyView.php",
							dataType: "json",
							data: "acadyear="+ay+"&fs="+sub,
							success: function(data){
									var content = '';
									var length = data.length;
									for(var i = 0; i < length; i++){
											
										content += "<tr><td>"+data[i].sno+"</td><td>"+data[i].name+"</td><td>"+data[i].status+"</td></tr>";
									}//for
									
									if(content != ''){
											$("#tbView").html(content);
									}
									else{
											content += "<tr><td>NONE</td><td>NONE</td><td>NONE</td></tr>";
											$("#tbView").html(content);
									}
									
									
							},
							error: function(){
									alert("Cannot fetch records from server.");
							}
							
					});
					
					
			}
			
			
			
	});
});