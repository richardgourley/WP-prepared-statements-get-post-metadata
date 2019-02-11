<?php
/*
In this example, we retrieve all posts with the post type 'services_offered'
We use get_post_meta() to retrieve the meta data we want.
*/

//Variable from the user selecting a custom post type - button clicked, drop down menu etc.
$post_type = "services_offered";

function get_metadata_by_post_type($post_type){
    //Sanitized post name string before entering into SQL query.
    $post_type_sanitized = filter_var($post_type, FILTER_SANITIZE_STRING);

    $output_string = "";
    global $wpdb;
    
    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_type = %s",
        $post_type
    );
    //Returns array of objects from SQL statement.
    $results = $wpdb->get_results($stmt);
    foreach($results as $entry){
        //Escape all output from the database with htmlspecialchars
        //Here we print the POST TITLE for each result from the query
        $output_string .= "<h1>" . htmlspecialchars($entry->post_title) . "</h1>";
        //Get post meta allows us to get specific post meta by POST ID and META KEY.
        //In the parameters for get_post_meta, TRUE returns a single value, FALSE returns an array.
        $output_string .= "<p>PRICES FROM: $";
        $output_string .=  htmlspecialchars(get_post_meta($entry->ID, 'price_from', true)) . "</p>";
        $output_string .= "<p>" . htmlspecialchars(get_post_meta($entry->ID, 'our_promise', true)) . "</p>";

    }
    
    return $output_string;
}

/*
NOTE: You can use %d or %f if you have an integer or float to pass in to your prepared statements using WPDB->prepare.
*/