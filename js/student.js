  var xmlHttp = new createXmlHttpRequestObject();

  function createXmlHttpRequestObject(){
    xmlHttp;
    if(window.ActiveXObject){
      try{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }catch( e ){
        alert( e.toString());
      }
    }//if ActiveXObject

    else if(window.XMLHttpRequest){
      try{
      xmlHttp = new XMLHttpRequest();
    }catch(e){
        alert( e.toString());
      }
    }

    else{
      xmlHttp = false;
    }

    if(!xmlHttp){
      alert('Cannot connect to server.');
    }

    return xmlHttp;
  }//createXmlHttpRequestObject

    function process(){
      if(xmlHttp){
        try{
          xmlHttp.open("GET","grades-ajax.php",true);
          xmlHttp.onreadystatechange = handleServerResponse();
          xmlHttp.send(null);
        } catch(e) {
            alert(e.toString());
        }
      } else{
        setTimeout('process()',1000);
      }
    }

    function handleServerResponse(){
      if(xmlHttp.readyState == 4){
        try{
        if(xmlHttp.status == 200){
          Response();
        }catch(e){
          alert(xml.statusText);
          }
        }
      }//if
    }

    function Response(){
      xmlReponse = xmlHttp.responseXML;
      root = xmlResponse.documentElement;
      
    }
