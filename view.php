<?php

class View {

    private $model;
    private $controller;

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function header() {
        $html = '<!DOCTYPE html>
                   <html>
                    <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
                    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
                    }
                    <script>
                    $(document).on("pagecreate","#pageone",function(){
                    $("p").on("swipeleft swiperight",function(e){

                        if ( e.type === "swipeleft"  ) {
                                    $("#rightPanel").panel("open");
                                } else if ( e.type === "swiperight" ) {
                                    $("#leftPanel").panel("open");
                                    
                                    var str = $(this).attr("value");
                                    //alert(document.getElementById("done").title);
                                    document.getElementById("done").title = str;
                                    document.getElementById("delay").title = str;
                                    xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                        document.getElementById("actiontxt").innerHTML = xmlhttp.responseText;
                                    }
                                    }
                                    xmlhttp.open("GET","getactionid.php?q="+str,true);
                                    xmlhttp.send();
                                }

                    });                       
                    });
                    </script>
                    <script type="text/javascript">
                    function actionDone(){
                        console.log("done actie opgeroepen voor : "+ document.getElementById("done").title);
                        var id = document.getElementById("done").title;
                                    xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                        document.getElementById("status").innerHTML = xmlhttp.responseText;
                                    }
                                    }
                                    xmlhttp.open("GET","handleactiondone.php?id="+id,true);
                                    xmlhttp.send();
                    };

                    function actionDelay(){
                        console.log("delay actie opgeroepen voor : "+ document.getElementById("delay").title);
                        var id = document.getElementById("delay").title;
                                    xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                        document.getElementById("status").innerHTML = xmlhttp.responseText;
                                    }
                                    }
                                    xmlhttp.open("GET","handleactiondelay.php?id="+id,true);
                                    xmlhttp.send();
                    };
                    </script>
                    </head>
                    <body>';
        
        return $html;
 }
 
 public function body (){
     $html = '<div data-role="page" id="pageone">
  
  <div data-role="panel" id="leftPanel" data-display="reveal"> 
    <h2>Reveal Panel</h2>
    <p id="actiontxt">You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
    <a id="done"  href="#"  onclick="actionDone()"   data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Done</a>
    <a id="delay"  href="#"  onclick="actionDelay()" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Stel uit</a>
  
  </div> 
  <div data-role="panel" id="rightPanel" data-display="reveal" data-position="right"> 
    <h2>Reveal Panel</h2>
    <p>You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
      <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Close panel</a>
  </div> 
  

  <div data-role="header">
    <h1>Page Header</h1>
  </div>

  <div data-role="main" class="ui-content">
    <p id="status"> </p> 
    <p  value="1">Click on one of the the buttons to open the Panel with different display modes.</p>
    <p value="2">Click on one of the the buttons to open the Panel with different display modes2.</p>
    <a href="#overlayPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Overlay Panel</a>
     <a href="#revealPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Reveal Panel</a>
      <a href="#pushPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Push Panel</a>
  </div>

  <div data-role="footer">
    <h1>Page Footer</h1>
  </div> 
</div> 

</body>
</html>';
     
     return $html;

 }
}