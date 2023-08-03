<?php

declare(strict_types=1);

namespace App\Libraries;



class WordPress
{
    // Default query settings taken from WordPress
    protected $query_defaults = array(
		'numberposts'      => 5,
		'category'         => 0,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => array(),
		'exclude'          => array(),
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'suppress_filters' => true,
	);
    function __construct()
    {
		define('WP_USE_THEMES', false);
        // Replace this with the folder where you have WordPress already installed
		require_once(APPPATH . '../wordpress/wp-load.php');
    }
    // Fetch Posts
    function get_posts($args = null) {
        // Get defaults
        $actual_args = $this->query_defaults;
        // Override only the necessary ones
        if(is_array($args)) {
            foreach($args as $key => $val) {
                if($val != $actual_args[$key]) {
                    $actual_args[$key] = $val;
                }
            }
        }
        // Defaults
        $parsed_args['ignore_sticky_posts'] = true;
        $parsed_args['no_found_rows']       = true;
        // WordPress query
        $get_posts = new \WP_Query();
        return $get_posts->query( $parsed_args );
    }
    // Get Post by ID
    function get_post_by_id($id) {
        return get_post($id);
    }
    // Get Post by Name (slug)
    function get_post_by_name($name) {
        return get_page_by_path($name, "OBJECT", "post");
    }
}