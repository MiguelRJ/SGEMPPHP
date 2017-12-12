<?php 

function show_head($titulo){
    print "
    <!DOCTYPE html>
    <html lang=\"es\">
        <head>
            <title>".$titulo."</title>
            <meta charset=\"utf8\"/>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' media='screen'>
        </head>
        <body>
        <h1>".$titulo."</h1>
        <script src='http://code.jquery.com/jquery.js'></script>
        <script src='js/bootstrap.min.js'></script>";
}

function show_footer(){
    print "
        </body>
    </html>";
}

?>