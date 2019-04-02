<?php
/*
* PREPARED STATEMENTS
* WP_QUERY and other API functions are usually enough in WP development.
* Use $wpdb when you needto create more advanced queries often using multiple tables with joins.
*/

class PostQuantityCounter{
    /*
    * @ no params
    * returns array - joins 3 tables to find how many posts there are for each term type
    * 'custom_post_type' is example of potential user input - made safe with prepared statements.
    */

    public function count_posts_per_category(){
        global $wpdb;
        $query = $wpdb->prepare( 
            "SELECT COUNT(ID), name
            FROM wp_posts, wp_terms, wp_term_relationships
            WHERE wp_posts.post_type != %s
            AND wp_posts.ID = wp_term_relationships.object_id
            AND wp_terms.term_id = wp_term_relationships.term_taxonomy_id
            GROUP BY wp_terms.name",
            'custom_post_type' 
        );
        $num_posts_per_category = $wpdb->get_results( $query ); //get array of results

        return $num_posts_per_category;

    }

}

$post_quantity_counter = new PostQuantityCounter();
$result = $post_quantity_counter->count_posts_per_category(); //returns array showing how many IDs match each term.