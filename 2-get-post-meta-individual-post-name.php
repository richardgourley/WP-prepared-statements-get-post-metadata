<?php
$post_name = 'Painting'; //Example variable from user input.
/*
* Search for matching post name, return an HTML string with details for this individual post.
* 
* @ param $post_name is passed in to our MySQL query.
* @ return string: a string containing HTML.
* 
* NOTE: %s signifies a string in prepared statements.
* NOTE: You can use %d for integers, %f for floats in your prepared statements.
*/
function get_metadata_individual_post($post_name){
    $post_name_sanitized = filter_var($post_name, FILTER_SANITIZE_STRING); //Sanitize input parameter.
        
    $output_string = "";
    global $wpdb;

    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_title = %s",
        $post_name_sanitized
    );
    
    $result = $wpdb->get_row($stmt); //Use get row when you expect 1 row as a result.
   
    $output_string .= "<h1>" . htmlspecialchars($result->post_title) . "</h1>"; //Escape all output 
    
    $output_string .= "<p>PRICES FROM: $";
    //TRUE parameter in get_post_meta() means you expect a single result.
    $output_string .=  htmlspecialchars(get_post_meta($result->ID, 'price_from', true)) . "</p>";
    $output_string .= "<p>" . htmlspecialchars(get_post_meta($result->ID, 'our_promise', true)) . "</p>";

    return $output_string;

}

