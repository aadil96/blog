<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wink\WinkPost;
use Wink\WinkTag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = WinkPost::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC');
        // ->simplePaginate(12);

        $tags = WinkTag::limit(3)->pluck('name')->toArray();

        if ( request()->has('tag') ) {
            $posts = WinkTag::where('name', request('tag'))
                ->first()
                ->posts()
                ->live()
                ->orderBy('publish_date', 'DESC');
        }

        $posts = $posts->simplePaginate(15);

//        $featured = $posts->where('featured_image', '!==', null)->first();

        return view('index', compact('posts', 'tags'));
    }

    public function show($slug)
    {
        $post = WinkPost::with('tags')
            ->live()
            ->whereSlug($slug)
            ->firstOrFail();
        $tags = WinkTag::limit(3)->pluck('name')->toArray();
        return view('show', compact('post', 'tags'));
    }
}
