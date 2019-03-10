<?php
/*
* On archive pages or index we can use the WP loop to get details and post meta data.
* We get details from each post in the loop.
* The code below results in an ARRAY of POST ARRAYS.
*/

$array_of_post_details = []; //Set an array to hold arrays of post details.

while ( have_posts() ) :
    the_post(); //the_post() acts as an iterator, looping through each post

    global $post; //We make $post obj global so we can access properties

    $this_post = []; //We set an array for this post
        
    $this_post['id'] = esc_html( $post->ID );
    $this_post['title'] = esc_html( $post->post_title );
    $this_post['content'] = esc_html( $post->post_content ) ;
 
    //Get meta data and add to our array
    $this_post['our_promise'] = esc_html( get_post_meta($id, 'our_promise', true ));
    $this_post['price_from'] = esc_html( get_post_meta($id, 'price_from', true ));

    $array_of_post_details[] = $this_post; //Add $this_post to our master array.

endwhile;

//Instead of calling get_template_part() here, we can create a bespoke archive page or unique index page.
