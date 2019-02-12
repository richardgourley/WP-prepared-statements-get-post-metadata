<?php
/*
In this example, we show how you can access post meta during the WORDPRESS LOOP.
We then place the title, content and post meta into an array for each post.
Then we add this to a 'master array' which we can then localize into a js file or use the data for bespoke front end creation.
*/

//Here we have the Wordpress loop found in archive pages and the index page.

/* Start the Loop */
    //Here we set our master array - it will be an array of arrays for each post
    $master_array = [];
    while ( have_posts() ) :
        //the_post() acts as an iterator, looping through each post
        the_post();
        //We make $post obj global so we can access properties
        global $post;
        //Here we get the id/
        $id = $post->ID;
        
        //We create an associative array for this post
        $this_arr = [];
        $this_arr['id'] = $id;
        $this_arr['title'] = $post->post_title;
        //Here we get the meta data for the keys we want.
        $this_arr['our_promise'] = get_post_meta($id, 'our_promise', true);
        $this_arr['price_from'] = get_post_meta($id, 'price_from', true);
        $this_arr['content'] = $content;
        //We add this_arr to our master array.
        $master_array[] = $this_arr;
            
        
        //get_template_part( 'template-parts/post/content', get_post_format() );

        endwhile;

/*
HERE we can now use our $master_array for various bespoke page creation.
*/