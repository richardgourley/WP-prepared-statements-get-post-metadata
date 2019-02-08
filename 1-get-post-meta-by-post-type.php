<?php
/*
In this example, we retrieve all posts with the post type 'services_offered'
Then we print the metadata for each post below the title.
*/

function get_metadata_by_post_type(){
        global $wpdb;
        $output_string = "";
        $stmt = $wpdb->prepare(
            "SELECT * FROM wp_posts WHERE post_type = %s",
            'services_offered'
        );
        //Returns array of objects from SQL statement.
        $results = $wpdb->get_results($stmt);
        foreach($results as $entry){
            $output_string .= "<h1>" . htmlspecialchars($entry->post_title) . "</h1>";
            //Use the ID from each entry to get post meta.
            $metadata = get_post_meta($entry->ID);
            //Escaped output from the database with htmlspecialchars
            $output_string .=  "<p>Prices from: $" . htmlspecialchars($metadata['price_from'][0]) . "</p>";
            $output_string .=  "<p>Our promise: " . htmlspecialchars($metadata['our_promise'][0]) . "</p>";
        }
    
        return $output_string;
    }

/*
NOTE: You can use %d or %f if you have an integer or float to pass in to your prepared statements using WPDB->prepare.
*/