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
        // Test age
        $myname = "Paul";
        $myage = 19;
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
        // Switch display wanted goods
        $wantedgood = "mugs";

        switch ($wantedgood) {
            case "specs":
                echo "You have to be 16 or over to buy specs";
                break;
            case "mugs":
                echo "You have to be 18 or over to buy mugs";
                break;
            case "sausage rolls":
                echo "You have to be 21 or over to buy sausage rolls";
                break;
            default:
                echo "You don't want anything!?";
        }

        ?>
    </p>
    </body>
</html>


