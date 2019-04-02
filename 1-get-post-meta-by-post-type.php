<?php
/*
* PREPARED STATEMENTS
* WP_QUERY adn other API functions are usually enough in WP development.
* Use $wpdb when you needto create more advanced queries often using multiple tables with joins.
*/


/*
*/

/*
* Search for posts for a given type, return an HTML string with details for each post.
* 
* @ param $post_type 
* @ param $meta_data is the meta data required
* @ return string: a string containing HTML.
*/

$post_type = 'services_offered';
$meta_keys = array( 'price_from', 'our_promise' );

function get_post_data_metadata($post_type, $meta_keys){
    $post_type_sanitized = esc_sql( $post_type ); // Escape for sql query. Not strictly necessary as using $wpdb->preprare()

    $output_string = "";
    global $wpdb;
    
    // NOTE: %s signifies a string in prepared statements.
    // NOTE: You can use %d for integers, %f for floats in your prepared statements.
    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_type = %s", 
        $post_type_sanitized
    );
    
    $results = $wpdb->get_results( $stmt ); //Returns array of objects

    foreach($results as $entry){
        $output_string .= "<h1>" . esc_html( $entry->post_title ) . "</h1>"; //Escape all output 
        $output_string .= "<p>PRICES FROM: $";
        //TRUE parameter in get_post_meta() means you expect a single result.
        foreach($meta_keys as $meta_key){
            $meta_key_cleaned = esc_html($meta_key);
            $output_string .= "<p>" . esc_html( get_post_meta( $entry->ID, $meta_key_cleaned, true ));
        }
    
    }
    
    return $output_string;
}

/* 
* This is ONLY intended as a simple example of using $wpdb->prepare
* Use $wpdb for more bespoke queries using joins, inner joins etc.
* Use $query = new WPQuery( $args ) for basic queries like this!
*/