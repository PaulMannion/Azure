//SQL Injection


// Impossible SQL Injection Source

<?php

if( isset( $_GET[ 'Submit' ] ) ) {
    // Check Anti-CSRF token 
    checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'index.php' );

    // Get input 
    $id = $_GET[ 'id' ];

    // Was a number entered? 
    if(is_numeric( $id )) {
        // Check the database 
        $data = $db->prepare( 'SELECT first_name, last_name FROM users WHERE user_id = (:id) LIMIT 1;' );
        $data->bindParam( ':id', $id, PDO::PARAM_INT );
        $data->execute();
        $row = $data->fetch();

        // Make sure only 1 result is returned 
        if( $data->rowCount() == 1 ) {
            // Get values 
            $first = $row[ 'first_name' ];
            $last  = $row[ 'last_name' ];

            // Feedback for end user 
            echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
        }
    }
}

// Generate Anti-CSRF token 
generateSessionToken();

?>

//High SQL Injection Source

<?php

if( isset( $_SESSION [ 'id' ] ) ) {
    // Get input 
    $id = $_SESSION[ 'id' ];

    // Check database 
    $query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id' LIMIT 1;";
    $result = mysql_query( $query ) or die( '<pre>Something went wrong.</pre>' );

    // Get results 
    $num = mysql_numrows( $result );
    $i   = 0;
    while( $i < $num ) {
        // Get values 
        $first = mysqli_result( $result, $i, "first_name" );
        $last  = mysqli_result( $result, $i, "last_name" );

        // Feedback for end user 
        echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";

        // Increase loop count 
        $i++;
    }

    mysql_close();
}

?>

//Medium SQL Injection Source

<?php

if( isset( $_POST[ 'Submit' ] ) ) {
    // Get input 
    $id = $_POST[ 'id' ];
    $id = mysqli_real_escape_string( $id );

    // Check database 
    $query  = "SELECT first_name, last_name FROM users WHERE user_id = $id;";
    $result = mysqli_query( $query ) or die( '<pre>' . mysql_error() . '</pre>' );

    // Get results 
    $num = mysql_numrows( $result );
    $i   = 0;
    while( $i < $num ) {
        // Display values 
        $first = mysqli_result( $result, $i, "first_name" );
        $last  = mysqli_result( $result, $i, "last_name" );

        // Feedback for end user 
        echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";

        // Increase loop count 
        $i++;
    }

    //mysql_close(); 
}

?>

//Low SQL Injection Source

<?php

if( isset( $_REQUEST[ 'Submit' ] ) ) {
    // Get input 
    $id = $_REQUEST[ 'id' ];

    // Check database 
    $query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id';";
    $result = mysqli_query( $query ) or die( '<pre>' . mysql_error() . '</pre>' );

    // Get results 
    $num = mysqli_numrows( $result );
    $i   = 0;
    while( $i < $num ) {
        // Get values 
        $first = mysqli_result( $result, $i, "first_name" );
        $last  = mysqli_result( $result, $i, "last_name" );

        // Feedback for end user 
        echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";

        // Increase loop count 
        $i++;
    }

    mysqli_close();
}

?> 


