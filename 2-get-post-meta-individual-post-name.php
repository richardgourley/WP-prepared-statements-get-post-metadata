<?php
/*
In this example, we retrieve ONE row using the GET_ROW function.
Then we print the metadata for the post result.
*/

//Variable from the user - button clicked, drop down menu etc.
$post_name = 'Painting';

function get_metadata_individual_post($post_name){
    //Sanitized post name string before entering into SQL query.
    $post_name_sanitized = filter_var($post_name, FILTER_SANITIZE_STRING);
        
    $output_string = "";
    global $wpdb;

    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_title = %s",
        $post_name_sanitized
    );
    //Use get row when you expect 1 row as a result.
    $result = $wpdb->get_row($stmt);
    //Escape all output from the database with htmlspecialchars
    //Here we print the POST TITLE for each result from the query
    $output_string .= "<h1>" . htmlspecialchars($result->post_title) . "</h1>";
    //Get post meta allows us to get specific post meta by POST ID and META KEY.
    //In the parameters for get_post_meta, TRUE returns a single value, FALSE returns an array.
    $output_string .= "<p>PRICES FROM: $";
    $output_string .=  htmlspecialchars(get_post_meta($result->ID, 'price_from', true)) . "</p>";
    $output_string .= "<p>" . htmlspecialchars(get_post_meta($result->ID, 'our_promise', true)) . "</p>";

    return $output_string;

}

/*
NOTE: You can use %d or %f if you have an integer or float to pass in to your prepared statements using WPDB->prepare.
*/