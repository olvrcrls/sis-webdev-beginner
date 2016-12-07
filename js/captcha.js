  function changeCode(){
    var random = Math.random();
      document.getElementById("imgCaptcha").src = "gd/generateCaptcha.php?$random ="+random; }
