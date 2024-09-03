<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use App\Models\StoryCategory;


class SuccessStoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = SuccessStory::published()->get();
        $categories = StoryCategory::published()->get();

        return view('site.success-stories.index', compact('stories','categories'));
    }

    public function show($slug)
    {
        $story = SuccessStory::where('slug', $slug)->first();


        // $story = Cache::remember('published-story-'.$slug, 1440, function () use ($slug) {
        //    return SuccessStory::where('slug', $slug)->first();
        // });

        // if (app()->environment() === 'production') {
        //     views($story)->record();
        // }

        //$recent_posts = Cache::remember('recent-posts-'.$post->id, 60, function () use ($post) {
        //     return Post::where('published', true)
        //         ->whereNotIn('id', [$post->id])
        //         ->orderByUniqueViews()
        //         ->take(4)
        //         ->get();
        // });

        views($story)->record();

        $viewcount = views($story)->unique()->remember()->count();

        $stories = SuccessStory::published()->orderBy('id', 'DESC')->paginate(6);

        return view('site.success-stories.show', compact('story', 'viewcount','stories'));
    }
}
