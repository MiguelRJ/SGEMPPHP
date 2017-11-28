<?php 
print "
<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>Curiosidades en los tipos</title>
        <meta charset=\"utf8\"/>
    </head>
    <body>";
        $titulo = "Curiosidades en los tipos";
        print "<h1>$titulo</h1>";

        $a = "12 manzanas";
        $b = "7 peras";
        echo "<p>Las suma de manzanas y pera es: ".($a+$b)."</p>";

        $c = "platanos";
        $d = "naranjas";
        echo "<p>Las suma de platanos y naranjas es: ".($c+$d)."</p>";

print "
    </body>
</html>
";
?>