<?php

namespace App\Observers;

use App\Models\StaticSeo;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class StaticSeoObserver implements ShouldHandleEventsAfterCommit
{
    public function creating(StaticSeo $staticSeo)
    {
        if ($staticSeo->meta_title) {
            if (strlen($staticSeo->meta_title) >= 30 && strlen($staticSeo->meta_title) <= 60) {
                $staticSeo->meta_title_check = 1;
            }
        }

        if ($staticSeo->facebook_title) {
            if (strlen($staticSeo->facebook_title) >= 30 && strlen($staticSeo->facebook_title) <= 60) {
                $staticSeo->facebook_title_check = 1;
            }
        }

        if ($staticSeo->twitter_title) {
            if (strlen($staticSeo->twitter_title) >= 30 && strlen($staticSeo->twitter_title) <= 60) {
                $staticSeo->twitter_title_check = 1;
            }
        }

        if ($staticSeo->meta_description) {
            if (strlen($staticSeo->meta_description) >= 120 && strlen($staticSeo->meta_description) <= 320) {
                $staticSeo->meta_desc_check = 1;
            }
        }

        if ($staticSeo->facebook_description) {
            if (strlen($staticSeo->facebook_description) >= 120 && strlen($staticSeo->facebook_description) <= 320) {
                $staticSeo->facebook_desc_check = 1;
            }
        }

        if ($staticSeo->twitter_description) {
            if (strlen($staticSeo->twitter_description) >= 120 && strlen($staticSeo->twitter_description) <= 320) {
                $staticSeo->twitter_desc_check = 1;
            }
        }
    }

    public function updating(StaticSeo $staticSeo)
    {
        if ($staticSeo->meta_title) {
            if (strlen($staticSeo->meta_title) >= 30 && strlen($staticSeo->meta_title) <= 60) {
                $staticSeo->meta_title_check = 1;
            }
        }

        if ($staticSeo->facebook_title) {
            if (strlen($staticSeo->facebook_title) >= 30 && strlen($staticSeo->facebook_title) <= 60) {
                $staticSeo->facebook_title_check = 1;
            }
        }

        if ($staticSeo->twitter_title) {
            if (strlen($staticSeo->twitter_title) >= 30 && strlen($staticSeo->twitter_title) <= 60) {
                $staticSeo->twitter_title_check = 1;
            }
        }

        if ($staticSeo->meta_description) {
            if (strlen($staticSeo->meta_description) >= 120 && strlen($staticSeo->meta_description) <= 320) {
                $staticSeo->meta_desc_check = 1;
            }
        }

        if ($staticSeo->facebook_description) {
            if (strlen($staticSeo->facebook_description) >= 120 && strlen($staticSeo->facebook_description) <= 320) {
                $staticSeo->facebook_desc_check = 1;
            }
        }

        if ($staticSeo->twitter_description) {
            if (strlen($staticSeo->twitter_description) >= 120 && strlen($staticSeo->twitter_description) <= 320) {
                $staticSeo->twitter_desc_check = 1;
            }
        }
    }
}
