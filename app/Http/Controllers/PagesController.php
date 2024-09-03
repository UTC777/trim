<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Models\Post;
use App\Models\SuccessStory;
use App\Models\Seenon;
use App\Models\Testimonial;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function show(ContentPage $page)
    {
        $slug = basename(request()->path());

        if ($slug) {
            $page = Cache::remember("content_page_slug_{$slug}", now()->addWeek(), function () use ($slug) {
                return ContentPage::where('slug', $slug)->first();
            });
        } else {
            $page = Cache::remember('content_page_homepage', now()->addWeek(), function () {
                return ContentPage::where('is_homepage', 1)->first();
            });
        }

        if ($page) {
            if ($page->is_homepage == 1) {
                $page = Cache::remember('content_page_homepage', now()->addWeek(), function () {
                    return ContentPage::where('is_homepage', 1)->first();
                });
            } elseif ($page->path_segments == 0) {
                $page = Cache::remember("content_page_slug_{$slug}", now()->addWeek(), function () use ($slug) {
                    return ContentPage::where('slug', $slug)->first();
                });
            } elseif ($page->path_segments == 1) {
                $page = Cache::remember("content_page_path_1_{$slug}", now()->addWeek(), function () use ($slug) {
                    return ContentPage::where('slug', $slug)->where('path', request()->segment(1))->first();
                });
            } elseif ($page->path_segments == 2) {
                $page = Cache::remember("content_page_path_2_{$slug}", now()->addWeek(), function () use ($slug) {
                    return ContentPage::where('slug', $slug)->where('path', request()->segment(1))->where('path2', request()->segment(2))->first();
                });
            } elseif ($page->path_segments == 3) {
                $page = Cache::remember("content_page_path_3_{$slug}", now()->addWeek(), function () use ($slug) {
                    return ContentPage::where('slug', $slug)->where('path', request()->segment(1))->where('path2', request()->segment(2))->where('path3', request()->segment(3))->first();
                });
            } elseif ($page->path_segments == 4) {
                $page = Cache::remember("content_page_path_4_{$slug}", now()->addWeek(), function () use ($slug) {
                    return ContentPage::where('slug', $slug)->where('path', request()->segment(1))->where('path2', request()->segment(2))->where('path3', request()->segment(3))->where('path4', request()->segment(4))->first();
                });
            }
        } else {
            return abort(404);
        }

        if (empty($page)) {
            return abort(404);
        }

        $testimonials = Cache::remember('testimonials', now()->addDay(), function () {
            return Testimonial::published()->latest()->take(12)->get();
        });

        $latest_posts = Cache::remember('latest_posts', now()->addDay(), function () {
            return Post::published()->latest()->take(12)->get();
        });

        $success_stories = Cache::remember('success_stories', now()->addDay(), function () {
            return SuccessStory::published()->latest()->take(12)->get();
        });

        $services = Cache::remember('services', now()->addDay(), function () {
            return Service::published()->latest()->take(12)->get();
        });

        $seenons = Cache::remember('seenons', now()->addDay(), function () {
            return Seenon::published()->latest()->get();
        });

        return view('site.contentpage.show', compact('page', 'testimonials', 'latest_posts', 'success_stories', 'seenons', 'services'));
    }
}
