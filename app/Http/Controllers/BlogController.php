<?php

namespace App\Http\Controllers;

use Wink\WinkPost;
use Wink\WinkTag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = WinkPost::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC');

        // $tags = WinkTag::limit(3)->pluck('name')->toArray();

        if (request()->has('tag')) {
            $posts = $this->filterByTag(request('tag'));
        }

        $posts = $posts->simplePaginate(5);

        return view('index', compact('posts'));
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

    protected function filterByTag($tag)
    {
        return WinkTag::where('name', $tag)
            ->first()
            ->posts()
            ->live()
            ->orderBy('publish_date', 'DESC');
    }
}
