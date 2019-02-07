<?php
/*
In this example, in our function we first search by post type using prepared SQL statements with WPDB->prepare and then using WPDB->get_results to execute the statement, returning the results.
Then we add the post title for each entry to our output string.
Then we get the post meta data for each entry and add the meta data to our output string.
*/

function get_metadata_by_post_type(){
    global $wpdb;
    $output_string = "";
    $stmt = $wpdb->prepare(
        "SELECT * FROM wp_posts WHERE post_type = %s",
        'services_offered'
    );
        $results = $wpdb->get_results($stmt);
    foreach($results as $entry){
        $output_string .= "<h1>$entry->post_title</h1>";
        $metadata = get_post_meta($entry->ID);
        $output_string .=  "<p>Prices from: $" . $metadata['price_from'][0] . "</p>";
        $output_string .=  "<p>Our promise: " . $metadata['our_promise'][0] . "</p>";
    }
    
    return $output_string;
}

/*
NOTE: You can use %d or %f if you have an integer or float to pass in to your prepared statements using WPDB->prepare.
*/