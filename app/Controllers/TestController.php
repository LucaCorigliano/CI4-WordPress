<?php

namespace App\Controllers;
use App\Libraries\WordPress;

class TestController extends BaseController
{
    public function index()
    {
        $wp = new WordPress();
        $posts = $wp->get_posts();

        return view('blog_index', ["posts" => $posts]);
    }
    public function article($slug) {
        $wp = new WordPress();
        $article = $wp->get_post_by_name($slug);

        return view('blog_article', ["posts" => $article]);     
    }
}
