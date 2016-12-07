

	var xmlHttp = new XmlHttpRequestObject();
	
	function XmlHttpRequestObject(){
		xmlHttp;
		if(window.ActiveXObject){
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e){ xmlHttp = false ;}
		}
		else if(window.XMLHttpRequest){
		
			try{
			
				xmlHttp = new XMLHttpRequest();
			
			} catch(e){ xmlHttp = false ; }
		
		}
		
		
		if(!xmlHttp){
			alert('Cannot create a connection.');
		}
		
		return xmlHttp;
	
	}
	
	
	function process(){
		if(xmlHttp){
			try{
				xmlHttp.open("GET","./js/accountlist.php",true);
				xmlHttp.onreadystatechange = handleServerResponse;
				xmlHttp.send(null);
				setTimeout("process()",1000);
			} catch(e){ alert(e.toString());}
		}
		
		else{
			setTimeout("process()", 1000);
		}
	}
	
	
	
	function handleServerResponse(){
		if(xmlHttp.readyState == 4){
			if(xmlHttp.status == 200){
				try{
				handleResponse();
				} catch(e){alert(e.toString());}
				} 
			} 
		}
		
	
	function handleResponse(){
		
		xmlResponse = xmlHttp.responseXML;
		documentRoot = xmlResponse.documentElement;
		accountnumber = documentRoot.getElementsByTagName('accountnumber');
		username = documentRoot.getElementsByTagName('username');
		password = documentRoot.getElementsByTagName('password');
		email = documentRoot.getElementsByTagName('email');
		type = documentRoot.getElementsByTagName('type');
		table = "<thead><tr><th>Account number</th><th>Account username</th><th>Account password</th><th>Account email</th><th>Account type</th></tr></thead>";
		table += "<tbody>";
		for(var x = 0; x < accountnumber.length; x++){
			
			table += "<tr><td align = 'center'> " +accountnumber.item(x).firstChild.data+ "</td>";
			table += "<td align = 'center'>" +username.item(x).firstChild.data+ "</td>";
			table += "<td align = 'center'>" +password.item(x).firstChild.data+ "</td>";
			table += "<td align = 'center'> " +email.item(x).firstChild.data+ "</td>";
			table += "<td align = 'center'>" +type.item(x).firstChild.data+ "</td></tr>";
			
		}
			table += "</tbody>";
			accountlist = document.getElementById('tblAccount');
			accountlist.innerHTML = table;
		
	}