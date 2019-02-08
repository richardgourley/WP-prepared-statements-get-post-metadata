<?php
/*
In this example, we retrieve ONE row matching the post_name variable (user input).
Then we print the metadata for the post result.
*/

//User input string selected by user, button drop down menu etc.
$post_name = 'Painting';

function get_metadata_individual_post(){
        global $post_name;
        //Sanitized post name srting before entering into SQL query.
        $post_name_sanitized = filter_var($post_name, FILTER_SANITIZE_STRING);
        
        $output_string = "";
        global $wpdb;

        $stmt = $wpdb->prepare(
            "SELECT * FROM wp_posts WHERE post_title = %s",
            $post_name_sanitized
        );
        //Use get row when you expect 1 row as a result.
        $result = $wpdb->get_row($stmt);
        $output_string .= "<h1>" . htmlspecialchars($result->post_title) . "</h1>";
        //Use the ID from each entry to get post meta.
        $metadata = get_post_meta($result->ID);
        //Escaped output from the database with htmlspecialchars
        $output_string .=  "<p>Prices from: $" . htmlspecialchars($metadata['price_from'][0]) . "</p>";
        $output_string .=  "<p>Our promise: " . htmlspecialchars($metadata['our_promise'][0]) . "</p>";
        
    
        return $output_string;

    }

/*
NOTE: You can use %d or %f if you have an integer or float to pass in to your prepared statements using WPDB->prepare.
*/