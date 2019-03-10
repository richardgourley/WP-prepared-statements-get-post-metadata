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

$post_name = 'Painting'; //Example variable from user input.

function get_metadata_individual_post($post_name){
    $post_name_sanitized = esc_sql( $post_type ); // Escape for sql query. Not strictly necessary as using $wpdb->preprare()
        
    $output_string = "";
    global $wpdb;

    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_title = %s",
        $post_name_sanitized
    );
    
    $result = $wpdb->get_row( $stmt ); //Use get row when you expect 1 row as a result.
   
    $output_string .= "<h1>" . esc_html( $result->post_title ) . "</h1>"; //Escape all output 
    
    $output_string .= "<p>PRICES FROM: $";
    //TRUE parameter in get_post_meta() means you expect a single result.
    $output_string .=  esc_html( get_post_meta($result->ID, 'price_from', true )) . "</p>";
    $output_string .= "<p>" . esc_html( get_post_meta($result->ID, 'our_promise', true )) . "</p>";

    return $output_string;

}

/* 
* This is ONLY intended as a simple example of using $wpdb->prepare
* Use $wpdb for more bespoke queries using joins, inner joins etc.
* Use $query = new WPQuery( $args ) for basic queries like this!
*/
