<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    <p>
        <?php
        echo "Hello World";
        echo "<br>";
        echo "Hello,"." "."world"."!";
        echo "<br>";
        echo 5 * 7;
        echo "<br>";
        $myname = "Paul";
        $myage = 15;
        if ($myage >=21){
            print "Hello " . $myname . " you are " . $myage . " so you can buy specs, mugs and sausage rolls";
        }
        elseif ($myage >=18) {
            print "Hello " . $myname . " you are " . $myage . " so you can buy specs and mugs.";
        }
        elseif ($myage >=16) {
            print "Hello " . $myname . " you are " . $myage . " so you can buy specs";
        }
        else {
            print "Hello " . $myname . " you are only" . $myage . ". Too young to buy anything!";
        }
        ?>
    </p>
    </body>
</html>


