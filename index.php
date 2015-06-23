<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script>
            $(document).on("pagecreate","#pageone",function(){
                $("p").on("swipe",function(){
                    $(this).hide();
                    $('#revealPanel').show();
                });                       
            });
        </script>

    </head>
    <body>

        <div data-role="page" id="pageone">

            <div data-role="panel" id="revealPanel" data-display="reveal"> 
                <h2>Zie todo</h2>
                <p>Jeej, zeer goed gedaan</p>
                <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Sluit</a>
            </div> 


            <div data-role="header">
                <h1>Page Header</h1>
            </div>

            <div data-role="main" class="ui-content">
                <p>Dag zoet, druk op knop.</p>
                <!--<a href="#overlayPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Overlay Panel</a> -->
                <a href="#revealPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Druk hier</a>
                <!-- <a href="#pushPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Push Panel</a> -->
            </div>

            <div data-role="main" class="ui-content">
                <p>If you swipe me, I will disappear.</p>
                <p>Swipe me away!</p>
                <p>Swipe me too!</p>
            </div>


            <div data-role="footer">
                <h1>Page Footer</h1>
            </div> 
        </div> 

    </body>
</html>

