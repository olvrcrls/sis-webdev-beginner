//AJAX for captcha change.
  var xml = new xmlHttpRequestObject();

function xmlHttpRequestObject(){
  var xml;
  if(window.ActiveXObject){
    try{
      xml = new ActiveXObject("Microsoft.XMLHTTP"); //for idiot IE 6 below users.
    }//try
    catch(e){
      xml = false;
    }
  }//if
  else{
    try{
      xml = new XMLHttpRequest(); //for almost all of the internet browsers.
    }//try
    catch(e){
      xml = false;
    }
  }

  if(!xml){
    alert("Cannot create xml http request.");
  } else return xml;
}//function xmlHttpRequestObject

function changeCaptcha(){
  if(xml){
    try{
      xml.open('GET','captchaXml.php',true); //open a configuration in communicating with the server.
      xml.onreadystatechange = serverResponse; //checks if the server receives and changes the state of xml.
      xml.send(null); //sends the response.

    }catch(e){
      alert( e.toString() );
    }
  }

}//changeCaptcha

  function serverResponse(){
    captchaImage = document.getElementById("captchaImage");
    if(xml.readyState == 2 || xml.readyState == 4){
      if(xml.status == 200){

      }
      else{
        alert( xml.statusText );
      }
    }
  }

  function changeCode(){
    
  }
