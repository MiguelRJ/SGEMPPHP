<?php 

function show_head($titulo){
    print "
    <!DOCTYPE html>
    <html lang=\"es\">
        <head>
            <title>".$titulo."</title>
            <meta charset=\"utf8\"/>
        </head>
        <body>";
}

function show_footer(){
    print "
        </body>
    </html>";
}

?>