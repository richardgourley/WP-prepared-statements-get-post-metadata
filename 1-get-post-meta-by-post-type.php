<?php
$post_type = "services_offered"; //Example variable from user input.

/*
* Loop through posts for a given post type, return an HTML string with details for each post.
* 
* @ param $post_type is any selected post type to be looped.
* @ return string: a string containing HTML.
* 
* NOTE: %s signifies a string in prepared statements.
* NOTE: You can use %d for integers, %f for floats in your prepared statements.
*/
function get_metadata_by_post_type($post_type){
    $post_type_sanitized = filter_var($post_type, FILTER_SANITIZE_STRING); //Sanitize input parameter.

    $output_string = "";
    global $wpdb;
    
    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_type = %s", 
        $post_type_sanitized
    );
    
    $results = $wpdb->get_results($stmt); //Returns array of objects

    foreach($results as $entry){
        $output_string .= "<h1>" . htmlspecialchars($entry->post_title) . "</h1>"; //Escape all output 
        $output_string .= "<p>PRICES FROM: $";
        //TRUE parameter in get_post_meta() means you expect a single result.
        $output_string .=  htmlspecialchars(get_post_meta($entry->ID, 'price_from', true)) . "</p>"; 
        $output_string .= "<p>" . htmlspecialchars(get_post_meta($entry->ID, 'our_promise', true)) . "</p>";
    }
    
    return $output_string;
}
