<?php

$path = '../../..';
include_once $path . '/wp-config.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';



function wp_subscription($e) {
    global $wpdb;
    $sql = "SELECT * FROM wp_subscription WHERE email = '$e'";
    $results = $wpdb->get_results( $sql );
    if(!$results){
        $wpdb->insert('wp_subscription', array('email' => $e), array('%s','%d'));
    }
    return 'Thankyou for subscribing';
}

if(isset($_POST['email'])){
    $email=$_POST['email'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        echo "Please enter valid email.";
        exit;
    }
    echo wp_subscription($email);
}
else {
    echo "Please enter valid email.";
}

?>