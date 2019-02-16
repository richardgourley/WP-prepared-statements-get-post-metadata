<?php
/*
In this example, we show how you can access post meta during the WORDPRESS LOOP.
*/

    //Set an array to hold arrays of post details.
    $array_of_post_details = [];
    //Start the loop (found in archive pages, index page)
    while ( have_posts() ) :
        //the_post() acts as an iterator, looping through each post
        the_post();

        //We make $post obj global so we can access properties
        global $post;

        //We set an array for this post
        $this_post = [];
        
        //Add id, post title and post content to array
        $this_post['id'] = $post->ID;
        $this_post['title'] = $post->post_title;
        $this_post['content'] = $post->post_content;

        //Here we get the meta data for the keys we want.
        $this_post['our_promise'] = get_post_meta($id, 'our_promise', true);
        $this_post['price_from'] = get_post_meta($id, 'price_from', true);

        //We add $this_post to our master array.
        $array_of_post_details[] = $this_post;
            
        
        //Instead of calling get_template_part() here, we can create a bespoke archive page or unique index page.

        endwhile;

/*
Now we can use our $array_of_post_details array for bespoke page creation.
*/