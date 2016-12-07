  var xml = new createXmlHttpRequestObject();

  function createXmlHttpRequestObject(){
    var xml;
      if(window.ActiveXObject){
        try{
        xml = new ActiveXObject("Microsoft.XMLHTTP");
      } catch(e){
          alert( e.toString() );
        }
      } //try

      else{
        try{
          xml = new XMLHttpRequest();
        } catch(e){
          xml = false;
        }
      }//else

      if(!xml){
        alert("Cannot create XMLHttpRequest");
      }
      return xml;
  }

  function process(){
    if(xml){
      try{
        xml.open("GET","ajax-xml.php",true);
        xml.onreadystatechange = handleStateChange;
        xml.send(null);
      }catch(e){
          alert( e.toString() );
      }
    } else{
        setTimeout('process()',1000);
    }
  }//process

  function handleStateChange(){
    if(xml.readyState == 4){
      if(xml.status == 200){
        try{
            handleResponse();
        }//try
        catch(e){
            alert(e.toString());
        }
      }
        else{
          alert(xml.statusText);
        }
    }
  }//handleStateChange()

  function handleResponse(){
    var response = xml.responseXML;
    root = response.documentElement; //<response> in xml file </response>
  }
